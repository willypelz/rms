<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@if(isset($pageTitle)){{ $pageTitle }}&middot;@endif SeamlessHiring</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,600" rel="stylesheet"> 
    <link rel="stylesheet" href="{{ asset('homepage/css/style.css') }}">

</head>
<body>
    <div class="container-fluid shr-auth">
        <div class="h-100 row justify-content-center align-items-center">

            <section class="col-xs-10 col-md-4 text-center">

                <img src="{{ asset('homepage/images/icon-check-mark.svg') }}" class="mt-5">

                <h4 class="my-4 dark-blue-text font-weight-bold">A mail has been sent to your email</h4>
            
                <a href="{{ route('candidate-login') }}" class="btn btn-block shr-auth-form-button">Go to login page</a>
            </section>
        
        </div>
    </div>
</body>
</html>