<div class="card-body">
    <div id="table-default" class="table-responsive">
        <table id="dataTables" class="table table-vcenter table-mobile-md card-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th> {{ __('msgs.photo') }}</th>
                    <th> {{ __('stock.item_name') }}</th>
                    <th> {{ __('stock.item_type') }}</th>
                    <th> {{ __('stock.item_category') }}</th>
                    <th> {{ __('stock.parent_item') }}</th>
                    <th> {{ __('stock.parent_unit') }}</th>
                    <th> {{ __('stock.child_unit') }}</th>
                    <th> {{ __('setting.status') }}</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-tbody">
                @forelse ($items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if ($item->getFirstMediaUrl('items', 'thumb'))
                                <img src="{{ $item->getFirstMediaUrl('items') }}" class="img img-thumbnail" alt="{{ $item->name }}" width="80">
                            @else
                                <img src="{{ asset('backend/static/default-show-product.png') }}" class="img img-thumbnail" alt="{{ $item->name }}" width="80">
                            @endif
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <span class="badge bg-blue">
                                {{ __('stock.' . App\Models\Item::ITEMTYPE[$item->type]) }}
                            </span>
                        </td>
                        <td><span class="badge badge-outline text-blue">{{ $item->category->name }}</span></td>
                        <td>{{ $item->parentItem->name ?? '-' }}</td>
                        <td><span class="badge bg-blue-lt">{{ $item->parentUnit->name }}</span></td>
                        <td><span class="badge bg-blue-lt">{{ $item->childUnit->name ?? '-' }}</span></td>
                        <td>
                            <div>
                                <button wire:click='updateStatus({{ $item->id }})' class="btn position-relative">
                                    {{ $item->is_active ? __('msgs.active') : __('msgs.not_active') }}
                                    <span class="badge {{ $item->is_active ? 'bg-green' : 'bg-red' }} badge-notification badge-blink"></span>
                                </button>
                            </div>
                        </td>
                        <td>
                            <span class="dropdown">
                                <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">{{ __('btns.actions') }}</button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item d-flex align-items-center gap-1" href="{{ route('admin.items.edit', $item) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                            <path d="M16 5l3 3" />
                                        </svg>
                                        <span>{{ __('btns.edit') }}</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center gap-1" href="{{ route('admin.items.show', ['item' => $item]) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text text-info" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M13 5h8" />
                                            <path d="M13 9h5" />
                                            <path d="M13 15h8" />
                                            <path d="M13 19h5" />
                                            <path d="M3 4m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                            <path d="M3 14m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                                        </svg>
                                        <span>{{ __('btns.details') }}</span>
                                    </a>
                                </div>
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">
                            <x-blank-section :content="__('stock.item')" :url="route('admin.items.create')" />
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-3 mt-2">
            {{ $items->links() }}
        </div>
    </div>
</div>
