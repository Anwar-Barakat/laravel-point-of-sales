<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('transaction.treasury_shifts')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('transaction.treasury_shifts')]))
    @section('breadcrumbSubtitle', __('transaction.warehouse_transactions'))


    <div class="card">
        <div class="row g-0">
            @livewire('admin.warehouse-transaction.shift.add-edit-shift')
        </div>
    </div>

</x-master-layout>
