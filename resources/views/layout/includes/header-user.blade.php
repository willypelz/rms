<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ secure_asset('img/favicon.png') }}">
    <link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png">

    <title> @if(isset($pageTitle)){{ $pageTitle }}&middot;@endif SeamlessHiring</title>

    <link href="{{ secure_asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/bootstrap-social.css') }}" rel="stylesheet">

    <link href="https://cdn.insidify.com/dist/css/owl.carousel.min.css" rel="stylesheet">
    <link href="https://cdn.insidify.com/dist/css/owl.theme.default.min.css" rel="stylesheet">

    <link href="{{ secure_asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/select2.css') }}" rel="stylesheet">
    
    <script src="//cdn.ckeditor.com/4.5.7/basic/ckeditor.js"></script>
    
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
        .container {
            max-width: none !important;
            width: 1140px;
        }
        .text-decoration-none{
            text-decoration: none !important;
        }
    </style>


    <!-- Add Custom CSS for brand white listing here -->
    @if(env('CUSTOM_STYLE'))
        <link href="{{ secure_asset('css/'.env('CUSTOM_STYLE').'.theme.css') }}" rel="stylesheet">
    @else
        <link href="{{ secure_asset('css/seamlesshiring.css') }}" rel="stylesheet">
    @endif

    {{--
    @if(env('CUSTOM_BRAND_STYLE'))
        <link href="{{ secure_asset('css/'.env('CUSTOM_BRAND_STYLE')) }}" rel="stylesheet">
    @endif
    --}}
</head>
