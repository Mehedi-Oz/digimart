@extends('admin.layouts.master')

@section('title')
    {{ __('Create Category') }}
@endsection

@push('styles')
    {{-- Tabler IconPicker Css --}}
    <link href="{{ asset('assets/admin/css/ez-icon-picker.css') }}" rel="stylesheet" />
@endpush


@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Create Category') }}</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.category.index') }}" class="btn btn-primary btn-3">
                                <i class="ti ti-plus"></i>
                                {{ __('Back') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label">{{ __('Category Icon') }}</label>
                                    <div class="icon-picker" data-name="icon"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <x-admin.input-text name="name" :label="__('Category Name')" />
                            </div>
                            <div class="col-md-12">
                                <x-admin.input-text name="file_types[]" :label="__('File Types')" data-role="tagsinput"
                                    :hint="__(
                                        'The allowed files to be uploaded as main file: zip, mp4, mp3, png, etc.',
                                    )" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">

                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <!-- Tabler IconPicker js -->
    <script src="{{ asset('assets/admin/js/ez-icon-picker.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            new EzIconPicker.IconPicker({
                selector: '.icon-picker'
            });
        });
    </script>
@endpush
