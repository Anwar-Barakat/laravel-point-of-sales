<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('stock.unit')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('stock.unit')]))

    <div class="card">
        <div class="row g-0">
            <div class="col d-flex flex-column">
                <form action="{{ route('admin.units.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <h3 class="mb-4">{{ __('msgs.main_info') }}</h3>
                        <div class="row row-cards">
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('msgs.name_ar')" />
                                    <x-text-input type="text" class="form-control" placeholder="{{ __('stock.unit_ar') }}" :value="old('name_ar')" name='name_ar' required />
                                    <x-input-error :messages="$errors->get('name_ar')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('msgs.name_en')" />
                                    <x-text-input type="text" class="form-control" placeholder="{{ __('stock.unit_en') }}" :value="old('name_en')" name='name_en' required />
                                    <x-input-error :messages="$errors->get('name_en')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('msgs.is_active')" />
                                    <select class="form-select" name='is_active'>
                                        <option value="">{{ __('btns.select') }}</option>
                                        <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>{{ __('msgs.yes') }}</option>
                                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>{{ __('msgs.no') }}</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('setting.status')" />
                                    <select class="form-select" name='status'>
                                        <option value="">{{ __('btns.select') }}</option>
                                        <option value="retail" {{ old('is_active') == 'retail' ? 'selected' : '' }}>{{ __('stock.retail') }}</option>
                                        <option value="wholesale" {{ old('is_active') == 'wholesale' ? 'selected' : '' }}>{{ __('stock.wholesale') }}</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary">{{ __('btns.submit') }}</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-master-layout>
