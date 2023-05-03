<x-master-layout>
    @section('pageTitle', __('msgs.details', ['name' => __('stock.item')]))
    @section('breadcrumbTitle', __('msgs.details', ['name' => __('stock.item')]))
    @section('breadcrumbSubtitle', __('partials.stocks'))

    <div class="row">
        <div class="col-6 col-lg-4">
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
                            <th>{{ __('stock.item_name') }}</th>
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
                            <th>{{ __('stock.item_type') }}</th>
                            <td>{{ __('stock.' . App\Models\Item::ITEMTYPE[$item->type]) }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('partials.status') }}</th>
                            <td>
                                {{ $item->is_active ? __('msgs.active') : __('msgs.not_active') }}
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('stock.item_category') }}</th>
                            <td>
                                {{ $item->category->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('stock.has_fixed_price') }}</th>
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
                        <h3 class="card-title">{{ __('stock.wholesale_price') }}</h3>
                    </div>
                </div>
                <div class="card-table table-responsive">
                    <table class="table table-vcenter" wire:key='store'>
                        <thead>
                            <tr>
                                <th>{{ __('stock.wholesale_unit') }}</th>
                                <th>{{ __('stock.wholesale_price') }}</th>
                                <th>{{ __('stock.wholesale_price_for_half_block') }}</th>
                                <th>{{ __('stock.wholesale_price_for_block') }}</th>
                                <th>{{ __('stock.wholesale_cost_price') }}</th>
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
                        <h3 class="card-title">{{ __('stock.retail_price') }}</h3>
                    </div>
                </div>
                <div class="card-table table-responsive">
                    <table class="table table-vcenter" wire:key='store'>
                        <thead>
                            <tr>
                                <th>{{ __('stock.retail_unit') }}</th>
                                <th>{{ __('stock.retail_price') }}</th>
                                <th>{{ __('stock.retail_price_for_half_block') }}</th>
                                <th>{{ __('stock.retail_price_for_block') }}</th>
                                <th>{{ __('stock.retail_cost_price') }}</th>
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
