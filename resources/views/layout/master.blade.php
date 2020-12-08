<!DOCTYPE html>
<html lang="en">
@section('header')

@show()

<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ secure_asset('js/jquery-1.11.1.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{ secure_asset('css/jquery.growl.css') }}"/>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>

<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });

        window.preloader = '{!! preloader() !!}';


    });
</script>

@include('layout.includes.analytics')

<body id="main-auth-entry">
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

        @if(!Auth::check())
            @include('layout.includes.cookie-consent')
        @endif

    @show()

</body>

</html>
