<div class="col d-flex flex-column">
    <form wire:submit.prevent='store'>
        <div class="card-body">
            <h3 class="mb-4">{{ __('msgs.main_info') }}</h3>
            <div class="row">
                <div class="col-sm-12 col-md-6 m-auto mb-4">
                    @if ($image)
                        <img src="{{ $image->temporaryUrl() }}" class="img img-thumbnail" height="300">
                    @endif
                </div>
            </div>
            <div class="row row-cards">
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('msgs.name_ar')" />
                        <x-text-input type="text" class="form-control" placeholder="{{ __('category.category_ar') }}" wire:model='name_ar' required />
                        <x-input-error :messages="$errors->get('name_ar')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('msgs.name_en')" />
                        <x-text-input type="text" class="form-control" placeholder="{{ __('category.category_en') }}" wire:model='name_en' required />
                        <x-input-error :messages="$errors->get('name_en')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
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

            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('section.section')" />
                        <select id="" class="form-control" wire:model="section_id">
                            <option value="">{{ __('btns.select') }}</option>
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('section_id')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('category.category_level')" />
                        <select id="" class="form-control" wire:model="parent_id">
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="0">{{ __('msgs.parent') }}</option>
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
                        <x-input-error :messages="$errors->get('parent_id')" class="mt-2" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <x-input-label class="form-label" :value="__('msgs.photo')" />
                    <x-text-input type="file" class="form-control" wire:model='image' />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>
            </div>

            <div class="row row-cards">
                <div class="col-sm-12 col-md-6">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('msgs.descriprion')" />
                        <textarea wire:model='description' rows="5" class="form-control"></textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                </div>
            </div>

        </div>
        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary">{{ __('btns.submit') }}</button>
        </div>
    </form>
</div>
