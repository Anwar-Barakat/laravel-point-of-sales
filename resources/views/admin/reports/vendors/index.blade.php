<x-master-layout>

    @section('pageTitle', __('msgs.list', ['name' => __('report.reports_of', ['name' => __('account.vendors')])]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('report.reports_of', ['name' => __('account.vendors')])]))
    @section('breadcrumbSubtitle', __('report.reports'))

    @livewire('admin.report.vendor.display-report')
</x-master-layout>
