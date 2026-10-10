@extends('admin.layouts.master')

@section('title')
    {{ __('All Withdraw Requests') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('All Withdraw Requests') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('No') }}</th>
                                        <th>{{ __('Author') }}</th>
                                        <th>{{ __('Amount') }}</th>
                                        <th>{{ __('Method') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th class="w-1">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($withdrawRequests as $withdrawRequest)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $withdrawRequest->author?->name ?? __('N/A') }}</td>
                                            <td class="text-secondary">
                                                {{ currencyPosition($withdrawRequest->amount) }}</td>
                                            <td class="text-secondary">{{ $withdrawRequest->method }}</td>
                                            <td>
                                                @if ($withdrawRequest->status == 'pending')
                                                    <span
                                                        class="badge bg-yellow text-yellow-fg">{{ __('Pending') }}</span>
                                                @elseif($withdrawRequest->status == 'paid')
                                                    <span
                                                        class="badge bg-green text-green-fg">{{ __('Paid') }}</span>
                                                @else
                                                    <span
                                                        class="badge bg-red text-red-fg">{{ __('Rejected') }}</span>
                                                @endif
                                            </td>
                                            <td class="text-secondary">
                                                {{ formatDate($withdrawRequest->created_at) }}</td>
                                            <td>
                                                <a
                                                    href="{{ route('admin.withdraw.requests.show', $withdrawRequest->id) }}">
                                                    <i class="ti ti-eye"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-secondary">
                                                {{ __('No withdraw requests found.') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        {{ $withdrawRequests->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
