 <div class="row row-deck row-cards">
     <div class="col-12">
         <div class="row row-cards">
             <div class="col-sm-6 col-lg-3">
                 <div class="card card-sm">
                     <div class="card-body">
                         <div class="row align-items-center">
                             <div class="col-auto">
                                 <span class="bg-bitbucket text-white avatar">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-report-money" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                         <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                         <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                                         <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                                         <path d="M14 11h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5"></path>
                                         <path d="M12 17v1m0 -8v1"></path>
                                     </svg>
                                 </span>
                             </div>
                             <div class="col">
                                 <div class="font-weight-medium">
                                     {{ __('dash.purchases') }} ({{ $orders_count ?? 0 }})
                                 </div>
                                 <div class="text-muted">
                                     {{ $orders_waiting_payment ?? 0 }} {{ __('dash.waiting_payment') }}
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-sm-6 col-lg-3">
                 <div class="card card-sm">
                     <div class="card-body">
                         <div class="row align-items-center">
                             <div class="col-auto">
                                 <span class="bg-green text-white avatar">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                         <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                         <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                         <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                         <path d="M17 17h-11v-14h-2" />
                                         <path d="M6 5l14 1l-1 7h-13" />
                                     </svg>
                                 </span>
                             </div>
                             <div class="col">
                                 <div class="font-weight-medium">
                                     {{ __('transaction.sales') }} ({{ $sales_count ?? 0 }})
                                 </div>
                                 <div class="text-muted">
                                     {{ $sales_has_shipped ?? 0 }} {{ __('dash.has_shipped') }}
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-sm-6 col-lg-3">
                 <div class="card card-sm">
                     <div class="card-body">
                         <div class="row align-items-center">
                             <div class="col-auto">
                                 <span class="bg-muted text-white avatar">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-24-hours" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                         <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                         <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                                         <path d="M4 13a8.094 8.094 0 0 0 3 5.24"></path>
                                         <path d="M11 15h2a1 1 0 0 1 1 1v1a1 1 0 0 1 -1 1h-1a1 1 0 0 0 -1 1v1a1 1 0 0 0 1 1h2"></path>
                                         <path d="M17 15v2a1 1 0 0 0 1 1h1"></path>
                                         <path d="M20 15v6"></path>
                                     </svg>
                                 </span>
                             </div>
                             <div class="col">
                                 <div class="font-weight-medium">
                                     {{ __('transaction.services_invoices') }} ({{ App\Models\ServiceInvoice::count() ?? 0 }})
                                 </div>
                                 <div class="text-muted">
                                     {{ App\Models\ServiceInvoice::where('remains', '!=', 0)->count() ?? 0 }} {{ __('dash.waiting_payment') }}
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-sm-6 col-lg-3">
                 <div class="card card-sm">
                     <div class="card-body">
                         <div class="row align-items-center">
                             <div class="col-auto">
                                 <span class="bg-facebook text-white avatar">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-asset" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                         <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                         <path d="M9 15m-6 0a6 6 0 1 0 12 0a6 6 0 1 0 -12 0"></path>
                                         <path d="M9 15m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                         <path d="M19 5m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                         <path d="M14.218 17.975l6.619 -12.174"></path>
                                         <path d="M6.079 9.756l12.217 -6.631"></path>
                                         <path d="M9 15m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                                     </svg>
                                 </span>
                             </div>
                             <div class="col">
                                 <div class="font-weight-medium">
                                     {{ __('transaction.production_lines') }} ({{ App\Models\ProductionLine::count() ?? 0 }})
                                 </div>
                                 <div class="text-muted">
                                     {{ __('transaction.approved') }} {{ App\Models\ProductionLine::where('is_approved', 1)->count() ?? 0 }}
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-sm-6 col-lg-3">
                 <div class="card card-sm">
                     <div class="card-body">
                         <div class="row align-items-center">
                             <div class="col-auto">
                                 <span class="bg-twitter text-white avatar">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-arch" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                         <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                         <path d="M3 21l18 0"></path>
                                         <path d="M4 21v-15a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v15"></path>
                                         <path d="M9 21v-8a3 3 0 0 1 6 0v8"></path>
                                     </svg>
                                 </span>
                             </div>
                             <div class="col">
                                 <div class="font-weight-medium">
                                     {{ __('transaction.workshops_invoices') }} ({{ App\Models\WorkshopInvoice::count() ?? 0 }})
                                 </div>
                                 <div class="text-muted">
                                     {{ __('transaction.approved') }} {{ App\Models\WorkshopInvoice::where('is_approved', 1)->count() ?? 0 }}
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="col-sm-6 col-lg-3">
                 <div class="card card-sm">
                     <div class="card-body">
                         <div class="row align-items-center">
                             <div class="col-auto">
                                 <span class="bg-pink text-white avatar">
                                     <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clipboard-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.25" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                         <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                         <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path>
                                         <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
                                         <path d="M10 14h4"></path>
                                         <path d="M12 12v4"></path>
                                     </svg>
                                 </span>
                             </div>
                             <div class="col">
                                 <div class="font-weight-medium">
                                     {{ __('transaction.products_receive') }} ({{ App\Models\ProductReceive::count() ?? 0 }})
                                 </div>
                                 <div class="text-muted">
                                     {{ __('transaction.approved') }} {{ App\Models\ProductReceive::where('is_approved', 1)->count() ?? 0 }}
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
   
     <div class="col-lg-6">
         <div class="card">
             <div class="card-body">
                 <h3 class="card-title">Traffic summary</h3>
                 <div id="chart-mentions" class="chart-lg"></div>
             </div>
         </div>
     </div>
     <div class="col-lg-6">
         <div class="card">
             <div class="card-body">
                 <h3 class="card-title">Locations</h3>
                 <div class="ratio ratio-21x9">
                     <div>
                         <div id="map-world" class="w-100 h-100"></div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="col-lg-6">
         <div class="card">
             <div class="card-header border-0">
                 <div class="card-title">Development activity</div>
             </div>
             <div class="position-relative">
                 <div class="position-absolute top-0 left-0 px-3 mt-1 w-75">
                     <div class="row g-2">
                         <div class="col-auto">
                             <div class="chart-sparkline chart-sparkline-square" id="sparkline-activity"></div>
                         </div>
                         <div class="col">
                             <div>Today's Earning: $4,262.40</div>
                             <div class="text-muted">
                                 <!-- Download SVG icon from http://tabler-icons.io/i/trending-up -->
                                 <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline text-green" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                     <path d="M3 17l6 -6l4 4l8 -8" />
                                     <path d="M14 7l7 0l0 7" />
                                 </svg>
                                 +5% more than yesterday
                             </div>
                         </div>
                     </div>
                 </div>
                 <div id="chart-development-activity"></div>
             </div>
             <div class="card-table table-responsive">
                 <table class="table table-vcenter">
                     <thead>
                         <tr>
                             <th>User</th>
                             <th>Commit</th>
                             <th>Date</th>
                         </tr>
                     </thead>
                     <tbody>
                         <tr>
                             <td class="w-1">
                                 <span class="avatar avatar-sm" style="background-image: url(./static/avatars/000m.jpg)"></span>
                             </td>
                             <td class="td-truncate">
                                 <div class="text-truncate">
                                     Fix dart Sass compatibility (#29755)
                                 </div>
                             </td>
                             <td class="text-nowrap text-muted">28 Nov 2019</td>
                         </tr>
                         <tr>
                             <td class="w-1">
                                 <span class="avatar avatar-sm">JL</span>
                             </td>
                             <td class="td-truncate">
                                 <div class="text-truncate">
                                     Change deprecated html tags to text decoration classes (#29604)
                                 </div>
                             </td>
                             <td class="text-nowrap text-muted">27 Nov 2019</td>
                         </tr>
                         <tr>
                             <td class="w-1">
                                 <span class="avatar avatar-sm" style="background-image: url(./static/avatars/002m.jpg)"></span>
                             </td>
                             <td class="td-truncate">
                                 <div class="text-truncate">
                                     justify-content:between ⇒ justify-content:space-between (#29734)
                                 </div>
                             </td>
                             <td class="text-nowrap text-muted">26 Nov 2019</td>
                         </tr>
                         <tr>
                             <td class="w-1">
                                 <span class="avatar avatar-sm" style="background-image: url(./static/avatars/003m.jpg)"></span>
                             </td>
                             <td class="td-truncate">
                                 <div class="text-truncate">
                                     Update change-version.js (#29736)
                                 </div>
                             </td>
                             <td class="text-nowrap text-muted">26 Nov 2019</td>
                         </tr>
                         <tr>
                             <td class="w-1">
                                 <span class="avatar avatar-sm" style="background-image: url(./static/avatars/000f.jpg)"></span>
                             </td>
                             <td class="td-truncate">
                                 <div class="text-truncate">
                                     Regenerate package-lock.json (#29730)
                                 </div>
                             </td>
                             <td class="text-nowrap text-muted">25 Nov 2019</td>
                         </tr>
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
     <div class="col-md-12 col-lg-8">
         <div class="card">
             <div class="card-header">
                 <h3 class="card-title">Most Visited Pages</h3>
             </div>
             <div class="card-table table-responsive">
                 <table class="table table-vcenter">
                     <thead>
                         <tr>
                             <th>Page name</th>
                             <th>Visitors</th>
                             <th>Unique</th>
                             <th colspan="2">Bounce rate</th>
                         </tr>
                     </thead>
                     <tr>
                         <td>
                             /
                             <a href="#" class="ms-1" aria-label="Open website">
                                 <!-- Download SVG icon from http://tabler-icons.io/i/link -->
                                 <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                     <path d="M10 14a3.5 3.5 0 0 0 5 0l4 -4a3.5 3.5 0 0 0 -5 -5l-.5 .5" />
                                     <path d="M14 10a3.5 3.5 0 0 0 -5 0l-4 4a3.5 3.5 0 0 0 5 5l.5 -.5" />
                                 </svg>
                             </a>
                         </td>
                         <td class="text-muted">4,896</td>
                         <td class="text-muted">3,654</td>
                         <td class="text-muted">82.54%</td>
                         <td class="text-end w-1">
                             <div class="chart-sparkline chart-sparkline-sm" id="sparkline-bounce-rate-1"></div>
                         </td>
                     </tr>
                     <tr>
                         <td>
                             /form-elements.html
                             <a href="#" class="ms-1" aria-label="Open website">
                                 <!-- Download SVG icon from http://tabler-icons.io/i/link -->
                                 <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                     <path d="M10 14a3.5 3.5 0 0 0 5 0l4 -4a3.5 3.5 0 0 0 -5 -5l-.5 .5" />
                                     <path d="M14 10a3.5 3.5 0 0 0 -5 0l-4 4a3.5 3.5 0 0 0 5 5l.5 -.5" />
                                 </svg>
                             </a>
                         </td>
                         <td class="text-muted">3,652</td>
                         <td class="text-muted">3,215</td>
                         <td class="text-muted">76.29%</td>
                         <td class="text-end w-1">
                             <div class="chart-sparkline chart-sparkline-sm" id="sparkline-bounce-rate-2"></div>
                         </td>
                     </tr>
                     <tr>
                         <td>
                             /index.html
                             <a href="#" class="ms-1" aria-label="Open website">
                                 <!-- Download SVG icon from http://tabler-icons.io/i/link -->
                                 <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                     <path d="M10 14a3.5 3.5 0 0 0 5 0l4 -4a3.5 3.5 0 0 0 -5 -5l-.5 .5" />
                                     <path d="M14 10a3.5 3.5 0 0 0 -5 0l-4 4a3.5 3.5 0 0 0 5 5l.5 -.5" />
                                 </svg>
                             </a>
                         </td>
                         <td class="text-muted">3,256</td>
                         <td class="text-muted">2,865</td>
                         <td class="text-muted">72.65%</td>
                         <td class="text-end w-1">
                             <div class="chart-sparkline chart-sparkline-sm" id="sparkline-bounce-rate-3"></div>
                         </td>
                     </tr>
                     <tr>
                         <td>
                             /icons.html
                             <a href="#" class="ms-1" aria-label="Open website">
                                 <!-- Download SVG icon from http://tabler-icons.io/i/link -->
                                 <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                     <path d="M10 14a3.5 3.5 0 0 0 5 0l4 -4a3.5 3.5 0 0 0 -5 -5l-.5 .5" />
                                     <path d="M14 10a3.5 3.5 0 0 0 -5 0l-4 4a3.5 3.5 0 0 0 5 5l.5 -.5" />
                                 </svg>
                             </a>
                         </td>
                         <td class="text-muted">986</td>
                         <td class="text-muted">865</td>
                         <td class="text-muted">44.89%</td>
                         <td class="text-end w-1">
                             <div class="chart-sparkline chart-sparkline-sm" id="sparkline-bounce-rate-4"></div>
                         </td>
                     </tr>
                     <tr>
                         <td>
                             /docs/
                             <a href="#" class="ms-1" aria-label="Open website">
                                 <!-- Download SVG icon from http://tabler-icons.io/i/link -->
                                 <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                     <path d="M10 14a3.5 3.5 0 0 0 5 0l4 -4a3.5 3.5 0 0 0 -5 -5l-.5 .5" />
                                     <path d="M14 10a3.5 3.5 0 0 0 -5 0l-4 4a3.5 3.5 0 0 0 5 5l.5 -.5" />
                                 </svg>
                             </a>
                         </td>
                         <td class="text-muted">912</td>
                         <td class="text-muted">822</td>
                         <td class="text-muted">41.12%</td>
                         <td class="text-end w-1">
                             <div class="chart-sparkline chart-sparkline-sm" id="sparkline-bounce-rate-5"></div>
                         </td>
                     </tr>
                     <tr>
                         <td>
                             /accordion.html
                             <a href="#" class="ms-1" aria-label="Open website">
                                 <!-- Download SVG icon from http://tabler-icons.io/i/link -->
                                 <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                     <path d="M10 14a3.5 3.5 0 0 0 5 0l4 -4a3.5 3.5 0 0 0 -5 -5l-.5 .5" />
                                     <path d="M14 10a3.5 3.5 0 0 0 -5 0l-4 4a3.5 3.5 0 0 0 5 5l.5 -.5" />
                                 </svg>
                             </a>
                         </td>
                         <td class="text-muted">855</td>
                         <td class="text-muted">798</td>
                         <td class="text-muted">32.65%</td>
                         <td class="text-end w-1">
                             <div class="chart-sparkline chart-sparkline-sm" id="sparkline-bounce-rate-6"></div>
                         </td>
                     </tr>
                 </table>
             </div>
         </div>
     </div>
     <div class="col-md-6 col-lg-4">
         <a href="https://github.com/sponsors/codecalm" class="card card-sponsor" target="_blank" rel="noopener" style="background-image: url(./static/sponsor-banner-homepage.svg)" aria-label="Sponsor Tabler!">
             <div class="card-body"></div>
         </a>
     </div>
     <div class="col-md-6 col-lg-4">
         <div class="card">
             <div class="card-header">
                 <h3 class="card-title">Social Media Traffic</h3>
             </div>
             <table class="table card-table table-vcenter">
                 <thead>
                     <tr>
                         <th>Network</th>
                         <th colspan="2">Visitors</th>
                     </tr>
                 </thead>
                 <tbody>
                     <tr>
                         <td>Instagram</td>
                         <td>3,550</td>
                         <td class="w-50">
                             <div class="progress progress-xs">
                                 <div class="progress-bar bg-primary" style="width: 71.0%"></div>
                             </div>
                         </td>
                     </tr>
                     <tr>
                         <td>Twitter</td>
                         <td>1,798</td>
                         <td class="w-50">
                             <div class="progress progress-xs">
                                 <div class="progress-bar bg-primary" style="width: 35.96%"></div>
                             </div>
                         </td>
                     </tr>
                     <tr>
                         <td>Facebook</td>
                         <td>1,245</td>
                         <td class="w-50">
                             <div class="progress progress-xs">
                                 <div class="progress-bar bg-primary" style="width: 24.9%"></div>
                             </div>
                         </td>
                     </tr>
                     <tr>
                         <td>TikTok</td>
                         <td>986</td>
                         <td class="w-50">
                             <div class="progress progress-xs">
                                 <div class="progress-bar bg-primary" style="width: 19.72%"></div>
                             </div>
                         </td>
                     </tr>
                     <tr>
                         <td>Pinterest</td>
                         <td>854</td>
                         <td class="w-50">
                             <div class="progress progress-xs">
                                 <div class="progress-bar bg-primary" style="width: 17.08%"></div>
                             </div>
                         </td>
                     </tr>
                     <tr>
                         <td>VK</td>
                         <td>650</td>
                         <td class="w-50">
                             <div class="progress progress-xs">
                                 <div class="progress-bar bg-primary" style="width: 13.0%"></div>
                             </div>
                         </td>
                     </tr>
                     <tr>
                         <td>Pinterest</td>
                         <td>420</td>
                         <td class="w-50">
                             <div class="progress progress-xs">
                                 <div class="progress-bar bg-primary" style="width: 8.4%"></div>
                             </div>
                         </td>
                     </tr>
                 </tbody>
             </table>
         </div>
     </div>
     <div class="col-md-12 col-lg-8">
         <div class="card">
             <div class="card-header">
                 <h3 class="card-title">Tasks</h3>
             </div>
             <div class="table-responsive">
                 <table class="table card-table table-vcenter">
                     <tr>
                         <td class="w-1 pe-0">
                             <input type="checkbox" class="form-check-input m-0 align-middle" aria-label="Select task" checked>
                         </td>
                         <td class="w-100">
                             <a href="#" class="text-reset">Extend the data model.</a>
                         </td>
                         <td class="text-nowrap text-muted">
                             <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                             <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                 <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                 <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                 <path d="M16 3l0 4" />
                                 <path d="M8 3l0 4" />
                                 <path d="M4 11l16 0" />
                                 <path d="M11 15l1 0" />
                                 <path d="M12 15l0 3" />
                             </svg>
                             August 04, 2021
                         </td>
                         <td class="text-nowrap">
                             <a href="#" class="text-muted">
                                 <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                                 <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                     <path d="M5 12l5 5l10 -10" />
                                 </svg>
                                 2/7
                             </a>
                         </td>
                         <td class="text-nowrap">
                             <a href="#" class="text-muted">
                                 <!-- Download SVG icon from http://tabler-icons.io/i/message -->
                                 <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                     <path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4" />
                                     <path d="M8 9l8 0" />
                                     <path d="M8 13l6 0" />
                                 </svg>
                                 3
                             </a>
                         </td>
                         <td>
                             <span class="avatar avatar-sm" style="background-image: url(./static/avatars/000m.jpg)"></span>
                         </td>
                     </tr>
                     <tr>
                         <td class="w-1 pe-0">
                             <input type="checkbox" class="form-check-input m-0 align-middle" aria-label="Select task">
                         </td>
                         <td class="w-100">
                             <a href="#" class="text-reset">Verify the event flow.</a>
                         </td>
                         <td class="text-nowrap text-muted">
                             <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                             <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                 <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                 <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                 <path d="M16 3l0 4" />
                                 <path d="M8 3l0 4" />
                                 <path d="M4 11l16 0" />
                                 <path d="M11 15l1 0" />
                                 <path d="M12 15l0 3" />
                             </svg>
                             January 03, 2019
                         </td>
                         <td class="text-nowrap">
                             <a href="#" class="text-muted">
                                 <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                                 <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                     <path d="M5 12l5 5l10 -10" />
                                 </svg>
                                 3/10
                             </a>
                         </td>
                         <td class="text-nowrap">
                             <a href="#" class="text-muted">
                                 <!-- Download SVG icon from http://tabler-icons.io/i/message -->
                                 <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                     <path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4" />
                                     <path d="M8 9l8 0" />
                                     <path d="M8 13l6 0" />
                                 </svg>
                                 6
                             </a>
                         </td>
                         <td>
                             <span class="avatar avatar-sm">JL</span>
                         </td>
                     </tr>
                     <tr>
                         <td class="w-1 pe-0">
                             <input type="checkbox" class="form-check-input m-0 align-middle" aria-label="Select task">
                         </td>
                         <td class="w-100">
                             <a href="#" class="text-reset">Database backup and maintenance</a>
                         </td>
                         <td class="text-nowrap text-muted">
                             <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                             <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                 <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                 <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                 <path d="M16 3l0 4" />
                                 <path d="M8 3l0 4" />
                                 <path d="M4 11l16 0" />
                                 <path d="M11 15l1 0" />
                                 <path d="M12 15l0 3" />
                             </svg>
                             December 28, 2018
                         </td>
                         <td class="text-nowrap">
                             <a href="#" class="text-muted">
                                 <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                                 <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                     <path d="M5 12l5 5l10 -10" />
                                 </svg>
                                 0/6
                             </a>
                         </td>
                         <td class="text-nowrap">
                             <a href="#" class="text-muted">
                                 <!-- Download SVG icon from http://tabler-icons.io/i/message -->
                                 <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                     <path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4" />
                                     <path d="M8 9l8 0" />
                                     <path d="M8 13l6 0" />
                                 </svg>
                                 1
                             </a>
                         </td>
                         <td>
                             <span class="avatar avatar-sm" style="background-image: url(./static/avatars/002m.jpg)"></span>
                         </td>
                     </tr>
                     <tr>
                         <td class="w-1 pe-0">
                             <input type="checkbox" class="form-check-input m-0 align-middle" aria-label="Select task" checked>
                         </td>
                         <td class="w-100">
                             <a href="#" class="text-reset">Identify the implementation team.</a>
                         </td>
                         <td class="text-nowrap text-muted">
                             <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                             <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                 <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                 <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                 <path d="M16 3l0 4" />
                                 <path d="M8 3l0 4" />
                                 <path d="M4 11l16 0" />
                                 <path d="M11 15l1 0" />
                                 <path d="M12 15l0 3" />
                             </svg>
                             November 07, 2020
                         </td>
                         <td class="text-nowrap">
                             <a href="#" class="text-muted">
                                 <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                                 <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                     <path d="M5 12l5 5l10 -10" />
                                 </svg>
                                 6/10
                             </a>
                         </td>
                         <td class="text-nowrap">
                             <a href="#" class="text-muted">
                                 <!-- Download SVG icon from http://tabler-icons.io/i/message -->
                                 <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                     <path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4" />
                                     <path d="M8 9l8 0" />
                                     <path d="M8 13l6 0" />
                                 </svg>
                                 12
                             </a>
                         </td>
                         <td>
                             <span class="avatar avatar-sm" style="background-image: url(./static/avatars/003m.jpg)"></span>
                         </td>
                     </tr>
                     <tr>
                         <td class="w-1 pe-0">
                             <input type="checkbox" class="form-check-input m-0 align-middle" aria-label="Select task">
                         </td>
                         <td class="w-100">
                             <a href="#" class="text-reset">Define users and workflow</a>
                         </td>
                         <td class="text-nowrap text-muted">
                             <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                             <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                 <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                 <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                 <path d="M16 3l0 4" />
                                 <path d="M8 3l0 4" />
                                 <path d="M4 11l16 0" />
                                 <path d="M11 15l1 0" />
                                 <path d="M12 15l0 3" />
                             </svg>
                             November 23, 2021
                         </td>
                         <td class="text-nowrap">
                             <a href="#" class="text-muted">
                                 <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                                 <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                     <path d="M5 12l5 5l10 -10" />
                                 </svg>
                                 3/7
                             </a>
                         </td>
                         <td class="text-nowrap">
                             <a href="#" class="text-muted">
                                 <!-- Download SVG icon from http://tabler-icons.io/i/message -->
                                 <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                     <path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4" />
                                     <path d="M8 9l8 0" />
                                     <path d="M8 13l6 0" />
                                 </svg>
                                 5
                             </a>
                         </td>
                         <td>
                             <span class="avatar avatar-sm" style="background-image: url(./static/avatars/000f.jpg)"></span>
                         </td>
                     </tr>
                     <tr>
                         <td class="w-1 pe-0">
                             <input type="checkbox" class="form-check-input m-0 align-middle" aria-label="Select task" checked>
                         </td>
                         <td class="w-100">
                             <a href="#" class="text-reset">Check Pull Requests</a>
                         </td>
                         <td class="text-nowrap text-muted">
                             <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                             <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                 <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                 <path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                 <path d="M16 3l0 4" />
                                 <path d="M8 3l0 4" />
                                 <path d="M4 11l16 0" />
                                 <path d="M11 15l1 0" />
                                 <path d="M12 15l0 3" />
                             </svg>
                             January 14, 2021
                         </td>
                         <td class="text-nowrap">
                             <a href="#" class="text-muted">
                                 <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                                 <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                     <path d="M5 12l5 5l10 -10" />
                                 </svg>
                                 2/9
                             </a>
                         </td>
                         <td class="text-nowrap">
                             <a href="#" class="text-muted">
                                 <!-- Download SVG icon from http://tabler-icons.io/i/message -->
                                 <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                     <path d="M4 21v-13a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-9l-4 4" />
                                     <path d="M8 9l8 0" />
                                     <path d="M8 13l6 0" />
                                 </svg>
                                 3
                             </a>
                         </td>
                         <td>
                             <span class="avatar avatar-sm" style="background-image: url(./static/avatars/001f.jpg)"></span>
                         </td>
                     </tr>
                 </table>
             </div>
         </div>
     </div>
     <div class="col-12">
         <div class="card">
             <div class="card-header">
                 <h3 class="card-title">Invoices</h3>
             </div>
             <div class="card-body border-bottom py-3">
                 <div class="d-flex">
                     <div class="text-muted">
                         Show
                         <div class="mx-2 d-inline-block">
                             <input type="text" class="form-control form-control-sm" value="8" size="3" aria-label="Invoices count">
                         </div>
                         entries
                     </div>
                     <div class="ms-auto text-muted">
                         Search:
                         <div class="ms-2 d-inline-block">
                             <input type="text" class="form-control form-control-sm" aria-label="Search invoice">
                         </div>
                     </div>
                 </div>
             </div>
             <div class="table-responsive">
                 <table class="table card-table table-vcenter text-nowrap datatable">
                     <thead>
                         <tr>
                             <th class="w-1"><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select all invoices"></th>
                             <th class="w-1">No.
                                 <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                                 <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-sm icon-thick" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                     <path d="M6 15l6 -6l6 6" />
                                 </svg>
                             </th>
                             <th>Invoice Subject</th>
                             <th>Client</th>
                             <th>VAT No.</th>
                             <th>Created</th>
                             <th>Status</th>
                             <th>Price</th>
                             <th></th>
                         </tr>
                     </thead>
                     <tbody>
                         <tr>
                             <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                             <td><span class="text-muted">001401</span></td>
                             <td><a href="invoice.html" class="text-reset" tabindex="-1">Design Works</a></td>
                             <td>
                                 <span class="flag flag-country-us"></span>
                                 Carlson Limited
                             </td>
                             <td>
                                 87956621
                             </td>
                             <td>
                                 15 Dec 2017
                             </td>
                             <td>
                                 <span class="badge bg-success me-1"></span> Paid
                             </td>
                             <td>$887</td>
                             <td class="text-end">
                                 <span class="dropdown">
                                     <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                     <div class="dropdown-menu dropdown-menu-end">
                                         <a class="dropdown-item" href="#">
                                             Action
                                         </a>
                                         <a class="dropdown-item" href="#">
                                             Another action
                                         </a>
                                     </div>
                                 </span>
                             </td>
                         </tr>
                         <tr>
                             <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                             <td><span class="text-muted">001402</span></td>
                             <td><a href="invoice.html" class="text-reset" tabindex="-1">UX Wireframes</a></td>
                             <td>
                                 <span class="flag flag-country-gb"></span>
                                 Adobe
                             </td>
                             <td>
                                 87956421
                             </td>
                             <td>
                                 12 Apr 2017
                             </td>
                             <td>
                                 <span class="badge bg-warning me-1"></span> Pending
                             </td>
                             <td>$1200</td>
                             <td class="text-end">
                                 <span class="dropdown">
                                     <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                     <div class="dropdown-menu dropdown-menu-end">
                                         <a class="dropdown-item" href="#">
                                             Action
                                         </a>
                                         <a class="dropdown-item" href="#">
                                             Another action
                                         </a>
                                     </div>
                                 </span>
                             </td>
                         </tr>
                         <tr>
                             <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                             <td><span class="text-muted">001403</span></td>
                             <td><a href="invoice.html" class="text-reset" tabindex="-1">New Dashboard</a></td>
                             <td>
                                 <span class="flag flag-country-de"></span>
                                 Bluewolf
                             </td>
                             <td>
                                 87952621
                             </td>
                             <td>
                                 23 Oct 2017
                             </td>
                             <td>
                                 <span class="badge bg-warning me-1"></span> Pending
                             </td>
                             <td>$534</td>
                             <td class="text-end">
                                 <span class="dropdown">
                                     <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                     <div class="dropdown-menu dropdown-menu-end">
                                         <a class="dropdown-item" href="#">
                                             Action
                                         </a>
                                         <a class="dropdown-item" href="#">
                                             Another action
                                         </a>
                                     </div>
                                 </span>
                             </td>
                         </tr>
                         <tr>
                             <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                             <td><span class="text-muted">001404</span></td>
                             <td><a href="invoice.html" class="text-reset" tabindex="-1">Landing Page</a></td>
                             <td>
                                 <span class="flag flag-country-br"></span>
                                 Salesforce
                             </td>
                             <td>
                                 87953421
                             </td>
                             <td>
                                 2 Sep 2017
                             </td>
                             <td>
                                 <span class="badge bg-secondary me-1"></span> Due in 2 Weeks
                             </td>
                             <td>$1500</td>
                             <td class="text-end">
                                 <span class="dropdown">
                                     <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                     <div class="dropdown-menu dropdown-menu-end">
                                         <a class="dropdown-item" href="#">
                                             Action
                                         </a>
                                         <a class="dropdown-item" href="#">
                                             Another action
                                         </a>
                                     </div>
                                 </span>
                             </td>
                         </tr>
                         <tr>
                             <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                             <td><span class="text-muted">001405</span></td>
                             <td><a href="invoice.html" class="text-reset" tabindex="-1">Marketing Templates</a></td>
                             <td>
                                 <span class="flag flag-country-pl"></span>
                                 Printic
                             </td>
                             <td>
                                 87956621
                             </td>
                             <td>
                                 29 Jan 2018
                             </td>
                             <td>
                                 <span class="badge bg-danger me-1"></span> Paid Today
                             </td>
                             <td>$648</td>
                             <td class="text-end">
                                 <span class="dropdown">
                                     <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                     <div class="dropdown-menu dropdown-menu-end">
                                         <a class="dropdown-item" href="#">
                                             Action
                                         </a>
                                         <a class="dropdown-item" href="#">
                                             Another action
                                         </a>
                                     </div>
                                 </span>
                             </td>
                         </tr>
                         <tr>
                             <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                             <td><span class="text-muted">001406</span></td>
                             <td><a href="invoice.html" class="text-reset" tabindex="-1">Sales Presentation</a></td>
                             <td>
                                 <span class="flag flag-country-br"></span>
                                 Tabdaq
                             </td>
                             <td>
                                 87956621
                             </td>
                             <td>
                                 4 Feb 2018
                             </td>
                             <td>
                                 <span class="badge bg-secondary me-1"></span> Due in 3 Weeks
                             </td>
                             <td>$300</td>
                             <td class="text-end">
                                 <span class="dropdown">
                                     <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                     <div class="dropdown-menu dropdown-menu-end">
                                         <a class="dropdown-item" href="#">
                                             Action
                                         </a>
                                         <a class="dropdown-item" href="#">
                                             Another action
                                         </a>
                                     </div>
                                 </span>
                             </td>
                         </tr>
                         <tr>
                             <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                             <td><span class="text-muted">001407</span></td>
                             <td><a href="invoice.html" class="text-reset" tabindex="-1">Logo & Print</a></td>
                             <td>
                                 <span class="flag flag-country-us"></span>
                                 Apple
                             </td>
                             <td>
                                 87956621
                             </td>
                             <td>
                                 22 Mar 2018
                             </td>
                             <td>
                                 <span class="badge bg-success me-1"></span> Paid Today
                             </td>
                             <td>$2500</td>
                             <td class="text-end">
                                 <span class="dropdown">
                                     <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                     <div class="dropdown-menu dropdown-menu-end">
                                         <a class="dropdown-item" href="#">
                                             Action
                                         </a>
                                         <a class="dropdown-item" href="#">
                                             Another action
                                         </a>
                                     </div>
                                 </span>
                             </td>
                         </tr>
                         <tr>
                             <td><input class="form-check-input m-0 align-middle" type="checkbox" aria-label="Select invoice"></td>
                             <td><span class="text-muted">001408</span></td>
                             <td><a href="invoice.html" class="text-reset" tabindex="-1">Icons</a></td>
                             <td>
                                 <span class="flag flag-country-pl"></span>
                                 Tookapic
                             </td>
                             <td>
                                 87956621
                             </td>
                             <td>
                                 13 May 2018
                             </td>
                             <td>
                                 <span class="badge bg-success me-1"></span> Paid Today
                             </td>
                             <td>$940</td>
                             <td class="text-end">
                                 <span class="dropdown">
                                     <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">Actions</button>
                                     <div class="dropdown-menu dropdown-menu-end">
                                         <a class="dropdown-item" href="#">
                                             Action
                                         </a>
                                         <a class="dropdown-item" href="#">
                                             Another action
                                         </a>
                                     </div>
                                 </span>
                             </td>
                         </tr>
                     </tbody>
                 </table>
             </div>
             <div class="card-footer d-flex align-items-center">
                 <p class="m-0 text-muted">Showing <span>1</span> to <span>8</span> of <span>16</span> entries</p>
                 <ul class="pagination m-0 ms-auto">
                     <li class="page-item disabled">
                         <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                             <!-- Download SVG icon from http://tabler-icons.io/i/chevron-left -->
                             <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                 <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                 <path d="M15 6l-6 6l6 6" />
                             </svg>
                             prev
                         </a>
                     </li>
                     <li class="page-item"><a class="page-link" href="#">1</a></li>
                     <li class="page-item active"><a class="page-link" href="#">2</a></li>
                     <li class="page-item"><a class="page-link" href="#">3</a></li>
                     <li class="page-item"><a class="page-link" href="#">4</a></li>
                     <li class="page-item"><a class="page-link" href="#">5</a></li>
                     <li class="page-item">
                         <a class="page-link" href="#">
                             next
                             <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                             <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                 <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                 <path d="M9 6l6 6l-6 6" />
                             </svg>
                         </a>
                     </li>
                 </ul>
             </div>
         </div>
     </div>

 </div>
