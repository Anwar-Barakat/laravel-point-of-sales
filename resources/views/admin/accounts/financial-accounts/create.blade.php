<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('category.category')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('category.category')]))
    @section('breadcrumbSubtitle', __('category.category'))


    <div class="card">
        <div class="row g-0">
            @livewire('admin.account.financial-account.add-edit-account')
        </div>
    </div>

</x-master-layout>
