<!DOCTYPE html>


<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS --> <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/pickr/pickr-themes.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
     <!-- endbuild -->

    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
  <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
  <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
  <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/select2/select2.css') }}" />
  <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/@form-validation/form-validation.css') }}" />

    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('backend/assets/vendor/js/helpers.js') }}"></script>
     <script src="{{ asset('backend/assets/vendor/js/template-customizer.js')}}"></script>
    <script src="{{ asset('backend/assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            @include('backend.layouts.aside')

            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                @include('backend.layouts.nav')

                <!-- / Navbar -->

                 @yield('content')
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->




    <script src="{{ asset('backend/assets/vendor/libs/jquery/jquery.js') }}" />
    </script>
    <script src="{{ asset('backend/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/libs/@algolia/autocomplete-js.js')}}"></script>
    <script src="{{ asset('backend/assets/vendor/libs/pickr/pickr.js')}}"></script>
    <script src="{{ asset('backend/assets/vendor/libs/hammer/hammer.js')}}"></script>
    <script src="{{ asset('backend/assets/vendor/libs/i18n/i18n.js')}}"></script>
    <script src="{{ asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('backend/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('backend/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
   <script src="{{ asset('backend/assets/vendor/libs/moment/moment.js')}}"></script>
  <script src="{{ asset('backend/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
  <script src="{{ asset('backend/assets/vendor/libs/select2/select2.js')}}"></script>
  <script src="{{ asset('backend/assets/vendor/libs/@form-validation/popular.js')}}"></script>
  <script src="{{ asset('backend/assets/vendor/libs/@form-validation/bootstrap5.js')}}"></script>
  <script src="{{ asset('backend/assets/vendor/libs/@form-validation/auto-focus.js')}}"></script>
  <script src="{{ asset('backend/assets/vendor/libs/cleave-zen/cleave-zen.js')}}"></script>
    <!-- Main JS -->
    <script src="{{ asset('backend/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('backend/assets/js/dashboards-analytics.js') }}"></script>

     <!-- Page JS -->
    <script src="{{asset('backend/assets/js/app-user-list.js') }}"></script>

    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
