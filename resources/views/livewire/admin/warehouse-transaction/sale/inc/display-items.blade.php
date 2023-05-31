<div>
    <table class="table card-table table-vcenter table-striped-columns">
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('stock.item') }}</th>
                <th>{{ __('stock.item_name') }}</th>
                <th>{{ __('stock.item_type') }}</th>
                <th>{{ __('stock.unit') }}</th>
                <th>{{ __('stock.unit_price') }}</th>
                <th>{{ __('transaction.sale_type') }}</th>
                <th>{{ __('transaction.qty') }}</th>
                <th>{{ __('transaction.production_date') }}</th>
                <th>{{ __('transaction.expiration_date') }}</th>
                <th>{{ __('transaction.total_price') }}</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sale_products as $saleProduct)
                <tr>
                    <td>{{ $saleProduct->id }}</td>
                    <td>
                        @if ($saleProduct->item->getFirstMediaUrl('items'))
                            <img src="{{ $saleProduct->item->getFirstMediaUrl('items') }}" class="img img-thumbnail" alt="{{ $saleProduct->item->name }}" width="80">
                        @else
                            <img src="{{ asset('backend/static/default-show-product.png') }}" class="img img-thumbnail" alt="{{ $saleProduct->item->name }}" width="80">
                        @endif
                    </td>
                    <td>{{ $saleProduct->item->name }}</td>
                    <td>
                        <span class="badge bg-blue">
                            {{ __('stock.' . App\Models\Item::ITEMTYPE[$saleProduct->item->type]) }}
                        </span>
                    </td>
                    <td> <span class="badge bg-blue-lt">{{ $saleProduct->unit->name }}</span></td>
                    <td>{{ $saleProduct->unit_price }}</td>
                    <td>
                        <span class="badge bg-azure-lt">
                            {{ __('transaction.' . App\Models\SaleProduct::SALETYPE[$saleProduct->sale_type]) }}
                        </span>
                    </td>
                    <td>{{ $saleProduct->qty }}</td>
                    <td>{{ $saleProduct->item_batch->production_date ?? '-' }}</td>
                    <td>{{ $saleProduct->item_batch->expiration_date ?? '-' }}</td>
                    <td class="bg-blue-500">{{ $saleProduct->total_price }}</td>
                    <td>
                        <div class="btn-list flex-nowrap justify-content-center">
                            @if (!$sale->is_approved == 1)
                                <a wire:click.prevent="edit({{ $saleProduct->id }})" href="javascript:;" class="btn d-flex justify-content-center align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success m-0" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                        <path d="M16 5l3 3" />
                                    </svg>
                                </a>
                                <a wire:click.prevent="delete({{ $saleProduct->id }})" href="javascript:;" class="btn d-flex justify-content-center align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon m-0 text-danger" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 7l16 0" />
                                        <path d="M10 11l0 6" />
                                        <path d="M14 11l0 6" />
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                </a>
                            @endif
                            <a href="#" class="btn d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#barcode{{ $saleProduct->item->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon m-0 icon-tabler icon-tabler-scan" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M4 7v-1a2 2 0 0 1 2 -2h2"></path>
                                    <path d="M4 17v1a2 2 0 0 0 2 2h2"></path>
                                    <path d="M16 4h2a2 2 0 0 1 2 2v1"></path>
                                    <path d="M16 20h2a2 2 0 0 0 2 -2v-1"></path>
                                    <path d="M5 12l14 0"></path>
                                </svg>
                            </a>
                        </div>
                        <x-barcode-modal :id="$saleProduct->item->id" :name="$saleProduct->item->name" :barcode="$saleProduct->item->barcode" />
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="12">
                        <x-blank-section :content="__('stock.item')" :url="'#add-items'" />
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    @if ($sale_products->count() > 0)
        <div class="p-3 mt-2">
            {{ $sale_products->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
