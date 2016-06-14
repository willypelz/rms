    <div class="navbar navbar-fixed-top no-margin fold" role="navigation">
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
                    <li class="{{ Request::is('dashboard*') ? 'active' : '' }}">
                        <a class="" href="{{ url('dashboard') }}">Dashboard <!-- &nbsp;<i class="fa fa-tachometer"></i> --></a>
                    </li>

                    <li class="dropdown {{ Request::is('cv/*') ? 'active' : '' }}">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">Candidates &nbsp; <i class="fa fa-caret-down no-margin"></i></a>
                        <ul class="dropdown-menu">
                            <li class="{{ Request::is('cv/talent-pool') ? 'active' : '' }}"><a href="{{ url('cv/talent-pool') }}">Talent Pool</a></li>
                            <li class="{{ Request::is('cv/saved') ? 'active' : '' }}"><a href="{{ url('cv/saved') }}">Saved Cvs</a></li>
                            <li class="{{ Request::is('cv/purchased') ? 'active' : '' }}"><a href="{{ url('cv/purchased') }}">Purchased Cvs</a></li>
                        </ul>
                    </li>

                    <li class="{{ Request::is('my-jobs*') ? 'active' : '' }}">
                        <a class="" href="{{ url('my-jobs') }}">My Jobs <i class="fa fa-briefcase mask"></i></a>

                    </li>
                    
                    <li class="">
                        <a class="" href="{{ url('my-career-page') }}" target="_blank" >My Career Page <i class="fa fa-building mask"></i></a>
                    </li>


                    <!--li class="">
                        <a class="" href="">Mail <span class="badge badge-danger animated bounce">3</span></a>
                    </li-->

                </ul>

                    <ul class="nav navbar-nav navbar-right">

                        <li>
                            <a class="btn btn-danger" href="{{ url('pricing') }}" >Upgrade</a>
                        </li>

                        <li id="fat-menu" class="dropdown" title="{{ Auth::user()->companies[0]->name }}"> 
                            <a class="a-user" id="drop3" href="#" class="dropdown-toggle" style="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> 

                            <span class="ellipsis text-green-light comp-name"><i class="fa fa-bookmark"></i> {{ Auth::user()->companies[0]->name }} &nbsp;</span>

                            <img src="{{ default_picture( Auth::user(), 'user' ) }}" width="40px" class="img-profile" height="40px" alt=""> 
                            <span class="caret"></span> 
                            </a> 
                            <ul class="dropdown-menu" aria-labelledby="drop3"> 
                                <!-- <li><a href="setting.php">Account Setting</a></li>  -->
                                @foreach( Auth::user()->companies as $key => $company )
                                    <li><a href="#"> @if( $company->id == Auth::user()->companies[0]->id ) <i class="fa fa-check"></i> @endif {{  $company->name }}</a></li>
                                @endforeach
                                <li role="separator" class="divider"></li> 
                                <li><a href="#"><i class="fa fa-plus"></i> Create new Company</a></li>
                                <li role="separator" class="divider"></li> 
                                <li><a href="{{ url('logout') }}">Logout</a></li> 
                            </ul> 
                        </li>
                    </ul>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </div>