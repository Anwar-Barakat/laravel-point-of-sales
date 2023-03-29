<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('category.category')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('category.category')]))
    @section('breadcrumbSubtitle', __('category.category'))


    <div class="card">
        <div class="row g-0">
            @livewire('admin.category.store-category')
        </div>
    </div>

</x-master-layout>
