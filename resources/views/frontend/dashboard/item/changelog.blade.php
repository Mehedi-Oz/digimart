@extends('frontend.dashboard.layouts.master')

@section('title')
    {{ __('Item Change Logs') }}
@endsection


@section('content')
    <div class="wsus__dash_order_table">
        <div class="d-flex align-item-center justify-content-between">
            <div>
                <h5>{{ __('Change Logs') }}</h5>
                <p>{{ __('Check Item Logs') }}</p>
            </div>
            <div>
                <!-- Button trigger modal -->
                <a href="{{ route('user.items.index') }}" class="btn btn-primary">{{ __('Back') }}</a>
            </div>
        </div>
    </div>
    <form action="{{ route('user.items.changelog.store', $item->id) }}" method="POST" enctype="multipart/form-data"
        id="item-form">
        @csrf
        @method('POST')

        <ul class="nav nav-pills mt-3">
            <li class="nav-item">
                <a class="nav-link" aria-current="page"
                    href="{{ route('user.items.edit', $item->id) }}">{{ __('Edit Details') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('user.items.changelog', $item->id) }}">{{ __('Change Logs') }}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.items.history', $item->id) }}">{{ __('History') }}</a>
            </li>
        </ul>

        <div class="row">
            <div class="col-md-7">
                @if ($item->status == 'approved')
                    <div class="wsus__dash_order_table mt-3">
                        <div>
                            <h6>{{ __('Add New Log') }}</h6>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <x-frontend.input-text name="version" :label="__('Version')"
                                    placeholder="{{ __('enter your name') }}" :required="true" />
                                <x-frontend.text-area name="description" :label="__('Description')"
                                    placeholder="{{ __('description') }}" :required="true" />
                            </div>
                        </div>
                    </div>
                @else
                    <div class="wsus__dash_order_table mt-3 text-center">
                        <p>{{ __('This item is not approved yet!') }}</p>
                    </div>
                @endif
            </div>
            <div class="col-md-5">
                <div class="wsus__dash_order_table mt-3">
                    <div>
                        <h6></h6>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6"><b>{{ __('ID') }}</b></div>
                        <div class="col-md-6 text-end">{{ $item->id }}</div>
                        <hr style="margin-top: 15px">
                        <div class="col-md-6"><b>{{ __('Name') }}</b></div>
                        <div class="col-md-6 text-end">{{ $item->name }}</div>
                        <hr style="margin-top: 15px">
                        <div class="col-md-6"><b>{{ __('Category') }}</b></div>
                        <div class="col-md-6 text-end">{{ $item->category->name }} / {{ $item->subcategory->name }}</div>
                        <hr style="margin-top: 15px">
                        <div class="col-md-6"><b>{{ __('Status') }}</b></div>
                        <div class="col-md-6 text-end">
                            @if ($item->status == 'approved')
                                <span class="badge bg-success">{{ __('Approved') }}</span>
                            @elseif ($item->status == 'pending')
                                <span class="badge bg-warning">{{ __('Pending') }}</span>
                            @elseif ($item->status == 'soft_reject')
                                <span class="badge bg-secondary">{{ __('Soft Reject') }}</span>
                            @elseif ($item->status == 'hard_reject')
                                <span class="badge bg-danger">{{ __('Hard Reject') }}</span>
                            @elseif ($item->status == 'resubmitted')
                                <span class="badge bg-primary">{{ __('Resubmitted') }}</span>
                            @endif
                        </div>
                        <hr style="margin-top: 15px">
                        <div class="col-md-6"><b>{{ __('Publish Date') }}</b></div>
                        <div class="col-md-6 text-end">{{ formatDate($item->created_at) }}</div>
                        <div class="col-md-12 mt-2">
                            <a class="btn btn-primary w-100"
                                href="{{ route('user.items.download', $item->id) }}">{{ __('Download') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($item->status == 'approved')
        <div class="wsus__dash_order_table mt-3">
            <div class="row">
                <div class="col-md-12">
                    <x-frontend.submit-button :label="__('Create Log')" />
                </div>
            </div>
        </div>
        @endif
    </form>
@endsection
