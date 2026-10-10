@extends('admin.layouts.master')

@section('title')
    {{ __('Withdraw Request Details') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Withdraw Request Details') }}</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.withdraw.requests.index') }}" class="btn btn-primary btn-3">
                                <i class="ti ti-arrow-left"></i>
                                {{ __('Back') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-vcenter card-table table-striped">
                            <tbody>
                                <tr>
                                    <th>{{ __('Author') }}</th>
                                    <td>{{ $withdraw->author?->name ?? __('N/A') }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Amount') }}</th>
                                    <td>{{ currencyPosition($withdraw->amount) }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Payment Method') }}</th>
                                    <td>{{ $withdraw->method }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Method Description') }}</th>
                                    <td style="white-space: pre-line;">{{ $withdrawMethod?->description ?? __('N/A') }}</td>
                                </tr>
                                @if ($withdrawMethod)
                                    <tr>
                                        <th>{{ __('Minimum Amount') }}</th>
                                        <td>{{ currencyPosition($withdrawMethod->minimum_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Maximum Amount') }}</th>
                                        <td>{{ currencyPosition($withdrawMethod->maximum_amount) }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>{{ __('Status') }}</th>
                                    <td>
                                        @if ($withdraw->status == 'pending')
                                            <span
                                                class="badge bg-yellow text-yellow-fg">{{ __('Pending') }}</span>
                                        @elseif($withdraw->status == 'paid')
                                            <span class="badge bg-green text-green-fg">{{ __('Paid') }}</span>
                                        @else
                                            <span
                                                class="badge bg-red text-red-fg">{{ __('Rejected') }}</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Date') }}</th>
                                    <td>{{ formatDate($withdraw->created_at) }}</td>
                                </tr>
                                @if ($withdraw->status == 'pending')
                                    <tr>
                                        <th>{{ __('Action') }}</th>
                                        <td>
                                            <form
                                                action="{{ route('admin.withdraw.requests.update', $withdraw->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <x-admin.input-select name="status" :label="__('Status')">
                                                    <option @selected(old('status', $withdraw->status) == 'pending') value="pending">
                                                        {{ __('Pending') }}
                                                    </option>
                                                    <option @selected(old('status', $withdraw->status) == 'paid') value="paid">
                                                        {{ __('Paid') }}
                                                    </option>
                                                    <option @selected(old('status', $withdraw->status) == 'rejected') value="rejected">
                                                        {{ __('Rejected') }}
                                                    </option>
                                                </x-admin.input-select>
                                                <x-admin.submit-button :label="__('Update')" />
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
