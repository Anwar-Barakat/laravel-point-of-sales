<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('movement.treasuries_shifts')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('movement.treasuries_shifts')]))
    @section('breadcrumbSubtitle', __('movement.stock_movements'))

    @livewire('admin.stock-movement.shift.show-shift')
</x-master-layout>
