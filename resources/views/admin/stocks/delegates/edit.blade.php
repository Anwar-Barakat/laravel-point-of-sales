<x-master-layout>
    @section('pageTitle', __('msgs.edit', ['name' => __('transaction.delegate')]))
    @section('breadcrumbTitle', __('msgs.edit', ['name' => __('transaction.delegate')]))
    @section('breadcrumbSubtitle', __('partials.stocks'))


    <div class="card">
        <div class="row g-0">
            @livewire('admin.stock.delegate.add-edit-delegate', ['delegate' => $delegate])
        </div>
    </div>

</x-master-layout>
