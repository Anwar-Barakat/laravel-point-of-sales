 <div class="modal modal-blur fade" id="approval-modal" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">{{ __('movement.approval_and_posting') }}</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <div class="row">
                     <div class="col">
                         <div class="mb-3">
                             <x-input-label class="form-label" :value="__('movement.items_cost')" />
                             <x-text-input type="number" class="form-control" :value="$order->items_cost ?? '0'" readonly disabled />
                         </div>
                     </div>
                     <div class="col">
                         <div class="mb-3">
                             <x-input-label class="form-label" :value="__('movement.tax')" />
                             <x-text-input type="text" class="form-control" :value="$order->tax_type ? '$' : '%' . $order->tax ?? '0'" readonly disabled />
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="row">
                         <div class="col">
                             <div class="mb-3">
                                 <x-input-label class="form-label" :value="__('movement.cost_before_discount')" />
                                 <x-text-input type="number" class="form-control" :value="$order->cost_before_discount ?? '0'" readonly disabled />
                             </div>
                         </div>
                         <div class="col">
                             <div class="mb-3">
                                 <x-input-label class="form-label" :value="__('movement.discount')" />
                                 <x-text-input type="text" class="form-control" :value="$order->discount_type ? '$' : '%' . $order->discount ?? '0'" readonly disabled />
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="row">
                     <div class="col">
                         <div class="mb-3">
                             <x-input-label class="form-label" :value="__('movement.cost_after_discount')" />
                             <x-text-input type="text" class="form-control" :value="$order->cost_after_discount" readonly disabled />
                         </div>
                     </div>
                 </div>
             </div>
             <hr>
             <br>
             <div class="modal-footer">
                 <a href="#" class="btn link-secondary" data-bs-dismiss="modal">
                     {{ __('btns.cancel') }}
                 </a>
                 <a href="#" class="btn btn-success ms-auto" data-bs-dismiss="modal">
                     <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                         <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                         <path d="M5 12l5 5l10 -10" />
                     </svg>
                     {{ __('btns.approval') }}
                 </a>
             </div>
         </div>
     </div>
 </div>
