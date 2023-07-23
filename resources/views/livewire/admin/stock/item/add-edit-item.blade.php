<div class="col d-flex flex-column">
    <form wire:submit.prevent='submit'>
        <div class="card-body">
            <h3 class="mb-4 text-blue">{{ __('msgs.main_info') }}</h3>
            <div class="row">
                <div class="col-12 col-md-6 m-auto mb-4">
                    @if ($item->getFirstMediaUrl('items'))
                        <img src="{{ $item->getFirstMediaUrl('items') }}" alt="{{ $item->name }}">
                    @else
                        <img src="{{ asset('backend/static/products/default-product.jpg') }}" alt="product name">
                    @endif
                </div>
            </div>
            <div class="row row-cards">
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.item_name')" />
                        <x-text-input type="text" class="form-control" wire:model.debounce.350s='item.name' />
                        <x-input-error :messages="$errors->get('item.name')" class="mt-2" />
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('msgs.is_active')" />
                        <select class="form-select" wire:model.debounce.350s='item.is_active'>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="1">{{ __('msgs.yes') }}</option>
                            <option value="0">{{ __('msgs.no') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('item.is_active')" class="mt-2" />
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.item_type')" />
                        <select class="form-select" wire:model.debounce.350s='item.type'>
                            <option value="">{{ __('btns.select') }}</option>
                            @foreach (App\Models\Item::ITEMTYPE as $key => $value)
                                <option value="{{ $key }}">{{ __('stock.' . $value) }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('item.type')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="row row-cards">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.item_category')" />
                        <select class="form-select" wire:model.debounce.350s="item.category_id">
                            <option value="">{{ __('btns.select') }}</option>
                            @if ($categories)
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
                            @endif
                        </select>
                        <x-input-error :messages="$errors->get('item.category_id')" class="mt-2" />
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.has_fixed_price')" />
                        <select class="form-select" wire:model.debounce.350s='item.has_fixed_price'>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="1">{{ __('msgs.yes') }}</option>
                            <option value="0">{{ __('msgs.no') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('item.has_fixed_price')" class="mt-2" />
                    </div>
                </div>
            </div>
            <hr class="mt-4 mb-3 w-50">
            <h4 class="mb-4 text-blue">{{ __('stock.wholesale_retail_prices') }}</h4>
            <div class="row row-cards">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.wholesale_unit')" />
                        <select class="form-select" @if ($item_used) readonly disabled @else wire:model.debounce.350s='item.wholesale_unit_id' @endif>
                            <option value="">{{ __('btns.select') }}</option>
                            @foreach ($wholesale_units as $unit)
                                <option value="{{ $unit->id }}" {{ $item_used && $unit->id == $item->wholesale_unit_id ? 'selected' : '' }}>{{ $unit->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('item.wholesale_unit_id')" class="mt-2" />
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.wholesale_price_for_the_main_unit')" />
                        <x-text-input type="number" placeholder="900.00" class="form-control" wire:model.debounce.350s='item.wholesale_price_for_block' />
                        <x-input-error :messages="$errors->get('item.wholesale_price_for_block')" class="mt-2" />
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.half_wholesale_price_for_the_main_unit')" />
                        <x-text-input type="number" placeholder="950.00" class="form-control" wire:model.debounce.350s='item.wholesale_price_for_half_block' />
                        <x-input-error :messages="$errors->get('item.wholesale_price_for_half_block')" class="mt-2" />
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.retail_price_for_main_unit')" />
                        <x-text-input type="number" placeholder="1000.00" class="form-control" wire:model.debounce.350s='item.wholesale_price' />
                        <x-input-error :messages="$errors->get('item.wholesale_price')" class="mt-2" />
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.wholesale_cost_price')" />
                        <x-text-input type="number" placeholder="17.00" class="form-control" wire:model.debounce.350s='item.wholesale_cost_price' />
                        <x-input-error :messages="$errors->get('item.wholesale_cost_price')" class="mt-2" />
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.has_retail_unit')" />
                        <select class="form-select" @if ($item_used) readonly disabled @else wire:model='item.has_retail_unit' @endif>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="1" {{ $item->has_retail_unit == '1' ? 'selected' : '' }}>{{ __('msgs.yes') }}</option>
                            <option value="0" {{ $item->has_retail_unit == '0' ? 'selected' : '' }}>{{ __('msgs.no') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('item.has_retail_unit')" class="mt-2" />
                    </div>
                </div>
            </div>

            @if ($item->has_retail_unit == 1)
                <div class="row row-cards">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('stock.retail_unit')" />
                            <select class="form-select" @if ($item_used) readonly disabled @else wire:model.debounce.350s='item.retail_unit_id' @endif>
                                <option value="">{{ __('btns.select') }}</option>
                                @foreach ($retail_units as $unit)
                                    <option value="{{ $unit->id }}" {{ $item_used && $unit->id == $item->retail_unit_id ? 'selected' : '' }}>{{ $unit->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('item.retail_unit_id')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('stock.wholesale_price_for_the_child_unit')" />
                            <x-text-input type="number" placeholder="90.00" class="form-control" wire:model.debounce.350s='item.retail_price_for_block' />
                            <x-input-error :messages="$errors->get('item.retail_price_for_block')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('stock.half_wholesale_price_for_the_child_unit')" />
                            <x-text-input type="number" placeholder="95.00" class="form-control" wire:model.debounce.350s='item.retail_price_for_half_block' />
                            <x-input-error :messages="$errors->get('item.retail_price_for_half_block')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('stock.retail_price_for_the_child_unit')" />
                            <x-text-input type="number" placeholder="100.00" class="form-control" wire:model.debounce.350s='item.retail_price' />
                            <x-input-error :messages="$errors->get('item.retail_price')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('stock.retail_cost_price')" />
                            <x-text-input type="number" placeholder="10.00" class="form-control" wire:model.debounce.350s='item.retail_cost_price' />
                            <x-input-error :messages="$errors->get('item.retail_cost_price')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('stock.retail_count_for_wholesale')" />
                            <input type="number" placeholder="10.00" class="form-control" @if (!$item_used) wire:model.debounce.350s='item.retail_count_for_wholesale' @else readonly disabled @endif>
                            <x-input-error :messages="$errors->get('item.retail_count_for_wholesale')" class="mt-2" />
                        </div>
                    </div>
                </div>
            @endif

            <hr class="mt-4 mb-3 w-50">
            <h4 class="mb-4  text-blue">{{ __('msgs.attachements') }}</h4>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <x-input-label class="form-label" :value="__('msgs.photo')" />
                    <x-text-input type="file" class="form-control" wire:model.debounce.350s='image' />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
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
