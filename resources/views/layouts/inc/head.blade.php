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

@stack('stylesheets')

{{-- fontawesome cdn --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<livewire:styles />
<link rel="stylesheet" href="{{ asset('backend/dist/css/custom.css') }}">
