<x-master-layout>
    @section('pageTitle', __('msgs.details', ['name' => __('stock.stores_inventories')]))
    @section('breadcrumbTitle', __('msgs.details', ['name' => __('stock.stores_inventories')]))
    @section('breadcrumbSubtitle', __('partials.stocks'))

    <livewire:admin.stock.store-inventory.store-inventory-detail :inventory='$stores_inventory'>
</x-master-layout>
