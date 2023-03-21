{{-- profile --}}
<div class="col d-flex flex-column">
    <form wire:submit.prevent='updateInfo'>
        <div class="card-body">
            <h3 class="card-title">{{ __('msgs.edit', ['name' => __('partials.profile')]) }}</h3>
            <div class="row row-cards">
                <div class="col-sm-12 col-md-6">
                    <div class="mb-3">
                        <label class="form-label">{{ __('auth.email') }}</label>
                        <input type="text" class="form-control" disabled="" placeholder="{{ __('auth.email') }}" wire:model='email'>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="mb-3">
                        <label class="form-label">{{ __('auth.name') }}</label>
                        <input type="text" class="form-control" placeholder="{{ __('auth.name') }}" wire:model='name'>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">{{ __('setting.address') }}</label>
                        <input type="text" class="form-control" placeholder="{{ __('setting.address') }}" wire:model='address'>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">{{ __('setting.bio') }}</label>
                        <textarea rows="5" class="form-control" placeholder="{{ __('setting.bio') }}" wire:model='bio'></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary">{{ __('msgs.update', ['name' => __('partials.profile')]) }}</button>
        </div>
    </form>
</div>
