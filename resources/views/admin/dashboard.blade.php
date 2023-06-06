<x-master-layout>
    @section('pageTitle', __('partials.home'))
    @section('breadcrumbTitle', __('partials.home'))


    @livewire('admin.dashboard-component')

    @livewire('admin.dashboard-count-component')
</x-master-layout>
