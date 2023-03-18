<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h2 class="h2 text-center mb-4">{{ __('auth.admin_login') }}</h2>

    <form method="POST" action="{{ route('admin.login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label class="form-label" for="email" :value="__('auth.email')" />
            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label class="form-label" for="password" :value="__('auth.password')" />
            <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>


        <div class="flex items-center justify-end mt-4 gap-2">
            @if (Route::has('admin.forget.password.form'))
                <a class="underline text-sm text-gray-600  hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 " href="{{ route('admin.forget.password.form') }}">
                    {{ __('auth.forget_your_password') }}
                </a>
            @endif

            <button class="ml-3 btn btn-primary">
                {{ __('auth.login') }}
            </button>
        </div>
    </form>
</x-guest-layout>
