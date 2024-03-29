@if( $result['response']['numFound'] > 0 )

    <?php $applicant_step = $job->workflow->workflowSteps->where('slug', $status)->first() ?>
    @if($applicant_step && ($applicant_step->type == 'assessment'))

        <a  class="btn btn-line status-1 text-success"
            data-toggle="modal"
            data-target="#viewModal"
            id="modalButton"
            data-title="Bulk Send Assessment Link"
            data-view="{{ route('modal-assess', [
            'jobID' => $jobID,
            'step' => $applicant_step->name,
            'stepSlug' => $applicant_step->slug,
            'stepId' => $applicant_step->id,
            'operation' => "bulk_send_assessment_link",
            'status' => $status,
            ]) }}"
            data-app-id=""
            data-cv=""
            data-type="wide">
            Bulk Send Assessment Link
        </a>
    @endif
    @foreach( @$result['response']['docs'] as $cv )

        <?php  $pic = default_color_picture($cv);
        $current_app_index = (int) array_search($jobID, $cv['job_id'] );
        // dd($cv['application_id'], $current_app_index );
        $current_status = isset($cv['application_status'][$current_app_index]) ? (($cv['application_status'][$current_app_index] == "ASSESSED") ? "TEST" : $cv['application_status'][$current_app_index]) : null;
        $check_both_permissions = checkForBothPermissions ($jobID);
        $is_stand_alone = getEnvData('RMS_STAND_ALONE');
        ?>

        <div class="ats-abx">
            <div class="comment" data-cv="{{ $cv['id'] }}"
                 data-app-id="{{ $cv['application_id'][ $current_app_index ] }}">
                <hr>
                <span class="col-md-2 col-sm-3">
                    <a href="{{ route('applicant-profile', [$cv['application_id']][ $current_app_index ] ) }}"
                       target="_blank"
                       class="text-center">
                        <img alt="" src="{{ $pic['image'] }}" style="background:{{ $pic['color'] }};"
                             class="media-object "
                             width="90%">
                    </a>
                </span>
                <div class="col-md-10 col-sm-9" style="padding-bottom: 10px;">
                    <input type="checkbox" class="media-body-check check-applicant pull-right">
                    <h4 class="media-heading text-muted">
                        <a href="{{ route('applicant-profile', [$cv['application_id']][ $current_app_index ] ) }}"
                           target="_blank"><strong>{{ ucwords( @$cv['first_name']. " " . @$cv['last_name'] ) }}</strong>
                           <small>{{((!$is_stand_alone) && isset($cv['applicant_type'])) ? '('.$cv['applicant_type'].')' : ''}} </small> </a>

                        <span class="span-stage">{{ $current_status }}</span>
                        @foreach($job->workflow->workflowSteps as $workflowStep)
                            @if($workflowStep->slug == $current_status && !$cv['is_approved'] && $workflowStep->requires_approval)
                                <span class=" text-danger" style="font-size: 12px;">
                                    (Requires Approval of {{ implode(" or ", $workflowStep->approvals->pluck("name")->toArray() )}})
                                </span>
                            @endif
                        @endforeach
                    </h4>
                    <p>{{ @$cv['last_position'] }} @if( @$cv['last_company_worked'] != '' ) {{ ' at '.@$cv['last_company_worked'] }}  @endif</p>
                    @if(sizeof(percentageOf($cv['application_id'])) > 0)
                            <p class="text-success">
                                {{-- % Score(s): --}}
                                @foreach(percentageOf($cv['application_id']) as $percentage)
                                    {{ $percentage->test_name }} - {{ $percentage->status }}
                                @if(!$loop->last) <br/> @endif

                                @endforeach
                            </p>
                     @endif
                    <?php
                    $appl_status = isset($cv['application_status'][$current_app_index]) ? $cv['application_status'][$current_app_index] : null;
                    ?>

                    @if( @$applicant_step->type == 'assessment' && in_array('can-test', $permissions) && $check_both_permissions)

                        @if( is_array( @$cv['test_name'] ) )
                            @for($i = 0; $i < count(@$cv['test_name']); $i++)

                                <p> {{ @$cv['test_name'][$i] }}
                                    <span class="span-stage">
                                        @if(!empty($cv['test_score'])){{ number_format(@$cv['test_score'][$i]) }} @endif
                                        [{{ ( $cv['test_status'][$i] == "PENDING" ) ? 'INVITED' : $cv['test_status'][$i] }}
                                        ]
                                    </span> @if(!empty($cv['test_score']))
                                        <a href="{{ route('applicant-assess',   $cv['application_id'][ $current_app_index ]  ) }}">
                                            View test results
                                        </a>
                                    @endif
                                </p>
                            @endfor

                        @else

                            <!-- <p class="text-warning">No test requested for candidate</p> -->
                        @endif

                        @if(sizeof(percentageOf($cv['application_id'])) > 0)
                            {{-- <p class="text-muted">
                                % Score(s):
                                @foreach(percentageOf($cv['application_id']) as $percentage)
                                    {{ $percentage->test_name }} - {{ $percentage->percentage }}%
                                @endforeach
                            </p> --}}
                        @else
                            <p class="text-warning">No test requested for candidate</p>
                        @endif
                    @endif


                    <div>
                        <span class="text-muted"><i
                                    class="fa fa-calendar"></i> {{ \Carbon\Carbon::parse( @$cv['application_date'] )->subHour()->diffForHumans() }} &nbsp;
                            &middot; &nbsp;</span>
                        @if((isset($permissions) && in_array('can-view-job', $permissions)) || $check_both_permissions)&nbsp;
                        <a id="showCvBtn" data-toggle="modal" data-target="#cvModal"
                           onclick="showCvModal('{{ $cv['id'] }}',true, {{ $cv['application_id'][ $current_app_index ] }});">
                            View CV
                        </a>
                        @endif
                        @if((isset($permissions) && in_array('can-view-candidates', $permissions)) || $check_both_permissions)
                        <span class="text-muted">&nbsp; &middot; &nbsp;</span>
                        <a href="{{ route('applicant-profile', [$cv['application_id']][ $current_app_index ] ) }}">
                            View application
                        </a>
                        @endif
                    <!--span class="text-muted">·</span>
              <a href="{{ route('applicant-profile', [$cv['application_id']][ $current_app_index ] ) }}">View Application</a-->

                        <span class="text-muted">&nbsp; </span>
                        @if((isset($permissions) && in_array('can-view-application', $permissions) && $cv['is_approved']) || $check_both_permissions)
                            <span class="dropdown">
                                <a id="moveToDrop"
                                   class="dropdown-toggle"
                                   data-toggle="dropdown"
                                   aria-expanded="false">
                                    Move to
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="moveToDrop"
                                >
                                    @foreach($job->workflow->workflowSteps as $workflowStep)

                                        @if($workflowStep->slug == 'ALL' || $workflowStep->slug == @$applicant_step->slug)
                                            @continue
                                        @endif

                                        <li>
                                            @if( !$workflowStep->requires_approval ||  ($cv['is_approved']))
                                                <a data-toggle="modal"
                                                data-target="#viewModal"
                                                id="modalButton"
                                                data-title="Move to {{ $workflowStep->name }}"
                                                data-view="{{ route('modal-step-action', [
                                                'step' => $workflowStep->name,
                                                'stepSlug' => $workflowStep->slug,
                                                'stepId' => $workflowStep->id
                                                ]) }}"
                                                data-app-id="{{ $cv['application_id'][ $current_app_index ] }}"
                                                data-cv="{{ $cv['id'] }}"
                                                data-type="normal">
                                                    {{ $workflowStep->name }}
                                                </a>
                                            @else
                                                <a href="javascript:;" data-toggle="tooltip" data-placement="top" title="Requires approval before you can move to the next step">
                                                    {{ $workflowStep->name }}
                                                </a>
                                            @endif
                                        </li>
                                    @endforeach


                                </ul>
                            </span>
                          @endif

                            @if(@$applicant_step->type == 'assessment' && (isset($permissions) && in_array('can-test', $permissions)) && $check_both_permissions)

                                <a data-toggle="modal"
                                   data-target="#viewModal"
                                   id="modalButton"
                                   href="#viewModal"
                                   data-title="Test"
                                   data-view="{{ route('modal-assess', [
                                       'step' => $applicant_step->name,
                                       'stepSlug' => $applicant_step->slug,
                                       'stepId' => $applicant_step->id
                                       ]) }}"
                                   data-app-id="{{ $cv['application_id'][ $current_app_index ] }}"
                                   data-cv="{{ $cv['id'] }}"
                                   data-type="wide">Test</a>

                            @endif

                            @if(@$applicant_step->type == 'interview' && (isset($permissions) && in_array('can-view-interview', $permissions)) && $check_both_permissions)
                                <a data-toggle="modal"
                                   data-target="#viewModal"
                                   id="modalButton"
                                   href="#viewModal"
                                   data-title="Schedule an interview for"
                                   data-view="{{ route('modal-interview',[
                                       'step' => $applicant_step->name,
                                       'stepSlug' => $applicant_step->slug,
                                       'stepId' => $applicant_step->id
                                       ]) }}"
                                   data-app-id="{{ $cv['application_id'][ $current_app_index ] }}"
                                   data-cv="{{ $cv['id'] }}"
                                   data-type="normal">Interview</a>
                            @endif

                            @if((@$applicant_step->type == 'background-check' || @$applicant_step->type == "medical-check") && (isset($permissions) && in_array('can-view-background-check', $permissions)) && $check_both_permissions)

                                <span class="text-muted"> &nbsp; &middot; &nbsp;</span>
                                <span class="dropdown" style="display: none;">
                                    <a id="checkDrop" type="button" data-toggle="dropdown" aria-expanded="false">
                                        Checks
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="checkDrop"
                                    >
                                        {{--@if(@$applicant_step->type == 'background-check')--}}
                                            {{--<li>--}}
                                                {{--<a data-toggle="modal"--}}
                                                   {{--data-target="#viewModal"--}}
                                                   {{--id="modalButton"--}}
                                                   {{--href="#viewModal"--}}
                                                   {{--data-title="Background Check"--}}
                                                   {{--data-view="{{ route('modal-background-check',[--}}
                                               {{--'step' => $applicant_step->name,--}}
                                               {{--'stepSlug' => $applicant_step->slug,--}}
                                               {{--'stepId' => $applicant_step->id--}}
                                               {{--]) }}"--}}
                                                   {{--data-app-id="{{ $cv['application_id'][ $current_app_index ] }}"--}}
                                                   {{--data-cv="{{ $cv['id'] }}"--}}
                                                   {{--data-type="wide">Background Check</a>--}}
                                            {{--</li>--}}
                                        {{--@endif--}}

                                        {{--@if(@$applicant_step->type == 'medical-check')--}}
                                            {{--<li>--}}
                                                {{--<a data-toggle="modal"--}}
                                                   {{--data-target="#viewModal"--}}
                                                   {{--id="modalButton"--}}
                                                   {{--href="#viewModal"--}}
                                                   {{--data-title="Medical Check"--}}
                                                   {{--data-view="{{ route('modal-medical-check',[--}}
                                               {{--'step' => $applicant_step->name,--}}
                                               {{--'stepSlug' => $applicant_step->slug,--}}
                                               {{--'stepId' => $applicant_step->id--}}
                                               {{--]) }}"--}}
                                                   {{--data-app-id="{{ $cv['application_id'][ $current_app_index ] }}"--}}
                                                   {{--data-cv="{{ $cv['id'] }}"--}}
                                                   {{--data-type="wide">Medical Check</a>--}}
                                            {{--</li>--}}
                                        {{--@endif--}}

                                    </ul>
                                </span>

                            @endif

                        {{-- @else --}}
                            @foreach($job->workflow->workflowSteps as $workflowStep)
                                @if(in_array(auth()->user()->id, $workflowStep->approvals->pluck('id')->toArray()) && $workflowStep->slug == @$applicant_step->slug && (isset($permissions) && in_array('can-perform-interview-actions', $permissions)))

                                @if(!$cv['is_approved'])

                                <!-- // Approval Button -->
                                    <a data-toggle="modal"
                                       data-target="#viewModal"
                                       id="modalButton"
                                       data-title="Approve"
                                       data-view="{{ route('modal-approve', [
                                           'stepSlug' => $workflowStep->slug,
                                           'stepId' => $workflowStep->id
                                           ]) }}"
                                       data-app-id="{{ $cv['application_id'][ $current_app_index ] }}"
                                       data-cv="{{ $cv['id'] }}"
                                       data-type="normal"
                                       class="text-success">
                                        Approve
                                    </a>

                                    <span class="text-muted">&nbsp; · &nbsp;</span>

                                    <span class="dropdown">
                                        <a id="moveToDrop"
                                           class="dropdown-toggle text-danger"
                                           data-toggle="dropdown"
                                           aria-expanded="false">
                                            Decline To
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" aria-labelledby="moveToDrop"
                                        >
                                            @foreach($job->workflow->workflowSteps as $workflowStep)

                                                @if($workflowStep->slug == 'ALL' || $workflowStep->slug == @$applicant_step->slug)
                                                    @continue
                                                @endif

                                                <li>
                                                    <a data-toggle="modal"
                                                       data-target="#viewModal"
                                                       id="modalButton"
                                                       data-title="{{ $workflowStep->name }}"
                                                       data-view="{{ route('modal-step-action', [
                                                       'step' => $workflowStep->name,
                                                       'stepSlug' => $workflowStep->slug,
                                                       'stepId' => $workflowStep->id
                                                       ]) }}"
                                                       data-app-id="{{ $cv['application_id'][ $current_app_index ] }}"
                                                       data-cv="{{ $cv['id'] }}"
                                                       data-type="normal">
                                                        {{ $workflowStep->name }}
                                                    </a>
                                                </li>

                                            @endforeach
                                        </ul>
                                    </span>
                                @endif
                                @endif
                            @endforeach
                        {{-- @endif --}}

                        {{-- @if($status != 'SHORTLISTED' && $status != 'ASSESSED' && $status != 'INTERVIEWED' && $status != 'HIRED')  --}}
                        {{--@if($status != 'SHORTLISTED')
                            <a data-toggle="modal"
                               data-target="#viewModal"
                               id="modalButton"
                               href="#viewModal"
                               data-title="Shortlist?"
                               data-view="{{ route('modal-shortlist') }}"
                               data-app-id="{{ $cv['application_id'][ $current_app_index ] }}"
                               data-cv="{{ $cv['id'] }}"
                               data-type="normal">Shortlist</a>
                            <span class="text-muted">·</span>
                        @endif

                        @if( $status != 'HIRED' )
                            <a type="button"
                               data-action="HIRED"
                               data-toggle="modal"
                               data-target="#viewModal"
                               id="modalButton"
                               href="#viewModal"
                               data-title="Hire"
                               data-view="{{ route('modal-hire') }}"
                               data-app-id="{{ $cv['application_id'][ $current_app_index ] }}"
                               data-cv="{{ $cv['id'] }}"
                               data-type="normal">Hire</a>
                            <span class="text-muted">·</span>
                        @endif

                    <!-- <a href="#" data-toggle="modal" data-target="#reviewCv[data-user='{{ @$cv['id'] }}']" id="reviewBtn-{{ $cv['application_id'][ $current_app_index ] }}">Comment</a> -->
                        <a data-toggle="modal"
                           data-target="#viewModal"
                           id="modalButton"
                           href="#viewModal"
                           data-title="Comment"
                           data-view="{{ route('modal-comment') }}"
                           data-app-id="{{ $cv['application_id'][ $current_app_index ] }}"
                           data-cv="{{ $cv['id'] }}"
                           data-type="normal">Comment</a>
                        <span class="text-muted">·</span>

                        @if($status != 'INTERVIEWED' && $status != 'HIRED')
                            <a data-toggle="modal"
                               data-target="#viewModal"
                               id="modalButton"
                               href="#viewModal"
                               data-title="Schedule an interview for"
                               data-view="{{ route('modal-interview') }}"
                               data-app-id="{{ $cv['application_id'][ $current_app_index ] }}"
                               data-cv="{{ $cv['id'] }}"
                               data-type="normal">Interview</a>
                            <span class="text-muted">·</span>

                        @endif

                        @if($status != 'WAITING')
                            <a data-toggle="modal"
                               data-target="#viewModal"
                               id="modalButton"
                               href="#viewModal"
                               data-title="Do you want to add to waiting list?"
                               data-view="{{ route('modal-add-to-waiting') }}"
                               data-app-id="{{ $cv['application_id'][ $current_app_index ] }}"
                               data-cv="{{ $cv['id'] }}"
                               data-type="normal">Add to waiting list</a>
                            <span class="text-muted">·</span>
                        @endif


                        @if(!empty($status) && $status != 'PENDING')
                            <a data-toggle="modal"
                               data-target="#viewModal"
                               id="modalButton"
                               href="#viewModal"
                               data-title="Do you want to return to pending?"
                               data-view="{{ route('modal-return-to-all') }}"
                               data-app-id="{{ $cv['application_id'][ $current_app_index ] }}"
                               data-cv="{{ $cv['id'] }}"
                               data-type="normal">Return to Pending</a>
                            <span class="text-muted">·</span>
                        @endif

                        <a data-toggle="modal"
                           class="text-danger"
                           data-target="#viewModal"
                           id="modalButton"
                           href="#viewModal"
                           data-title="Reject?"
                           data-view="{{ route('modal-reject') }}"
                           data-app-id="{{ $cv['application_id'][ $current_app_index ] }}"
                           data-cv="{{ $cv['id'] }}"
                           data-type="normal">
                            Reject
                        </a>

              <!-- <a href="#" data-toggle="modal" data-target="#reviewCv[data-user='{{ @$cv['id'] }}']" id="reviewBtn-{{ $cv['application_id'][ $current_app_index ] }}">Comment</a> -->

--}}
                        <span class="text-muted">&nbsp; &middot; &nbsp;</span>
                        @if((isset($permissions) && in_array('can-view-comments', $permissions)) && $check_both_permissions)

                        <a data-toggle="modal" data-target="#viewModal" id="modalButton" href="#viewModal"
                           data-title="Comment" data-view="{{ route('modal-comment') }}"
                           data-app-id="{{ $cv['application_id'][ $current_app_index ] }}" data-cv="{{ $cv['id'] }}"
                           data-type="normal">Comment</a>
                        @endif
                        @if((isset($permissions) && in_array('can-view-background-check', $permissions)) && $check_both_permissions)
                        <span class="pull-right hide">
                            <a class="text-muted" href="#">Background Check</a>
                            <span class="text-muted">·</span>
                        </span>
                        @endif
                    </div>


                </div>
            </div>
        </div>


        <!-- <div class="modal fade" tabindex="-1" id="reviewCv" data-user="{{ @$cv['id'] }}" role="dialog" aria-labelledby="reviewCv">
      <div class="modal-dialog">
        <div class="modal-content">

            <h3 class="text-center">Write a review</h3>


        <section class="no-pad" id='ContentAREA'>
                <div class="">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="content rounded">
                                <div id="message"></div>
                                <div class="form-group">
                                    <textarea class="form-control" id="add_folder" data-app-id="{{ $cv['application_id'][ $current_app_index ] }}"></textarea>


                                  </div>
                                  <div class="clearfix"></div>
                              <div class="pull-right">
                                  <a href="javascript://" id="writeReviewBtn" data-app-id="{{ $cv['application_id'][ $current_app_index ] }}" data-cv="{{ $cv['id'] }}" class="btn btn-success pull-right">Send</a>
                                  <div class="separator separator-small"></div>
                              </div>

                            </div>
                        </div>
                    </div>
                </div>
         </section>
        </div>
      </div>
    </div> -->
        <!--script>
    $(document).ready(function(){

        var id = "{{ $cv['id'] }}";
        var url = "{{ route('cart') }}"

        $("#cartAdd"+id).click(function(){
            // console.log(url)
            $.ajax
            ({
              type: "POST",
              url: url,
              data: ({ rnd : Math.random() * 100000, cv_id: id, type:'add', name:"{{ @$cv['first_name']. " " . @$cv['last_name'] }}", 'qty':1, 'price':500, "_token":"{{ csrf_token() }}"}),
              success: function(response){

                console.log(response);

              }
          });

        });


        $("#cartRemove"+id).click(function(){
            // console.log(url)
            $.ajax
            ({
              type: "POST",
              url: url,
              data: ({ rnd : Math.random() * 100000, cv_id: id, type:'remove', "_token":"{{ csrf_token() }}"}),
              success: function(response){

                console.log(response);

              }
          });

        });

        $("#clearCart").click(function(){
            // console.log(url)
            $.ajax
            ({
              type: "POST",
              url: url,
              data: ({ rnd : Math.random() * 100000, cv_id: id, type:'clear', "_token":"{{ csrf_token() }}"}),
              success: function(response){

                console.log(response);

              }
          });

        });


    })

