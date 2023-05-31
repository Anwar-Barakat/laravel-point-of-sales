 <div class="modal modal-blur fade" id="barcode{{ $id }}" tabindex="-1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">{{ $name }} {{ __('stock.barcode') }}</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 @php
                     echo DNS1D::getBarcodeHTML($barcode, 'C39');
                 @endphp
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
             </div>
         </div>
     </div>
 </div>
