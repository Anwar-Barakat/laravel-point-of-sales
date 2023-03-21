{{-- profile --}}
<div class="col d-flex flex-column">
    <form wire:submit.prevent='updateInfo'>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <ul class="p-0 m-0 list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h3 class="card-title">{{ __('msgs.edit', ['name' => __('partials.profile')]) }}</h3>
            <div class="row row-cards">
                <div class="col-sm-12 col-md-6">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('auth.email')" />
                        <x-text-input type="text" class="form-control" disabled="diabled" placeholder="{{ __('auth.email') }}" wire:model='email' required />

                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('auth.name')" />
                        <x-text-input type="text" class="form-control" placeholder="{{ __('auth.name') }}" wire:model='name' required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('setting.address')" />
                        <x-text-input type="text" class="form-control" placeholder="{{ __('setting.address') }}" wire:model='address' required />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('setting.bio')" />
                        <textarea rows="5" class="form-control" placeholder="{{ __('setting.bio') }}" wire:model='bio' required></textarea>
                        <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                    </div>
                </div>
                <div class="col-md-12 col-lg-6">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('setting.avatar')" />
                        <x-text-input type="file" class="form-control" wire:model="avatar" />
                        <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary">{{ __('msgs.update', ['name' => __('partials.profile')]) }}</button>
        </div>
    </form>
</div>
