@extends('admin.layouts.master')

@section('title')
    {{ __('Update Role') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Update Role') }}</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-primary btn-3">
                                <i class="ti ti-arrow-left"></i>
                                {{ __('Back') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="role-form" action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="col-12">
                                <x-admin.input-text name="role" :label="__('Role Name')" :placeholder="__('enter role name')" :value="$role->name" />
                            </div>
                            <hr>
                            <div class="row">
                                @foreach ($permissions as $groupName => $permissionItems)
                                    <div class="col-md-4">
                                        <h3>{{ $groupName }}</h3>
                                        @foreach ($permissionItems as $permission)
                                            <x-admin.input-checkbox name="permissions[]" :value="$permission->name" :label="$permission->name"
                                                :checked="$role->hasPermissionTo($permission->name)" />
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" onclick="$('#role-form').submit();"
                            class="btn btn-primary">{{ __('Update Role') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
