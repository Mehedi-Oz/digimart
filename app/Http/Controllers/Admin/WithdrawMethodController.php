<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WithdrawMethodStoreRequest;
use App\Models\WithdrawMethod;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class WithdrawMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $withdrawMethods = WithdrawMethod::paginate(25);

        return view('admin.withdraw-method.index', compact('withdrawMethods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.withdraw-method.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WithdrawMethodStoreRequest $request): RedirectResponse
    {
        WithdrawMethod::create($request->validated());

        NotificationService::CREATED();

        return to_route('admin.withdrawal-methods.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WithdrawMethod $withdrawal_method): View
    {
        return view('admin.withdraw-method.edit', compact('withdrawal_method'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WithdrawMethodStoreRequest $request, WithdrawMethod $withdrawal_method): RedirectResponse
    {
        $withdrawal_method->update($request->validated());

        NotificationService::UPDATED();

        return to_route('admin.withdrawal-methods.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WithdrawMethod $withdrawal_method)
    {
        try {
            $withdrawal_method->delete();

            NotificationService::DELETED();

            return response()->json(['status' => 'success', 'message' => __('Deleted Successful')], 200);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 400);
        }
    }
}
