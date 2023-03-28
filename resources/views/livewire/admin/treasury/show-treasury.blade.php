<div class="card-body">
    <div id="table-default" class="table-responsive">
        <div class="row">
            <div class="col-sm-12 col-md-4 col-lg-2">
                <div class="mb-3">
                    <x-input-label class="form-label" :value="__('msgs.search_by_name')" />
                    <x-text-input class="form-control" placeholder="{{ __('btns.search') }}" wire:model="name" />
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-2">
                <div class="mb-3">
                    <x-input-label class="form-label" :value="__('msgs.added_by')" />
                    <select id="" class="form-control" wire:model='added_by'>
                        <option value="">{{ __('btns.select') }}</option>
                        @foreach (App\Models\Admin::all() as $admin)
                            <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-2">
                <div class="mb-3">
                    <x-input-label class="form-label" :value="__('msgs.order_by')" />
                    <select id="" class="form-control" wire:model='order_by'>
                        <option value="">{{ __('btns.select') }}</option>
                        <option value="last_payment_receipt">{{ __('treasury.last_payment_receipt') }}</option>
                        <option value="last_payment_collect">{{ __('treasury.last_payment_collect') }}</option>
                    </select>
                    <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-2">
                <div class="mb-3">
                    <x-input-label class="form-label" :value="__('msgs.per_page')" />
                    <select id="" class="form-control" wire:model='per_page'>
                        <option value="">{{ __('btns.select') }}</option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">10</option>
                    </select>
                    <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-2">
                <div class="mb-3">
                    <x-input-label class="form-label" :value="__('msgs.sort_by')" />
                    <select id="" class="form-control" wire:model='sort_by'>
                        <option value="">{{ __('btns.select') }}</option>
                        <option value="asc">{{ __('msgs.asc') }}</option>
                        <option value="desc">{{ __('msgs.desc') }}</option>
                    </select>
                    <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                </div>
            </div>
        </div>
        <br>
        <table class="table table-vcenter table-mobile-md card-table">
            <thead>
                <tr>
                    <th>
                        <button class="table-sort" data-sort="sort-name">#</button>
                    </th>
                    <th>
                        <button class="table-sort" data-sort="sort-name"> {{ __('treasury.treasury') }}</button>
                    </th>
                    <th>
                        <button class="table-sort" data-sort="sort-city"> {{ __('msgs.is_master') }}</button>
                    </th>
                    <th>
                        <button class="table-sort" data-sort="sort-quantity"> {{ __('msgs.is_active') }}</button>
                    </th>
                    <th>
                        <button class="table-sort" data-sort="sort-type"> {{ __('treasury.last_payment_receipt') }}</button>
                    </th>
                    <th>
                        <button class="table-sort" data-sort="sort-score"> {{ __('treasury.last_payment_receipt') }}</button>
                    </th>
                    <th>
                        <button class="table-sort" data-sort="sort-quantity"> {{ __('msgs.created_at') }}</button>
                    </th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-tbody">
                @forelse ($treasuries as $treasury)
                    <tr>
                        <td class="sort-name">{{ $loop->iteration }}</td>
                        <td class="sort-city">{{ $treasury->name }}</td>
                        <td class="sort-quantity">
                            @if ($treasury->is_master)
                                <span class="badge badge-outline text-green">{{ __('msgs.master') }}</span>
                            @else
                                <span class="badge badge-outline text-blue">{{ __('msgs.branch') }}</span>
                            @endif

                        </td>
                        <td class="sort-type">
                            @livewire('admin.treasury.update-status', ['treasury_id' => $treasury->id, 'is_active' => $treasury->is_active])
                        </td>
                        <td class="sort-score">{{ $treasury->last_payment_receipt }}</td>
                        <td class="sort-date"> {{ $treasury->last_payment_collect }}</td>
                        <td class="sort-progress"> {{ $treasury->created_at }} </td>
                        <td>
                            <span class="dropdown">
                                <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">{{ __('btns.actions') }}</button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item d-flex align-items-center gap-1" href="{{ route('admin.treasuries.edit', ['treasury' => $treasury]) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                            <path d="M16 5l3 3" />
                                        </svg>
                                        <span>{{ __('btns.edit') }}</span>
                                    </a>
                                    <a class="dropdown-item d-flex align-items-center gap-1" href="{{ route('admin.treasuries.show', ['treasury' => $treasury]) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon text-warning" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
                        <td colspan="8">
                            <x-blank-section :content="__('treasury.treasury')" :url="route('admin.treasuries.create')" />
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $treasuries->links() }}
        </div>
    </div>
</div>
