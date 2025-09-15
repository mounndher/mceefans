<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Dashboard - Tabler</title>

    <!-- CSS files -->
    <link href="{{ asset('backend/assets/dist/css/tabler.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('backend/assets/dist/css/tabler-flags.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('backend/assets/dist/css/tabler-payments.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('backend/assets/dist/css/tabler-vendors.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('backend/assets/dist/css/demo.min.css') }}" rel="stylesheet"/>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
        --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont,
          San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
        font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
  </head>

  <body>
    <script src="{{ asset('backend/assets/dist/js/demo-theme.min.js') }}"></script>

    <div class="page">
      <!-- Sidebar -->
      @include('backend.layouts.aside')

      <!-- Navbar -->
      @include('backend.layouts.header')

      <div class="page-wrapper">
        <!-- Page content -->
        @yield('context')

        <!-- Footer -->
        @include('backend.layouts.footer')
      </div>
    </div>

    <!-- Danger Modal -->
    
    <!-- Database Clear Modal -->
    

    <!-- JS Libraries -->
    <script src="{{ asset('backend/assets/dist/libs/apexcharts/dist/apexcharts.min.js') }}" defer></script>
    <script src="{{ asset('backend/assets/dist/libs/jsvectormap/dist/js/jsvectormap.min.js') }}" defer></script>
    <script src="{{ asset('backend/assets/dist/libs/jsvectormap/dist/maps/world.js') }}" defer></script>
    <script src="{{ asset('backend/assets/dist/libs/jsvectormap/dist/maps/world-merc.js') }}" defer></script>

    <!-- Tabler JS -->
    <script src="{{ asset('backend/assets/dist/js/tabler.min.js') }}" defer></script>
    <script src="{{ asset('backend/assets/dist/js/demo.min.js') }}" defer></script>

    <!-- Your charts and map scripts -->
    @include('backend.layouts.scripts') <!-- optional: move all JS ApexCharts & maps into a separate file -->

  </body>
</html>
