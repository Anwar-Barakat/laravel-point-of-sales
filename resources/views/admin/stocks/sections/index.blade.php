<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('stock.sections')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('stock.sections')]))
    @section('breadcrumbSubtitle', __('partials.stocks'))

    @livewire('admin.stock.section.display-section')
</x-master-layout>
