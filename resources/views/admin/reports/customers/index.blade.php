<x-master-layout>

    @section('pageTitle', __('msgs.list', ['name' => __('report.reports_of', ['name' => __('stock.customers')])]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('report.reports_of', ['name' => __('stock.customers')])]))
    @section('breadcrumbSubtitle', __('report.reports'))

    @livewire('admin.report.customer.display-report')
</x-master-layout>
