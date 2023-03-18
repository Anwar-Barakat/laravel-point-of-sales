<!DOCTYPE html>
<html @if (App::getLocale() == 'ar') dir="rtl" @else dir="ltr" @endif>

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

    @if (App::getLocale() == 'ar')
        <link href="{{ asset('backend/dist/css/tabler.rtl.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('backend/dist/css/tabler-flags.rtl.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('backend/dist/css/tabler-payments.rtl.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('backend/dist/css/tabler-vendors.rtl.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('backend/dist/css/demo.rtl.min.css') }}" rel="stylesheet" />
    @else
        <link href="{{ asset('backend/dist/css/tabler.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('backend/dist/css/tabler-flags.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('backend/dist/css/tabler-payments.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('backend/dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('backend/dist/css/demo.min.css') }}" rel="stylesheet" />
    @endif
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
