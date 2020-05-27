<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Fonts Import -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,400i,700,700i" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" 
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" 
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
        crossorigin="anonymous">
        
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <title>We are currently updating your servers.</title>
    <style>
        body {
            background-color: white;
            color: #333;
            font-family: 'Muli', sans-serif;
        }

        .full-width-height {
            height: 100vh;
        }

        .btn {
            font-weight: bold;
        }

        .all-404s {
            max-width: 800px;
        }

        .single-404 {
            font-weight: bold;
            color: #999;
        }

        .four0four-image {
            width: 100%;
        }

        .leave-404-btn {
            position: absolute;
            top: 15px;
            left: 15px;
        }
    </style>
</head>
<body>
    <a  href="/" class="btn leave-404-btn">
        {{-- <i class="fas fa-angle-left"></i> --}}
        <img class="dash-img" src="{{ getCompanyImage() }}" alt="" height='45px'>
    </a>
    <div class="full-width-height d-flex flex-column justify-content-center align-items-center text-center pt-3">
        <div class="container">
        <div class="all-404s mx-auto text-center">
           <!--
            <h1 class="single-404 d-none d-lg-block" style="font-size: 18rem;">
                404
            </h1>
            <h1 class="single-404 d-none">
                404
            </h1>
            <h1 class="single-404 d-none">
                404
            </h1>
            <h1 class="single-404 d-none">
                404
            </h1>
        -->


        <img src="{{ url('/svgs/503.svg') }}" alt="404" class="four0four-image" style="width:60%" />
       
        </div>
	

	<br/><br/>
        <h3>Sorry, We are down for maintenance</h3>
        <br/>
        
        <p style="font-size: 1.1rem;" class="my-3">
            We are currently undergoing scheduled maintenance. Portal will be back up soon.
        </p>

        <div class="links collapse">
            <a href="/" class="btn btn-light m-2 btn-lg">Go to Home</a>
            <a href="{{ route('switcher') }}" class="btn btn-outline-success m-2 btn-lg">Dashboard</a>
        </div>
    </div>
    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>
</html>
