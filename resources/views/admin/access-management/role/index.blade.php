@extends('admin.layouts.master')

@section('title')
    {{ __('All Roles') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('All Roles') }}</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-3">
                                <i class="ti ti-plus"></i>
                                {{ __('Create Role') }}
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
                                                <th> {{ __('Roles') }}</th>
                                                <th> {{ __('Permissions') }}</th>
                                                <th class="w-1">{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($roles as $role)
                                                <tr>
                                                    <td>{{ $role->name }}</td>
                                                    @if ($role->name === 'super admin')
                                                        <td><span
                                                                class="badge text-bg-primary">{{ __('All Permissions') }}</span>
                                                        </td>
                                                    @else
                                                        <td class="text-secondary">{{ $role->permissions_count }}</td>
                                                    @endif
                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                            @if($role->name === 'super admin')
                                                                <span class="text-muted"><i class="ti ti-edit"></i></span>
                                                                <span class="text-muted"><i class="ti ti-trash"></i></span>
                                                            @else
                                                                <a href="{{ route('admin.roles.edit', $role->id) }}">
                                                                    <i class="ti ti-edit"></i></a>
                                                                <a class="delete-item text-danger"
                                                                    href="{{ route('admin.roles.destroy', $role->id) }}">
                                                                    <i class="ti ti-trash"></i></a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center"> {{ __('No roles found.') }}
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
