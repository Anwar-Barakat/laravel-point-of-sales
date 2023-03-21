<script src="{{ asset('backend/dist/libs/apexcharts/dist/apexcharts.min.js') }}" defer></script>
<script src="{{ asset('backend/dist/libs/jsvectormap/dist/js/jsvectormap.min.js') }}" defer></script>
<script src="{{ asset('backend/dist/libs/jsvectormap/dist/maps/world.js') }}" defer></script>
<script src="{{ asset('backend/dist/libs/jsvectormap/dist/maps/world-merc.js') }}" defer></script>

<!-- Tabler Core -->
<script src="{{ asset('backend/dist/js/tabler.min.js') }}" defer></script>
@stack('scripts')

<livewire:scripts />
<script src="{{ asset('backend/dist/js/demo.min.js') }}" defer></script>
