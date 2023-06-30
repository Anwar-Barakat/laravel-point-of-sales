 <div class="row row-deck row-cards">
     <div class="col-lg-6">
         <div class="card">
             <div class="card-body">
                 <h3 class="card-title">{{ $orders->options['chart_title'] }}</h3>
                 {!! $orders->renderHtml() !!}
             </div>
         </div>
     </div>
     <div class="col-lg-6">
         <div class="card">
             <div class="card-body">
                 <h3 class="card-title">{{ $sales->options['chart_title'] }}</h3>
                 {!! $sales->renderHtml() !!}
             </div>
         </div>
     </div>

     @section('javascripts')
         {!! $orders->renderChartJsLibrary() !!}
         {!! $orders->renderJs() !!}

         {!! $sales->renderChartJsLibrary() !!}
         {!! $sales->renderJs() !!}
     @endsection

 </div>
