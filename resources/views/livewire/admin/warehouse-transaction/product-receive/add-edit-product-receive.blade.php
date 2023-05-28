<div class="card">
    <div class="row g-0">
        <div class="col d-flex flex-column">
            <form wire:submit.prevent='submit'>
                <div class="card-body">
                    <h3 class="mb-4 text-blue">{{ __('msgs.main_info') }}</h3>
                    @include('layouts.errors-message')
                    <div class="row row-cards">
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="" class="form-label">
                                    {{ __('transaction.production_line') }}
                                    (<a href="{{ route('admin.production-lines.create') }}" class="text underline text-blue-500" title="{{ __('msgs.create', ['name' => __('transaction.production_line')]) }}">{{ __('msgs.add_new') }}</a>)
                                </label>
                                <select class="form-select" wire:model='invoice.production_line_id'>
                                    <option value="">{{ __('btns.select') }}</option>
                                    @foreach ($production_lines as $production_line)
                                        <option value="{{ $production_line->id }}">{{ $production_line->plan }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('invoice.production_line_id')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('transaction.invoice_date')" />
                                <x-text-input type="date" class="form-control" wire:model.debounce.500s='invoice.invoice_date' />
                                <x-input-error :messages="$errors->get('invoice.invoice_date')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('transaction.invoice_type')" />
                                <select class="form-select" disabled readonly>
                                    <option value="1">{{ __('transaction.delayed') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row row-cards">
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="" class="form-label">
                                    {{ __('account.workshop_name') }}
                                    (<a href="{{ route('admin.workshops.create') }}" class="text underline text-blue-500" title="{{ __('msgs.create', ['name' => __('account.workshop')]) }}">{{ __('msgs.add_new') }}</a>)
                                </label>
                                <select class="form-select" wire:model.debounce.500s='invoice.workshop_id'>
                                    <option value="">{{ __('btns.select') }}</option>
                                    @foreach ($workshops as $workshop)
                                        <option value="{{ $workshop->id }}">{{ $workshop->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('invoice.workshop_id')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="mb-3">
                                <label for="" class="form-label">
                                    {{ __('stock.store') }}
                                    (<a href="{{ route('admin.stores.index') }}" class="text underline text-blue-500" title="{{ __('msgs.create', ['name' => __('stock.store')]) }}">{{ __('msgs.add_new') }}</a>)
                                </label>
                                <select class="form-select" wire:model.debounce.500s='invoice.store_id'>
                                    <option value="">{{ __('btns.select') }}</option>
                                    @foreach ($stores as $store)
                                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('invoice.store_id')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <div class="row row-cards">
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('msgs.notes')" />
                                <textarea rows="3" class="form-control" wire:model.debounce.500s='invoice.notes'></textarea>
                                <x-input-error :messages="$errors->get('invoice.notes')" class="mt-2" />
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
