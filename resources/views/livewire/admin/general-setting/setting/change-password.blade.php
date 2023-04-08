{{-- profile --}}
<div class="col d-flex flex-column">
    <form wire:submit.prevent='updatePassword'>
        <div class="card-body">
            <h2 class="mb-4">{{ __('msgs.edit', ['name' => __('auth.password')]) }}</h2>
            <div class="row row-cards">
                <div class="row">
                    <div class="mb-3 col-sm-12 col-md-6">
                        <x-input-label class="form-label" :value="__('setting.current_password')" />
                        <x-text-input type="password" class="form-control" placeholder="{{ __('setting.current_password') }}" wire:model='current_password' required />
                        <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-sm-12 col-md-6">
                        <x-input-label class="form-label" :value="__('setting.new_password')" />
                        <x-text-input type="password" class="form-control" placeholder="{{ __('setting.new_password') }}" wire:model='password' required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-sm-12 col-md-6">
                        <x-input-label class="form-label" :value="__('setting.password_confirmation')" />
                        <x-text-input type="password" class="form-control" placeholder="{{ __('setting.password_confirmation') }}" wire:model='password_confirmation' required />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary">{{ __('msgs.update', ['name' => __('setting.password')]) }}</button>
        </div>
    </form>
</div>
