    <div class="modal modal-blur fade" wire:ignore.self id="approval-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered large-modal" role="document">
            <form class="w-100" wire:submit.prevent='submit'>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('transaction.approval_and_posting') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h3 class="mb-3 text-blue">{{ __('transaction.items_tax_discount') }}</h3>
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('transaction.services_cost')" />
                                    <x-text-input type="number" placeholder="10.15" class="form-control" wire:model='invoice.services_cost' readonly disabled />
                                    <x-input-error :messages="$errors->get('invoice.services_cost')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('transaction.tax_type')" />
                                    <select class="form-select" wire:model='invoice.tax_type'>
                                        <option value="">{{ __('btns.select') }}</option>
                                        <option value="0">{{ __('transaction.percentage') }}</option>
                                        <option value="1">{{ __('transaction.fixed') }}</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('invoice.tax_type')" class="mt-2" />
                                </div>
                            </div>
                            @if ($invoice->tax_type != null)
                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('transaction.tax')" />
                                        <x-text-input type="number" placeholder="10.15" class="form-control" wire:model='invoice.tax_value' />
                                        <x-input-error :messages="$errors->get('invoice.tax_value')" class="mt-2" />
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('transaction.services_cost') . ' + ' . __('transaction.tax')" />
                                    <x-text-input type="number" placeholder="10.15" class="form-control" wire:model='invoice.cost_before_discount' readonly disabled />
                                    <x-input-error :messages="$errors->get('invoice.cost_before_discount')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('transaction.discount_type')" />
                                    <select class="form-select" wire:model='invoice.discount_type'>
                                        <option value="">{{ __('btns.select') }}</option>
                                        <option value="0">{{ __('transaction.percentage') }}</option>
                                        <option value="1">{{ __('transaction.fixed') }}</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('invoice.discount_type')" class="mt-2" />
                                </div>
                            </div>
                            @if ($invoice->discount_type != null)
                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('transaction.discount')" />
                                        <x-text-input type="number" placeholder="10.15" class="form-control" wire:model='invoice.discount_value' />
                                        <x-input-error :messages="$errors->get('invoice.discount_value')" class="mt-2" />
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            @if (has_open_shift())
                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('treasury.treasury')" />
                                        <x-text-input type="text" class="form-control" :value="has_open_shift()->treasury->name" disabled readonly />
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('account.treasury_available_balance')" />
                                        <x-text-input type="number" placeholder="10.15" class="form-control" :value="get_treasury_balance()" disabled readonly />
                                    </div>
                                </div>
                            @endif
                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('transaction.cost_after_discount')" />
                                    <x-text-input type="number" placeholder="10.15" class="form-control bg-info text-white" wire:model='invoice.cost_after_discount' readonly disabled />
                                    <x-input-error :messages="$errors->get('invoice.cost_after_discount')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <hr class="mt-4 mb-3 w-50">
                        <h3 class="mb-3 text-blue">{{ __('transaction.payments_reminders') }}</h3>
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('transaction.invoice_type')" />
                                    <select class="form-select" wire:model='invoice.invoice_type' disabled readonly>
                                        <option value="">{{ __('btns.select') }}</option>
                                        <option value="{{ $invoice->invoice_type }}">
                                            {{ $invoice->invoice_type ? __('transaction.delayed') : __('transaction.cash') }}
                                        </option>
                                    </select>
                                    <x-input-error :messages="$errors->get('invoice.invoice_type')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('transaction.paid_amount')" />
                                    <input type="number" placeholder="10.15" class="form-control" wire:model='invoice.paid' {{ $invoice->invoice_type == 0 ? 'readonly disabled' : '' }} />
                                    <x-input-error :messages="$errors->get('invoice.paid')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('transaction.remain_amount')" />
                                    <x-text-input type="number" placeholder="10.15" class="form-control" wire:model='invoice.remains' readonly disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-4 mb-3">
                    <div class="modal-footer">
                        <a href="#" class="btn link-secondary" data-bs-dismiss="modal">
                            {{ __('btns.cancel') }}
                        </a>
                        <button type="submit" class="btn btn-success ms-auto" data-bs-dismiss="modal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l5 5l10 -10" />
                            </svg>
                            {{ __('btns.approval') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
