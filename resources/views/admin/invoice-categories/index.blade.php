<x-master-layout>
    @section('pageTitle', __('invoiceCat.invoice_categories'))
    @section('breadcrumbTitle', __('invoiceCat.invoice_categories'))

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="card-title">{{ __('msgs.all', ['name' => __('invoiceCat.invoice_categories')]) }}</h3>
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-invoice-category">
                {{ __('msgs.create', ['name' => __('invoiceCat.invoice_category')]) }}
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
                                <button class="table-sort" data-sort="sort-name"> {{ __('invoiceCat.invoice_category') }}</button>
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
                        @forelse ($invoiceCategories as $cat)
                            <tr>
                                <td class="sort-name">{{ $loop->iteration }}</td>
                                <td class="sort-city">{{ $cat->name }}</td>

                                <td class="sort-type">
                                    @if ($cat->is_active)
                                        <button class="btn position-relative">{{ __('msgs.active') }}
                                            <span class="badge bg-green badge-notification badge-blink"></span>
                                        </button>
                                    @else
                                        <button class="btn position-relative">{{ __('msgs.not_active') }}
                                            <span class="badge bg-red badge-notification badge-blink"></span>
                                        </button>
                                    @endif
                                </td>
                                <td class="sort-progress"> {{ $cat->created_at }} </td>
                                <td>
                                    <span class="dropdown">
                                        <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">{{ __('btns.actions') }}</button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item d-flex align-items-center gap-1" href="">
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
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <x-blank-section :content="__('invoiceCat.invoice_category')" :url="route('admin.invoice-categories.create')" />
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $invoiceCategories->links() }}
                </div>
            </div>
        </div>

        <!-- Add invoice category modal -->
        <div class="modal modal-blur fade" wire:ignore.self id="add-invoice-category" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> {{ __('msgs.create', ['name' => __('invoiceCat.invoice_category')]) }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('admin.invoice-categories.store') }}">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('invoiceCat.invoice_category_ar')" />
                                <x-text-input type="text" name="name_ar" class="form-control" placeholder="{{ __('msgs.name_ar') }}" :value="old('name_ar')" required />
                                <x-input-error :messages="$errors->get('name_ar')" class="mt-2" />
                            </div>
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('invoiceCat.invoice_category_en')" />
                                <x-text-input type="text" name="name_en" class="form-control" placeholder="{{ __('msgs.name_en') }}" :value="old('name_en')" required />
                                <x-input-error :messages="$errors->get('name_en')" class="mt-2" />
                            </div>
                            <div class="mb-3">
                                <x-input-label class="form-label" :value="__('msgs.is_it_active')" />
                                <select class="form-control" name="is_active">
                                    <option value="">{{ __('btns.select') }}</option>
                                    <option value="1" {{ old('is_active') ? 'selected' : '' }}>{{ __('msgs.yes') }}</option>
                                    <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>{{ __('msgs.no') }}</option>
                                </select>
                                <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                            </div>
                        </div>
                        <hr class="mt-0">
                        <div class="modal-footer">
                            <button type="button" class="btn" data-bs-dismiss="modal">
                                {{ __('btns.cancel') }}
                            </button>
                            <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                {{ __('btns.submit') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-master-layout>