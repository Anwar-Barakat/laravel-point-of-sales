<x-master-layout>
    @section('pageTitle', __('store.stores'))
    @section('breadcrumbTitle', __('store.stores'))

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="card-title">{{ __('msgs.all', ['name' => __('store.stores')]) }}</h3>
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-store">
                {{ __('msgs.create', ['name' => __('store.store')]) }}
            </a>
        </div>

        <div class="card-body">
            <div id="table-default" class="table-responsive">
                <table class="table table-vcenter table-mobile-md card-table">
                    <thead>
                        <tr>
                            <th>
                                <button class="table-sort" data-sort="sort-name">#</button>
                            </th>
                            <th>
                                <button class="table-sort" data-sort="sort-name"> {{ __('store.store') }}</button>
                            </th>
                            <th>
                                <button class="table-sort" data-sort="sort-quantity"> {{ __('msgs.is_active') }}</button>
                            </th>
                            <th>
                                <button class="table-sort" data-sort="sort-quantity"> {{ __('msgs.created_at') }}</button>
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-tbody">
                        @forelse ($stores as $store)
                            <tr>
                                <td class="sort-name">{{ $loop->iteration }}</td>
                                <td class="sort-city">{{ $store->name }}</td>
                                <td class="sort-type">
                                    @livewire('admin.store.update-status', ['store_id' => $store->id, 'is_active' => $store->is_active])

                                </td>
                                <td class="sort-progress"> {{ $store->created_at }} </td>
                                <td>
                                    <span class="dropdown">
                                        <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">{{ __('btns.actions') }}</button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="#" class="dropdown-item d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#edit-store-{{ $store->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                    <path d="M16 5l3 3" />
                                                </svg>
                                                <span>{{ __('btns.edit') }}</span>
                                            </a>
                                            <a href="#" class="dropdown-item d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#modal-danger-{{ $store->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon m-0 text-danger" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M4 7l16 0" />
                                                    <path d="M10 11l0 6" />
                                                    <path d="M14 11l0 6" />
                                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                </svg>
                                                <span>{{ __('btns.delete') }}</span>
                                            </a>
                                        </div>
                                    </span>

                                    <x-modal-delete :id="$store->id" :action="route('admin.stores.destroy', ['store' => $store])" />

                                </td>
                                <!-- edit store modal -->
                                @include('admin.stores.edit')
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <x-blank-section :content="__('store.store')" :url="route('admin.stores.create')" />
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $stores->links() }}
                </div>
            </div>
        </div>

        <!-- Add store modal -->
        @include('admin.stores.create')
    </div>
</x-master-layout>
