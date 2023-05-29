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
                <th>{{ __('transaction.qty') }}</th>
                <th>{{ __('transaction.production_date') }}</th>
                <th>{{ __('transaction.expiration_date') }}</th>
                <th>{{ __('transaction.total_price') }}</th>
                @if (!$order->is_approved == 1)
                    <th></th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($order_products as $orderProduct)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if ($orderProduct->item->getFirstMediaUrl('items'))
                            <img src="{{ $orderProduct->item->getFirstMediaUrl('items') }}" class="img img-thumbnail" alt="{{ $orderProduct->item->name }}" width="80">
                        @else
                            <img src="{{ asset('backend/static/default-show-product.png') }}" class="img img-thumbnail" alt="{{ $orderProduct->item->name }}" width="80">
                        @endif
                    </td>
                    <td>{{ $orderProduct->item->name }}</td>
                    <td>
                        <span class="badge bg-blue">
                            {{ __('stock.' . App\Models\Item::ITEMTYPE[$orderProduct->item->type]) }}
                        </span>
                    </td>
                    <td> <span class="badge bg-blue-lt">{{ $orderProduct->unit->name }}</span></td>
                    <td>{{ $orderProduct->unit_price }}</td>
                    <td>{{ $orderProduct->qty }}</td>
                    <td>{{ $orderProduct->production_date ?? '-' }}</td>
                    <td>{{ $orderProduct->expiration_date ?? '-' }}</td>
                    <td class="bg-blue-500">{{ $orderProduct->total_price }}</td>
                    @if (!$order->is_approved == 1)
                        <td>
                            <div class="btn-list flex-nowrap justify-content-center">
                                <a wire:click.prevent="edit({{ $orderProduct->id }})" href="javascript:;" class="btn d-flex justify-content-center align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success m-0" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                        <path d="M16 5l3 3" />
                                    </svg>
                                </a>
                                <a wire:click.prevent="delete({{ $orderProduct->id }})" href="javascript:;" class="btn d-flex justify-content-center align-items-center">
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
    @if ($order_products->count() > 0)
        <div class="p-3 mt-2">
            {{ $order_products->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
