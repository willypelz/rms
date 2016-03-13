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
                <a class="navbar-brand" href="{{ URL::to('dashboard') }}"><b><i class="fa fa-skype"></i>&nbsp; Seamless Hiring</b></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a class="" href="{{ URL::to('dashboard') }}">Dashboard &nbsp;<i class="fa fa-tachometer"></i></a>
                    </li>

                    <li class="">
                        <a class="" href="{{ URL::to('cv/search-results') }}">Talent Pool <i class="fa fa-users mask"></i></a>
                    </li>

                    <li class="">
                        <a class="" href="{{ URL::to('jobs/list') }}">My Jobs <i class="fa fa-briefcase mask"></i></a>
                    </li>


                    <li class="">
                        <a class="" href="{{ URL::to('jobs/create') }}">My Company <i class="fa fa-building mask"></i></a>
                    </li>

                </ul>

                    <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown">
                        <a class="animated tada dropdown-toggle" id="dropBell" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="label label-danger label-sm">3</span>
                            <i class="fa fa-bell fa-lg"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropBell"> 
                            <li><a href="setting.php">Account Setting</a></li> 
                            <li role="separator" class="divider"></li> 
                            <li><a href="_index.php">Logout</a></li> 
                        </ul> 
                    </li>
                    <!-- <li>
                        <a href="" class="animated">3 <i class="fa fa-shopping-basket fa-lg"></i></a>
                    </li> -->
                        <li id="fat-menu" class="dropdown"> 
                            <a class="a-user" id="drop3" href="#" class="dropdown-toggle" style="" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> 
                                <img src="http://dummyimage.com/300x300/ffffff/405465.jpg&text=DL" width="40px" class="img-profile" height="40px" alt=""> 
                                <span class="caret"></span> 
                            </a> 
                            <ul class="dropdown-menu" aria-labelledby="drop3"> 
                                <li><a href="setting.php">Account Setting</a></li> 
                                <li role="separator" class="divider"></li> 
                                <li><a href="_index.php">Logout</a></li> 
                            </ul> 
                        </li>
                    </ul>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </div>