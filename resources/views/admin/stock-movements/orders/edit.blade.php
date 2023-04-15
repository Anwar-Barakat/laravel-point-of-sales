<x-master-layout>
    @section('pageTitle', __('msgs.edit', ['name' => __('movement.order')]))
    @section('breadcrumbTitle', __('msgs.edit', ['name' => __('movement.order')]))
    @section('breadcrumbSubtitle', __('movement.stock_movements'))

    <div class="card">
        <div class="row g-0">
            @livewire('admin.stock-movement.order.add-edit-order', ['order' => $order])
        </div>
    </div>

</x-master-layout>
