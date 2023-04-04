<x-master-layout>
    @section('pageTitle', __('msgs.edit', ['name' => __('item.item')]))
    @section('breadcrumbTitle', __('msgs.edit', ['name' => __('item.item')]))
    @section('breadcrumbSubtitle', __('partials.stocks'))

    <div class="card">
        <div class="row g-0">
            @livewire('admin.item.edit-item', [$item])
        </div>
    </div>

</x-master-layout>
