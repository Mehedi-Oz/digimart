@extends('admin.layouts.master')

@section('title')
    {{ __('All Role Users') }}
@endsection

@section('styles')
    <style>
        .ti {
            font-size: 1.25rem;
        }
    </style>
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('All Role Users') }}</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.role-users.create') }}" class="btn btn-primary btn-3">
                                <i class="ti ti-plus"></i>
                                {{ __('Create Role User') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-vcenter card-table table-striped">
                                        <thead>
                                            <tr>
                                                <th> {{ __('Role Users') }}</th>
                                                <th> {{ __('Email') }}</th>
                                                <th> {{ __('Role') }}</th>
                                                <th class="w-1"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($admins as $admin)
                                                <tr>
                                                    <td>{{ $admin->name }}</td>
                                                    <td class="text-secondary">{{ $admin->email }}</td>
                                                    <td>
                                                        @foreach ($admin->roles as $role)
                                                            <span class="badge text-bg-primary">{{ $role->name }}</span>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                            @if($admin->hasRole('super admin'))
                                                                <span class="text-muted"><i class="ti ti-edit"></i></span>
                                                                <span class="text-muted"><i class="ti ti-trash"></i></span>
                                                            @else
                                                                <a href="{{ route('admin.role-users.edit', $admin->id) }}">
                                                                    <i class="ti ti-edit"></i></a>
                                                                <a class="delete-item text-danger" href="{{ route('admin.role-users.destroy', $admin->id) }}">
                                                                    <i class="ti ti-trash"></i></a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">
                                                        {{ __('No role users found.') }}
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
