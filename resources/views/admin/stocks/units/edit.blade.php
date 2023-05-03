<x-master-layout>
    @section('pageTitle', __('msgs.edit', ['name' => __('stock.unit')]))
    @section('breadcrumbTitle', __('msgs.edit', ['name' => __('stock.unit')]))
    @section('breadcrumbSubtitle', __('partials.stocks'))

    @livewire('admin.stock.unit.add-edit-unit', ['unit' => $unit])
</x-master-layout>
