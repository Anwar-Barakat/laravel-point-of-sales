<form wire:submit.prevent='submit'>
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="card-title">{{ __('msgs.all', ['name' => __('report.reports_of', ['name' => __('account.vendors')])]) }}</h3>
        </div>

        <div class="card-body">
            <div id="table-default" class="table-responsive">
                <div class="row row-cards">
                    <div class="col-sm-12 col-md-4 col-lg-3">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('stock.vendor')" />
                            <select class="form-select" wire:model='vendor_id' required>
                                <option value="">{{ __('btns.select') }}</option>
                                @foreach ($vendors as $vendor)
                                    <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('vendor_id')" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-3">
                        <div class="mb-3">
                            <x-input-label class="form-label" :value="__('report.report_type')" />
                            <select class="form-select" wire:model='report_type' required>
                                <option value="">{{ __('btns.select') }}</option>
                                <option value="1">{{ __('report.total_account_statement') }}</option>
                                <option value="2">{{ __('report.detailed_statement_of_account_within_a_period') }}</option>
                                <option value="3">{{ __('report.purchase_account_statement_within_a_period') }}</option>
                                <option value="4">{{ __('report.purchase_return_statement_within_a_period') }}</option>
                                <option value="5">{{ __('report.monetory_statement_during_a_period') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('report_type')" class="mt-2" />
                        </div>
                    </div>
                    @if ($date)
                        <div class="col-sm-12 col-md-4 col-lg-3">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('report.reports_from_date')" />
                                <input type="date" class="form-control" wire:model='reports_from_date'>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-3">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('report.reports_to_date')" />
                                <input type="date" class="form-control" wire:model='reports_to_date'>
                            </div>
                        </div>
                    @endif
                </div>
                <br>
            </div>
        </div>

        <div class="card-footer text-end">
            <button type="submit" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-report-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697"></path>
                    <path d="M18 12v-5a2 2 0 0 0 -2 -2h-2"></path>
                    <path d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                    <path d="M8 11h4"></path>
                    <path d="M8 15h3"></path>
                    <path d="M16.5 17.5m-2.5 0a2.5 2.5 0 1 0 5 0a2.5 2.5 0 1 0 -5 0"></path>
                    <path d="M18.5 19.5l2.5 2.5"></path>
                </svg>
                {{ __('btns.display_report') }}
            </button>
        </div>
    </div>

</form>
