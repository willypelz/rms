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
        @include('layout.footer')
    @show()



   </body>

</html>