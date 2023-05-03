<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('stock.unit')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('stock.unit')]))
    @section('breadcrumbSubtitle', __('partials.stocks'))

    @livewire('admin.stock.unit.add-edit-unit')
</x-master-layout>
