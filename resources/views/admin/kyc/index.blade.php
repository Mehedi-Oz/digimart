@extends('admin.layouts.master')

@section('title')
    {{ __('KYC Requests') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('KYC Requests') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table table-striped">
                                <thead>
                                    <tr>
                                        <th> {{ __('Name') }}</th>
                                        <th> {{ __('Email') }}</th>
                                        <th> {{ __('Document Type') }}</th>
                                        <th> {{ __('Status') }}</th>
                                        <th class="w-1">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($kycRequests as $kycRequest)
                                        <tr>
                                            <td>{{ $kycRequest->user->name }}</td>
                                            <td class="text-secondary">{{ $kycRequest->user->email }}</td>
                                            <td class="text-secondary">{{ ucfirst($kycRequest->document_type) }}</td>
                                            <td class="text-secondary">
                                                @php
                                                    $badge = [
                                                        'pending' => 'bg-orange text-orange-fg',
                                                        'approved' => 'bg-green text-green-fg',
                                                        'rejected' => 'bg-red text-red-fg',
                                                    ];
                                                @endphp

                                                <span class="badge {{ $badge[$kycRequest->status] ?? 'bg-secondary' }}">
                                                    {{ $kycRequest->status }}
                                                </span>

                                            </td>

                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <a href="{{ route('admin.kyc.show', $kycRequest->id) }}">
                                                        <i class="ti ti-eye"></i></a>
                                                    <a class="delete-item text-danger"
                                                        href="{{ route('admin.kyc.destroy', $kycRequest->id) }}">
                                                        <i class="ti ti-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center"> {{ __('No kycRequests found.') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        {{ $kycRequests->Links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
