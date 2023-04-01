<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('card.card')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('card.card')]))
    @section('breadcrumbSubtitle', __('partials.stocks'))

    <div class="card">
        <div class="row g-0">
            @livewire('admin.card-item.add-card-item')
        </div>
    </div>

</x-master-layout>
