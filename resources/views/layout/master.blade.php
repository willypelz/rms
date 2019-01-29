<!DOCTYPE html>
<html lang="en">
@section('header')

@show()

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
    <?php $agent = new \Jenssegers\Agent\Agent(); ?>

    @if( $agent->isMobile() )
        <div class="alert alert-danger text-center">
            <strong>View this site on a desktop browser to get the best experience</strong>
        </div>
    @endif

    
    @yield('content')
    

    @section('footer')
        @include('layout.includes.footer')
    @show()
    


   </body>

</html>