<x-master-layout>
    @section('pageTitle', __('msgs.edit', ['name' => __('stock.item')]))
    @section('breadcrumbTitle', __('msgs.edit', ['name' => __('stock.item')]))
    @section('breadcrumbSubtitle', __('partials.stocks'))

    <div class="card">
        <div class="row g-0">
            @livewire('admin.stock.item.add-edit-item', [$item])
        </div>
    </div>

</x-master-layout>
