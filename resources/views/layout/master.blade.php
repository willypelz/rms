<!DOCTYPE html>
<html lang="en">

@section('header')

@show()



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