<base href="/">
<link href="{{ asset('backend/dist/css/tabler.min.css?1674944402') }}" rel="stylesheet" />
<link href="{{ asset('backend/dist/css/tabler-flags.min.css?1674944402') }}" rel="stylesheet" />
<link href="{{ asset('backend/dist/css/tabler-payments.min.css?1674944402') }}" rel="stylesheet" />
<link href="{{ asset('backend/dist/css/tabler-vendors.min.css?1674944402') }}" rel="stylesheet" />
@stack('stylesheets')
@livewireStyles
<link href="{{ asset('backend/dist/css/demo.min.css?1674944402') }}" rel="stylesheet" />
<style>
    @import url('https://rsms.me/inter/inter.css');

    :root {
        --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
    }

    body {
        font-feature-settings: "cv03", "cv04", "cv11";
    }
</style>
