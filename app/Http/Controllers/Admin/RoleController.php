<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleStoreRequest;
use App\Http\Requests\Admin\RoleUpdateRequest;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $roles = Role::withCount('permissions')->get();
        return view('admin.access-management.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $permissions = Permission::all()->groupBy('group_name');
        return view('admin.access-management.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleStoreRequest $request): RedirectResponse
    {
        $role = Role::create([
            'name' => $request->role,
            'guard_name' => 'admin'
        ]);
        $role->syncPermissions($request->permissions);

        NotificationService::CREATED();
        return redirect()->route('admin.roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role): View
    {
        $permissions = Permission::all()->groupBy('group_name');
        return view('admin.access-management.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateRequest $request, Role $role): RedirectResponse
    {
        $role->name = $request->role;
        $role->save();
        $role->syncPermissions($request->permissions);

        NotificationService::UPDATED();
        return redirect()->route('admin.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role): JsonResponse
    {
        try {
            DB::beginTransaction();

            // remove role from users
            // this will be implemented later

            $role->delete();

            DB::commit();

            NotificationService::DELETED();

            return response()->json(['status' => 'success', 'message' => __('Deleted Successful')], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("an error occurred during deleting role:", ["exception" => $th]);
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 400);
        }
    }
}
