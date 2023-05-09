<x-master-layout>
    @php
        $pageTitle = $sale_type == 3 ? __('transaction.' . App\Models\Sale::ORDERTYPE[3]) : __('transaction.sales');
    @endphp
    @section('pageTitle', __('msgs.create', ['name' => $pageTitle]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => $pageTitle]))
    @section('breadcrumbSubtitle', __('transaction.warehouse_transactions'))

    <div class="card">
        <div class="row g-0">
            @livewire('admin.warehouse-transaction.sale.add-edit-sale', ['sale_type' => 3])
        </div>
    </div>
</x-master-layout>
