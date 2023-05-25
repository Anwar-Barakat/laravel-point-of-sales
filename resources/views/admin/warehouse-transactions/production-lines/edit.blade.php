<x-master-layout>
    @section('pageTitle', __('msgs.edit', ['name' => __('transaction.production_line')]))
    @section('breadcrumbTitle', __('msgs.edit', ['name' => __('transaction.production_line')]))
    @section('breadcrumbSubtitle', __('transaction.warehouse_transactions'))

    <div class="card">
        <div class="row g-0">
            @livewire('admin.warehouse-transaction.production-line.add-edit-production-line', ['production_line' => $production_line])
        </div>
    </div>

</x-master-layout>
