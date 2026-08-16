@extends('admin.layouts.master')

@section('title')
    {{ __('Item Details') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Item Details') }}</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.item-reviews.pending') }}" class="btn btn-primary btn-3">
                                <i class="ti ti-arrow-left"></i>
                                {{ __('Back') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-home" type="button" role="tab"
                                            aria-controls="pills-home"
                                            aria-selected="true">{{ __('Item Details') }}</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-profile" type="button" role="tab"
                                            aria-controls="pills-profile" aria-selected="false">{{ __('History') }}</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                            data-bs-target="#pills-contact" type="button" role="tab"
                                            aria-controls="pills-contact" aria-selected="false">{{ __('Status') }}</button>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                        aria-labelledby="pills-home-tab">
                                        <div class="accordion" id="accordion-default">
                                            <div class="accordion-item">
                                                <div class="accordion-header">
                                                    <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse-1-default"
                                                        aria-expanded="true">
                                                        {{ __('Preview') }}
                                                    </button>
                                                </div>
                                                <div id="collapse-1-default" class="accordion-collapse collapse show"
                                                    data-bs-parent="#accordion-default" style="">
                                                    <div class="accordion-body">
                                                        @if ($item->preview_type == 'image')
                                                            <x-admin.image-preview :src="$item->preview_image" width="100%"
                                                                height="500" class="img-fluid" />
                                                        @elseif($item->preview_type == 'video')
                                                            <iframe src="{{ asset($item->preview_video) }}"
                                                                frameborder="0"></iframe>
                                                        @elseif($item->preview_type == 'audio')
                                                            <audio src="{{ asset($item->preview_audio) }}"></audio>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <div class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse-2-default"
                                                        aria-expanded="false">
                                                        {{ __('Screenshots') }}
                                                    </button>
                                                </div>
                                                <div id="collapse-2-default" class="accordion-collapse collapse"
                                                    data-bs-parent="#accordion-default">
                                                    <div class="accordion-body">
                                                        @if ($item->screenshots)
                                                            <div id="carousel-controls" class="carousel slide pointer-event"
                                                                data-bs-ride="carousel">
                                                                <div class="carousel-inner">
                                                                    @foreach ($item->screenshots as $screenshot)
                                                                        <div
                                                                            class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                                                            <x-admin.image-preview :src="$screenshot"
                                                                                width="100%" height="400px"
                                                                                class="img-fluid" />
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                                <a class="carousel-control-prev" href="#carousel-controls"
                                                                    role="button" data-bs-slide="prev">
                                                                    <span class="carousel-control-prev-icon"
                                                                        aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Previous</span>
                                                                </a>
                                                                <a class="carousel-control-next" href="#carousel-controls"
                                                                    role="button" data-bs-slide="next">
                                                                    <span class="carousel-control-next-icon"
                                                                        aria-hidden="true"></span>
                                                                    <span class="visually-hidden">Next</span>
                                                                </a>
                                                            </div>
                                                        @else
                                                            <p class="text-muted">{{ __('No screenshots available') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <div class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse-3-default"
                                                        aria-expanded="false">
                                                        {{ __('Description') }}
                                                    </button>
                                                </div>
                                                <div id="collapse-3-default" class="accordion-collapse collapse"
                                                    data-bs-parent="#accordion-default">
                                                    <div class="accordion-body">
                                                        {!! $item->description !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <div class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse-4-default"
                                                        aria-expanded="false">
                                                        {{ __('Support') }}
                                                    </button>
                                                </div>
                                                <div id="collapse-4-default" class="accordion-collapse collapse"
                                                    data-bs-parent="#accordion-default">
                                                    <div class="accordion-body">
                                                        @if ($item->is_supported == 1)
                                                            <span
                                                                class="badge bg-success text-white">{{ __('Supported') }}</span>
                                                        @else
                                                            <span
                                                                class="badge bg-danger text-white">{{ __('Not Supported') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <div class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse-5-default"
                                                        aria-expanded="false">
                                                        {{ __('Price') }}
                                                    </button>
                                                </div>
                                                <div id="collapse-5-default" class="accordion-collapse collapse"
                                                    data-bs-parent="#accordion-default">
                                                    <div class="accordion-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <x-admin.input-text name="price" :value="$item->price"
                                                                    :label="__('Regular Price')" disabled />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <x-admin.input-text name="discount_price" :value="$item->discount_price"
                                                                    :label="__('Discount Price')" disabled />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <div class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse-6-default"
                                                        aria-expanded="false">
                                                        {{ __('Free Item') }}
                                                    </button>
                                                </div>
                                                <div id="collapse-6-default" class="accordion-collapse collapse"
                                                    data-bs-parent="#accordion-default">
                                                    <div class="accordion-body">
                                                        @if ($item->is_free == 1)
                                                            <span
                                                                class="badge bg-success text-white">{{ __('Free Item') }}</span>
                                                        @else
                                                            <span
                                                                class="badge bg-danger text-white">{{ __('Not Free') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                        aria-labelledby="pills-profile-tab">
                                        @forelse ($item->histories as $history)
                                            <div class="card mt-3">
                                                <div class="card-body">
                                                    <h4>{{ $history->title }}</h6>
                                                        <p>{{ $history->body }}</p>
                                                        <p>{{ __('Status: ') }}{{ Str::replace('_', ' ', $history->status) }}
                                                        </p>
                                                        <hr>
                                                        <span>{{ __('Date: ') }}{{ formatDate($history->created_at) }}</span>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="wsus__dash_order_table mt-3">
                                                {{ __('No Data') }}
                                            </div>
                                        @endforelse
                                    </div>
                                    @if ($item->status == 'pending' || $item->status == 'resubmitted' || admin()->hasRole('super admin'))
                                        <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                            aria-labelledby="pills-contact-tab">
                                            <form action="{{ route('admin.item-reviews.status', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                <x-admin.input-select name="status" :label="__('Status')" id="status">
                                                    <option value="approved" @selected($item->status == 'approved')>
                                                        {{ __('Approved') }}
                                                    </option>
                                                    <option value="soft_rejected" @selected($item->status == 'soft_rejected')>
                                                        {{ __('Soft Rejected') }}</option>
                                                    <option value="hard_rejected" @selected($item->status == 'hard_rejected')>
                                                        {{ __('Hard Rejected') }}</option>
                                                </x-admin.input-select>
                                                <div class="d-none" id="reason">
                                                    <x-admin.input-textarea name="reason" :label="__('Reason')"
                                                        :value="$item->reject_reason" />
                                                </div>
                                                <x-admin.submit-button :label="__('Update')" />
                                            </form>
                                        </div>
                                    @else
                                        <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                            aria-labelledby="pills-contact-tab">
                                            <div class="text-center text-secondary">
                                                {{ __('Item could be soft or hard rejected.') }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card mt-3">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6"><b>{{ __('ID') }}</b></div>
                                            <div class="col-md-6 text-end">{{ $item->id }}</div>
                                            <hr style="margin-top: 5px; margin-bottom: 5px;">
                                            <div class="col-md-2"><b>{{ __('Name') }}</b></div>
                                            <div class="col-md-10 text-end">{{ $item->name }}</div>
                                            <hr style="margin-top: 5px; margin-bottom: 5px;">
                                            <div class="col-md-6"><b>{{ __('Category') }}</b></div>
                                            <div class="col-md-6 text-end">{{ $item->category->name }} /
                                                {{ $item->subcategory->name }}</div>
                                            <hr style="margin-top: 5px; margin-bottom: 5px;">
                                            <div class="col-md-6"><b>{{ __('Status') }}</b></div>
                                            <div class="col-md-6 text-end">
                                                @if ($item->status == 'approved')
                                                    <span class="badge text-white bg-green">{{ __('Approved') }}</span>
                                                @elseif ($item->status == 'pending')
                                                    <span class="badge text-white bg-yellow">{{ __('Pending') }}</span>
                                                @elseif ($item->status == 'soft_reject')
                                                    <span class="badge text-white bg-cyan">{{ __('Soft Reject') }}</span>
                                                @elseif ($item->status == 'hard_reject')
                                                    <span class="badge text-white bg-red">{{ __('Hard Reject') }}</span>
                                                @elseif ($item->status == 'resubmitted')
                                                    <span
                                                        class="badge text-white bg-indigo">{{ __('Resubmitted') }}</span>
                                                @endif
                                            </div>
                                            <hr style="margin-top: 5px; margin-bottom: 5px;">
                                            <div class="col-md-6"><b>{{ __('Publish Date') }}</b></div>
                                            <div class="col-md-6 text-end">{{ formatDate($item->created_at) }}</div>
                                            <div class="col-md-12 mt-2">
                                                @if ($item->demo_link)
                                                    <a class="btn btn-yellow w-100 mb-2"
                                                        href="{{ $item->demo_link }}">{{ __('Demo') }}</a>
                                                @endif

                                                @if ($item->is_main_file_external == 1)
                                                    <a class="btn btn-primary w-100"
                                                        href="{{ $item->main_file }}" target="_blank">{{ __('File Link') }}</a>
                                                @else
                                                    <a class="btn btn-primary w-100"
                                                        href="{{ route('admin.item.download', $item->id) }}" target="_blank">{{ __('Download File') }}</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        'use strict';

        function toggleReason() {
            let status = $('#status').val();
            if (status === 'soft_rejected' || status === 'hard_rejected') {
                $('#reason').removeClass('d-none');
            } else {
                $('#reason').addClass('d-none');
            }
        }
        $('#status').on('change', toggleReason);
        toggleReason();
    </script>
@endpush
