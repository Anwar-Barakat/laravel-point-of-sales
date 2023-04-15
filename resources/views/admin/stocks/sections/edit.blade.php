<div class="modal modal-blur fade" id="edit-section-{{ $section->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> {{ __('msgs.edit', ['name' => __('stock.section')]) }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('admin.sections.update', ['section' => $section]) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.section_ar')" />
                        <x-text-input type="text" name="name_ar" class="form-control" placeholder="{{ __('msgs.name_ar') }}" :value="old('name_ar', $section->getTranslation('name', 'ar'))" required />
                        <x-input-error :messages="$errors->get('name_ar')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('stock.section_en')" />
                        <x-text-input type="text" name="name_en" class="form-control" placeholder="{{ __('msgs.name_en') }}" :value="old('name_en', $section->getTranslation('name', 'en'))" required />
                        <x-input-error :messages="$errors->get('name_en')" class="mt-2" />
                    </div>
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('msgs.is_it_active')" />
                        <select class="form-select" name="is_active">
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="1" {{ $section->is_active ? 'selected' : '' }}>{{ __('msgs.yes') }}</option>
                            <option value="0" {{ $section->is_active == '0' ? 'selected' : '' }}>{{ __('msgs.no') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
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
                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                            <path d="M16 5l3 3" />
                        </svg>
                        {{ __('btns.update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
