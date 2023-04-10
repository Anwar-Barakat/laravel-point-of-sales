<div class="modal modal-blur fade" id="add-vendor-category" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> {{ __('msgs.create', ['name' => __('account.vendor_category')]) }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.vendor-categories.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('stock.category_ar')" />
                                <x-text-input type="text" name="name_ar" class="form-control" placeholder="{{ __('msgs.name_ar') }}" :value="old('name_ar')" required />
                                <x-input-error :messages="$errors->get('name_ar')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('stock.category_en')" />
                                <x-text-input type="text" name="name_en" class="form-control" placeholder="{{ __('msgs.name_en') }}" :value="old('name_en')" required />
                                <x-input-error :messages="$errors->get('name_en')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('partials.status')" />
                                <select class="form-control" name="is_active">
                                    <option value="">{{ __('btns.select') }}</option>
                                    <option value="1" {{ old('is_active') ? 'selected' : '' }}>{{ __('msgs.active') }}</option>
                                    <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>{{ __('msgs.not_active') }}</option>
                                </select>
                                <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('stock.section')" />
                                <select class="form-control" name="section_id">
                                    <option value="">{{ __('btns.select') }}</option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}>{{ $section->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('section_id')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mt-0">
                <div class="modal-footer">
                    <button type="button" class="btn" data-bs-dismiss="modal">
                        {{ __('btns.cancel') }}
                    </button>
                    <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        {{ __('btns.submit') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
