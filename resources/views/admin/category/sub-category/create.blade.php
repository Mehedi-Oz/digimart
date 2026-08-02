@extends('admin.layouts.master')

@section('title')
    {{ __('Create SubCategory') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Create SubCategory') }}</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.sub-categories.index') }}" class="btn btn-primary btn-3">
                                <i class="ti ti-arrow-left"></i>
                                {{ __('Back') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.sub-categories.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <x-admin.input-select class="select_2" name="category_id" :label="__('Category')">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </x-admin.input-select>
                                </div>
                                <div class="col-md-12">
                                    <x-admin.input-text name="name" :label="__('SubCategory Name')" />
                                </div>
                            </div>
                            <div>
                                <x-admin.submit-button :label="__('Create SubCategory')" onclick="$('form').submit();" />
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-footer text-end">

                </div>
            </div>
        </div>
    </div>
@endsection
