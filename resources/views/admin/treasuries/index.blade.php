<x-master-layout>
    @section('pageTitle', __('treasury.treasuries'))
    @section('breadcrumbTitle', __('treasury.treasuries'))

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h3 class="card-title">{{ __('msgs.all', ['name' => __('treasury.treasuries')]) }}</h3>
            <a href="{{ route('admin.treasuries.create') }}" class="btn btn-primary">{{ __('msgs.create', ['name' => __('treasury.treasury')]) }}</a>
        </div>

        @livewire('admin.treasury.show-treasury')
    </div>
</x-master-layout>
