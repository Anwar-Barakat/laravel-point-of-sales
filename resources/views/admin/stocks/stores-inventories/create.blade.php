<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('stock.store_inventory')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('stock.store_inventory')]))
    @section('breadcrumbSubtitle', __('partials.stocks'))


    <div class="card">
        <div class="row g-0">
            <livewire:admin.stock.store-inventory.add-edit-store-inventory>
        </div>
    </div>

</x-master-layout>
