<style>
  body{
    font-weight: 300;

  }
  p{
        font-size: 110%;
        /* color: #666; */
    }
</style>
<div id="target-stick" style="position: fixed;"></div>
<div class="navbar navbar-out no-margin" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}" title="SeamlessHiring Homepage"></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="{{ Request::is('/') ? 'active' : '' }}">
                    <a class="" href="{{ url('/') }}">Home</a>
                </li>

                <!-- <li>
                    <a class="" href="{{ url('about') }}">About</a>
                </li> -->

                <li class="{{ Request::is('about') ? 'active' : '' }}">
                    <a class="" href="{{ url('about') }}">About</a>
                </li>

                <li class="{{ Request::is('pricing') ? 'active' : '' }}">
                    <a class="" href="{{ url('pricing') }}">Pricing</a>
                </li>

                <!-- <li class="{{ Request::is('cv/search*') ? 'active' : '' }}">
                    <a class="" href="{{ url('cv/search') }}">Find Resumes</a>
                </li> -->

                <li class="{{ Request::is('talent-source') ? 'active' : '' }}">
                    <a class="" href="{{ route('talent-source') }}">Talent Sourcing <!-- &nbsp;<i class="fa fa-search"> </i> --></a>
                </li>

                <li class="{{ Request::is('contact') ? 'active' : '' }}">
                    <a class="" href="{{ url('contact') }}">Contact</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a class="btn btn-primary" href="{{ url('register') }}" >SIGN UP</a>
                </li>
                <li>
                    <a class="signin" href="{{ url('login') }}" >LOG IN</a>

                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</div>
<!-- <div class="separator separator-small"></div> -->