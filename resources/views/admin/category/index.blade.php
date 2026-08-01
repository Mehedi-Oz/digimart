@extends('admin.layouts.master')

@section('title')
    {{ __('All Categories') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('All Categories') }}</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.category.create') }}" class="btn btn-primary btn-3">
                                <i class="ti ti-plus"></i>
                                {{ __('Create Category') }}
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
                                            <th>{{ __('Icon') }}</th>
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('File Types') }}</th>
                                            <th>{{ __('Date') }}</th>
                                            <th class="w-1">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><i class="{{ $category->icon }}"></i></td>
                                                <td class="text-secondary">{{ $category->name }}</td>
                                                 <td class="text-secondary">
                                                     @if (is_array($category->file_types))
                                                         @foreach ($category->file_types as $file_type)
                                                             <span class="badge bg-primary text-primary-fg">{{ $file_type }}</span>
                                                         @endforeach
                                                     @endif
                                                 </td>
                                                <td class="text-secondary">{{ formatDate($category->created_at) }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <a href="{{ route('admin.category.edit', $category->id) }}">
                                                            <i class="ti ti-edit"></i></a>
                                                        <a class="delete-item text-danger"
                                                            href="{{ route('admin.category.destroy', $category->id) }}">
                                                            <i class="ti ti-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
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
 