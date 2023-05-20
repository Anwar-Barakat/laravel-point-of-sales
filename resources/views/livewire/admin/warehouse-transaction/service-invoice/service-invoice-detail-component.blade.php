<div>
    <div class="row">
        <div class="col-12 col-lg-4 mb-3">
            <div class="card">
                <div class="card-header flex justify-content-between items-center">
                    <h3 class="card-title">{{ __('msgs.main_info') }}</h3>
                    @if ($invoice->is_approved == 0 && $invoice->serviceInvoiceDetails->count() > 0)
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approval-modal">{{ __('btns.approval') }}</button>
                    @endif
                    {{-- @livewire('admin.warehouse-transaction.order.order-approval', ['order' => $order]) --}}
                </div>
                <table class="table card-table table-vcenter table-striped-columns">
                    <thead>
                        <tr>
                            <th>{{ __('msgs.column') }}</th>
                            <th colspan="2">{{ __('btns.details') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>{{ __('transaction.invoice_number') }}</th>
                            <td>{{ $invoice->id }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('transaction.invoice_type') }}</th>
                            <td>{{ $invoice->invoice_type ? __('transaction.delayed') : __('transaction.cash') }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('transaction.invoice_number') }}</th>
                            <td>{{ $invoice->account->number }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('setting.service_type') }}</th>
                            <td>
                                <span class="badge bg-red-lt">{{ __('setting.' . App\Models\Service::SERTICETYPE[$invoice->service_type]) }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('transaction.tax') }}</th>
                            <td>{{ $invoice->tax_value ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('transaction.cost_before_discount') }}</th>
                            <td>{{ $invoice->cost_before_discount ?? '0' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('transaction.discount') }}</th>
                            <td>{{ $invoice->discount_value ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('transaction.grand_total') }}</th>
                            <td>{{ $invoice->cost_after_discount ?? '0' }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('msgs.created_at') }}</th>
                            <td>{{ $invoice->created_at }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="card-footer border-top-0"></div>
            </div>
        </div>
        @if ($invoice->is_approved == 0)
            <div class="col-12 col-lg-8 mb-3" id="add-items">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('transaction.add_services') }}</h3>
                    </div>
                    <form wire:submit.prevent='submit'>
                        <div class="card-body">
                            <h3 class="mb-4 text-blue">{{ __('msgs.main_info') }}</h3>
                            <div class="row row-cards">
                                @include('layouts.errors-message')
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">
                                            {{ __('setting.services') }}
                                            (<a href="{{ route('admin.services.create') }}" class="text underline">{{ __('msgs.add_new') }}</a>)
                                        </label>
                                        <select class="form-select" wire:model='service.service_id'>
                                            <option value="">{{ __('btns.select') }}</option>
                                            @forelse ($services as $service)
                                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('transaction.total_amount')" />
                                        <x-text-input type="number" placeholder="10.15" class="form-control" wire:model.debounce.500s='service.total' />
                                    </div>
                                </div>
                            </div>
                            <div class="row-cards">
                                <div class="col-sm-12 col-12">
                                    <div class="mb-3">
                                        <x-input-label class="form-label" :value="__('msgs.notes')" />
                                        <textarea rows="3" class="form-control" wire:model.defer='service.notes' placeholder="{{ __('msgs.at_least_ten_ch') }}"></textarea>
                                        <x-input-error :messages="$errors->get('service.notes')" class="mt-2" />
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
        @else
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="ribbon ribbon-top bg-yellow">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                        </svg>
                    </div>
                    <div class="card-body flex justify-center items-center flex-column">
                        <h3 class="card-title mt-4">{{ __('transaction.order_is_closed') }}</h3>
                        <img src="{{ asset('backend/static/illustrations/undraw_quitting_time_dm8t.svg') }}" width="400" alt="{{ __('transaction.order_is_closed') }}">
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header w-100 d-flex align-items-center justify-content-between">
                    <h3 class="card-title">{{ __('stock.items') }}</h3>
                </div>
                <div>
                    <table class="table card-table table-vcenter table-striped-columns">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('setting.service') }}</th>
                                <th>{{ __('transaction.total_amount') }}</th>
                                <th>{{ __('msgs.notes') }}</th>
                                @if (!$invoice->is_approved == 1)
                                    <th></th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($serviceInvoiceDetails as $serviceInvoiceDetail)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <span class="badge bg-blue">
                                            {{ $serviceInvoiceDetail->service->name }}
                                        </span>
                                    </td>
                                    <td>{{ $serviceInvoiceDetail->total }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm" data-bs-placement="top" data-bs-toggle="popover" title="{{ __('msgs.notes') }}" data-bs-content="{{ $serviceInvoiceDetail->notes }}">{{ __('account.click_here') }}</button>
                                    </td>
                                    @if (!$invoice->is_approved == 1)
                                        <td>
                                            <div class="btn-list flex-nowrap justify-content-center">
                                                <a wire:click.prevent="edit({{ $serviceInvoiceDetail->id }})" href="javascript:;" class="btn d-flex justify-content-center align-items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success m-0" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                        <path d="M16 5l3 3" />
                                                    </svg>
                                                </a>
                                                <a wire:click.prevent="delete({{ $serviceInvoiceDetail->id }})" href="javascript:;" class="btn d-flex justify-content-center align-items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon m-0 text-danger" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M4 7l16 0" />
                                                        <path d="M10 11l0 6" />
                                                        <path d="M14 11l0 6" />
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>
                                                </a>

                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11">
                                        <x-blank-section :content="__('stock.item')" :url="'#add-items'" />
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @if ($serviceInvoiceDetails->count() > 0)
                        <div class="p-3 mt-2">
                            {{ $serviceInvoiceDetails->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>
                <div class="card-footer border-top-0">
                </div>
            </div>
        </div>
    </div>
</div>
