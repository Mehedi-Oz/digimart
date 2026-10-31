@extends('admin.layouts.master')

@section('title')
    {{ __('Update Hero Section') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Update Hero Section') }}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.hero-section.update', 1) }}" method="POST" class="x-form">
                            @csrf
                            @method('PUT')
                            <x-admin.input-text name="title" :label="__('Title')" :value="$hero?->title" />
                            <x-admin.input-text name="sub_title" :label="__('Sub Title')" :value="$hero?->subtitle" />
                            <x-admin.input-select multiple class="product_select" name="featured_items_one[]" :label="__('Featured Items One')">
                                @foreach ($featuredItemsOne as $item)
                                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                @endforeach
                            </x-admin.input-select>
                            <x-admin.input-select multiple class="product_select_two" name="featured_items_two[]" :label="__('Featured Items Two')">
                                @foreach ($featuredItemsTwo as $item)
                                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                @endforeach
                            </x-admin.input-select>
                        </form>
                    </div>
                    <div class="card-footer text-end">
                        <x-admin.submit-button :label="__('Update')" onclick="$('.x-form').submit();" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        "use strict";

        $(function() {
            $(".product_select").select2({
                ajax: {
                    url: "{{ route('admin.ajax.product-search') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term,
                            page: params.page || 1
                        }
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;

                        return {
                            results: data.results.map(function(item) {
                                var image;
                                if (item.preview_type == 'image') {
                                    image = item.preview_image;
                                } else if (item.preview_type == 'video') {
                                    image = "{{ asset('default/video.webp') }}";
                                } else if (item.preview_type == 'audio') {
                                    image = "{{ asset('default/audio.webp') }}";
                                }

                                return {
                                    id: item.id,
                                    text: item.name,
                                    description: item.description,
                                    image: image,
                                    author: item.author ? item.author.name : ''
                                }
                            }),
                            pagination: {
                                more: data.pagination.more
                            }
                        }
                    },
                    cache: true
                },
                placeholder: "{{ __('Select Product') }}",
                minimumInputLength: 3,
                templateResult: formatProduct,
                templateSelection: formatProductSelection
            });

            $(".product_select_two").select2({
                ajax: {
                    url: "{{ route('admin.ajax.product-search') }}",
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term,
                            page: params.page || 1
                        }
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;

                        return {
                            results: data.results.map(function(item) {
                                var image;
                                if (item.preview_type == 'image') {
                                    image = item.preview_image;
                                } else if (item.preview_type == 'video') {
                                    image = "{{ asset('default/video.webp') }}";
                                } else if (item.preview_type == 'audio') {
                                    image = "{{ asset('default/audio.webp') }}";
                                }

                                return {
                                    id: item.id,
                                    text: item.name,
                                    description: item.description,
                                    image: image,
                                    author: item.author ? item.author.name : ''
                                }
                            }),
                            pagination: {
                                more: data.pagination.more
                            }
                        }
                    },
                    cache: true
                },
                placeholder: "{{ __('Select Product') }}",
                minimumInputLength: 3,
                templateResult: formatProduct,
                templateSelection: formatProductSelection
            });

            function formatProduct(product) {
                if (product.loading) {
                    return product.text;
                }

                var $container = $(
                    "<div class='select2-result-repository clearfix' style='display: flex; align-items: center; gap:10px;'>" +
                    "<div class='select2-result-repository__avatar'><img style='width: 50px; height: 50px; object-fit: cover' src='" + product.image +
                    "' /></div>" +
                    "<div class='select2-result-repository__meta'>" +
                    "<div class='select2-result-repository__title'></div>" +
                    "<div class='select2-result-repository__author'>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
                );

                $container.find(".select2-result-repository__title").text(product.text);
                $container.find(".select2-result-repository__author").text(`Author: ${product.author}`);

                return $container;
            }

            function formatProductSelection(product) {
                return product.text;
            }
        })
    </script>
@endpush
