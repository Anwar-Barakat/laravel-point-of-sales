<x-master-layout>
    @php
        $pageTitle = $sale_type == 3 ? __('transaction.' . App\Models\Sale::SALETYPE[3]) : __('transaction.sales');
    @endphp
    @section('pageTitle', __('msgs.edit', ['name' => $pageTitle]))
    @section('breadcrumbTitle', __('msgs.edit', ['name' => $pageTitle]))
    @section('breadcrumbSubtitle', __('transaction.warehouse_transactions'))

    <div class="card">
        <div class="row g-0">
            @livewire('admin.warehouse-transaction.sale.add-edit-sale', ['sale' => $sale, 'sale_type' => 3])
        </div>
    </div>
</x-master-layout>
