<x-master-layout>
    @section('pageTitle', __('partials.home'))
    @section('breadcrumbTitle', __('partials.home'))

    @livewire('admin.dashboard-component')

    @livewire('admin.dashboard-count-component')

    @livewire('admin.dashboard-chart-component')
</x-master-layout>
