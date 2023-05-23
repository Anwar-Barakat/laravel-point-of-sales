<div class="col d-flex flex-column">
    <form wire:submit.prevent='submit'>
        <div class="card-body">
            <h3 class="mb-4 text-blue">{{ __('msgs.main_info') }}</h3>
            <div class="row row-cards">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.inventory_date')" />
                        <x-text-input type="date" class="form-control" wire:model.debounce.500s='inventory.inventory_date' readonly disabled />
                        <x-input-error :messages="$errors->get('inventory.inventory_date')" class="mt-2" />
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.inventory_type')" />
                        <select class="form-select" wire:model.defer='inventory.inventory_type'>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="1">{{ __('stock.daily_inventory') }}</option>
                            <option value="2">{{ __('stock.weekly_inventory') }}</option>
                            <option value="3">{{ __('stock.monthly_inventory') }}</option>
                            <option value="4">{{ __('stock.annual_inventory') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('inventory.inventory_type')" class="mt-2" />
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <label for="" class="form-label">
                            {{ __('stock.store') }}
                            (<a href="{{ route('admin.stores.index') }}" class="text underline text-blue-500" title="{{ __('msgs.create', ['name' => __('stock.store')]) }}">{{ __('msgs.add_new') }}</a>)
                        </label>
                        <select class="form-select" wire:model.debounce.500s='inventory.store_id'>
                            <option value="">{{ __('btns.select') }}</option>
                            @foreach ($stores as $store)
                                <option value="{{ $store->id }}">{{ $store->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('inventory.store_id')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="row row-cards">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('msgs.notes')" />
                        <textarea rows="3" class="form-control" wire:model.debounce.500s='inventory.notes' placeholder="{{ __('msgs.at_least_ten_ch') }}"></textarea>
                        <x-input-error :messages="$errors->get('inventory.notes')" class="mt-2" />
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
