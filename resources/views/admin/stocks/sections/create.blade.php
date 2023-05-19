<x-master-layout>
    @section('pageTitle', __('msgs.create', ['name' => __('stock.section')]))
    @section('breadcrumbTitle', __('msgs.create', ['name' => __('stock.section')]))
 @section('breadcrumbSubtitle', __('partials.stocks'))


    <div class="card">
        <div class="row g-0">
            @livewire('admin.stock.section.add-edit-section')
        </div>
    </div>

</x-master-layout>