</script-->
    @endforeach

    <script type="text/javascript">
        total_candidates = "{{ $application_statuses['ALL'] }}";

        $(document).ready(function () {
            if ($('#pagination').data("twbs-pagination")) {
                $('#pagination').twbsPagination('destroy');
            }
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })

            $('#pagination').twbsPagination({
                totalPages: "{{ ceil( $application_statuses['ALL'] / 20 ) }}",
                visiblePages: 5,
                initiateStartPageClick: false,
                startPage: parseInt("{{ ( intval( $start / 20 ) + 1 ) }}"),
                onPageClick: function (event, page) {
                    $('.select-all input[type=checkbox]').prop('checked', false);
                    // console.log(page,filters);
                    scrollTo('.job-progress-xs')
                    $('#page-content').text('Page ' + page);
                    $('.result-label').html('')
                    $('#pagination').hide();
                    $('.search-results').html('{!! preloader() !!}');
                    var url = "{{ (@$is_saved) ? url('cv/saved') : url('cv/search')   }}";
                    var pagination_url = "{{ route('job-candidates', $jobID) }}";

                    $.get(pagination_url, {
                        search_query: $('#search_query').val(),
                        start: (page - 1),
                        filter_query: filters,
                        status: status_filter,
                        exp_years: exp_years_range,
                        age: age_range,
                        video_application_score: video_application_score_range,
                        test_score: test_score_range
                    }, function (data) {
                        //console.log(response);
                        // var response = JSON.parse(data);
                        // console.log(data.search_results);
                        $('.result-label').html(data.showing)
                        $('.search-results').html(data.search_results);
                        $('#pagination').show();

                    });
                }
            });
        });
    </script>



