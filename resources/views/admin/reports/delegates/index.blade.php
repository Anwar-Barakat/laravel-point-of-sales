<x-master-layout>

    @section('pageTitle', __('msgs.list', ['name' => __('report.reports_of', ['name' => __('stock.delegates')])]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('report.reports_of', ['name' => __('stock.delegates')])]))
    @section('breadcrumbSubtitle', __('report.reports'))

    @livewire('admin.report.delegate.display-report')
</x-master-layout>
