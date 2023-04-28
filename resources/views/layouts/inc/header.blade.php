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
                    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                            <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                        </svg>
                        <span class="badge bg-red"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Last updates</h3>
                            </div>
                            <div class="list-group list-group-flush list-group-hoverable">
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto"><span class="status-dot status-dot-animated bg-red d-block"></span></div>
                                        <div class="col text-truncate">
                                            <a href="#" class="text-body d-block">Example 1</a>
                                            <div class="d-block text-muted text-truncate mt-n1">
                                                Change deprecated html tags to text decoration classes (#29604)
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#" class="list-group-item-actions">
                                                <!-- Download SVG icon from http://tabler-icons.io/i/star -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                    <a href="{{ route('admin.settings.index') }}" class="dropdown-item">{{ __('partials.settings') }}</a>
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
                    <!-- _______________________
                    Dashboard
                    _______________________ !-->
                    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <!-- Download SVG icon from http://tabler-icons.io/i/home -->
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
                    </li>

                    <!-- _______________________
                    General Setting
                    _______________________!-->
                    <li class="nav-item dropdown {{ request()->routeIs('admin.treasuries.*') || request()->routeIs('admin.settings.*') || request()->routeIs('admin.admins.*') ? 'active' : '' }}">
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
                                {{ __('partials.general_setting') }}
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <!-- setting -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.settings.index') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                                        {{ __('setting.settings') }}
                                    </a>

                                    <!-- treasuries -->
                                    <div class="dropend">
                                        <a class="dropdown-item dropdown-toggle {{ request()->routeIs('admin.treasuries.*') ? 'active' : '' }}" href="javascript:;" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                                            {{ __('treasury.treasuries') }}
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
                                        {{ __('setting.admins') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- _______________________
                    Stocks
                    _______________________!-->
                    <li class="nav-item dropdown {{ request()->routeIs('admin.sections.*') || request()->routeIs('admin.categories.*') || request()->routeIs('admin.units.*') || request()->routeIs('admin.stores.*') || request()->routeIs('admin.items.*') || request()->routeIs('admin.customers.*') ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 21l18 0" />
                                    <path d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4" />
                                    <path d="M5 21l0 -10.15" />
                                    <path d="M19 21l0 -10.15" />
                                    <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4" />
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
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- _______________________
                    Accounts
                    _______________________!-->
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
                                {{ __('account.accounts') }}
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
                                        {{ __('account.cash_collection_screen') }}
                                    </a>

                                    <!-- exchangeing monetary screen -->
                                    <a class="dropdown-item {{ request()->routeIs('admin.exchange-transactions') ? 'active' : '' }}" href="{{ route('admin.exchange-transactions') }}">
                                        {{ __('account.cash_exchange_screen') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- _______________________
                    Movements Stocks
                    _______________________!-->
                    <li class="nav-item dropdown {{ request()->routeIs('admin.orders.*') || request()->routeIs('admin.shifts.*') || request()->routeIs('admin.sales.*') ? 'active' : '' }}">
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
                                {{ __('movement.stock_movements') }}
                            </span>
                        </a>
                        <div class="dropdown-menu">
                            <!-- orders -->
                            <a class="dropdown-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                                {{ __('movement.orders') }}
                            </a>

                            <!-- sales -->
                            <a class="dropdown-item {{ request()->routeIs('admin.sales.*') ? 'active' : '' }}" href="{{ route('admin.sales.index') }}">
                                {{ __('movement.sales_invoices') }}
                            </a>

                            <!-- shifts -->
                            <a class="dropdown-item {{ request()->routeIs('admin.shifts.*') ? 'active' : '' }}" href="{{ route('admin.shifts.index') }}">
                                {{ __('movement.treasuries_shifts') }}
                            </a>
                        </div>
                    </li>

                    <!-- _______________________
                    Languages
                    _______________________!-->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 5h7" />
                                    <path d="M9 3v2c0 4.418 -2.239 8 -5 8" />
                                    <path d="M5 9c0 2.144 2.952 3.908 6.7 4" />
                                    <path d="M12 20l4 -9l4 9" />
                                    <path d="M19.1 18h-6.2" />
                                </svg>
                            </span>
                            <span class="nav-link-title">
                                {{ __('partials.languages') }}
                            </span>
                        </a>
                        <div class="dropdown-menu">
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
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
