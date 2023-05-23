<x-master-layout>
    @section('pageTitle', __('msgs.edit', ['name' => __('stock.store_inventory')]))
    @section('breadcrumbTitle', __('msgs.edit', ['name' => __('stock.store_inventory')]))
    @section('breadcrumbSubtitle', __('partials.stocks'))

    <div class="card">
        <div class="row g-0">
            <livewire:admin.stock.store-inventory.add-edit-store-inventory :inventory='$stores_inventory'>
        </div>
    </div>

</x-master-layout>
