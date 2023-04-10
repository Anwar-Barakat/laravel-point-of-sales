<x-master-layout>
    @section('pageTitle', __('stock.sections'))
    @section('breadcrumbTitle', __('stock.sections'))

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="card-title">{{ __('msgs.all', ['name' => __('stock.sections')]) }}</h3>
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-section">
                {{ __('msgs.create', ['name' => __('stock.section')]) }}
            </a>
        </div>

        <div class="card-body">
            <div id="table-default" class="table-responsive">
                <table id="dataTables" class="table table-vcenter table-mobile-md card-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('stock.section') }}</th>
                            <th>{{ __('partials.status') }}</th>
                            <th>{{ __('msgs.created_at') }}</th>
                            <th>{{ __('msgs.added_by') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-tbody">
                        @forelse ($sections as $section)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td> {{ $section->name }}</td>
                                <td>
                                    @livewire('admin.stock.section.update-status', ['section_id' => $section->id, 'is_active' => $section->is_active])
                                </td>
                                <td> {{ $section->created_at }} </td>
                                <td>
                                    <span class="badge bg-blue-lt">{{ $section->addedBy->name }}</span>
                                </td>
                                <td>
                                    <span class="dropdown">
                                        <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">{{ __('btns.actions') }}</button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="#" class="dropdown-item d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#edit-section-{{ $section->id }}">
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

                                    <x-modal-delete :id="$section->id" :action="route('admin.sections.destroy', ['section' => $section])" />

                                </td>
                                <!-- edit section modal -->
                                @include('admin.stocks.sections.edit')
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <x-blank-section :content="__('stock.section')" :url="route('admin.sections.create')" />
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $sections->links() }}
                </div>
            </div>
        </div>

        <!-- Add section modal -->
        @include('admin.stocks.sections.create')
    </div>
</x-master-layout>
