<x-master-layout>
    @section('pageTitle', __('msgs.edit', ['name' => __('account.account')]))
    @section('breadcrumbTitle', __('msgs.edit', ['name' => __('account.account')]))
    @section('breadcrumbSubtitle', __('account.accounts'))


    <div class="card">
        <div class="row g-0">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            @endif
            @livewire('admin.account.financial-account.add-edit-account', ['account' => $account])
        </div>
    </div>

</x-master-layout>
