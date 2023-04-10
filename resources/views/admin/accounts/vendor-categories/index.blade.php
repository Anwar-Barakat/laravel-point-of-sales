<x-master-layout>
    @section('pageTitle', __('account.vendor_categories'))
    @section('breadcrumbTitle', __('account.vendor_categories'))

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="card-title">{{ __('msgs.all', ['name' => __('account.vendor_categories')]) }}</h3>
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-vendor-category">
                {{ __('msgs.create', ['name' => __('account.vendor_category')]) }}
            </a>
        </div>

        <div class="card-body">
            <div id="table-default" class="table-responsive">
                <table id="dataTables" class="table table-vcenter table-mobile-md card-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('category.category_name') }}</th>
                            <th>{{ __('account.section') }}</th>
                            <th>{{ __('msgs.is_active') }}</th>
                            <th>{{ __('msgs.created_at') }}</th>
                            <th>{{ __('msgs.added_by') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-tbody">
                        @forelse ($vendor_categories as $vendor_category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td> {{ $vendor_category->name }}</td>
                                <td>
                                    <span class="badge bg-blue-lg">
                                        {{ $vendor_category->section->name }}
                                    </span>
                                </td>
                                <td>
                                    1
                                    {{-- @livewire('admin.stock.section.update-status', ['section_id' => $vendor_category->id, 'is_active' => $vendor_category->is_active]) --}}
                                </td>
                                <td> {{ $vendor_category->created_at }} </td>
                                <td>
                                    <span class="badge bg-blue-lt">{{ $vendor_category->addedBy->name }}</span>
                                </td>
                                <td>
                                    <span class="dropdown">
                                        <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">{{ __('btns.actions') }}</button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="#" class="dropdown-item d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#edit-section-{{ $vendor_category->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                    <path d="M16 5l3 3" />
                                                </svg>
                                                <span>{{ __('btns.edit') }}</span>
                                            </a>
                                        </div>
                                    </span>

                                    <x-modal-delete :id="$vendor_category->id" :action="route('admin.vendor-categories.destroy', ['vendor_category' => $vendor_category])" />

                                </td>
                                <!-- edit section modal -->
                                @include('admin.accounts.vendor-categories.edit')
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
                                    <x-blank-section :content="__('account.vendor_category')" :url="route('admin.vendors-categories.create')" />
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $vendor_categories->links() }}
                </div>
            </div>
        </div>

        <!-- Add section modal -->
        @include('admin.accounts.vendor-categories.create')
    </div>
</x-master-layout>
