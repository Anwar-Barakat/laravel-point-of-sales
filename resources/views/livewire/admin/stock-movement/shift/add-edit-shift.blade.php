<div class="col d-flex flex-column">
    <form wire:submit.prevent='submit'>
        @if ($errors->any())
            {{ implode('', $errors->all('<div>:message</div>')) }}
        @endif
        <div class="card-body">
            <h3 class="mb-4 text-blue">{{ __('msgs.main_info') }}</h3>
            <div class="row row-cards">
                <div class="col-sm-12 col-md-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('treasury.treasury')" />
                        <select class="form-select" wire:model.debounce.500s='shift.treasury_id'>
                            <option value="">{{ __('btns.select') }}</option>
                            @if ($treasuries)
                                @foreach ($treasuries as $treasury)
                                    @php
                                        $not_available = App\Models\Shift::where(['treasury_id' => $treasury->id, 'admin_id' => $auth->id, 'company_code' => $auth->company_code])->exists();
                                    @endphp
                                    <option value="{{ $treasury->id }}" {{ $not_available ? 'disabled' : '' }}>
                                        {{ $treasury->name }}
                                        {{ $not_available ? __('movement.not_available_now') : '' }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <x-input-error :messages="$errors->get('shift.treasury_id')" class="mt-2" />
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
