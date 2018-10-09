<div class="panel-group">
    <div class="panel panel-default tweak panel-dash logged-in" >
        <div class="panel-heading">
            <h4 class="text-brandon text-center no-margin">{{ ucwords( Auth::guard('candidate')->user()->first_name . " " .Auth::guard('candidate')->user()->last_name ) }}</h4>
        </div>
        
        <div class="panel-collapse">
            <div class="row">
                <div class="panel-body no-padding">
                    <div class=" border-bottom-thin">
                        <div class="col-xs-12 text-center">
                            <div class="" style="">
                                <img src="{{ default_picture(Auth::guard('candidate')->user(), 'cv') }}" class="img-circle" width="30%">
                            </div><br>
                        </div>
                        {{-- <div class="col-xs-12 text-center">
                            <p class="text-white">
                                <span class="fa-stack">
                                    <i class="fa fa-briefcase fa-stack-1x fa-inverse"></i>
                                </span> Frontend Developer
                                <br>
                                <span class="fa-stack">
                                    <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                                </span> agbonscollins@gmail.com
                                <br>
                            </p>
                        </div> --}}
                        <div class="clearfix"></div>
                    </div>
                    <br>
                    
                    <div class="col-xs-12">
                        <div class="list-group">
                            <a href="{{ route('candidate-dashboard') }}" class=" @if( Route::currentRouteName() == "candidate-dashboard" ) active @endif list-group-item">
                                My applications
                                <span class="pull-right"><i class="fa fa-random"></i></span>
                            </a>

                            <a href="{{ route('candidate-jobs') }}" class=" @if( Route::currentRouteName() == "candidate-jobs" ) active @endif list-group-item">
                                Jobs
                                <span class="pull-right"><i class="fa fa-briefcase"></i></span>
                            </a>
                            {{-- <a role="presentation" href="#sec-notifications" aria-controls="sec-notifications" role="tab" data-toggle="tab" class="list-group-item">
                                Notifications &nbsp;

                                <span class="label label-danger pull-right">3</span>

                            </a> --}}
                           {{--  <a role="presentation" href="#sec-job-list" aria-controls="sec-job-list" role="tab" data-toggle="tab" class=" list-group-item">
                                See Jobs that Match you
                                <span class="pull-right"><i class="fa fa-check-square-o"></i></span>
                            </a> --}}
                            <a href="{{ route('candidate-logout') }}" class="list-group-item">
                                Logout
                                <span class="pull-right"><i class="fa fa-sign-out"></i></span>
                            </a>
                        </div>
                        <!-- <hr class="">
                        <div class="row">
                            <div class="col-xs-12">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero porro sapiente reiciendis nesciunt fuga soluta excepturi quod non molestias, at explicabo aliquam, laudantium, laborum fugit dolorem blanditiis deleniti! Harum, itaque!</p>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>