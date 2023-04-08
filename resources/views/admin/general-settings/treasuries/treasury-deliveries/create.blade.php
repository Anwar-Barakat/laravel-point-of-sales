 <div class="modal modal-blur fade" id="add-treasury-delivery" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title"> {{ __('msgs.create', ['name' => __('treasury.treasury_delivery')]) }}</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <form action="{{ route('admin.treasury-deliveries.store') }}" method="POST">
                 @csrf
                 <input type="hidden" name="id" value="{{ $treasury->id }}">
                 <input type="hidden" name="treasury_delivery_id" value="{{ $treasury->treasury_delivery_id }}">
                 <div class="modal-body">
                     <div class="mb-3">
                         <x-input-label class="form-label" :value="__('treasury.treasury')" />
                         <select class="form-control" name="treasury_delivery_id">
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
