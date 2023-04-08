<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('stock.item')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('stock.item')]))
    @section('breadcrumbSubtitle', __('partials.stocks'))

    <div class="card">
        <div class="row g-0">
            @livewire('admin.stock.item.add-edit-item')
        </div>
    </div>

</x-master-layout>
