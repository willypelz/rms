<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@if(isset($pageTitle)){{ $pageTitle }}&middot;@endif SeamlessHiring</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,600" rel="stylesheet"> 
    <link rel="stylesheet" href="{{ asset('homepage/css/style.css') }}">

</head>
<body>
    @yield('content')
</body>
</html>