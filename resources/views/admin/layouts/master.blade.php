<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title')</title>
    <!-- CSS files -->
    @include('admin.layouts.partials.styles')
    @stack('styles')
</head>

<body>
    {{-- Loaded inline to apply theme before render, preventing flash of wrong theme --}}
    <script src="{{ asset('assets/admin/js/demo-theme.min.js') }}"></script>
    <div class="page">

        <!-- Sidebar -->
        @include('admin.layouts.sidebar')

        <!-- Dynamic Contents -->
        @yield('content')

        <!-- Footer -->
        @include('admin.layouts.footer')
    </div>

    <!-- Js files -->
    @include('admin.layouts.partials.scripts')
    @stack('scripts')
</body>

</html>
