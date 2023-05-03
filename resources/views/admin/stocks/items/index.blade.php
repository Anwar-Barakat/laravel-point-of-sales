<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('stock.items')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('stock.items')]))
    @section('breadcrumbSubtitle', __('partials.stocks'))

    <div class="card">
        <div class="row g-0">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title">{{ __('msgs.all', ['name' => __('stock.items')]) }}</h3>
                <a href="{{ route('admin.items.create') }}" class="btn btn-primary">
                    {{ __('msgs.create', ['name' => __('stock.item')]) }}
                </a>
            </div>
            @livewire('admin.stock.item.show-item')
            <div class="card-footer">
            </div>
        </div>
    </div>

</x-master-layout>
