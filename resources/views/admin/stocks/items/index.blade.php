<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('item.items')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('item.items')]))
    @section('breadcrumbSubtitle', __('partials.stocks'))

    <div class="card">
        <div class="row g-0">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title">{{ __('msgs.all', ['name' => __('item.items')]) }}</h3>
                <a href="{{ route('admin.items.create') }}" class="btn btn-primary">
                    {{ __('msgs.create', ['name' => __('item.item')]) }}
                </a>
            </div>
            @livewire('admin.stock.item.show-item')
        </div>
    </div>

</x-master-layout>
