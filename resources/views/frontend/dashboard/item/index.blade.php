@extends('frontend.dashboard.layouts.master')

@section('title')
    {{ __('Items') }}
@endsection

@section('content')
    <div class="wsus__dash_order_table">
        <div class="d-flex align-item-center justify-content-between">
            <div>
                <h5>{{ __('My Items') }}</h5>
                <p>{{ __('Manage Your Items') }}</p>
            </div>
            <div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    {{ __('Add Items') }}
                </button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="sn">
                            {{ __('SN') }}
                        </th>
                        <th class="details">
                            {{ __('Details') }}
                        </th>
                        <th class="price">
                            {{ __('Price') }}
                        </th>
                        <th class="p_date">
                            {{ __('Publish Date') }}
                        </th>
                        <th class="status">
                            {{ __('Status') }}
                        </th>
                        <th class="action">
                            {{ __('action') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($items as $item)
                        <tr>
                            <td class="sn">{{ $loop->iteration }}</td>
                            <td class="details">
                                <div class="d-flex">
                                    @if ($item->preview_type == 'image')
                                        <x-frontend.image-preview :src="$item->preview_image" width="60" height="60" />
                                    @elseif($item->preview_type == 'video')
                                        <img src="{{ asset('default/video.webp') }}" alt="">
                                    @elseif($item->preview_type == 'audio')
                                        <img src="{{ asset('default/audio.webp') }}" alt="">
                                    @endif
                                    <div class="ms-3">
                                        <h3>
                                            {{ $item->name }}
                                        </h3>
                                        <div class="d-flex">
                                            <span class="text-primary">{{ $item->category?->name }}</span> <span
                                                class="ms-2 me-2">/</span> <span
                                                class="text-primary">{{ $item->subcategory?->name }}</span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="price">
                                @if ($item->discount_price > 0)
                                    <span>{{ __('Regular Price: ') }}<del>
                                            {{ $item->price }}{{ __(' Taka') }}</del></span>
                                    <span>{{ __('Discount Price: ') }}{{ $item->discount_price }}{{ __(' Taka') }}</span>
                                @else
                                    <span>{{ __('Regular Price: ') }}{{ $item->price }}{{ __(' Taka') }}</span>
                                @endif
                            </td>
                            <td class="p_date">
                                <p>{{ formatDate($item->created_at) }}</p>
                            </td>
                            <td class="status">
                                @if ($item->status == 'pending')
                                    <div class="badge bg-warning">{{ __('Pending') }}</div>
                                @elseif($item->status == 'approved')
                                    <div class="badge bg-success">{{ __('Approved') }}</div>
                                @elseif($item->status == 'soft_rejected')
                                    <div class="badge bg-danger">{{ __('Soft Rejected') }}</div>
                                @elseif($item->status == 'hard_rejected')
                                    <div class="badge bg-danger">{{ __('Hard Rejected') }}</div>
                                @elseif($item->status == 'resubmitted')
                                    <div class="badge bg-primary">{{ __('Resubmitted') }}</div>
                                @endif
                            </td>
                            <td class="action">
                                @if ($item->status == 'approved' || $item->status == 'soft_rejected')
                                    <a href="{{ route('user.items.edit', $item->id) }}"
                                        class="btn btn-sm btn-primary">{{ __('Edit') }}</a>
                                @else
                                    <a href="{{ route('user.items.edit', $item->id) }}"
                                        class="btn btn-sm btn-primary disabled">{{ __('Edit') }}</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <form action="{{ route('user.items.create') }}" method="GET" novalidate>
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title fs-5" id="exampleModalLabel">{{ __('Select Category') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <x-frontend.input-select name="category" :label="__('Category')" class="select_2" :required="true">
                            @foreach ($categories as $category)
                                <option value="{{ $category->slug }}">{{ $category->name }}</option>
                            @endforeach
                        </x-frontend.input-select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelector('#exampleModal form').addEventListener('submit', function(e) {
            const select = this.querySelector('select[name="category"]');
            const existing = this.querySelector('.modal-validation-error');
            if (existing) existing.remove();
            if (!select.value) {
                e.preventDefault();
                const msg = document.createElement('div');
                msg.className = 'modal-validation-error text-danger small mt-1';
                msg.textContent = 'Please select an item in the list.';
                const select2Container = this.querySelector('.select2-container');
                (select2Container || select).after(msg);
            }
        });
    </script>
@endpush
