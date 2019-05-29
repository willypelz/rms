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

            <section class="col-xs-10 col-md-4">

                <div class="text-center">
                    <img src="{{ env('APP_LOGO') }}" class="shr-auth-logo">
                </div>

                <h4 class="my-4 dark-blue-text font-weight-bold">Enter your email to reset your password</h4>
                
                <form action="" method="POST">
                    
                        @include('layout.alerts')
                    <div class="form-group shr-form-group">
                        <label class="shr-input-label">Password</label>
                        <div class="shr-input-group">
                            <img src="{{ asset('homepage/images/icon-lock-alt.svg') }}" class="shr-input-group-addon">
                            <input required="" name="password" type="password" class="shr-input">
                        </div>
                    </div>

                    <div class="form-group shr-form-group">
                        <label class="shr-input-label">Password confirmation</label>
                        <div class="shr-input-group">
                            <img src="{{ asset('homepage/images/icon-lock-alt.svg') }}" class="shr-input-group-addon">
                            <input required="" name="password_confirmation" type="password" class="shr-input">
                        </div>
                    </div>
                    
                    <button class="btn btn-block shr-auth-form-button" type="submit" > Reset Password</button>
                </form>
            </section>
        
        </div>
    </div>
</body>
</html>