<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('stock.vendor')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('stock.vendor')]))
    @section('breadcrumbSubtitle', __('partials.stocks'))


    <div class="card">
        <div class="row g-0">
            @livewire('admin.stock.vendor.add-edit-vendor')
        </div>
    </div>

</x-master-layout>
