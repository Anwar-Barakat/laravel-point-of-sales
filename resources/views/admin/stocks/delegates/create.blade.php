<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('transaction.delegate')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('transaction.delegate')]))
    @section('breadcrumbSubtitle', __('partials.stocks'))


    <div class="card">
        <div class="row g-0">
            @livewire('admin.stock.delegate.add-edit-delegate')
        </div>
    </div>

</x-master-layout>
