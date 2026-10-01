@extends('admin.layouts.master')

@section('title')
    {{ __('Withdrawal Methods') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Withdrawal Methods') }}</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.withdrawal-methods.create') }}" class="btn btn-primary btn-3">
                                <i class="ti ti-plus"></i>
                                {{ __('Add new ') }}
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
                                            <th>{{ __('Name') }}</th>
                                            <th>{{ __('Minimum Amount') }}</th>
                                            <th>{{ __('Maximum Amount') }}</th>
                                            <th>{{ __('Description') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Date') }}</th>
                                            <th class="w-1">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($withdrawMethods as $withdrawMethod)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="text-secondary">{{ $withdrawMethod->name }}</td>
                                                <td class="text-secondary">
                                                    {{ number_format($withdrawMethod->minimum_amount, 2) }}
                                                </td>
                                                <td class="text-secondary">
                                                    {{ number_format($withdrawMethod->maximum_amount, 2) }}
                                                </td>
                                                <td class="text-secondary">{{ $withdrawMethod->description }}</td>
                                                <td>
                                                    @if($withdrawMethod->status)
                                                        <span class="badge bg-green text-green-fg">{{ __('Active') }}</span>
                                                    @else
                                                        <span class="badge bg-red text-red-fg">{{ __('Inactive') }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-secondary">{{ formatDate($withdrawMethod->created_at) }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <a href="{{ route('admin.withdrawal-methods.edit', $withdrawMethod->id) }}">
                                                            <i class="ti ti-edit"></i></a>
                                                        <a class="delete-item text-danger"
                                                            href="{{ route('admin.withdrawal-methods.destroy', $withdrawMethod->id) }}">
                                                            <i class="ti ti-trash"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center text-secondary">
                                                    {{ __('No withdrawal methods found.') }}
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        {{ $withdrawMethods->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
