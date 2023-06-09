<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('stock.categories')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('stock.categories')]))
    @section('breadcrumbSubtitle', __('partials.stocks'))

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="card-title">{{ __('msgs.all', ['name' => __('stock.categories')]) }}</h3>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                {{ __('msgs.create', ['name' => __('stock.category')]) }}
            </a>
        </div>
        <div class="card-body">
            <div id="table-default" class="table-responsive">
                <table id="dataTables" class="table table-vcenter table-mobile-md card-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th> {{ __('stock.category') }}</th>
                            <th>{{ __('stock.section') }}</th>
                            <th>{{ __('msgs.is_it_parent') }}</th>
                            <th> {{ __('msgs.is_active') }}</th>
                            <th> {{ __('msgs.created_at') }}</th>
                            <th> {{ __('msgs.added_by') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-tbody">
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <span class="badge badge-outline text-blue">{{ $category->section->name }}</span>
                                </td>
                                <td>
                                    @if ($category->parent_id == '0')
                                        <span class="badge badge-outline text-green">{{ __('msgs.parent') }}</span>
                                    @else
                                        <span class="badge badge-outline text-purple">
                                            {{ $category->parentCategory->name }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @livewire('admin.stock.category.update-status', ['category_id' => $category->id, 'is_active' => $category->is_active])
                                </td>
                                <td> {{ $category->created_at }} </td>
                                <td>
                                    <span class="badge bg-blue-lt">{{ $category->addedBy->name }}</span>
                                </td>
                                <td>
                                    <span class="dropdown">
                                        <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">{{ __('btns.actions') }}</button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="{{ route('admin.categories.edit', ['category' => $category]) }}" class="dropdown-item d-flex align-items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                    <path d="M16 5l3 3" />
                                                </svg>
                                                <span>{{ __('btns.edit') }}</span>
                                            </a>
                                            <a href="#" class="dropdown-item d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#modal-danger-{{ $category->id }}">
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
                                    <x-modal-delete :id="$category->id" :action="route('admin.categories.destroy', ['category' => $category])" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <x-blank-section :content="__('stock.category')" :url="route('admin.categories.create')" />
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $categories->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
        <div class="card-footer">
        </div>
    </div>
</x-master-layout>
