<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WithdrawMethodStoreRequest;
use App\Models\WithdrawMethod;
use App\Services\NotificationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
