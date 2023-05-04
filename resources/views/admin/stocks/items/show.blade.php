<x-master-layout>
    @section('pageTitle', __('msgs.details', ['name' => __('stock.item')]))
    @section('breadcrumbTitle', __('msgs.details', ['name' => __('stock.item')]))
    @section('breadcrumbSubtitle', __('partials.stocks'))

    @livewire('admin.stock.item.item-detail', ['item' => $item])
</x-master-layout>
