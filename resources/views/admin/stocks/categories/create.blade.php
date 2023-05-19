<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('stock.category')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('stock.category')]))
    @section('breadcrumbSubtitle', __('partials.stocks'))


    <div class="card">
        <div class="row g-0">
            @livewire('admin.stock.category.store-category')
        </div>
    </div>

</x-master-layout>
