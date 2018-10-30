@extends('layout.template-user')

@section('content')
    <script src="http://seamlesshiring.com/js/embed.js"></script>
    
    <section class="s-div">
        <div class="container">
            <div class="row no-pad">
                
                <div class="col-xs-12 no-margin">
                    <br>
                    <h3 class="text-green-light no-margin">
                        {{ $active + $expired + $suspended }} {{ $company->name }}  @if($active + $suspended == 1)
                            Job @else Jobs @endif
                        &nbsp;
                        <a href="{{ route('post-job') }}" class="btn btn-success"><i class="fa fa-plus"></i> Post a New
                            Job</a>
                        
                        <small class="pull-right text-white">Active ({{ $active }}) | Expired ({{ $expired }}) |
                            Suspended ({{ $suspended }})
                        </small>
                    </h3>
                </div>
            
            </div>
        </div>
    </section>
    <div class="separator separator-small"></div>
    
    <section class="no-pad">
        <div class="container">
            <div class="row">
                
                <div class="col-md-4 col-sm-12 pull-right" style="margin-top: -40px;margin-bottom: 20px;">
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
                
                @foreach( $all_jobs as  $jobs)
                    @if( count(@$jobs) > 0 )
                        @foreach($jobs as $job)
                            
                            <div class="col-xs-12 job-block">
                                <div class="panel panel-default b-db">
                                    <div class="panel-body no-pad">
                                        <div class="">
                                            <div class="title-job pull-left">
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
                                                                    class="glyphicon glyphicon-remove "></i> Job Expired
                                                        </span>
                                                    @elseif($job['status'] == 'ACTIVE')<span class="text-success"><i
                                                                class="glyphicon glyphicon-ok "></i> Job Active </span>
                                                    @elseif($job['status'] == 'DRAFT') Job Draft
                                                    @elseif($job['status'] == 'SUSPENDED')<i
                                                            class="glyphicon glyphicon-ban-circle "></i> Job Suspended
                                                    @elseif($job['status'] == 'DELETED') Job Deleted
                                                    @else Job Expired @endif |
                                                    <a href="{{ route('job-board', [$job['id']]) }}">View Job</a> | <a
                                                            href="{{ url($company->slug.'/job/'.$job->id.'/'.str_slug($job->title)) }}"
                                                            target="_blank">Preview Job</a></small>
                                                <br/>
                                                <small class="text-muted"><i
                                                            class="glyphicon glyphicon-map-marker "></i> {{ $job['location'] }}
                                                    &nbsp;
                                                    <i class="glyphicon glyphicon-calendar"></i> Date Created
                                                    : {{ date('D. j M, Y', strtotime($job['created_at'])) }}</small>
                                            
                                            </div>
                                            
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
                                                    <li><a href="{{ route('job-candidates', [$job['id']]) }}">View
                                                            Applicants</a></li>
                                                    <li><a href="{{ route('job-promote', [$job['id']]) }}">Promote this
                                                            Job</a></li>
                                                    <li><a href="{{ route('job-promote', [$job['id']]) }}">Get
                                                            Referrals </a></li>
                                                    <li><a href="{{ route('job-promote', [$job['id']]) }}">Share this
                                                            job on
                                                            Social Media. </a></li>
                                                    <li role="separator" class="divider"></li>
                                                    @if($job['status'] == 'SUSPENDED')
                                                        <li><a href="#"
                                                               onclick="Activate( {{$job['id']}} ); return false">Activate
                                                                Job</a></li>
                                                    @elseif($job['status'] == 'DRAFT')
                                                        <li><a href="#"
                                                               onclick="Activate( {{$job['id']}} ); return false">Activate
                                                                Job</a></li>
                                                    @elseif($job['status'] == 'EXPIRED')
                                                        <li><a href="#" disabled>EXPIRED</a></li>
                                                    @elseif($job['status'] == 'ACTIVE')
                                                        <li><a href="#"
                                                               onclick="Suspend( {{$job['id']}} ); return false">Suspend
                                                                Job</a></li>
                                                    @endif
                                                    <li><a href="#"
                                                           onclick="DuplicateJob( {{$job['id']}} ); return false">Duplicate
                                                            Job</a></li>
                                                    <li role="separator" class="divider"></li>
                                                    <li><a href="#" id="delete-job" class="text text-danger"
                                                           data-id="{{$job['id']}}" data-title="{{ $job['title'] }}"
                                                           data-toggle="modal" data-target="#deleteJob" id="modalButton"
                                                           href="#deleteJob">Delete Job</a></li>
                                                </ul>
                                            </div>
                                            
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
                            
                            <script type="text/javascript">
                                $(document).ready(function () {

                                    $.ajax
                                    ({
                                        type: "POST",
                                        url: "{{ route('job-list-data') }}",
                                        data: ({rnd: Math.random() * 100000, job_id:{{$job['id']}} }),
                                        success: function (response) {
                                            $("#job-list-data-{{ $job['id'] }}").html(response);

                                        }
                                    });


                                });

                                function Activate(id) {
                                    console.log(id)
                                    var url = "{{ route('job-status') }}"

                                    $.ajax
                                    ({
                                        type: "POST",
                                        url: url,
                                        data: ({rnd: Math.random() * 100000, job_id: id, status: 'ACTIVE'}),
                                        success: function (response) {
                                            // $('#statusBtn').hide()
                                            alert('Job has been Activated')
                                            location.reload();
                                            // alert('success')

                                        }
                                    });
                                }

                                function Suspend(id) {
                                    console.log(id)
                                    var url = "{{ route('job-status') }}"

                                    $.ajax
                                    ({
                                        type: "POST",
                                        url: url,
                                        data: ({rnd: Math.random() * 100000, job_id: id, status: 'SUSPENDED'}),
                                        success: function (response) {
                                            // $('#statusBtn').hide()
                                            alert('Job has been Suspended')
                                            location.reload();
                                        }
                                    });
                                }

                                function DuplicateJob(id) {
                                    console.log(id)
                                    var url = "{{ route('duplicate-job') }}"

                                    $.ajax
                                    ({
                                        type: "POST",
                                        url: url,
                                        data: ({rnd: Math.random() * 100000, job_id: id}),
                                        success: function (response) {
                                            // $('#statusBtn').hide()
                                            alert('Job has been Duplicated')
                                            location.reload();
                                        }
                                    });
                                }
                            </script>
                        @endforeach
                        
                        <script type="text/javascript">
                            $(document).ready(function () {
                                var job_id = "";
                                var job_title = "";
                                var this_one = null;
                                $('body').on('click', '#delete-job', function () {
                                    job_id = $(this).data('id');
                                    job_title = $(this).data('title');
                                    this_one = $(this);
                                });

                                $('body').on('click', '#delete-job-pop', function () {

                                    $this = $(this);

                                    $.post("{{ route('job-status') }}", {
                                        rnd: Math.random() * 100000,
                                        job_id: this_one.data('id'),
                                        status: 'DELETED'
                                    }, function () {
                                        this_one.closest('.job-block').remove();
                                        $('#deleteJob').modal('toggle');
                                        $.growl.notice({message: "You have deleted '" + this_one.data('title') + "'"});
                                    });

                                });

                                $('body #closeRejectModal').on('click', function () {
                                    $('#deleteJob').modal('toggle');
                                });
                            });
                        
                        </script>
                    
                    @else
                    
                    
                    
                    @endif
                @endforeach
                
                
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
                        <a href="javascript://" id="delete-job-pop" class="btn btn-success pull-right">Yes</a>
                        <div class="separator separator-small"></div>
                    </div>
                    
                    <div class="pull-right" style="margin-right:10px;">
                        <a href="javascript://" id="closeRejectModal" class="btn btn-danger pull-right">No</a>
                        <div class="separator separator-small"></div>
                    </div>
                    
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>

@endsection