<div class="card-table table-responsive">
    <table class="table table-vcenter" wire:key='store'>
        <thead>
            <tr>
                <th>#</th>
                <th>{{ __('treasury.treasury_name') }}</th>
                <th>{{ __('msgs.created_at') }}</th>
                <th></th>
            </tr>
        </thead>
        @forelse ($treasury->treasuriesDelivery as $branch)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $branch->treasuryDelivered->name }}</td>
                <td>{{ $branch->treasuryDelivered->created_at }}</td>
                <th>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-danger-{{ $branch->id }}" class="btn btn-outline-danger d-flex align-items-center justify-content-center" title="{{ __('btns.delete') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon m-0" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 7l16 0" />
                            <path d="M10 11l0 6" />
                            <path d="M14 11l0 6" />
                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                        </svg>
                    </a>
                    <x-modal-delete :id="$branch->id" :action="route('admin.treasury-deliveries.destroy', ['treasury_delivery' => $branch])" />
                </th>
            </tr>
        @empty
            <tr>
                <td colspan="5">
                    <x-blank-section :content="__('treasury.treasury_delivery')" :url="'javascript:;'" data-bs-toggle="modal" data-bs-target="#add-treasury-delivery" />
                </td>
            </tr>
        @endforelse
    </table>
</div>
