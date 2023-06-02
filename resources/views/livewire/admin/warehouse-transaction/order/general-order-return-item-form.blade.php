<div class="col-12 col-lg-8 mb-3" id="add-items">
    <div class="card mb-3">
        <div class="card-header">
            <h3 class="card-title">{{ __('transaction.add_items') }}</h3>
        </div>
        <form wire:submit.prevent='submit'>
            <div class="card-body">
                @include('layouts.errors-message')
                <h3 class="mb-4 text-blue">{{ __('msgs.main_info') }}</h3>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('stock.store')" />
                            <select class="form-select" readonly disabled>
                                <option value="">{{ $order->store->name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <label for="" class="form-label">
                                {{ __('stock.item_name') }}
                                (<a href="{{ route('admin.items.create') }}" class="text underline">{{ __('msgs.add_new') }}</a>)
                            </label>
                            <select class="form-select" wire:model='product.item_id'>
                                <option value="">{{ __('btns.select') }}</option>
                                @forelse ($items as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if ($item)
                        <div class="col-12 col-lg-6">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('stock.unit')" />
                                <select class="form-select" wire:model='product.unit_id'>
                                    <option value="">{{ __('btns.select') }}</option>
                                    <option value="{{ $item->parentUnit->id }}">{{ $item->parentUnit->name }} ({{ __('stock.wholesale_unit') }})</option>
                                    @if (!is_null($item->childUnit))
                                        <option value="{{ $item->childUnit->id }}">{{ $item->childUnit->name }} ({{ __('stock.retail_unit') }})</option>
                                    @endif
                                </select>
                                <x-input-error :messages="$errors->get('product.unit_id')" class="mt-2" />
                            </div>
                        </div>
                    @endif
                    @include('livewire.admin.inc.batches', ['batches' => $batches])

                    @if ($batch)
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('transaction.unit_price')" />
                                <x-text-input type="number" placeholder="10.15" class="form-control" wire:model='product.unit_price' readonly disabled />
                            </div>
                        </div>
                    @endif
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('transaction.returned_qty')" />
                            <x-text-input type="number" placeholder="10.15" class="form-control" wire:model.debounce.500s='product.qty' wire:keyup='calcPrice' />
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('transaction.total_price')" />
                            <x-text-input type="number" placeholder="10.15" class="form-control" wire:model.debounce.500s='product.total_price' readonly disabled />
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
