<x-master-layout>
    @section('pageTitle', __('msgs.edit', ['name' => __('account.workshop')]))
    @section('breadcrumbTitle', __('msgs.edit', ['name' => __('account.workshop')]))
    @section('breadcrumbSubtitle', __('account.workshops'))


    <div class="card">
        <div class="row g-0">
            @livewire('admin.account.workshop.add-edit-workshop', ['workshop' => $workshop])
        </div>
    </div>

</x-master-layout>
