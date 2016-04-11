@extends('layout.template-user')

@section('content')



    <section class="s-div">
        <div class="container">
            <div class="row no-pad">

                <div class="col-xs-12 no-margin">
                <br>
                    <h3 class="text-green-light no-margin">
                        36 Sesewa Recruit Jobs
                        &nbsp;
                        <a href="create-{{ url('jobs/dashboard') }}" class="btn btn-success"><i class="fa fa-plus"></i> Post a New Job</a>

                        <small class="pull-right text-white">Active (3) | Suspended (34)</small>
                    </h3>

                    <!--<hr>
                    <ul class="list-inline">
                        <li><strong>Company:</strong>&nbsp; JobAcess</li>
                        <li>
                            <strong>
                                <span class="glyphicon glyphicon-map-marker"></span>&nbsp;Location:</strong>&nbsp; Lagos, Nigeria</li>
                        <li>
                            <strong>
                                <span class="glyphicon glyphicon-calendar"></span>&nbsp;Posted Date:</strong>&nbsp; 07 Jun, 2014</li>
                        <li>
                            <strong>
                                <span class="glyphicon glyphicon-calendar"></span>&nbsp;Expiry Date:</strong>&nbsp; 21 Jun, 2014</li>
                    </ul>-->
                </div>

            </div>
        </div>
    </section>
    <div class="separator separator-small"></div>

    <section class="no-pad">
        <div class="container">
            <div class="row">

                
                @foreach($jobs as $job)
                <div class="col-xs-12">
                    <div class="panel panel-default b-db">
                        <div class="panel-body no-pad">

                            <div class="title-job pull-left">

                                <big><a target="_blank" href="{{ route('job-board', [$job['id']]) }}"><b>{{ $job['title'] }}</b></a></big><hr/>
                                <small class="text-muted"><i class="glyphicon glyphicon-ban-circle "></i> @if($job['published'] == 1) Job Live @else  Job Suspended @endif| <a href="{{ route('job-view', [$job['id'],  str_slug($job['title'])]) }}">View Job</a></small><br/>
                                <small class="text-muted"><i class="glyphicon glyphicon-map-marker "></i> {{ $job['location'] }} &nbsp;
                                    <i class="glyphicon glyphicon-calendar"></i> Date Created : {{ date('D, M Y', strtotime($job['created_at'])) }}</small>

                            </div>

                        <div class="btn-group btn-abs-ad">
                          <button type="button" class="btn btn-success">Promote Job</button>
                          <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">Separated link</a></li>
                          </ul>
                        </div>                            

                            <div class="job-item ">
                                <span class="number">26</span><br/>Hired
                            </div>
                            <div class="job-item ">
                                <span class="number">1006</span><br/>Assessed
                            </div>
                            <div class="job-item ">
                                <span class="number">106</span><br/>Interviewed
                            </div>
                            <div class="job-item ">
                                <span class="number text-muted">00</span><br/>Reviewed
                            </div>
                            <div class="job-item  purple">
                                <span class="number text-muted">00</span><br/>New
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                @endforeach


               

                <span class="col-xs-6"></span>
                </div>

            </div>
        <h1></h1>
    </section>


@endsection