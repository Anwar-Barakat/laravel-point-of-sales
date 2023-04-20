    <div class="modal modal-blur fade" id="approval-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered large-modal" role="document">
            <form class="w-100">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('movement.approval_and_posting') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('movement.items_cost')" />
                                    <x-text-input type="text" class="form-control" wire:model='order.items_cost' readonly disabled />
                                    <x-input-error :messages="$errors->get('order.items_cost')" class="mt-2" />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('movement.tax_type')" />
                                    <select class="form-select" wire:model='order.tax_type'>
                                        <option value="">{{ __('btns.select') }}</option>
                                        <option value="0">{{ __('movement.percentage') }}</option>
                                        <option value="1">{{ __('movement.fixed') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('movement.tax')" />
                                    <x-text-input type="text" class="form-control" wire:model='order.tax_value' />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('movement.cost_before_discount')" />
                                    <x-text-input type="number" class="form-control" wire:model='order.cost_before_discount' readonly disabled />
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('movement.discount_type')" />
                                    <select class="form-select" wire:model='order.discount_type'>
                                        <option value="">{{ __('btns.select') }}</option>
                                        <option value="0">{{ __('movement.percentage') }}</option>
                                        <option value="1">{{ __('movement.fixed') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('movement.discount')" />
                                    <x-text-input type="text" class="form-control" wire:model='order.discount_value' />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('movement.cost_after_discount')" />
                                    <x-text-input type="text" class="form-control" wire:model='order.cost_after_discount' readonly disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <br>
                    <div class="modal-footer">
                        <a href="#" class="btn link-secondary" data-bs-dismiss="modal">
                            {{ __('btns.cancel') }}
                        </a>
                        <a href="#" class="btn btn-success ms-auto" data-bs-dismiss="modal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l5 5l10 -10" />
                            </svg>
                            {{ __('btns.approval') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
