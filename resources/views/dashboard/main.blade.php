<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        @yield('title') - Electronic
    </title>   

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="{{ url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,700') }}" rel="stylesheet">
	<link href="{{ url('https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap') }}" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="{{ URL::asset('asset/css/all.min.css') }}">
	<!-- <link rel="stylesheet" href="{{asset('templates/landing-page')}}/css/vendor/plugins.min.css"> -->
	<!-- bootstrap -->
	<link rel="stylesheet" href="{{ URL::asset('asset/css/app.css') }}">
	<!-- owl carousel -->
	<link rel="stylesheet" href="{{ URL::asset('asset/css/owl.carousel.css') }}">
	<!-- magnific popup -->
	<link rel="stylesheet" href="{{ URL::asset('asset/css/magnific-popup.css') }}">
	<!-- animate css -->
	<link rel="stylesheet" href="{{ URL::asset('asset/css/animate.css') }}">
	<!-- mean menu css -->
	<link rel="stylesheet" href="{{ URL::asset('asset/css/meanmenu.min.css') }}">
	<!-- main style -->
	<link rel="stylesheet" href="{{ URL::asset('asset/css/main.css') }}">
	<!-- responsive -->
	<link rel="stylesheet" href="{{ URL::asset('asset/css/responsive.css') }}">
		<!-- jquery -->
        <script src="{{ URL::asset('asset/js/jquery-1.11.3.min.js') }}"></script>
	<!-- bootstrap -->
	<!-- <script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script> -->
	<!-- count down -->
	<script src="{{ URL::asset('asset/js/jquery.countdown.js') }}"></script>
	<!-- isotope -->
	<script src="{{ URL::asset('asset/js/jquery.isotope-3.0.6.min.js') }}"></script>
	<!-- waypoints -->
	<script src="{{ URL::asset('asset/js/waypoints.js') }}"></script>
	<!-- owl carousel -->
	<script src="{{ URL::asset('asset/js/owl.carousel.min.js') }}"></script>
	<!-- magnific popup -->
	<script src="{{ URL::asset('asset/js/jquery.magnific-popup.min.js') }}"></script>
	<!-- mean menu -->
	<script src="{{ URL::asset('asset/js/jquery.meanmenu.min.js') }}"></script>
	<!-- sticker js -->
	<script src="{{ URL::asset('asset/js/sticker.js') }}"></script>
	<!-- main js -->
	<script src="{{ URL::asset('asset/js/main.js') }}"></script>
	<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
    
    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet">
  </head>
  <body>

      @include('dashboard/navbar')
      @if (auth()->user()->role=='user')
        @include('dashboard/user/sidebarUser')
      @else
        @include('dashboard/admin/sidebarAdmin')
      @endif
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          @yield('content')
      </main>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
      <script src="/js/dashboard.js"></script>
  </body>
</html>