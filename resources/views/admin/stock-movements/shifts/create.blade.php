<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('movement.treasury_shifts')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('movement.treasury_shifts')]))
    @section('breadcrumbSubtitle', __('movement.stock_movements'))


    <div class="card">
        <div class="row g-0">
            @livewire('admin.stock-movement.shift.add-edit-shift')
        </div>
    </div>

</x-master-layout>
