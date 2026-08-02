@extends('admin.layouts.master')

@section('title')
    {{ __('Update SubCategory') }}
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Update SubCategory') }}</h3>
                        <div class="card-actions">
                            <a href="{{ route('admin.sub-categories.index') }}" class="btn btn-primary btn-3">
                                <i class="ti ti-arrow-left"></i>
                                {{ __('Back') }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.sub-categories.update', $sub_category->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <x-admin.input-select class="select_2" name="category_id" :label="__('Category')">
                                        @foreach ($categories as $category)
                                            <option @selected($sub_category->category_id == $category->id) value="{{ $category->id }}">
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </x-admin.input-select>
                                </div>
                                <div class="col-md-12">
                                    <x-admin.input-text name="name" :label="__('SubCategory Name')" :value="$sub_category->name" />
                                </div>
                            </div>
                            <div>
                                <x-admin.submit-button :label="__('Update SubCategory')" onclick="$('form').submit();" />
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
