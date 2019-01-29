<div id="target-stick" style="position: fixed;"></div>
<div class="navbar no-margin" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
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
                    <a class="" href="{{ url('dashboard') }}">Dashboard
                        <!-- &nbsp;<i class="fa fa-tachometer"></i> --></a>
                </li>

                <li class="dropdown {{ Request::is('cv/*') ? 'active' : '' }}">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">Candidates &nbsp; <i
                                class="fa fa-caret-down no-margin"></i></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::is('cv/talent-pool') ? 'active' : '' }}"><a
                                    href="{{ url('cv/talent-pool') }}">Talent Pool</a></li>
                        <li class="{{ Request::is('talent-source') ? 'active' : '' }}">
                            <a class="" href="{{ route('talent-source') }}">Talent Sourcing</a>
                        </li>
                    <!-- <li class="{{ Request::is('cv/purchased') ? 'active' : '' }}"><a href="{{ url('cv/purchased') }}">Purchased Cvs</a></li> -->
                    <!-- <li class="{{ Request::is('cv/saved') ? 'active' : '' }}"><a href="{{ url('cv/saved') }}">Saved Cvs</a></li> -->
                    <!-- <li class="{{ Request::is('cv/purchased') ? 'active' : '' }}"><a href="{{ url('cv/purchased') }}">Purchased Cvs</a></li> -->
                    </ul>
                </li>


                <li class="dropdown {{ Request::is('cv/*') ? 'active' : '' }}">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">Jobs <i
                                class="fa fa-caret-down fa-fw"></i></a>
                    <ul class="dropdown-menu">

                        <li class="{{ Request::is('my-jobs*') ? 'active' : '' }}">
                            <a class="" href="{{ url('my-jobs') }}">
                                <i class="fa fa-briefcase fa-fw"></i>
                                All Job
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('workflow') }}">
                                <i class="fa fa-chain fa-fw"></i>
                                Workflow
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('interview-note-templates') }}">
                                <i class="fa fa-file fa-fw"></i>
                                Interview Note Templates
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('settings-embed') }}">
                                <i class="fa fa-code fa-fw"></i>
                                Embed
                            </a>
                        </li>
                    <!-- <li class="{{ Request::is('cv/purchased') ? 'active' : '' }}"><a href="{{ url('cv/purchased') }}">Purchased Cvs</a></li> -->
                    <!-- <li class="{{ Request::is('cv/saved') ? 'active' : '' }}"><a href="{{ url('cv/saved') }}">Saved Cvs</a></li> -->
                    <!-- <li class="{{ Request::is('cv/purchased') ? 'active' : '' }}"><a href="{{ url('cv/purchased') }}">Purchased Cvs</a></li> -->
                    </ul>
                </li>

                <li class="">
                    <a class="" href="{{ url('my-career-page') }}" target="_blank">My Career Page <i
                                class="fa fa-building mask"></i></a>
                </li>


                <!--li class="">
                    <a class="" href="">Mail <span class="badge badge-danger animated bounce">3</span></a>
                </li-->

            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if( get_current_company()->id != 13 )
                    @if( @$account->status == 'TRIAL')
                        @if( @$account->has_expired )

                            <li>
                                <a title="Upgrade now to avoid termination of service" class="btn btn-danger"
                                   href="{{ url('pricing') }}">{{ @$account->trial_time }} Days left</a>

                                <div class="pricey-callout animated zoomInDown">Your trial period has ended <a
                                            class="closer">&times;</a></div>

                            </li>

                        @else

                            <li>
                                <a title="Upgrade now to avoid termination of service" class="btn btn-danger"
                                   href="{{ url('pricing') }}">{{ @$account->trial_time }} Days left</a>

                                <div class="pricey-callout animated zoomInDown">Your trial period ends in
                                    <span>{{ @$account->trial_time }}</span> days. Upgrade now to avoid termination of
                                    service <a class="closer">&times;</a></div>

                            </li>


                        @endif

                    @endif

                @endif

                <li id="fat-menu" class="dropdown" title="{{ get_current_company()->name }}">
                    <a class="a-user" id="drop3" href="#" class="dropdown-toggle" style="" data-toggle="dropdown"
                       role="button" aria-haspopup="true" aria-expanded="false">

                        <span class="ellipsis comp-name"><i
                                    class="fa fa-bookmark"></i> {{ get_current_company()->name }} &nbsp;</span>

                        <img src="{{ default_picture( Auth::user(), 'user' ) }}" width="40px" class="img-profile"
                             height="40px" alt="">
                    </a>
                    <ul class="dropdown-menu top-user-menu" aria-labelledby="drop3">
                        <!-- <li><a href="setting.php">Account Setting</a></li>  -->
                        <?php $companies = Auth::user()->companies->unique(); ?>
                        @foreach( $companies as $key => $company )
                            <li>
                                <a href="{{ route('select-company',['slug'=>$company->slug]) }}"> @if( $company->id == get_current_company()->id )
                                        <i class="fa fa-check"></i> @endif {{  $company->name }}</a></li>
                        @endforeach
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('add-company') }}"><i class="fa fa-plus fa-fw"></i> Create new Company</a>

                        </li>
                    <!-- <li><a href="{{-- route('edit-company', ['id' => get_current_company()->id ]) --}}">Edit <strong>{{ get_current_company()->name }}</strong> </a></li> -->
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

<script>
    $('.pricey-callout .closer').on('click', function () {
        $('.pricey-callout').hide();
//           alert('tkgykug');
    });
</script>
