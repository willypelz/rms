<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@if(isset($pageTitle)){{ $pageTitle }}&middot;@endif SeamlessHiring</title>
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,600" rel="stylesheet">
    <link rel="shortcut icon" href="{{ secure_asset('img/favicon.png') }}">
    <!-- Add Custom CSS for brand white listing here -->
    @if(env('CUSTOM_STYLE'))
        <link href="{{ secure_asset('css/'.env('CUSTOM_STYLE').'.theme.css') }}" rel="stylesheet">
    @else
        <link href="{{ secure_asset('css/seamlesshiring.css') }}" rel="stylesheet">
    @endif
    <!-- Cookie Consent stylesheet -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/cookieconsent@3/build/cookieconsent.min.css" />

</head>
<body style="background-color: #fff; margin: 0 !important; padding: 0 !important;">
@yield('content')
@include('layout.includes.cookie-consent')
</body>
</html>
