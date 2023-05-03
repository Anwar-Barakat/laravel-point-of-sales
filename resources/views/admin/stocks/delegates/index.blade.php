<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('transaction.delegates')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('transaction.delegates')]))
    @section('breadcrumbSubtitle', __('partials.stocks'))

    @livewire('admin.stock.delegate.show-delegate')
</x-master-layout>
