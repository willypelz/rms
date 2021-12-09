@foreach( $all_jobs as $job_section)
    @if( count(@$job_section) > 0 )
        @foreach($job_section as $key => $job)
            @php

                $tag = $key = (( \Carbon\Carbon::now()->diffInDays( \Carbon\Carbon::parse($job->expiry_date), false ) < 0 ) ? 'expired' : strtolower($job['status']));

            @endphp

            <div class="col-xs-12 job-block job-all job-{{$tag}}">
                <div class="panel panel-default b-db">
                    <div class="panel-body no-pad">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="title-job">
                                    <h5>
                                        <a target="_blank"
                                           href="{{ route('job-board', [$job['id']]) }}"><b>{{ $job['title'] .'- '.$tag }}</b>
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
                                            | <a href="{{ route('job-view',['jobID'=>$job->id,'jobSlug'=>str_slug($job->title)]) }}"
                                                 target="_blank">Preview Job</a>
                                        @endif
                                    </small>
                                    <br/>
                                    <small class="text-muted">

                                        <i
                                                class="glyphicon glyphicon-bookmark "></i> {{ $job['is_for']}} {{ $job['is_private'] == 1 ? '(PRIVATE)' : '(PUBLIC)'}}
                                        &nbsp;
                                        <i
                                                class="glyphicon glyphicon-map-marker "></i> {{ substring($job['location'], 0, 9) }}
                                        &nbsp;
                                        <i class="glyphicon glyphicon-calendar"></i> Date Posted
                                        : {{ date('F d, Y', strtotime($job['post_date'])) }}</small>

                                    <div class="btn-group btn-abs-ad button-top">
                                        <a href="{{ route('job-board', [$job['id']]) }}" type="button"
                                           class="btn btn-sm btn-success">View Job</a>
                                        <button type="button" class="btn btn-sm btn-success dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu">

                                            @if($job['status'] != 'DRAFT')
                                                <li><a href="{{ route('job-view',['jobID'=>$job->id,'jobSlug'=>str_slug($job->title)]) }}" target="_blank">Preview Job</a></li>

                                                <li><a href="{{ route('job-candidates', [$job['id']]) }}">View
                                                        Applicants</a></li>
                                                @if((isset($user_role) &&  !is_null($user_role) && in_array($user_role->name, ['admin'])) || $is_super_admin)

                                                    @if( !$job->hasExpied())
                                                        <li><a href="{{ route('job-promote', [$job['id']]) }}">Promote
                                                                this
                                                                Job</a></li>



                                                        <li><a href="{{ route('job-promote', [$job['id']]) }}">Share
                                                                this
                                                                job on
                                                                Social Media. </a></li>


                                                        <input type="text"
                                                               id="copy_{{ $job->id }}"
                                                               value="{{ route('job-view',['jobID'=>$job->id,'jobSlug'=>str_slug($job->title)]) }}" style="display: none;">




                                                    @endif

                                                    <li><a href="#" class="copyBtn" id="copyBtn" onclick="copyLink('{{ route('job-view',['jobID'=>$job->id,'jobSlug'=>str_slug($job->title)]) }}')" data-text="{{ route('job-view',['jobID'=>$job->id,'jobSlug'=>str_slug($job->title)]) }}">Copy job Link </a></li>


                                                    <li role="separator" class="divider"></li>
                                                    @if($job['is_private'] == 1)
                                                        <li><a href="#"
                                                               onclick="makePublic( {{$job['id']}} ); return false">Make job public</a></li>
                                                    @else
                                                        <li><a href="#"
                                                               onclick="makePrivate( {{$job['id']}} ); return false">Make job private</a></li>
                                                    @endif

                                                    @if(in_array($job['status'], ['SUSPENDED', 'DRAFT'] ) && !$job->hasExpied())
                                                        <li><a href="#"
                                                               onclick="Activate( {{$job['id']}} ); return false">Activate
                                                                Job</a></li>
                                                    @elseif($job['status'] == 'EXPIRED')
                                                        <li><a href="#" disabled>EXPIRED</a></li>
                                                    @elseif($job['status'] == 'ACTIVE' && !$job->hasExpied())
                                                        <li><a href="#"
                                                               onclick="Suspend( {{$job['id']}} ); return false">Suspend Job</a></li>
                                                    @endif
                                                    <li><a href="#"
                                                           onclick="DuplicateJob( {{$job['id']}} ); return false">Duplicate Job</a></li>

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
                                                            <span class="number"> @if($workflowStep->name == 'All') - @else - @endif
                                                            </span><br/>{{ $workflowStep->name }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                function copyLink(text){
                    var $temp = $("<input>");
                    $("body").append($temp);
                    $temp.val(text).select();
                    if (document.execCommand('copy')) {
                        $.growl.notice({message: "Job link copied"});
                        $temp.remove();
                    }

                }
                function Activate(id) {
                    var url = "{{ route('job-status') }}";

                    $.ajax
                    ({
                        type: "POST",
                        url: url,
                        data: ({rnd: Math.random() * 100000, job_id: id, status: 'ACTIVE'}),
                        success: function (response) {
                            $.growl.notice({ message: "Job has been Activated" });
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
                            $.growl.notice({ message: "Job has been Suspended" });
                            location.reload();
                        }
                    });
                }

                function makePrivate(id) {
                    var url = "{{ route('make-job-private') }}";
                    var confirmed = confirm("Are you sure you want to make this job private?");
                    if(confirmed == true){
                        $.ajax
                        ({
                            type: "POST",
                            url: url,
                            data: ({rnd: Math.random() * 100000, job_id: id, is_private: true}),
                            success: function (response) {
                                $.growl.notice({ message: "Job has been made private" });
                                location.reload();
                            }
                        });
                    }
                }

                function makePublic(id) {
                    var url = "{{ route('make-job-private') }}";
                    var confirmed = confirm("Are you sure you want to make this job public?");
                    if(confirmed == true){
                        $.ajax
                        ({
                            type: "POST",
                            url: url,
                            data: ({rnd: Math.random() * 100000, job_id: id, is_private: false}),
                            success: function (response) {
                                $.growl.notice({ message: "Job has been made public" });
                                location.reload();
                            }
                        });
                    }
                }

                function DuplicateJob(id) {
                    var url = "{{ route('duplicate-job') }}";

                    $.ajax
                    ({
                        type: "POST",
                        url: url,
                        data: ({rnd: Math.random() * 100000, job_id: id}),
                        success: function (response) {
                            $.growl.notice({ message: "Job has been Duplicated" });
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


            <script>
                $(function () {

                    $.ajax
                    ({
                        type: "POST",
                        url: "{{ route('get-one-job-data') }}",
                        data: ({
                            rnd: Math.random() * 100000,
                            jobs_ids: {!! $job->id !!} }),
                        success: function (response) {

                            console.log(response)

                            response.forEach(function (v) {
                                $("#job-list-data-" + v.id).html(v.html_data);
                            });

                        }
                    });

                });

            </script>

        @endforeach

    @else



    @endif
@endforeach
<div>
    {!!  $jobs->links('job.includes.paginate'); !!}
</div>
