@extends('admin.layouts.master')

@section('title')
    {{ __('Category') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('All Categories') }}</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-3">
                                <i class="ti ti-plus"></i>
                                {{ __('Button Text') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Title</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th class="w-1"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td class="text-secondary"></td>
                                            <td class="text-secondary"><a href="#" class="text-reset"></a></td>
                                            <td class="text-secondary"></td>
                                            <td>
                                                <a href="#">Edit</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
