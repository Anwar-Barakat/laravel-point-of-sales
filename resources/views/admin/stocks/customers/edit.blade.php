<x-master-layout>
    @section('pageTitle', __('msgs.edit', ['name' => __('stock.customer')]))
    @section('breadcrumbTitle', __('msgs.edit', ['name' => __('stock.customer')]))
    @section('breadcrumbSubtitle', __('partials.stocks'))


    <div class="card">
        <div class="row g-0">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            @endif
            @livewire('admin.stock.customer.add-edit-customer', ['customer' => $customer])
        </div>
    </div>

</x-master-layout>
