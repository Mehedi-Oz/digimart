<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title')</title>
    <!-- CSS files -->
    @include('admin.layouts.partials.styles')
</head>

<body class="d-flex flex-column">
    
    {{-- Loaded inline to apply theme before render, preventing flash of wrong theme --}}
    <script src="{{ asset('assets/admin/js/demo-theme.min.js') }}"></script>

    <div class="page page-center">
        <div class="container container-tight py-4">
            @yield('content')
        </div>
    </div>

    <!-- Js files -->
    @include('admin.layouts.partials.scripts')
</body>

</html>
