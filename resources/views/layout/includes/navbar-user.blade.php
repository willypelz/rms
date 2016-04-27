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
                    <li class="">
                        <a class="" href="{{ url('dashboard') }}">Dashboard <!-- &nbsp;<i class="fa fa-tachometer"></i> --></a>
                    </li>

                    <li class="dropdown">
                        <a class="dropdown-toggle" href="cv-search.php" data-toggle="dropdown">Candidates &nbsp; <i class="fa fa-caret-down no-margin"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('cv/talent-pool') }}">All my CVs</a></li>
                            <li><a href="{{ url('cv/saved') }}">Saved Cvs</a></li>
                            <li><a href="{{ url('cv/purchased') }}">Purchased Cvs</a></li>
                        </ul>
                    </li>

                    <li class="">
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

                        <li id="fat-menu" class="dropdown"> 
                            <a class="a-user" id="drop3" href="#" class="dropdown-toggle" style="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> 
                                <img src="{{ default_picture( Auth::user(), 'user' ) }}" width="40px" class="img-profile" height="40px" alt=""> 
                                <span class="caret"></span> 
                            </a> 
                            <ul class="dropdown-menu" aria-labelledby="drop3"> 
                                <!-- <li><a href="setting.php">Account Setting</a></li>  -->
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