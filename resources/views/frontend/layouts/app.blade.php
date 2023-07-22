<!doctype html>
<html lang="en">

<head>
	<!-- Meta Data -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>FinTracker</title>

	<link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/img/favicon/apple-touch-icon.png')}}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/img/budget-buddha-logo.png')}}">
	<link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon/favicon-16x16.png">
	<link rel="mask-icon" href="assets/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="{{asset('assets/frontend/dependencies/bootstrap/css/bootstrap.min.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('assets/frontend/dependencies/fontawesome/css/all.min.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('assets/frontend/dependencies/swiper/css/swiper.min.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('assets/frontend/dependencies/wow/css/animate.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('assets/frontend/dependencies/simple-line-icons/css/simple-line-icons.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('assets/frontend/dependencies/themify-icons/css/themify-icons.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('assets/frontend/dependencies/components-elegant-icons/css/elegant-icons.min.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('assets/frontend/dependencies/magnific-popup/css/magnific-popup.css')}}" type="text/css">
	<link rel="stylesheet" href="{{asset('assets/frontend/dependencies/slick-carousel/css/slick.css')}}" type="text/css">


	<!-- Site Stylesheet -->
	<link rel="stylesheet" href="{{asset('css/app.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/custom/app.css')}}">

	<!-- Google Web Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Barlow+Condensed:300,400,500,600,700,800%7CPoppins:300,400,500,600,700,800" rel="stylesheet">

</head>

<body id="home-version-1" class="home-analytics" data-style="default">
    @include('frontend.layouts.partials._navbar')
    @include('frontend.layouts.partials._hero')
    @include('frontend.layouts.partials._feature')
    {{-- @include('frontend.layouts.partials._our-team') --}}
    @include('frontend.layouts.partials._footer')







    <!-- Dependency Scripts -->
	<script src="{{asset('assets/frontend/dependencies/jquery/jquery.min.js')}}"></script>
	<script src="{{asset('assets/frontend/dependencies/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/frontend/dependencies/swiper/js/swiper.min.js')}}"></script>
	<script src="{{asset('assets/frontend/dependencies/isotope-layout/isotope.pkgd.min.js')}}"></script>
	<script src="{{asset('assets/frontend/dependencies/imagesloaded/imagesloaded.pkgd.min.js')}}"></script>
	<script src="{{asset('assets/frontend/dependencies/magnific-popup/js/jquery.magnific-popup.min.js')}}"></script>
	<script src="{{asset('assets/frontend/dependencies/jquery.appear/jquery.appear.js')}}"></script>
	<script src="{{asset('assets/frontend/dependencies/wow/js/wow.min.js')}}"></script>
	<script src="{{asset('assets/frontend/js/TweenMax.min.js')}}"></script>
	<script src="{{asset('assets/frontend/dependencies/countUp.js/countUp.min.js')}}"></script>
	<script src="{{asset('assets/frontend/dependencies/bodymovin/lottie.min.js')}}"></script>
	<script src="{{asset('assets/frontend/dependencies/jquery.parallax-scroll/js/jquery.parallax-scroll.js')}}"></script>
	<script src="{{asset('assets/frontend/dependencies/wavify/wavify.js')}}"></script>
	<script src="{{asset('assets/frontend/dependencies/jquery.marquee/js/jquery.marquee.js')}}"></script>
	<script src="{{asset('assets/frontend/js/jarallax.min.js')}}"></script>
	<script src="{{asset('assets/frontend/dependencies/gmap3/js/gmap3.min.js')}}"></script>
	<script src="{{asset('assets/frontend/dependencies/slick-carousel/js/slick.min.js')}}"></script>
	<script src="{{asset('assets/frontend/js/jquery.parallax.min.js')}}"></script>
	<script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyDk2HrmqE4sWSei0XdKGbOMOHN3Mm2Bf-M'></script>
    <script src="{{asset('assets/frontend/js/app.js')}}"></script>
    <script src="{{asset('js/app.js')}}"></script>

</body>
