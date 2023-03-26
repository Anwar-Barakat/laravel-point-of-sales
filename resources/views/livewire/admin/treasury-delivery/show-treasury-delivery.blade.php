<div class="row">
    <div class="col-md-6 col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ __('msgs.main_info') }}</h3>
            </div>
            <table class="table card-table table-vcenter table-striped-columns">
                <thead>
                    <tr>
                        <th>{{ __('msgs.column') }}</th>
                        <th colspan="2">{{ __('btns.details') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>{{ __('treasury.treasury_name') }}</th>
                        <td>{{ $treasury->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('treasury.is_it_master') }}</th>
                        <td>{{ $treasury->is_master ? __('treasury.master') : __('treasury.branch') }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('treasury.is_it_active') }}</th>
                        <td>{{ $treasury->is_active ? __('treasury.active') : __('treasury.not_active') }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('treasury.last_payment_receipt') }}</th>
                        <td>{{ $treasury->last_payment_receipt }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('treasury.last_payment_collect') }}</th>
                        <td>{{ $treasury->last_payment_collect }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('msgs.created_at') }}</th>
                        <td>{{ \Carbon\Carbon::parse($treasury->created_at)->format('Y-m-d') }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('treasury.added_by') }}</th>
                        <td>{{ $treasury->addedBy->name }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('msgs.updated_at') }}</th>
                        <td>{{ \Carbon\Carbon::parse($treasury->updated_at)->format('Y-m-d') }}</td>
                    </tr>
                    <tr>
                        <th>{{ __('setting.updated_by') }}</th>
                        <td>{{ $treasury->updatedBy->name ?? '' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-12 col-lg-8">
        <div class="card">
            <div class="card-header d-grid">
                @if ($errors->any())
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data -dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">{{ __('btns.close') }}</span>
                        </button>
                        <ul class="p-0 m-0 list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="w-100 d-flex align-items-center justify-content-between">
                    <h3 class="card-title">{{ __('treasury.treasury_will_delivery_to_master') }}</h3>
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-treasury-delivery">
                        {{ __('msgs.create', ['name' => __('treasury.treasury_delivery')]) }}
                    </a>
                </div>
            </div>
            <div class="card-table table-responsive">
                <table class="table table-vcenter">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('treasury.treasury_name') }}</th>
                            <th>{{ __('treasury.added_by') }}</th>
                            <th>{{ __('msgs.created_at') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    @forelse ($treasury->treasuriesDelivery as $branch)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $branch->treasuryDelivered->name }}</td>
                            <td>{{ $branch->treasuryDelivered->addedBy->name }}</td>
                            <td>{{ $branch->treasuryDelivered->addedBy->created_at }}</td>
                            <th></th>
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

            {{-- Add treasury delivery modal --}}
            <div class="modal modal-blur fade" wire:ignore id="add-treasury-delivery" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"> {{ __('msgs.create', ['name' => __('treasury.treasury_delivery')]) }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form wire:submit.prevent='store'>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <x-input-label class="form-label" :value="__('treasury.treasury')" />
                                    <select class="form-control" wire:model='treasury_delivery_id'>
                                        <option value="">{{ __('btns.select') }}</option>
                                        @foreach ($treasuries as $treasury)
                                            <option value="{{ $treasury->id }}">{{ $treasury->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr class="mt-0">
                            <div class="modal-footer">
                                <button type="button" class="btn" data-bs-dismiss="modal">
                                    {{ __('btns.cancel') }}
                                </button>
                                <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 5l0 14" />
                                        <path d="M5 12l14 0" />
                                    </svg>
                                    {{ __('btns.submit') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
