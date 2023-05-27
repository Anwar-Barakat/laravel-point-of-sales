<div class="col d-flex flex-column">
    <form wire:submit.prevent='submit'>
        <div class="card-body">
            <h3 class="mb-4 text-blue">{{ __('msgs.main_info') }}</h3>
            <div class="row row-cards">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('transaction.production_plan_date')" />
                        @if ($production_line->is_closed == 1)
                            <input class="form-control" value="{{ $production_line->plan_date }}" readonly disabled>
                        @else
                            <x-text-input type="date" class="form-control" wire:model.debounce.500s='production_line.plan_date' />
                        @endif
                        <x-input-error :messages="$errors->get('production_line.plan_date')" class="mt-2" />
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('transaction.production_plan')" />
                        @if ($production_line->is_closed == 1)
                            <input class="form-control" value="{{ $production_line->plan }}" readonly disabled>
                        @else
                            <input class="form-control" wire:model.debounce.500s='production_line.plan' placeholder="{{ __('msgs.at_least_ten_ch') }}" {{ $production_line->is_closed == 1 ? 'disabled readonly' : '' }}>
                            <x-input-error :messages="$errors->get('production_line.plan')" class="mt-2" />
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-end">
            @if ($production_line->is_closed == 0)
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
            @endif
        </div>
    </form>
</div>
