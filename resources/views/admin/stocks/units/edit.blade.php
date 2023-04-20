<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('stock.unit')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('stock.unit')]))

    <div class="card">
        <div class="row g-0">
            <div class="col d-flex flex-column">
                <form action="{{ route('admin.units.update', ['unit' => $unit]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <h3 class="mb-4">{{ __('msgs.main_info') }}</h3>
                        <div class="row row-cards">
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('msgs.name_ar')" />
                                    <x-text-input type="text" class="form-control" placeholder="{{ __('stock.unit_ar') }}" :value="old('name_ar', $unit->getTranslation('name', 'ar'))" name='name_ar' required />
                                    <x-input-error :messages="$errors->get('name_ar')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('msgs.name_en')" />
                                    <x-text-input type="text" class="form-control" placeholder="{{ __('stock.unit_en') }}" :value="old('name_en', $unit->getTranslation('name', 'en'))" name='name_en' required />
                                    <x-input-error :messages="$errors->get('name_en')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('msgs.is_active')" />
                                    <select class="form-select" name='is_active'>
                                        <option value="">{{ __('btns.select') }}</option>
                                        <option value="1" {{ $unit->is_active ? 'selected' : '' }}>{{ __('msgs.yes') }}</option>
                                        <option value="0" {{ $unit->is_active == '0' ? 'selected' : '' }}>{{ __('msgs.no') }}</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('setting.status')" />
                                    <select class="form-select" name='status'>
                                        <option value="">{{ __('btns.select') }}</option>
                                        <option value="retail" {{ $unit->status == 'retail' ? 'selected' : '' }}>{{ __('stock.retail') }}</option>
                                        <option value="wholesale" {{ $unit->status == 'wholesale ' ? 'selected' : '' }}>{{ __('stock.wholesale') }}</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
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
</x-master-layout>
