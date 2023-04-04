<x-master-layout>
    @section('pageTitle', __('msgs.list', ['name' => __('card.cards')]))
    @section('breadcrumbTitle', __('msgs.list', ['name' => __('card.cards')]))
    @section('breadcrumbSubtitle', __('partials.stocks'))

    <div class="card">
        <div class="row g-0">
            @livewire('admin.card-item.show-card-item')
        </div>
    </div>

</x-master-layout>
