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
                    <x-input-label class="form-label" :value="__('treasury.added_by')" />
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
                        <button class="table-sort" data-sort="sort-city"> {{ __('treasury.is_master') }}</button>
                    </th>
                    <th>
                        <button class="table-sort" data-sort="sort-quantity"> {{ __('treasury.is_active') }}</button>
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
                                <span class="badge badge-outline text-green">{{ __('treasury.master') }}</span>
                            @else
                                <span class="badge badge-outline text-blue">{{ __('treasury.branch') }}</span>
                            @endif

                        </td>
                        <td class="sort-type">
                            @if ($treasury->is_active)
                                <button class="btn position-relative">{{ __('treasury.active') }}
                                    <span class="badge bg-green badge-notification badge-blink"></span>
                                </button>
                            @else
                                <button class="btn position-relative">{{ __('treasury.not_active') }}
                                    <span class="badge bg-red badge-notification badge-blink"></span>
                                </button>
                            @endif
                        </td>
                        <td class="sort-score">{{ $treasury->last_payment_receipt }}</td>
                        <td class="sort-date"> {{ $treasury->last_payment_collect }}</td>
                        <td class="sort-progress"> {{ $treasury->created_at }} </td>
                        <td>
                            <span class="dropdown">
                                <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">{{ __('btns.actions') }}</button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{ route('admin.treasuries.edit', ['treasury' => $treasury]) }}">
                                        <span class="text text-success"><i class="fas fa-times"></i></span>
                                        {{ __('btns.edit') }}
                                    </a>
                                </div>
                            </span>
                        </td>
                    </tr>
                @empty
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {{ $treasuries->links() }}
        </div>
    </div>
</div>