@else
    <br>
    <div class="alert text-center alert-warning">
        <!-- <i class="fa fa-frown-o fa-3x"></i> -->
        <!-- <h3>There are no Applicants in this Section.</h3> -->
        <!-- <p class="p-empty" style=""> -->
        <p class="lead" style="">
            <i class="fa-2x fa fa-exclamation-circle"></i><br>
            @if($request->ajax() || isset($defaultView))
                @if((isset($application_statuses[$status]) && ($application_statuses[$status] > 0) || (isset($defaultView) && $defaultView != true)) )
                Applicants are currently indexing, this may take a few minutes
                @else
                    You have no applicants here.
                @endif
            @else
                No candidate matches your search, please <a id="clearAllFilters" href="javacript://"> &nbsp; <i
                            class="fa fa-times" class="text-danger"></i>Clear Filters</a>
        @endif
        <!-- <ul class="list-unstyled">
        <li class="">a) <a href="{{ route('job-promote',  $jobID) }}" class="">Promote this job</a></li>
                                <li class="">b) <a href="{{ route('job-promote',  $jobID) }}" class="">Share on social
                                        media</a></li>
                                <li class="">c) <a href="{{ route('job-promote',  $jobID) }}" class="">Get referrals for
                                        this job</a></li>
                                <li class="">d) <a class="">Upload applicants to this job</a></li>
                                </ul> -->
        </p>
    </div>

@endif
