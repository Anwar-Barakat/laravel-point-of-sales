<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('item.item')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('item.item')]))
    @section('breadcrumbSubtitle', __('partials.stocks'))

    <div class="card">
        <div class="row g-0">
            @livewire('admin.stock.item.add-edit-item')
        </div>
    </div>

</x-master-layout>
