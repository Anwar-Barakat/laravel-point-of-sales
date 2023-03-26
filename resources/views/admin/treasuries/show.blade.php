<x-master-layout>
    @section('pageTitle', __('msgs.details', ['name' => __('treasury.treasury')]))
    @section('breadcrumbTitle', __('msgs.details', ['name' => __('treasury.treasury')]))
    @section('breadcrumbSubtitle', __('treasury.treasuries'))


    @livewire('admin.treasury-delivery.show-treasury-delivery', ['treasury' => $treasury])
</x-master-layout>
