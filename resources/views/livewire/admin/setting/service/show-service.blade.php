<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <h3 class="card-title">{{ __('msgs.all', ['name' => __('setting.services')]) }}</h3>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
            {{ __('msgs.create', ['name' => __('setting.service')]) }}
        </a>
    </div>

    <div class="card-body">
        <div id="table-default" class="table-responsive">
            <div class="row row-cards mb-3">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('msgs.search_by_name')" />
                        <x-text-input class="form-control" placeholder="{{ __('btns.search') }}" wire:model="name" />
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('setting.service_type')" />
                        <select class="form-select" wire:model='type'>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="0">{{ __('setting.internal_services') }}</option>
                            <option value="1">{{ __('setting.external_services') }}</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-2">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('msgs.per_page')" />
                        <select class="form-select" wire:model='per_page'>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-2">
                    <div class="mb-3">
                        <x-input-label class="form-label" :value="__('msgs.sort_by')" />
                        <select class="form-select" wire:model='sort_by'>
                            <option value="">{{ __('btns.select') }}</option>
                            <option value="asc">{{ __('msgs.asc') }}</option>
                            <option value="desc">{{ __('msgs.desc') }}</option>
                        </select>
                        <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                    </div>
                </div>
            </div>
            <table id="dataTables" class="table table-vcenter table-mobile-md card-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th> {{ __('setting.service_name') }}</th>
                        <th> {{ __('setting.service_type') }}</th>
                        <th> {{ __('msgs.is_active') }}</th>
                        <th> {{ __('msgs.created_at') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-tbody">
                    @forelse ($services as $service)
                        <tr>
                            <td>{{ $service->id }}</td>
                            <td>{{ $service->name }}</td>
                            <td>
                                <span class="badge bg-{{ $service->type == 0 ? 'blue' : 'green' }}">{{ __('setting.' . App\Models\Service::SERTICETYPE[$service->type]) }}</span>
                            </td>
                            <td>
                                <div>
                                    <button wire:click='updateStatus({{ $service }})' class="btn position-relative">
                                        {{ $service->is_active ? __('msgs.active') : __('msgs.not_active') }}
                                        <span class="badge {{ $service->is_active ? 'bg-green' : 'bg-red' }} badge-notification badge-blink"></span>
                                    </button>
                                </div>
                            </td>
                            <td> {{ $service->created_at }} </td>
                            <td>
                                <span class="dropdown">
                                    <button class="btn dropdown-toggle align-text-top " data-bs-boundary="viewport" data-bs-toggle="dropdown">{{ __('btns.actions') }}</button>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="{{ route('admin.services.edit', ['service' => $service]) }}" class="dropdown-item d-flex align-items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                <path d="M16 5l3 3" />
                                            </svg>
                                            <span>{{ __('btns.edit') }}</span>
                                        </a>
                                        <a href="#" class="dropdown-item d-flex align-items-center gap-1" data-bs-toggle="modal" data-bs-target="#modal-danger-{{ $service->id }}">
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
                                <x-modal-delete :id="$service->id" :action="route('admin.services.destroy', ['service' => $service])" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">
                                <x-blank-section :content="__('stock.service')" :url="route('admin.categories.create')" />
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="p-3 mt-2">
                {{ $services->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <div class="card-footer">
    </div>
</div>
