@extends('backend.layouts.auth-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Login')

@section('content')
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="{{ route('admin.login.show') }}" class="navbar-brand navbar-brand-autodark"><img src="{{ asset('backend/static/logo.svg') }}" height="36" alt=""></a>
            </div>
            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">Login to your account</h2>
                    @livewire('backend.auth.admin-login')
                </div>
            </div>
        </div>
    </div>
@endsection
