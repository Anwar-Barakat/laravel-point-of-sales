<div class="card">
    <div class="row g-0">
        <div class="col d-flex flex-column">
            <form wire:submit.prevent='submit'>
                <div class="card-body">
                    <h3 class="mb-3 text-blue">{{ __('msgs.main_info') }}</h3>
                    <div class="row row-cards">
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('msgs.name_ar')" />
                                <x-text-input type="text" class="form-control" placeholder="الرجال" wire:model='name_ar' required />
                                <x-input-error :messages="$errors->get('name_ar')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('msgs.name_en')" />
                                <x-text-input type="text" class="form-control" placeholder="Men" wire:model='name_en' required />
                                <x-input-error :messages="$errors->get('name_en')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('partials.status')" />
                                <select class="form-select" wire:model.defer='section.is_active'>
                                    <option value="">{{ __('btns.select') }}</option>
                                    <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>{{ __('msgs.yes') }}</option>
                                    <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>{{ __('msgs.no') }}</option>
                                </select>
                                <x-input-error :messages="$errors->get('section.is_active')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checklist" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8"></path>
                            <path d="M14 19l2 2l4 -4"></path>
                            <path d="M9 8h4"></path>
                            <path d="M9 12h2"></path>
                        </svg>
                        {{ __('btns.submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
