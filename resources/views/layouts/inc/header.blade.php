<header class="navbar navbar-expand-md navbar-light d-print-none sticky-top">
    <div class="container-xl">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href=".">
                <img src="{{ asset('backend/static/logo.svg') }}" width="110" height="32" alt="Tabler" class="navbar-brand-image">
            </a>
        </h1>
        <div class="navbar-nav flex-row order-md-last">
            <div class="d-none d-md-flex">
                <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                    </svg>
                </a>
                <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                        <path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                    </svg>
                </a>
                <div class="nav-item dropdown d-none d-md-flex me-3">
                    <a href="javascript:;" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 5h7" />
                            <path d="M9 3v2c0 4.418 -2.239 8 -5 8" />
                            <path d="M5 9c0 2.144 2.952 3.908 6.7 4" />
                            <path d="M12 20l4 -9l4 9" />
                            <path d="M19.1 18h-6.2" />
                        </svg>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <a rel="alternate" hreflang="{{ $localeCode }}" class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                @if ($properties['native'] == 'العربية')
                                    <span class="flag flag-country-sy me-1"></span>
                                @else
                                    <span class="flag flag-country-um me-1"></span>
                                @endif
                                <span> {{ $properties['native'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm">
                        <img src="{{ asset('backend/static/avatars/000m.jpg') }}" alt="" class="rounded-full shadow-sm">
                    </span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ Auth::guard('admin')->name }}</div>
                        <div class="mt-1 small text-muted">{{ Auth::guard('admin')->user()->email }}</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="#" class="dropdown-item">{{ __('partials.status') }}</a>
                    <a href="{{ route('admin.setting.profile') }}" class="dropdown-item">{{ __('partials.profile') }}</a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('admin.setting.company') }}" class="dropdown-item">{{ __('partials.settings') }}</a>
                    <a href="{{ route('admin.logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('admin-logout').submit();">{{ __('partials.logout') }}</a>
                    <form id="admin-logout" action="{{ route('admin.logout') }}" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                <ul class="navbar-nav">
                    <!---------------------------
                    General Setting
                    -------------------------!-->
                    <li class="nav-item dropdown {{ request()->routeIs('admin.treasuries.*') || request()->routeIs('admin.settings.*') || request()->routeIs('admin.admins.*') || request()->routeIs('admin.services.*') ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                    <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                {{ __('partials.settings') }}
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <!-- dashboard -->
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('partials.home') }}
                                        </span>
                                    </a>

                                    <!-- services -->
                                    <a class="dropdown-item" href="{{ route('admin.services.index') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-24-hours" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                                                <path d="M4 13a8.094 8.094 0 0 0 3 5.24"></path>
                                                <path d="M11 15h2a1 1 0 0 1 1 1v1a1 1 0 0 1 -1 1h-1a1 1 0 0 0 -1 1v1a1 1 0 0 0 1 1h2"></path>
                                                <path d="M17 15v2a1 1 0 0 0 1 1h1"></path>
                                                <path d="M20 15v6"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('setting.services') }}
                                        </span>
                                    </a>

                                    <!-- treasuries -->
                                    <div class="dropend">
                                        <a class="dropdown-item dropdown-toggle {{ request()->routeIs('admin.treasuries.*') ? 'active' : '' }}" href="javascript:;" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-packages" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M7 16.5l-5 -3l5 -3l5 3v5.5l-5 3z"></path>
                                                    <path d="M2 13.5v5.5l5 3"></path>
                                                    <path d="M7 16.545l5 -3.03"></path>
                                                    <path d="M17 16.5l-5 -3l5 -3l5 3v5.5l-5 3z"></path>
                                                    <path d="M12 19l5 3"></path>
                                                    <path d="M17 16.5l5 -3"></path>
                                                    <path d="M12 13.5v-5.5l-5 -3l5 -3l5 3v5.5"></path>
                                                    <path d="M7 5.03v5.455"></path>
                                                    <path d="M12 8l5 -3"></path>
                                                </svg>
                                            </span>
                                            <span class="nav-link-title">
                                                {{ __('treasury.treasuries') }}
                                            </span>
                                        </a>
                                        <div class="dropdown-menu">
                                            <a href="{{ route('admin.treasuries.index') }}" class="dropdown-item {{ request()->routeIs('admin.treasuries.index') ? 'active' : '' }}">
                                                {{ __('msgs.list', ['name' => __('treasury.treasuries')]) }}
                                            </a>
                                            <a href="{{ route('admin.treasuries.create') }}" class="dropdown-item {{ request()->routeIs('admin.treasuries.create') ? 'active' : '' }}">
                                                {{ __('msgs.create', ['name' => __('treasury.treasury')]) }}
                                            </a>
                                        </div>
                                    </div>

                                    <!-- admins -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.admins.index') ? 'active' : '' }}" href="{{ route('admin.admins.index') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shield-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M11.46 20.846a12 12 0 0 1 -7.96 -14.846a12 12 0 0 0 8.5 -3a12 12 0 0 0 8.5 3a12 12 0 0 1 -.09 7.06"></path>
                                                <path d="M15 19l2 2l4 -4"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('setting.admins') }}
                                        </span>
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <!-- setting -->
                                    <a class="dropdown-item flex items-center gap-1 {{ request()->routeIs('admin.setting.company') ? 'active' : '' }}" href="{{ route('admin.setting.company') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M19 6.873a2 2 0 0 1 1 1.747v6.536a2 2 0 0 1 -1.029 1.748l-6 3.833a2 2 0 0 1 -1.942 0l-6 -3.833a2 2 0 0 1 -1.029 -1.747v-6.537a2 2 0 0 1 1.029 -1.748l6 -3.572a2.056 2.056 0 0 1 2 0l6 3.573h-.029z" />
                                            <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                                        </svg>
                                        {{ __('partials.profile') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!---------------------------
                    Stocks
                    -------------------------!-->
                    <li class="nav-item dropdown {{ request()->routeIs('admin.sections.*') || request()->routeIs('admin.categories.*') || request()->routeIs('admin.units.*') || request()->routeIs('admin.stores.*') || request()->routeIs('admin.items.*') || request()->routeIs('admin.customers.*') ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-warehouse" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M3 21v-13l9 -4l9 4v13"></path>
                                    <path d="M13 13h4v8h-10v-6h6"></path>
                                    <path d="M13 21v-9a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1v3"></path>
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                {{ __('partials.stocks') }}
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <!-- sections -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.sections.index') ? 'active' : '' }}" href="{{ route('admin.sections.index') }}">
                                        {{ __('stock.sections') }}
                                    </a>

                                    <!-- categories -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}"">
                                        {{ __('stock.categories') }}
                                    </a>

                                    <!-- units -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.units.index') ? 'active' : '' }}" href="{{ route('admin.units.index') }}"">
                                        {{ __('stock.units') }}
                                    </a>

                                    <!-- stores -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.stores.index') ? 'active' : '' }}" href="{{ route('admin.stores.index') }}">
                                        {{ __('stock.stores') }}
                                    </a>

                                    <!-- items -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.items.index') ? 'active' : '' }}" href="{{ route('admin.items.index') }}"">
                                        {{ __('stock.items') }}
                                    </a>
                                </div>

                                <div class="dropdown-menu-column">
                                    <!-- customers -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.customers.index') ? 'active' : '' }}" href="{{ route('admin.customers.index') }}"">
                                        {{ __('stock.customers') }}
                                    </a>

                                    <!-- vendors -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.vendors.index') ? 'active' : '' }}" href="{{ route('admin.vendors.index') }}"">
                                        {{ __('stock.vendors') }}
                                    </a>

                                    <!-- delegates -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.delegates.index') ? 'active' : '' }}" href="{{ route('admin.delegates.index') }}"">
                                        {{ __('transaction.delegates') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!---------------------------
                    Accounts
                     -------------------------!-->
                    <li class="nav-item dropdown {{ request()->routeIs('admin.account-types.*') || request()->routeIs('admin.financial-accounts.*') || request()->routeIs('admin.collect-transactions') || request()->routeIs('admin.exchange-transactions') ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                    <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                    <path d="M14 11h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                                    <path d="M12 17v1m0 -8v1" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                {{ __('partials.accounts') }}
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <!-- account types -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.account-types.index') ? 'active' : '' }}" href="{{ route('admin.account-types.index') }}">
                                        {{ __('account.account_types') }}
                                    </a>

                                    <!-- financial accounts -->
                                    <div class="dropend">
                                        <a class="dropdown-item dropdown-toggle {{ request()->routeIs('admin.accounts.*') ? 'active' : '' }}" href="javascript:;" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                            {{ __('account.accounts') }}
                                        </a>
                                        <div class="dropdown-menu">
                                            <a href="{{ route('admin.accounts.index') }}" class="dropdown-item {{ request()->routeIs('admin.accounts.index') ? 'active' : '' }}">
                                                {{ __('msgs.list', ['name' => __('account.accounts')]) }}
                                            </a>
                                            <a href="{{ route('admin.accounts.create') }}" class="dropdown-item {{ request()->routeIs('admin.accounts.create') ? 'active' : '' }}">
                                                {{ __('msgs.create', ['name' => __('account.account')]) }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider"></div>

                                    <!-- collection monetary screen -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.collect-transactions') ? 'active' : '' }}" href="{{ route('admin.collect-transactions') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-desktop-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M13.5 16h-9.5a1 1 0 0 1 -1 -1v-10a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v7.5"></path>
                                            <path d="M19 22v-6"></path>
                                            <path d="M22 19l-3 -3l-3 3"></path>
                                            <path d="M7 20h5"></path>
                                            <path d="M9 16v4"></path>
                                        </svg>
                                        {{ __('account.cash_collection_screen') }}
                                    </a>

                                    <!-- exchangeing monetary screen -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.exchange-transactions') ? 'active' : '' }}" href="{{ route('admin.exchange-transactions') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-desktop-down" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M13.5 16h-9.5a1 1 0 0 1 -1 -1v-10a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v7.5"></path>
                                            <path d="M7 20h5"></path>
                                            <path d="M9 16v4"></path>
                                            <path d="M19 16v6"></path>
                                            <path d="M22 19l-3 3l-3 -3"></path>
                                        </svg>
                                        {{ __('account.cash_exchange_screen') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!---------------------------
                    Movements Stocks
                    -------------------------!-->
                    <li class="nav-item dropdown {{ request()->routeIs('admin.orders.*') || request()->routeIs('admin.shifts.*') || request()->routeIs('admin.sales.*') || request()->routeIs('admin.services-invoices.*') ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 3a7 7 0 0 1 7 7v4l-3 -3" />
                                    <path d="M22 11l-3 3" />
                                    <path d="M8 15.5l-5 -3l5 -3l5 3v5.5l-5 3z" />
                                    <path d="M3 12.5v5.5l5 3" />
                                    <path d="M8 15.545l5 -3.03" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                {{ __('partials.transactions') }}
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <!-- purchases bills -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                                        {{ __('transaction.orders') }}
                                    </a>

                                    <!-- general orders returns -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.general-order-returns.*') ? 'active' : '' }}" href="{{ route('admin.general-order-returns.index') }}">
                                        {{ __('transaction.general_orders_returns') }}
                                    </a>

                                    <!-- sales -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.sales.*') ? 'active' : '' }}" href="{{ route('admin.sales.index') }}">
                                        {{ __('transaction.sales_invoices') }}
                                    </a>

                                    <!-- general sales -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.general-sale-returns.*') ? 'active' : '' }}" href="{{ route('admin.general-sale-returns.index') }}">
                                        {{ __('transaction.general_sales_returns') }}
                                    </a>

                                    <!-- services invoices -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.services-invoices.*') ? 'active' : '' }}" href="{{ route('admin.services-invoices.index') }}">
                                        {{ __('transaction.services_invoices') }}
                                    </a>
                                </div>
                                <div class="dropdown-menu-column">
                                    <!-- shifts -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.shifts.*') ? 'active' : '' }}" href="{{ route('admin.shifts.index') }}">
                                        {{ __('transaction.treasuries_shifts') }}
                                    </a>

                                    <!-- item balances -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.item.balances') ? 'active' : '' }}" href="{{ route('admin.item.balances') }}">
                                        {{ __('transaction.item_balances') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!---------------------------
                    Reports
                    -------------------------!-->
                    <li class="nav-item dropdown {{ request()->routeIs('admin.vendors.reports') || request()->routeIs('admin.customers.reports') || request()->routeIs('admin.delegates.reports') ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                    <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                    <path d="M9 17v-5" />
                                    <path d="M12 17v-1" />
                                    <path d="M15 17v-3" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                {{ __('report.reports') }}
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a class="dropdown-item {{ request()->routeIs('admin.vendors.reports') ? 'active' : '' }}" href="{{ route('admin.vendors.reports') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-report-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697"></path>
                                                <path d="M18 12v-5a2 2 0 0 0 -2 -2h-2"></path>
                                                <path d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                                                <path d="M8 11h4"></path>
                                                <path d="M8 15h3"></path>
                                                <path d="M16.5 17.5m-2.5 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 1 0 -5 0"></path>
                                                <path d="M18.5 19.5l2.5 2.5"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('report.reports_of', ['name' => __('stock.vendors')]) }}
                                        </span>
                                    </a>
                                    <a class="dropdown-item {{ request()->routeIs('admin.customers.reports') ? 'active' : '' }}" href="{{ route('admin.customers.reports') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-report" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697"></path>
                                                <path d="M18 14v4h4"></path>
                                                <path d="M18 11v-4a2 2 0 0 0 -2 -2h-2"></path>
                                                <path d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                                                <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                                <path d="M8 11h4"></path>
                                                <path d="M8 15h3"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('report.reports_of', ['name' => __('stock.customers')]) }}
                                        </span>
                                    </a>
                                    <a class="dropdown-item {{ request()->routeIs('admin.delegates.reports') ? 'active' : '' }}" href="{{ route('admin.delegates.reports') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-description" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                                <path d="M9 17h6"></path>
                                                <path d="M9 13h6"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('report.reports_of', ['name' => __('stock.delegates')]) }}
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
