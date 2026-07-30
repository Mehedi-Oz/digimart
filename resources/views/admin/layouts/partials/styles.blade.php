{{-- Tabler UI CSS --}}
<link href="{{ asset('assets/admin/css/tabler.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/admin/css/tabler-flags.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/admin/css/tabler-payments.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/admin/css/tabler-vendors.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/admin/css/demo.min.css') }}" rel="stylesheet" />

{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

{{-- Tabler Icons --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tabler-icons/3.21.0/tabler-icons.min.css"
    integrity="sha512-XrgoTBs7P5YtpkeKqKOKkruURsawIaRrhe8QrcWeMnFeyRZiOcRNjBAX+AQeXOvx9/9fSY32dVct1PccRoCICQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

{{-- Inter Font --}}
<link rel="preconnect" href="https://rsms.me">
<link rel="stylesheet" href="https://rsms.me/inter/inter.css">

{{-- Theme Overrides --}}
<style>
    :root {
        --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
    }

    body {
        font-feature-settings: "cv03", "cv04", "cv11";
    }
</style>

{{-- Custom Css --}}
<link href="{{ asset('assets/admin/css/custom.css') }}" rel="stylesheet" />
