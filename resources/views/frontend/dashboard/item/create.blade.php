@extends('frontend.dashboard.layouts.master')

@section('title')
    {{ __('Items') }}
@endsection

@section('content')
    <div class="wsus__dash_order_table">
        <div class="d-flex align-item-center justify-content-between">
            <div>
                <h5>{{ __('New Item') }}</h5>
                <p>{{ __('Create a new Item') }}</p>
            </div>
            <div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    {{ __('Back') }}
                </button>
            </div>
        </div>
    </div>
    <div class="wsus__dash_order_table mt-3">
        <div>
            <h6>{{ __('Name & Description') }}</h6>
        </div>
        <hr>
        <form action="">
            <div class="col-md-12">
                <x-frontend.input-text name="name" label="{{ __('Name') }}"
                    placeholder="{{ __('enter your name') }}" required />
                <x-frontend.text-area id="default-editor" name="description" label="{{ __('Description') }}"
                    placeholder="{{ __('description') }}" required />
            </div>
        </form>
    </div>
@endsection
