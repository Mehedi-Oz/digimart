<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleUserStoreRequest;
use App\Http\Requests\Admin\RoleUserUpdateRequest;
use App\Models\Admin;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Role;

class RoleUserController extends Controller
{
    private function isSuperAdmin(Admin $admin): bool
    {
        return $admin->hasRole('super admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $admins = Admin::with('roles')->get();
        return view('admin.access-management.role-user.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $roles = Role::all();
        return view('admin.access-management.role-user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleUserStoreRequest $request): RedirectResponse
    {
        $admin = Admin::create($request->safe()->only('name', 'email', 'password'));
        $admin->assignRole($request->role);

        NotificationService::CREATED();
        return redirect()->route('admin.role-users.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $role_user): View|RedirectResponse
    {
        if ($this->isSuperAdmin($role_user)) {
            NotificationService::ERROR(__('You cannot edit super admin user'));
            return to_route('admin.role-users.index');
        }
        $admin = $role_user;
        $roles = Role::all();
        return view('admin.access-management.role-user.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUserUpdateRequest $request, Admin $role_user): RedirectResponse
    {
        if ($this->isSuperAdmin($role_user)) {
            NotificationService::ERROR(__('You cannot edit super admin user'));
            return to_route('admin.role-users.index');
        }

        $role_user->fill($request->safe()->only('name', 'email'));

        if ($request->filled('password')) {
            $role_user->password = $request->password;
        }

        $role_user->save();
        $role_user->syncRoles($request->role);

        NotificationService::UPDATED();
        return redirect()->route('admin.role-users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $role_user): JsonResponse|RedirectResponse
    {
        if ($this->isSuperAdmin($role_user)) {
            NotificationService::ERROR(__('You cannot delete super admin user'));
            return to_route('admin.role-users.index');
        }

        try {
            $role_user->syncRoles([]);
            $role_user->delete();

            NotificationService::DELETED();
            return response()->json(['status' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 500);
        }
    }
}
