<!DOCTYPE html>
<html lang="en">
@section('header')

@show()

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.growl.css') }}" />

<script type="text/javascript">
	$(function () {
	    $.ajaxSetup({
	        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
	    });

        window.preloader = '{!! preloader() !!}';


	});
</script>

@include('layout.includes.analytics')

<body>
    <!-- Navbar -->
    @section('navbar')

    @show()
    

    
    @yield('content')
    

    @section('footer')
        @include('layout.includes.footer')
    @show()
    


   </body>

</html>