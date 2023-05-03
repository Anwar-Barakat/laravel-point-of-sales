<x-master-layout>
    @section('pageTitle', __('treasury.treasuries'))
    @section('breadcrumbTitle', __('treasury.treasuries'))
    @section('breadcrumbSubtitle', __('partials.general_setting'))

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="card-title">{{ __('msgs.all', ['name' => __('treasury.treasuries')]) }}</h3>
            <a href="{{ route('admin.treasuries.create') }}" class="btn btn-primary">{{ __('msgs.create', ['name' => __('treasury.treasury')]) }}</a>
        </div>

        @livewire('admin.setting.treasury.show-treasury')

        <div class="card-footer">
        </div>
    </div>
</x-master-layout>
