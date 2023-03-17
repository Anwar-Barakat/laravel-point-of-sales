<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="{{ asset('backend/dist/css/tabler.min.css?1674944402') }}" rel="stylesheet" />
    <link href="{{ asset('backend/dist/css/tabler-flags.min.css?1674944402') }}" rel="stylesheet" />
    <link href="{{ asset('backend/dist/css/tabler-payments.min.css?1674944402') }}" rel="stylesheet" />
    <link href="{{ asset('backend/dist/css/tabler-vendors.min.css?1674944402') }}" rel="stylesheet" />
    <link href="{{ asset('backend/dist/css/demo.min.css?1674944402') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('backend/dist/css/custom.css') }}">
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="" class="navbar-brand navbar-brand-autodark">
                    <img src="{{ asset('backend/static/logo.svg') }}" style="height: 36px;">
                </a>
            </div>
            <div class="card card-md">
                <div class="card-body">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('backend/dist/js/tabler.min.js') }}" defer></script>
    <script src="{{ asset('backend/dist/js/demo.min.js') }}" defer></script>
    <script src="{{ asset('backend/dist/js/demo-theme.min.js') }}"></script>
</body>

</html>
