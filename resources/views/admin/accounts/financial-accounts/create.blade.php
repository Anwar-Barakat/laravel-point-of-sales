<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('stock.category')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('stock.category')]))
    @section('breadcrumbSubtitle', __('stock.category'))


    <div class="card">
        <div class="row g-0">
            @livewire('admin.account.financial-account.add-edit-account')
        </div>
    </div>

</x-master-layout>
