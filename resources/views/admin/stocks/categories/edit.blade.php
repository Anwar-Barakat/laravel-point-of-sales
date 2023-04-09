<x-master-layout>
    @section('pageTitle', __('msgs.edit', ['name' => __('stock.category')]))
    @section('breadcrumbTitle', __('msgs.edit', ['name' => __('stock.category')]))
    @section('breadcrumbSubtitle', __('stock.category'))


    <div class="card">
        <div class="row g-0">
            @livewire('admin.stock.category.edit-category', ['category' => $category])
        </div>
    </div>

</x-master-layout>
