@extends('layout.template-user')

@section('content')
    <script src="{{ asset('js/embed.js') }}"></script>
    @php
        $user_role = getCurrentLoggedInUserRole();
        $is_super_admin = auth()->user()->is_super_admin;
    @endphp
    <section class="s-div">
        <div class="container">
            <div class="row no-pad">

                <div class="col-xs-12 no-margin">
                    <br>
                    <h3 class="text-green-light no-margin">
                        {{ $active + $expired + $suspended }} {{ $company->name }}  @if($active + $suspended > 1)
                            Jobs @else Job @endif
                        &nbsp;
                        @if($user_role == 'admin')
                        <a href="{{ route('post-job') }}" class="btn btn-success"><i class="fa fa-plus"></i> Post a New
                            Job</a>
                        @endif
                    </h3>
                </div>

            </div>
        </div>
    </section>
    <div class="separator separator-small"></div>

    <section class="no-pad">
        <div class="container">
            <div class="row">

                <div class="col-md-8 col-sm-12" id="filter">
                    <button class="btn btn-primary active" type="button" data-target="all">
                        All <span class="badge">{{ $active + $expired + $suspended }}</span>
                    </button>
                    <button class="btn btn-primary" type="button" data-target="active">
                        Active <span class="badge">{{ $active }}</span>
                    </button>
                    <button class="btn btn-primary" type="button" data-target="suspended">
                        Suspended <span class="badge">{{ $suspended }}</span>
                    </button>
                    <button class="btn btn-primary" type="button" data-target="expired">
                        Expired <span class="badge">{{ $expired }}</span>
                    </button>
                    <button class="btn btn-primary" type="button" data-target="draft">
                        Draft <span class="badge">{{ $draft }}</span>
                    </button>
                </div>
                <script>
                    $(document).ready(function () {
                        $('#filter button').on('click', function () {
                            $('#filter button').removeClass('active');
                            $('body .job-block').hide();
                            $(this).addClass('active');
                            $("body .job-" + $(this).data('target')).fadeIn();
                        })
                    });
                </script>

                <div class="col-md-4 col-sm-12" style="margin-top: -40px;margin-bottom: 20px;">
                    <form action="" class="form-group"><br>

                        <div class="form-lg">
                            <div class="col-xs-10">
                                <div class="row"><input placeholder="Search" name="q" id="q" value="{{ @$q }}"
                                                        class="form-control input-lg" type="text"></div>
                            </div>
                            <div class="col-xs-2">
                                <div class="row">
                                    <button type="submit" class="btn btn-lg btn-block btn-success ">
                                        <!-- Find <span class="hidden-sm hidden-xs">Candidates</span>  -->
                                        <i class="fa fa-search fa-lg"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="clearfix"></div>


                @if( @$q !== null && count( $jobs ) == 0 )

                    <h2 class="text-center">No Jobs with "{{ @$q }}" Found</h2>

                @endif

                @foreach( $all_jobs as  $job_section)
                    @if( count(@$job_section) > 0 )
                        @foreach($job_section as $job)
                            @php $tag = ( \Carbon\Carbon::now()->diffInDays( \Carbon\Carbon::parse($job->expiry_date), false ) < 0 ) ? 'expired' : strtolower($job['status']); @endphp

                            <div class="col-xs-12 job-block job-all job-{{$tag}}">
                                <div class="panel panel-default b-db">
                                    <div class="panel-body no-pad">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="title-job">
                                                    <h5>
                                                        <a target="_blank"
                                                           href="{{ route('job-board', [$job['id']]) }}"><b>{{ $job['title'] }}</b>
                                                        </a>
                                                        <a href="{{ route('workflow-steps-add', ['id' => $job->workflow->id]) }}"
                                                           class="label label-info">
                                                            {{ ucwords($job->workflow->name) }}
                                                        </a>
                                                    </h5>
                                                    <hr/>
                                                    <small class="text-muted">
                                                        @if( \Carbon\Carbon::now()->diffInDays( \Carbon\Carbon::parse($job->expiry_date), false ) < 0 )
                                                            <span class="text-danger"><i
                                                                        class="glyphicon glyphicon-remove "></i> Job
                                                                Expired
                                                            </span>
                                                        @elseif($job['status'] == 'ACTIVE')<span class="text-success"><i
                                                                    class="glyphicon glyphicon-ok "></i> Job Active
                                                        </span>
                                                        @elseif($job['status'] == 'DRAFT') Job Draft
                                                        @elseif($job['status'] == 'SUSPENDED')<i
                                                                class="glyphicon glyphicon-ban-circle "></i> Job
                                                        Suspended
                                                        @elseif($job['status'] == 'DELETED') Job Deleted
                                                        @else Job Expired @endif |
                                                        <a href="{{ route('job-board', [$job['id']]) }}">View Job</a>
                                                        @if((isset($user_role) && !is_null($user_role) && in_array($user_role->name, ['admin','commenter'])) || $is_super_admin)
                                                                <a href="{{ route('job-view',['jobID'=>$job->id,'jobSlug'=>str_slug($job->title)]) }}"
                                                                    target="_blank">Preview Job</a>
                                                            @endif
                                                    </small>
                                                    <br/>
                                                    <small class="text-muted">
                                                    <i
                                                                class="glyphicon glyphicon-bookmark "></i> {{$job['is_for']}}
                                                        &nbsp;
                                                        <i
                                                                class="glyphicon glyphicon-map-marker "></i> {{ $job['location'] }}
                                                        &nbsp;
                                                        <i class="glyphicon glyphicon-calendar"></i> Date Posted
                                                        : {{ date('D. j M, Y', strtotime($job['post_date'])) }}</small>

                                                    <div class="btn-group btn-abs-ad">
                                                        <a href="{{ route('job-board', [$job['id']]) }}" type="button"
                                                           class="btn btn-success">View Job</a>
                                                        <button type="button" class="btn btn-success dropdown-toggle"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                            <span class="caret"></span>
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <ul class="dropdown-menu">

                                                            @if($job['status'] != 'DRAFT')
                                                                <li><a href="{{ route('job-candidates', [$job['id']]) }}">View
                                                                    Applicants</a></li>
                                                                @if((isset($user_role) && !is_null($user_role) && in_array($user_role->name, ['admin'])) || $is_super_admin)
                                                                <li><a href="{{ route('job-promote', [$job['id']]) }}">Promote
                                                                        this
                                                                        Job</a></li>
                                                                <li><a href="{{ route('job-promote', [$job['id']]) }}">Get
                                                                        Referrals </a></li>
                                                                <li><a href="{{ route('job-promote', [$job['id']]) }}">Share
                                                                        this
                                                                        job on
                                                                        Social Media. </a></li>
                                                                <li role="separator" class="divider"></li>
                                                                @if(in_array($job['status'], ['SUSPENDED', 'DRAFT'] ) && !$job->hasExpied())
                                                                    <li><a href="#"
                                                                           onclick="Activate( {{$job['id']}} ); return false">Activate
                                                                            Job</a></li>
                                                                @elseif($job['status'] == 'EXPIRED')
                                                                    <li><a href="#" disabled>EXPIRED</a></li>
                                                                @elseif($job['status'] == 'ACTIVE' && !$job->hasExpied())
                                                                    <li><a href="#"
                                                                           onclick="Suspend( {{$job['id']}} ); return false">Suspend
                                                                            Job</a></li>
                                                                @endif
                                                                <li><a href="#"
                                                                       onclick="DuplicateJob( {{$job['id']}} ); return false">Duplicate
                                                                        Job</a></li>

                                                                <li role="separator" class="divider"></li>
                                                                @endif
                                                            @endif



                                                            <li><a href="{{ route('create-job', $job['id']) }}"  class="text t"
                                                                   >Edit Job</a></li>

                                                            <li><a href="#" id="delete-job" class="text text-danger"
                                                                   data-id="{{$job['id']}}"
                                                                   data-title="{{ $job['title'] }}"
                                                                   data-toggle="modal" data-target="#deleteJob"
                                                                   id="modalButton"
                                                                   href="#deleteJob">Delete Job</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div id="job-list-data-{{ $job['id'] }}" class="job-items">
                                                    @foreach($job->workflow->workflowSteps as $workflowStep)
                                                        <div class="job-item">
                                                            <span class="number">--</span><br/>{{ $workflowStep->name }}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script type="text/javascript">

                                function Activate(id) {
                                    var url = "{{ route('job-status') }}";

                                    $.ajax
                                    ({
                                        type: "POST",
                                        url: url,
                                        data: ({rnd: Math.random() * 100000, job_id: id, status: 'ACTIVE'}),
                                        success: function (response) {
                                            alert('Job has been Activated');
                                            location.reload();

                                        }
                                    });
                                }

                                function Suspend(id) {
                                    var url = "{{ route('job-status') }}";

                                    $.ajax
                                    ({
                                        type: "POST",
                                        url: url,
                                        data: ({rnd: Math.random() * 100000, job_id: id, status: 'SUSPENDED'}),
                                        success: function (response) {
                                            alert('Job has been Suspended');
                                            location.reload();
                                        }
                                    });
                                }

                                function DuplicateJob(id) {
                                    var url = "{{ route('duplicate-job') }}";

                                    $.ajax
                                    ({
                                        type: "POST",
                                        url: url,
                                        data: ({rnd: Math.random() * 100000, job_id: id}),
                                        success: function (response) {
                                            alert('Job has been Duplicated');
                                            location.reload();
                                        }
                                    });
                                }
                                var job_id = "";
                                var job_title = "";
                                var this_one = null;
                                $('body').on('click', '#delete-job', function () {
                                    job_id = $(this).data('id');
                                    job_title = $(this).data('title');
                                    this_one = $(this);
                                });
                                function Kolo() {
                                    var url = "{{ route('job-status') }}";
                                    $.ajax
                                        ({
                                            type: "POST",
                                            url: url,
                                            data: ({
                                                rnd: Math.random() * 100000,
                                                job_id: job_id,
                                                status: 'DELETED'
                                            }),
                                            success: function (response) {
                                                if (response == "true") {
                                                    $('#deleteJob').modal('hide');
                                                    $.growl.notice({
                                                        message: "You have deleted '" + this_one.data('title') + "'"
                                                    });
                                                    setTimeout(function(){location.reload()}, 3000);
                                                } else {
                                                    $('#deleteJob').modal('hide');
                                                    $.growl.error({
                                                        message: "Applicants are attached to '" + this_one.data('title') + "'"
                                                    });
                                                }
                                            }
                                        });
                                }
                            </script>
                        @endforeach

                    @else



                    @endif
                @endforeach

                <script>
                    $(function () {

                        $.ajax
                        ({
                            type: "POST",
                            url: "{{ route('get-job-data') }}",
                            data: ({
                                rnd: Math.random() * 100000,
                                jobs_ids: {!! $jobs->pluck('id')->toJson() !!} }),
                            success: function (response) {

                                response.forEach(function (v) {
                                    $("#job-list-data-" + v.id).html(v.html_data);
                                });

                            }
                        });

                    });

                </script>
                <span class="col-xs-6"></span>
            </div>

        </div>
        <h1></h1>
    </section>

    <div class="modal widemodal fade" id="deleteJob" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="false">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin: 18px;">
                        ×
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Delete Job?</h4>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this job?

                    <div class="clearfix"></div>
                    <div class="pull-right">
                        <a href="javascript://" onclick="Kolo();" class="btn btn-success pull-right">Yes</a>
                        <div class="separator separator-small"></div>
                    </div>

                    <div class="pull-right" style="margin-right:10px;">
                        <a href="javascript://" id="closeRejectModal" onclick = "$('#deleteJob').modal('hide');"class="btn btn-danger pull-right">No</a>
                        <div class="separator separator-small"></div>
                    </div>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

@endsection
