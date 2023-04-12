<x-master-layout>
    @section('pageTitle', __('msgs.edit', ['name' => __('movement.order')]))
    @section('breadcrumbTitle', __('msgs.edit', ['name' => __('movement.order')]))
    @section('breadcrumbSubtitle', __('movement.stock_movements'))

    <div class="card">
        <div class="row g-0">
            @livewire('admin.stock.vendor.add-edit-vendor', ['vendor' => $vendor])
        </div>
    </div>

</x-master-layout>
