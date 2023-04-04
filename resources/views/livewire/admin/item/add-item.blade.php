<div class="col d-flex flex-column">
    <form wire:submit.prevent='submit'>
        <div class="card-body">
            <h3 class="mb-4 text-blue">{{ __('msgs.main_info') }}</h3>
            <div class="row">
                <div class="col-sm-12 col-md-6 m-auto mb-4">
                    @if ($image)
                        <img src="{{ $image->temporaryUrl() }}" class="img img-thumbnail" height="300">
                    @endif
                </div>
            </div>

            <div class="row row-cards">
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('card.barcode_not_entered')" />
                        <x-text-input type="text" class="form-control" readonly disabled />
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('card.item_name')" />
                        <x-text-input type="text" class="form-control" wire:model='item_name' />
                        <x-input-error :messages="$errors->get('item_name')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('msgs.is_active')" />
                        <select id="" class="form-control" wire:model='is_active'>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="1">{{ __('msgs.yes') }}</option>
                            <option value="0">{{ __('msgs.no') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div class="row row-cards">
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('card.item_type')" />
                        <select id="" class="form-control" wire:model='item_type'>
                            <option value="">{{ __('btns.select') }}</option>
                            @foreach (App\Models\Item::ITEMTYPE as $key => $value)
                                <option value="{{ $key }}">{{ __('card.' . $value) }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('item_type')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('card.item_category')" />
                        <select id="" class="form-control" wire:model="category_id">
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
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('card.has_fixed_price')" />
                        <select id="" class="form-control" wire:model='has_fixed_price'>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="1">{{ __('msgs.yes') }}</option>
                            <option value="0">{{ __('msgs.no') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('has_fixed_price')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('card.parent_item')" />
                        <select id="" class="form-control" wire:model='parent_id'>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="">{{ __('card.parent') }}</option>
                            @if ($parent_items->count() > 0)
                                @foreach ($parent_items as $parent)
                                    <option value="{{ $parent->id }}">{{ $parent->item_name }}</option>
                                @endforeach
                            @endif
                        </select>
                        <x-input-error :messages="$errors->get('parent_id')" class="mt-2" />
                    </div>
                </div>
            </div>
            <hr class="w-50">
            <h4 class="mb-4 text-blue">{{ __('card.wholesale_retail_prices') }}</h4>
            <div class="row row-cards">
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('card.wholesale_unit')" />
                        <select id="" class="form-control" wire:model='wholesale_unit_id'>
                            <option value="">{{ __('btns.select') }}</option>
                            @foreach ($wholesale_units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('wholesale_unit_id')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('card.wholesale_price')" />
                        <x-text-input type="number" class="form-control" wire:model='wholesale_price' />
                        <x-input-error :messages="$errors->get('wholesale_price')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('card.wholesale_price_for_block')" />
                        <x-text-input type="number" class="form-control" wire:model='wholesale_price_for_block' />
                        <x-input-error :messages="$errors->get('wholesale_price_for_block')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('card.wholesale_price_for_half_block')" />
                        <x-text-input type="number" class="form-control" wire:model='wholesale_price_for_half_block' />
                        <x-input-error :messages="$errors->get('wholesale_price_for_half_block')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('card.wholesale_cost_price')" />
                        <x-text-input type="number" class="form-control" wire:model='wholesale_cost_price' />
                        <x-input-error :messages="$errors->get('wholesale_cost_price')" class="mt-2" />
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('card.has_retail_unit')" />
                        <select id="" class="form-control" wire:model='has_retail_unit'>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="1">{{ __('msgs.yes') }}</option>
                            <option value="0">{{ __('msgs.no') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('has_retail_unit')" class="mt-2" />
                    </div>
                </div>
            </div>
            @if (!empty($retail_units))
                <div class="row row-cards">
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('card.retail_unit')" />
                            <select id="" class="form-control" wire:model='retail_unit_id'>
                                <option value="">{{ __('btns.select') }}</option>
                                @foreach ($retail_units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('retail_unit_id')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('card.retail_price')" />
                            <x-text-input type="number" class="form-control" wire:model='retail_price' />
                            <x-input-error :messages="$errors->get('retail_price')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('card.retail_price_for_block')" />
                            <x-text-input type="number" class="form-control" wire:model='retail_price_for_block' />
                            <x-input-error :messages="$errors->get('retail_price_for_block')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('card.retail_price_for_half_block')" />
                            <x-text-input type="number" class="form-control" wire:model='retail_price_for_half_block' />
                            <x-input-error :messages="$errors->get('retail_price_for_half_block')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('card.retail_cost_price')" />
                            <x-text-input type="number" class="form-control" wire:model='retail_cost_price' />
                            <x-input-error :messages="$errors->get('retail_cost_price')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('card.retail_count_for_wholesale')" />
                            <x-text-input type="number" class="form-control" wire:model='retail_count_for_wholesale' />
                            <x-input-error :messages="$errors->get('retail_count_for_wholesale')" class="mt-2" />
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
