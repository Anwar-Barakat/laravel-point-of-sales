<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('account.financial_account')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('account.financial_account')]))
    @section('breadcrumbSubtitle', __('account.accounts'))


    <div class="card">
        <div class="row g-0">
            @livewire('admin.stock.category.store-category')
        </div>
    </div>

</x-master-layout>
