@extends('admin.layouts.master')

@section('title')
    {{ __('Approved Items') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Approved Items') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Details</th>
                                            <th>Category</th>
                                            <th>Publish Date</th>
                                            <th class="w-1">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($items as $item)
                                            <tr>
                                                <td>#{{ $item->id }}</td>
                                                <td class="text-secondary">
                                                    <div class="d-flex">
                                                        <div class="me-2">
                                                            @if ($item->preview_type == 'image')
                                                                <x-admin.image-preview :src="$item->preview_image" width="60"
                                                                    height="60" />
                                                            @elseif($item->preview_type == 'video')
                                                                <x-admin.image-preview
                                                                    src="{{ asset('default/video.webp') }}" width="60"
                                                                    height="60" />
                                                            @elseif($item->preview_type == 'audio')
                                                                <x-admin.image-preview
                                                                    src="{{ asset('default/audio.webp') }}" width="60"
                                                                    height="60" />
                                                            @endif
                                                        </div>
                                                        <div>
                                                            <div>
                                                                <a href="#" class="text-reset"><b>
                                                                        {{ $item->name }}</b></a>
                                                            </div>
                                                            <div>
                                                                <span>{{ __('Author:') }}</span>
                                                                <span class="text-primary">{{ $item->author->name }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-secondary">
                                                    <div class="d-flex">
                                                        <span class="text-primary">{{ $item->category?->name }}</span> <span
                                                            class="ms-2 me-2">/</span> <span
                                                            class="text-primary">{{ $item->subcategory?->name }}</span>
                                                    </div>
                                                </td>
                                                <td class="text-secondary">{{ formatDate($item->updated_at) }}</td>
                                                <td>
                                                    <a href="{{ route('admin.item-reviews.show', $item->id) }}"
                                                        class="text-primary"><i class="ti ti-eye"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-secondary">
                                                    <span>{{ __('No approved items.') }}</span>
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
