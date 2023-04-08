<x-master-layout>
    @section('pageTitle', __('msgs.edit', ['name' => __('category.category')]))
    @section('breadcrumbTitle', __('msgs.edit', ['name' => __('category.category')]))
    @section('breadcrumbSubtitle', __('category.category'))


    <div class="card">
        <div class="row g-0">
            @livewire('admin.stock.category.edit-category', ['category' => $category])
        </div>
    </div>

</x-master-layout>
