<x-master-layout>
    @section('pageTitle', __('msgs.edit', ['name' => __('account.account')]))
    @section('breadcrumbTitle', __('msgs.edit', ['name' => __('account.account')]))
    @section('breadcrumbSubtitle', __('account.accounts'))


    <div class="card">
        <div class="row g-0">
            @livewire('admin.account.financial-account.add-edit-account', ['account' => $account])
        </div>
    </div>

</x-master-layout>
