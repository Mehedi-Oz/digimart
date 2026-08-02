@extends('admin.layouts.master')

@section('title')
    {{ __('All SubCategories') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('All SubCategories') }}</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.sub-categories.create') }}" class="btn btn-primary btn-3">
                                <i class="ti ti-plus"></i>
                                {{ __('Create SubCategories') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table table-striped">
                                    <thead>
                                        <tr>
                                            <th>{{ __('ID') }}</th>
                                            <th>{{ __('Parent Category') }}</th>
                                            <th>{{ __('SubCategory') }}</th>
                                            <th>{{ __('Date') }}</th>
                                            <th class="w-1">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($sub_categories as $sub_category)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $sub_category->category->name }}</td>
                                                <td class="text-secondary">{{ $sub_category->name }}</td>
                                                <td class="text-secondary">{{ formatDate($sub_category->created_at) }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <a href="{{ route('admin.sub-categories.edit', $sub_category->id) }}">
                                                            <i class="ti ti-edit"></i></a>
                                                        <a class="delete-item text-danger"
                                                            href="{{ route('admin.sub-categories.destroy', $sub_category->id) }}">
                                                            <i class="ti ti-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-secondary">
                                                    {{ __('No subcategories found.') }}
                                                </td>
                                            </tr>
                                        @endforelse
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
