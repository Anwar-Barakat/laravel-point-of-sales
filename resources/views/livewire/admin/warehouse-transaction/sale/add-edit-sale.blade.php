<div class="col d-flex flex-column">
    <form wire:submit.prevent='submit'>
        <div class="card-body">
            <h3 class="mb-4 text-blue">{{ __('msgs.main_info') }}</h3>
            <div class="row row-cards">
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <label for="" class="form-label">
                            {{ __('stock.customer_name') }}
                            (<a href="{{ route('admin.customers.create') }}" class="text underline text-blue-500" title="{{ __('msgs.create', ['name' => __('stock.customer')]) }}">{{ __('msgs.add_new') }}</a>)
                        </label>
                        <select class="form-select" wire:model.defer='sale.customer_id'>
                            <option value="">{{ __('btns.select') }}</option>
                            @if ($customers)
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('sale.customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <x-input-error :messages="$errors->get('sale.customer_id')" class="mt-2" />
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('transaction.invoice_type')" />
                        <select class="form-select" wire:model.defer='sale.invoice_type'>
                            <option value="">{{ __('btns.select') }}</option>
                            @foreach (App\Models\Sale::INVOICETYPE as $key => $value)
                                <option value="{{ $key }}">{{ __('transaction.' . $value) }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('sale.invoice_type')" class="mt-2" />
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('transaction.invoice_date')" />
                        <x-text-input type="date" class="form-control" wire:model.defer='sale.invoice_date' />
                        <x-input-error :messages="$errors->get('sale.invoice_date')" class="mt-2" />
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <label for="" class="form-label">
                            {{ __('transaction.delegate_name') }}
                            (<a href="" class="text underline text-blue-500" title="{{ __('msgs.create', ['name' => __('transaction.delegate')]) }}">{{ __('msgs.add_new') }}</a>)
                        </label>
                        <select class="form-select" wire:model.defer='sale.delegate_id'>
                            <option value="">{{ __('btns.select') }}</option>
                            @if ($delegates)
                                @foreach ($delegates as $delegate)
                                    <option value="{{ $delegate->id }}" {{ old('sale.delegate_id') == $delegate->id ? 'selected' : '' }}>
                                        {{ $delegate->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <x-input-error :messages="$errors->get('sale.delegate_id')" class="mt-2" />
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.category_name')" />
                        <select class="form-select" wire:model.defer="sale.category_id">
                            <option value="">{{ __('btns.select') }}</option>
                            @foreach ($categories as $root)
                                <option value="{{ $root->id }}">{{ ucwords($root->name) }}</option>
                                @if ($root->subCategories)
                                    @foreach ($root->subCategories as $child)
                                        <option value="{{ $child->id }}">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;
                                            {{ ucwords($child->name) }}
                                        </option>
                                    @endforeach
                                @endif
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('sale.category_id')" class="mt-2" />
                    </div>
                </div>
            </div>

            <div class="row row-cards">
                <div class="col-12 col-md-6">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('msgs.notes')" />
                        <textarea rows="5" class="form-control" wire:model.defer='sale.notes'></textarea>
                        <x-input-error :messages="$errors->get('sale.notes')" class="mt-2" />
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
