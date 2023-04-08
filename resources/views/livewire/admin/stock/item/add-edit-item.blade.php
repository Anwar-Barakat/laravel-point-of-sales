<div class="col d-flex flex-column">
    <form wire:submit.prevent='submit'>
        <div class="card-body">
            <h3 class="mb-4 text-blue">{{ __('msgs.main_info') }}</h3>
            {{-- @if ($errors->any())
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <ul class="p-0 m-0 list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif --}}
            <div class="row">
                <div class="col-sm-12 col-md-6 m-auto mb-4">
                    @if ($item->getFirstMediaUrl('items'))
                        <img src="{{ $item->getFirstMediaUrl('items') }}" alt="{{ $item->name }}">
                    @else
                        <img src="{{ asset('backend/static/products/default-product.jpg') }}" alt="product name">
                    @endif
                </div>
            </div>

            <div class="row row-cards">
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.barcode_not_entered')" />
                        <x-text-input type="text" class="form-control" disabled readonly wire:model='barcode' />
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.item_name')" />
                        <x-text-input type="text" class="form-control" wire:model='item.name' />
                        <x-input-error :messages="$errors->get('item.name')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('msgs.is_active')" />
                        <select id="" class="form-control" wire:model='item.is_active'>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="1">{{ __('msgs.yes') }}</option>
                            <option value="0">{{ __('msgs.no') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('item.is_active')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="row row-cards">
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.item_type')" />
                        <select id="" class="form-control" wire:model='item.type'>
                            <option value="">{{ __('btns.select') }}</option>
                            @foreach (App\Models\Item::ITEMTYPE as $key => $value)
                                <option value="{{ $key }}">{{ __('stock.' . $value) }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('item.type')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.item_category')" />
                        <select id="" class="form-control" wire:model="item.category_id">
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
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.has_fixed_price')" />
                        <select id="" class="form-control" wire:model='item.has_fixed_price'>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="1">{{ __('msgs.yes') }}</option>
                            <option value="0">{{ __('msgs.no') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('item.has_fixed_price')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.parent_item')" />
                        <select id="" class="form-control" wire:model='item.parent_id'>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="0">{{ __('stock.parent') }}</option>
                            @if ($parent_items->count() > 0)
                                @foreach ($parent_items as $parent)
                                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <x-input-error :messages="$errors->get('item.parent_id')" class="mt-2" />
                    </div>
                </div>
            </div>
            <hr class="w-50">
            <h4 class="mb-4 text-blue">{{ __('stock.wholesale_retail_prices') }}</h4>
            <div class="row row-cards">
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.wholesale_unit')" />
                        <select id="" class="form-control" wire:model='item.wholesale_unit_id'>
                            <option value="">{{ __('btns.select') }}</option>
                            @foreach ($wholesale_units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('item.wholesale_unit_id')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.wholesale_price')" />
                        <x-text-input type="number" class="form-control" wire:model='item.wholesale_price' />
                        <x-input-error :messages="$errors->get('item.wholesale_price')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.wholesale_price_for_block')" />
                        <x-text-input type="number" class="form-control" wire:model='item.wholesale_price_for_block' />
                        <x-input-error :messages="$errors->get('item.wholesale_price_for_block')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.wholesale_price_for_half_block')" />
                        <x-text-input type="number" class="form-control" wire:model='item.wholesale_price_for_half_block' />
                        <x-input-error :messages="$errors->get('item.wholesale_price_for_half_block')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.wholesale_cost_price')" />
                        <x-text-input type="number" class="form-control" wire:model='item.wholesale_cost_price' />
                        <x-input-error :messages="$errors->get('item.wholesale_cost_price')" class="mt-2" />
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.has_retail_unit')" />
                        <select id="" class="form-control" wire:model='item.has_retail_unit'>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="1">{{ __('msgs.yes') }}</option>
                            <option value="0">{{ __('msgs.no') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('item.has_retail_unit')" class="mt-2" />
                    </div>
                </div>
            </div>
            @if (!empty($retail_units) || !empty($item['retail_unit_id']))
                <div class="row row-cards">
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('stock.retail_unit')" />
                            <select id="" class="form-control" wire:model='item.retail_unit_id'>
                                <option value="">{{ __('btns.select') }}</option>
                                @foreach ($retail_units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('item.retail_unit_id')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('stock.retail_price')" />
                            <x-text-input type="number" class="form-control" wire:model='item.retail_price' />
                            <x-input-error :messages="$errors->get('item.retail_price')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('stock.retail_price_for_block')" />
                            <x-text-input type="number" class="form-control" wire:model='item.retail_price_for_block' />
                            <x-input-error :messages="$errors->get('item.retail_price_for_block')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('stock.retail_price_for_half_block')" />
                            <x-text-input type="number" class="form-control" wire:model='item.retail_price_for_half_block' />
                            <x-input-error :messages="$errors->get('item.retail_price_for_half_block')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('stock.retail_cost_price')" />
                            <x-text-input type="number" class="form-control" wire:model='item.retail_cost_price' />
                            <x-input-error :messages="$errors->get('item.retail_cost_price')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('stock.retail_count_for_wholesale')" />
                            <x-text-input type="number" class="form-control" wire:model='item.retail_count_for_wholesale' />
                            <x-input-error :messages="$errors->get('item.retail_count_for_wholesale')" class="mt-2" />
                        </div>
                    </div>
                </div>
            @endif

            <hr class="w-50">
            <h4 class="mb-4  text-blue">{{ __('msgs.attachements') }}</h4>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <x-input-label class="form-label" :value="__('msgs.photo')" />
                    <x-text-input type="file" class="form-control" wire:model='image' />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary">{{ __('btns.submit') }}</button>
        </div>
    </form>
</div>
