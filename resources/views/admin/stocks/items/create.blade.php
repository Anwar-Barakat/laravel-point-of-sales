<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('item.card')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('item.card')]))
    @section('breadcrumbSubtitle', __('partials.stocks'))

    <div class="card">
        <div class="row g-0">
            @livewire('admin.item.add-item')
        </div>
    </div>

</x-master-layout>
