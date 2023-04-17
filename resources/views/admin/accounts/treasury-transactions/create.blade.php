<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('account.treasury_transation')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('account.treasury_transation')]))
    @section('breadcrumbSubtitle', __('account.accounts'))


    <div class="card">
        <div class="row g-0">
            @livewire('admin.account.treasury-transaction.add-edit-treasury-transaction')
        </div>
    </div>

</x-master-layout>
