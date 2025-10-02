
@php
    use App\Models\Setting;
    use App\Models\Contact;

    $contact = Contact::first();
    $settings = Setting::first();
@endphp
<!DOCTYPE html>
<html lang="zxx">
<head>
	<!-- Meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
	<meta name="description" content="{{ $settings->description_site ?? 'Default description' }}">
	<meta name="keywords" content="{{ $settings->keywords}}">
	<meta name="author" content="Awaiken">
	<!-- Page Title -->
    <title>{{ $settings->title ?? 'Default description' }}</title>
	<!-- Favicon Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/images/favicon.png') }}">
	<!-- Google Fonts Css-->
	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Manrope:wght@200..800&display=swap" rel="stylesheet">
	<!-- Bootstrap Css -->
	<link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet" media="screen">
	<!-- SlickNav Css -->
	<link href="{{ asset('frontend/css/slicknav.min.css') }}" rel="stylesheet">
	<!-- Swiper Css -->
	<link rel="stylesheet" href="{{ asset('frontend/css/swiper-bundle.min.css') }}">
	<!-- Font Awesome Icon Css-->
	<link href="{{ asset('frontend/css/all.min.css') }}" rel="stylesheet" media="screen">
	<!-- Animated Css -->
	<link href="{{ asset('frontend/css/animate.css') }}" rel="stylesheet">
    <!-- Magnific Popup Core Css File -->
	<link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
	<!-- Mouse Cursor Css File -->
	<link rel="stylesheet" href="{{ asset('frontend/css/mousecursor.css') }}">
	<!-- Main Custom Css -->
	<link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet" media="screen">
</head>
<body>

    <!-- Preloader Start -->
	<div class="preloader">
		<div class="loading-container">
			<div class="loading"></div>
			<div id="loading-icon"><img src="{{ asset('frontend/images/loader.svg')}}" alt=""></div>
		</div>
	</div>
	<!-- Preloader End -->

    <!-- Header Start -->
    @include('frontend.layouts.header')
	<!-- Header End -->

    <!-- Main Content Start -->
    <main>
        @yield('frontend')
    </main>
    <!-- Main Content End -->

    <!-- Footer Start -->
    @include('frontend.layouts.footer')
    <!-- Footer End -->

    <!-- Jquery Library File -->
    <script src="{{ asset('frontend/js/jquery-3.7.1.min.js')}}"></script>
    <!-- Bootstrap js file -->
    <script src="{{ asset('frontend/js/bootstrap.min.js')}}"></script>
    <!-- Validator js file -->
    <script src="{{ asset('frontend/js/validator.min.js')}}"></script>
    <!-- SlickNav js file -->
    <script src="{{ asset('frontend/js/jquery.slicknav.js')}}"></script>
    <!-- Swiper js file -->
    <script src="{{ asset('frontend/js/swiper-bundle.min.js')}}"></script>
    <!-- Counter js file -->
    <script src="{{ asset('frontend/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{ asset('frontend/js/jquery.counterup.min.js')}}"></script>
    <!-- Magnific js file -->
    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js')}}"></script>
    <!-- SmoothScroll -->
    <script src="{{ asset('frontend/js/SmoothScroll.js')}}"></script>
    <!-- Parallax js -->
    <script src="{{ asset('frontend/js/parallaxie.js')}}"></script>
    <!-- MagicCursor js file -->
    <script src="{{ asset('frontend/js/gsap.min.js')}}"></script>
    <script src="{{ asset('frontend/js/magiccursor.js')}}"></script>
    <!-- Text Effect js file -->
    <script src="{{ asset('frontend/js/SplitText.js')}}"></script>
    <script src="{{ asset('frontend/js/ScrollTrigger.min.js')}}"></script>
    <!-- YTPlayer js File -->
    <script src="{{ asset('frontend/js/jquery.mb.YTPlayer.min.js')}}"></script>
    <!-- Wow js file -->
    <script src="{{ asset('frontend/js/wow.min.js')}}"></script>
    <!-- Main Custom js file -->
    <script src="{{ asset('frontend/js/function.js')}}"></script>
</body>
</html>
