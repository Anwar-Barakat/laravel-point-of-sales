<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('item.cards')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('item.cards')]))
    @section('breadcrumbSubtitle', __('partials.stocks'))

    <div class="card">
        <div class="row g-0">
            @livewire('admin.item.show-item')
        </div>
    </div>

</x-master-layout>
