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
                    <div class="dropdown-divider m-0"></div>
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
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M21 12l-9 -9l-9 9h2v7a2 2 0 0 0 2 2h4.7"></path>
                                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2"></path>
                                                <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                                <path d="M20.2 20.2l1.8 1.8"></path>
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

                                    <div class="dropdown-divider m-0"></div>

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
                    <li class="nav-item dropdown {{ request()->routeIs('admin.sections.*') || request()->routeIs('admin.categories.*') || request()->routeIs('admin.units.*') || request()->routeIs('admin.stores.*') || request()->routeIs('admin.items.*') || request()->routeIs('admin.stores-inventories.*') ? 'active' : '' }}">
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
                                    <a class="dropdown-item {{ request()->routeIs('admin.sections.*') ? 'active' : '' }}" href="{{ route('admin.sections.index') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-affiliate" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M5.931 6.936l1.275 4.249m5.607 5.609l4.251 1.275"></path>
                                                <path d="M11.683 12.317l5.759 -5.759"></path>
                                                <path d="M5.5 5.5m-1.5 0a1.5 1.5 0 1 0 3 0a1.5 1.5 0 1 0 -3 0"></path>
                                                <path d="M18.5 5.5m-1.5 0a1.5 1.5 0 1 0 3 0a1.5 1.5 0 1 0 -3 0"></path>
                                                <path d="M18.5 18.5m-1.5 0a1.5 1.5 0 1 0 3 0a1.5 1.5 0 1 0 -3 0"></path>
                                                <path d="M8.5 15.5m-4.5 0a4.5 4.5 0 1 0 9 0a4.5 4.5 0 1 0 -9 0"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('stock.sections') }}
                                        </span>
                                    </a>

                                    <!-- categories -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}"">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-category" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M4 4h6v6h-6z"></path>
                                                <path d="M14 4h6v6h-6z"></path>
                                                <path d="M4 14h6v6h-6z"></path>
                                                <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('stock.categories') }}
                                        </span>
                                    </a>

                                    <!-- units -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.units.*') ? 'active' : '' }}" href="{{ route('admin.units.index') }}"">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-atom" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M12 12v.01"></path>
                                                <path d="M19.071 4.929c-1.562 -1.562 -6 .337 -9.9 4.243c-3.905 3.905 -5.804 8.337 -4.242 9.9c1.562 1.561 6 -.338 9.9 -4.244c3.905 -3.905 5.804 -8.337 4.242 -9.9"></path>
                                                <path d="M4.929 4.929c-1.562 1.562 .337 6 4.243 9.9c3.905 3.905 8.337 5.804 9.9 4.242c1.561 -1.562 -.338 -6 -4.244 -9.9c-3.905 -3.905 -8.337 -5.804 -9.9 -4.242"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('stock.units') }}
                                        </span>
                                    </a>

                                    <!-- stores -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.stores.*') ? 'active' : '' }}" href="{{ route('admin.stores.index') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-store" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M3 21l18 0"></path>
                                                <path d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4"></path>
                                                <path d="M5 21l0 -10.15"></path>
                                                <path d="M19 21l0 -10.15"></path>
                                                <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('stock.stores') }}
                                        </span>
                                    </a>
                                </div>
                                <div class="dropdown-menu-column">

                                    <!-- items -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.items.*') ? 'active' : '' }}" href="{{ route('admin.items.index') }}"">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-tags" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M7.859 6h-2.834a2.025 2.025 0 0 0 -2.025 2.025v2.834c0 .537 .213 1.052 .593 1.432l6.116 6.116a2.025 2.025 0 0 0 2.864 0l2.834 -2.834a2.025 2.025 0 0 0 0 -2.864l-6.117 -6.116a2.025 2.025 0 0 0 -1.431 -.593z"></path>
                                                <path d="M17.573 18.407l2.834 -2.834a2.025 2.025 0 0 0 0 -2.864l-7.117 -7.116"></path>
                                                <path d="M6 9h-.01"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('stock.items') }}
                                        </span>
                                    </a>

                                    <!-- store inventory -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.stores-inventories.*') ? 'active' : '' }}" href="{{ route('admin.stores-inventories.index') }}"">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-forklift" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M5 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                <path d="M14 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                <path d="M7 17l5 0"></path>
                                                <path d="M3 17v-6h13v6"></path>
                                                <path d="M5 11v-4h4"></path>
                                                <path d="M9 11v-6h4l3 6"></path>
                                                <path d="M22 15h-3v-10"></path>
                                                <path d="M16 13l3 0"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('stock.stores_inventories') }}
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!---------------------------
                    Accounts
                     -------------------------!-->
                    <li class="nav-item dropdown {{ request()->routeIs('admin.account-types.*') || request()->routeIs('admin.financial-accounts.*') || request()->routeIs('admin.collect-transactions') || request()->routeIs('admin.exchange-transactions') || request()->routeIs('admin.customers.*') || request()->routeIs('admin.delegates.*') || request()->routeIs('admin.vendors.*') || request()->routeIs('admin.workshops.*') ? 'active' : '' }}">
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
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-cashapp" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path
                                                    d="M17.1 8.648a.568 .568 0 0 1 -.761 .011a5.682 5.682 0 0 0 -3.659 -1.34c-1.102 0 -2.205 .363 -2.205 1.374c0 1.023 1.182 1.364 2.546 1.875c2.386 .796 4.363 1.796 4.363 4.137c0 2.545 -1.977 4.295 -5.204 4.488l-.295 1.364a.557 .557 0 0 1 -.546 .443h-2.034l-.102 -.011a.568 .568 0 0 1 -.432 -.67l.318 -1.444a7.432 7.432 0 0 1 -3.273 -1.784v-.011a.545 .545 0 0 1 0 -.773l1.137 -1.102c.214 -.2 .547 -.2 .761 0a5.495 5.495 0 0 0 3.852 1.5c1.478 0 2.466 -.625 2.466 -1.614c0 -.989 -1 -1.25 -2.886 -1.954c-2 -.716 -3.898 -1.728 -3.898 -4.091c0 -2.75 2.284 -4.091 4.989 -4.216l.284 -1.398a.545 .545 0 0 1 .545 -.432h2.023l.114 .012a.544 .544 0 0 1 .42 .647l-.307 1.557a8.528 8.528 0 0 1 2.818 1.58l.023 .022c.216 .228 .216 .569 0 .773l-1.057 1.057z">
                                                </path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('account.account_types') }}
                                        </span>
                                    </a>

                                    <!-- financial accounts -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.accounts.index') ? 'active' : '' }}" href="{{ route('admin.accounts.index') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-dollar" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M19 10l-7 -7l-9 9h2v7a2 2 0 0 0 2 2h6"></path>
                                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2c.387 0 .748 .11 1.054 .3"></path>
                                                <path d="M21 15h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5"></path>
                                                <path d="M19 21v1m0 -8v1"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('account.accounts') }}
                                        </span>
                                    </a>

                                    <div class="dropdown-divider m-0"></div>

                                    <!-- customers -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.customers.index') ? 'active' : '' }}" href="{{ route('admin.customers.index') }}"">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coins" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M9 14c0 1.657 2.686 3 6 3s6 -1.343 6 -3s-2.686 -3 -6 -3s-6 1.343 -6 3z"></path>
                                                <path d="M9 14v4c0 1.656 2.686 3 6 3s6 -1.344 6 -3v-4"></path>
                                                <path d="M3 6c0 1.072 1.144 2.062 3 2.598s4.144 .536 6 0c1.856 -.536 3 -1.526 3 -2.598c0 -1.072 -1.144 -2.062 -3 -2.598s-4.144 -.536 -6 0c-1.856 .536 -3 1.526 -3 2.598z"></path>
                                                <path d="M3 6v10c0 .888 .772 1.45 2 2"></path>
                                                <path d="M3 11c0 .888 .772 1.45 2 2"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('account.accounts_of', ['name' => __('stock.customers')]) }}
                                        </span>
                                    </a>

                                    <!-- vendors -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.vendors.index') ? 'active' : '' }}" href="{{ route('admin.vendors.index') }}"">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-businessplan" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M16 6m-5 0a5 3 0 1 0 10 0a5 3 0 1 0 -10 0"></path>
                                                <path d="M11 6v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4"></path>
                                                <path d="M11 10v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4"></path>
                                                <path d="M11 14v4c0 1.657 2.239 3 5 3s5 -1.343 5 -3v-4"></path>
                                                <path d="M7 9h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5"></path>
                                                <path d="M5 15v1m0 -8v1"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('account.accounts_of', ['name' => __('stock.vendors')]) }}
                                        </span>
                                    </a>

                                    <!-- delegates -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.delegates.index') ? 'active' : '' }}" href="{{ route('admin.delegates.index') }}"">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coin" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                                                <path d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 1 0 0 4h2a2 2 0 1 1 0 4h-2a2 2 0 0 1 -1.8 -1"></path>
                                                <path d="M12 7v10"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('account.accounts_of', ['name' => __('stock.delegates')]) }}
                                        </span>
                                    </a>

                                    <!-- workshops -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.workshops.index') ? 'active' : '' }}" href="{{ route('admin.workshops.index') }}"">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-receipt-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2"></path>
                                                <path d="M14 8h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5m2 0v1.5m0 -9v1.5"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('account.accounts_of', ['name' => __('account.workshops')]) }}
                                        </span>
                                    </a>
                                </div>

                                <div class="dropdown-menu-column">
                                    <!-- collection monetary screen -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.collect-transactions') ? 'active' : '' }}" href="{{ route('admin.collect-transactions') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-desktop-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M13.5 16h-9.5a1 1 0 0 1 -1 -1v-10a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v7.5"></path>
                                                <path d="M19 22v-6"></path>
                                                <path d="M22 19l-3 -3l-3 3"></path>
                                                <path d="M7 20h5"></path>
                                                <path d="M9 16v4"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('account.cash_collection_screen') }}
                                        </span>
                                    </a>

                                    <!-- exchangeing monetary screen -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.exchange-transactions') ? 'active' : '' }}" href="{{ route('admin.exchange-transactions') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-desktop-down" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M13.5 16h-9.5a1 1 0 0 1 -1 -1v-10a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v7.5"></path>
                                                <path d="M7 20h5"></path>
                                                <path d="M9 16v4"></path>
                                                <path d="M19 16v6"></path>
                                                <path d="M22 19l-3 3l-3 -3"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('account.cash_exchange_screen') }}
                                        </span>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </li>

                    <!---------------------------
                    Movements Stocks
                    -------------------------!-->
                    <li class="nav-item dropdown {{ request()->routeIs('admin.orders.*') || request()->routeIs('admin.shifts.*') || request()->routeIs('admin.sales.*') || request()->routeIs('admin.services-invoices.*') || request()->routeIs('admin.production-lines.*') || request()->routeIs('admin.workshop-invoices.*') || request()->routeIs('admin.products-receive.*') || request()->routeIs('admin.store-transfers.*') ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-warehouse" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M3 21v-13l9 -4l9 4v13"></path>
                                    <path d="M13 13h4v8h-10v-6h6"></path>
                                    <path d="M13 21v-9a1 1 0 0 0 -1 -1h-2a1 1 0 0 0 -1 1v3"></path>
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
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-dollar" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                                <path d="M14 11h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5"></path>
                                                <path d="M12 17v1m0 -8v1"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('transaction.orders') }}
                                        </span>
                                    </a>

                                    <!-- general orders returns -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.general-order-returns.*') ? 'active' : '' }}" href="{{ route('admin.general-order-returns.index') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-export" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                <path d="M11.5 21h-4.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v5m-5 6h7m-3 -3l3 3l-3 3"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('transaction.general_orders_returns') }}
                                        </span>
                                    </a>

                                    <div class="dropdown-divider m-0"></div>

                                    <!-- sales -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.sales.*') ? 'active' : '' }}" href="{{ route('admin.sales.index') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-3d" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                                <path d="M12 13.5l4 -1.5"></path>
                                                <path d="M8 11.846l4 1.654v4.5l4 -1.846v-4.308l-4 -1.846z"></path>
                                                <path d="M8 12v4.2l4 1.8"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('transaction.sales_invoices') }}
                                        </span>
                                    </a>

                                    <!-- general sales -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.general-sale-returns.*') ? 'active' : '' }}" href="{{ route('admin.general-sale-returns.index') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-export" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                <path d="M11.5 21h-4.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v5m-5 6h7m-3 -3l3 3l-3 3"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('transaction.general_sales_returns') }}
                                        </span>
                                    </a>

                                    <!-- services invoices -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.services-invoices.*') ? 'active' : '' }}" href="{{ route('admin.services-invoices.index') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-invoice" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4"></path>
                                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z"></path>
                                                <path d="M9 7l1 0"></path>
                                                <path d="M9 13l6 0"></path>
                                                <path d="M13 17l2 0"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('transaction.services_invoices') }}
                                        </span>
                                    </a>

                                    <div class="dropdown-divider m-0"></div>

                                    <!-- production lines -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.production-lines.*') ? 'active' : '' }}" href="{{ route('admin.production-lines.index') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-asset" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M9 15m-6 0a6 6 0 1 0 12 0a6 6 0 1 0 -12 0"></path>
                                                <path d="M9 15m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                <path d="M19 5m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                                <path d="M14.218 17.975l6.619 -12.174"></path>
                                                <path d="M6.079 9.756l12.217 -6.631"></path>
                                                <path d="M9 15m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('transaction.production_lines') }}
                                        </span>
                                    </a>

                                    <!-- workshop invoices -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.workshop-invoices.*') ? 'active' : '' }}" href="{{ route('admin.workshop-invoices.index') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home-share" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2c.247 0 .484 .045 .702 .127"></path>
                                                <path d="M19 12h2l-9 -9l-9 9h2v7a2 2 0 0 0 2 2h5"></path>
                                                <path d="M16 22l5 -5"></path>
                                                <path d="M21 21.5v-4.5h-4.5"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('transaction.workshops_invoices') }}
                                        </span>
                                    </a>

                                    <!-- products receive -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.products-receive.*') ? 'active' : '' }}" href="{{ route('admin.products-receive.index') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                                                <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                                                <path d="M10 14h4"></path>
                                                <path d="M12 12v4"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('transaction.products_receive_from_production_line') }}
                                        </span>
                                    </a>
                                </div>
                                <div class="dropdown-menu-column">
                                    <!-- shifts -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.shifts.*') ? 'active' : '' }}" href="{{ route('admin.shifts.index') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrows-transfer-down" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M17 3v6"></path>
                                                <path d="M10 18l-3 3l-3 -3"></path>
                                                <path d="M7 21v-18"></path>
                                                <path d="M20 6l-3 -3l-3 3"></path>
                                                <path d="M17 21v-2"></path>
                                                <path d="M17 15v-2"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('transaction.treasuries_shifts') }}
                                        </span>
                                    </a>

                                    <!-- item balances -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.item.balances') ? 'active' : '' }}" href="{{ route('admin.item.balances') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-scale" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M7 20l10 0"></path>
                                                <path d="M6 6l6 -1l6 1"></path>
                                                <path d="M12 3l0 17"></path>
                                                <path d="M9 12l-3 -6l-3 6a3 3 0 0 0 6 0"></path>
                                                <path d="M21 12l-3 -6l-3 6a3 3 0 0 0 6 0"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('transaction.item_balances') }}
                                        </span>
                                    </a>

                                    <!-- store transfers -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.store-transfers.*') ? 'active' : '' }}" href="{{ route('admin.store-transfers.index') }}">
                                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-transform" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M3 6a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                                <path d="M21 11v-3a2 2 0 0 0 -2 -2h-6l3 3m0 -6l-3 3"></path>
                                                <path d="M3 13v3a2 2 0 0 0 2 2h6l-3 -3m0 6l3 -3"></path>
                                                <path d="M15 18a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            {{ __('transaction.store_transfers') }}
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!---------------------------
                    Reports
                    -------------------------!-->
                    <li class="nav-item dropdown {{ request()->routeIs('admin.reports.vendors') || request()->routeIs('admin.reports.customers') || request()->routeIs('admin.delegates.reports') ? 'active' : '' }}">
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
                                    <a class="dropdown-item {{ request()->routeIs('admin.reports.vendors') ? 'active' : '' }}" href="{{ route('admin.reports.vendors') }}">
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
                                    <a class="dropdown-item {{ request()->routeIs('admin.reports.customers') ? 'active' : '' }}" href="{{ route('admin.reports.customers') }}">
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
