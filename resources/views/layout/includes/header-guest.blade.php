<head>

    @if(isset($job) && isset($company) )
        <!-- Open Graph data -->
            <meta property="og:title" content="{{ $job->title }}"/>
            <meta property="og:type" content="article"/>
            <meta property="og:url" content="{{route('job-view',['jobID'=>$job->id,'jobSlug'=>str_slug($job->title)])}}"/>
            <meta name="image" property="og:image" content="{{ ($company->logo) }}"/>
            <meta name="description" property="og:description" content="{{$job->summary}}"/>
        {{--    <meta property="og:site_name" content="{{ url('') }}"/>--}}
        <!-- <meta property="og:price:amount" content="15.00" />
        <meta property="og:price:currency" content="USD" /> -->

            <!-- Schema.org markup for Google+ -->
            <meta itemprop="name" content="{{$job->title}}">
            <meta itemprop="description" content="{{$job->summary}}">
            <meta itemprop="image" content="{{ ($company->logo) }}">

            <!-- Twitter Card data -->
            <meta name="twitter:card" content="{{$company->name}}">
            <!-- <meta name="twitter:site" content="@publisher_handle"> -->
            <meta name="twitter:title" content="{{$job->title}}">
            <meta name="twitter:description" content="{{$job->summary}}">
            <!-- <meta name="twitter:creator" content="@author_handle"> -->
            <meta name="twitter:image" content="{{ ($company->logo) }}">
            <!-- <meta name="twitter:data1" content="$3">
            <meta name="twitter:label1" content="Price">
            <meta name="twitter:data2" content="Black">
            <meta name="twitter:label2" content="Color"> -->
    @endif
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ secure_asset('img/favicon.png') }}">
    <link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png">

    <title> @if(isset($pageTitle)){{ $pageTitle }}&middot;@endif SeamlessHiring</title>

    <link href="{{ secure_asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/seamless.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('css/bootstrap-social.css') }}" rel="stylesheet">
    {{--<link href="{{ secure_asset('css/owl-carousel.css') }}" rel="stylesheet">--}}
    <link href="https://cdn.insidify.com/dist/css/owl.carousel.min.css" rel="stylesheet">
    <link href="https://cdn.insidify.com/dist/css/owl.theme.default.min.css" rel="stylesheet">

    <!-- Cookie Consent stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />

    <script src="{{ secure_asset('js/ckeditor/ckeditor.js') }}"></script>

    <!--<script src="//cdn.ckeditor.com/4.5.7/basic/ckeditor.js"></script>-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
