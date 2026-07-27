@extends('admin.layouts.master')

@section('title')
    {{ __('KYC Details') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('KYC Details') }}</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.kyc.index') }}" class="btn btn-primary btn-3">
                                <i class="ti ti-arrow-left"></i>
                                {{ __('Back') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-vcenter card-table table-striped">
                            <tbody>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <td>{{ $kyc->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Email') }}</th>
                                    <td>{{ $kyc->user->email }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Document Type') }}</th>
                                    <td>{{ ucfirst($kyc->document_type) }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Document Number') }}</th>
                                    <td>{{ ucfirst($kyc->document_number) }}</td>
                                </tr>
                                <tr>
                                    <th>{{ __('Document Attachments') }}</th>
                                    <td>
                                        @php
                                            $attachments = json_decode($kyc->documents);
                                        @endphp

                                        @foreach ($attachments as $attachment)
                                            <a
                                                href="{{ route('admin.kyc.download-document', ['kyc_id' => $kyc->id, 'attachment_id' => $loop->index]) }}">{{ __('Attachment') }}
                                                ({{ $loop->iteration }})
                                            </a>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Status') }}</th>
                                    <td>
                                        @php
                                            $badge = [
                                                'pending' => 'bg-orange text-orange-fg',
                                                'approved' => 'bg-green text-green-fg',
                                                'rejected' => 'bg-red text-red-fg',
                                            ];
                                        @endphp

                                        <span class="badge {{ $badge[$kyc->status] ?? 'bg-secondary' }}">
                                            {{ $kyc->status }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>{{ __('Action') }}</th>
                                    <td>
                                        <div>
                                            <form action="{{ route('admin.kyc.status', $kyc->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <x-admin.input-select name="status" label="">
                                                    <option @selected(old('status', $kyc->status) == 'pending') value="pending">
                                                        {{ __('Pending') }}
                                                    </option>
                                                    <option @selected(old('status', $kyc->status) == 'approved') value="approved">
                                                        {{ __('Approved') }}
                                                    </option>
                                                    <option @selected(old('status', $kyc->status) == 'rejected') value="rejected">
                                                        {{ __('Rejected') }}
                                                    </option>
                                                </x-admin.input-select>
                                                <div id="reject_reason" class="{{ $kyc->status === 'rejected' || $errors->has('reject_reason') ? '' : 'd-none' }}">
                                                    <x-admin.input-text-area name="reject_reason"
                                                        :label="__('Reason')" :value="old('reject_reason', $kyc->reject_reason)" />
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer text-end">
                        <x-admin.submit-button :label="__('Update')" onclick="$('form').submit();" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        'use strict';

        $(function() {
            $(document).on('change', '#status', function() {
                if ($(this).val() === 'rejected') {
                    $('#reject_reason').removeClass('d-none');
                } else {
                    $('#reject_reason').addClass('d-none');
                }
            });
        })
    </script>
@endpush
