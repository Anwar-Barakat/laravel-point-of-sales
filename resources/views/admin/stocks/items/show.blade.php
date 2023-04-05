<x-master-layout>
    @section('pageTitle', __('msgs.details', ['name' => __('item.item')]))
    @section('breadcrumbTitle', __('msgs.details', ['name' => __('item.item')]))
    @section('breadcrumbSubtitle', __('partials.stocks'))

    <div class="row">
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('msgs.main_info') }}</h3>
                </div>
                <table class="table card-table table-vcenter table-striped-columns">
                    <thead>
                        <tr>
                            <th>{{ __('msgs.column') }}</th>
                            <th colspan="2">{{ __('btns.details') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>{{ __('item.item_name') }}</th>
                            <td>{{ $item->name }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('msgs.photo') }}</th>
                            <th>
                                @if ($item->getFirstMediaUrl('items', 'thumb'))
                                    <img src="{{ $item->getFirstMediaUrl('items') }}" class="img img-thumbnail" alt="{{ $item->name }}" width="80">
                                @else
                                    <img src="{{ asset('backend/static/default-show-product.png') }}" class="img img-thumbnail" alt="{{ $item->name }}" width="80">
                                @endif
                            </th>
                        </tr>
                        <tr>
                            <th>{{ __('item.item_type') }}</th>
                            <td><span class="badge bg-blue"> {{ __('item.' . App\Models\Item::ITEMTYPE[$item->type]) }}</span></td>
                        </tr>
                        <tr>
                            <th>{{ __('msgs.is_active') }}</th>
                            <td>
                                <div>
                                    <button class="btn position-relative">
                                        {{ $item->is_active ? __('msgs.active') : __('msgs.not_active') }}
                                        <span class="badge {{ $item->is_active ? 'bg-green' : 'bg-red' }} badge-notification badge-blink"></span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('item.item_category') }}</th>
                            <td>
                                <span class="badge bg-blue">
                                    {{ $item->category->name }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('item.has_fixed_price') }}</th>
                            <td>{{ $item->has_fixed_price ? __('msgs.yes') : __('msgs.no') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-12 col-lg-8">
            <div class="card">
                <div class="card-header d-grid">
                    <div class="w-100 d-flex align-items-center justify-content-between">
                        <h3 class="card-title">{{ __('item.wholesale_price') }}</h3>
                    </div>
                </div>
                <div class="card-table table-responsive">
                    <table class="table table-vcenter" wire:key='store'>
                        <thead>
                            <tr>
                                <th>{{ __('item.wholesale_unit') }}</th>
                                <th>{{ __('item.wholesale_price') }}</th>
                                <th>{{ __('item.wholesale_price_for_half_block') }}</th>
                                <th>{{ __('item.wholesale_price_for_block') }}</th>
                                <th>{{ __('item.wholesale_cost_price') }}</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>{{ $item->parentUnit->name }}</td>
                            <td>{{ $item->wholesale_price }}</td>
                            <td>{{ $item->wholesale_price_for_half_block }}</td>
                            <td>{{ $item->wholesale_price_for_block }}</td>
                            <td>{{ $item->wholesale_cost_price }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header d-grid">
                    <div class="w-100 d-flex align-items-center justify-content-between">
                        <h3 class="card-title">{{ __('item.retail_price') }}</h3>
                    </div>
                </div>
                <div class="card-table table-responsive">
                    <table class="table table-vcenter" wire:key='store'>
                        <thead>
                            <tr>
                                <th>{{ __('item.retail_unit') }}</th>
                                <th>{{ __('item.retail_price') }}</th>
                                <th>{{ __('item.retail_price_for_half_block') }}</th>
                                <th>{{ __('item.retail_price_for_block') }}</th>
                                <th>{{ __('item.retail_cost_price') }}</th>
                            </tr>
                        </thead>
                        <tr>
                            <td>{{ $item->childUnit->name }}</td>
                            <td>{{ $item->retail_price }}</td>
                            <td>{{ $item->retail_price_for_half_block }}</td>
                            <td>{{ $item->retail_price_for_block }}</td>
                            <td>{{ $item->retail_cost_price }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-master-layout>
