@extends('layout.template-user')

@section('content')

    @include('job.board.jobBoard-header')
    @php
        $user_role = getCurrentLoggedInUserRole();
        $admin_roles = getRoleArrayName($job->id, auth()->user());
    @endphp

    @if($job['status'] != 'DELETED')
        <div class="row">

            <div class="col-sm-12">
                <div class="page no-bod-rad">
                    <div class="row">

                        @include('job.board.job-board-tabs')

                        <div class="tab-content">


                            <div class="row">
                                <p> Manage your team members for this job here. </p>
                                <!-- applicant -->
                                <div class="col-xs-7">
                                    <h5 class="no-margin"> Team members </h5>
                                    <hr>
                                    <hr>
                                    @php
                                        $my_array = []
                                    @endphp
                                    @if( count( @$job->users ) > 0 )
                                        <ul class="list-group">

                                            @foreach($job->users as $user)
                                                <li style="display: flex; align-items: start; margin: 20px 10px">

                                                    <img alt="" src="{{ default_picture( $user, 'user' ) }}"
                                                         class="img-circle" style="width: 50px;height: 50px;">

                                                    <div style="margin-left: 20px;">
                                                        <h5 style="color: #0E2231; margin-bottom: 5px;margin-top: 0px;"> {{ $user->name }}</h5>
                                                        <p>{{ $user->email }}</p>
                                                        <h6 class="text-info">{{$job->users()->where('user_id', $user->id)->first() ? $job->users()->where('user_id', $user->id)->first()->pivot->role_name : ''}} </h6>
                                                        <ul class="list-unstyled">
                                                            @php
                                                                $all_roles = \App\Models\Role::get();
                                                                $user_roles = getRoleArrayName($job->id, $user);
                                                            @endphp
                                                            @foreach($all_roles as $role)
                                                                <li>
                                                                    <input @if(auth()->user()->is_super_admin == 0) disabled
                                                                           @endif class="role-{!! $user->id !!}-{!! $role->id !!}"
                                                                           onclick="submitRoles('{{$user->id}}', '{{$role->id}}')"
                                                                           type="checkbox" data-id="{{$role->id}}"
                                                                           @if(in_array($role->name, $user_roles)) checked @endif>
                                                                    {{$role->display_name}}
                                                                </li>
                                                                <a data-toggle="modal"
                                                                   data-target="#viewModal"
                                                                   id="modalButton"
                                                                   data-id="{{$user->id}}"
                                                                   class="modalButton-{!! $user->id !!}-{!! $role->id !!}"
                                                                   href="#viewModal"
                                                                   data-title="Select Workflow steps"
                                                                   data-view="{{ route('workflow-select', [$job->id, $user->id])}}"
                                                                   data-type="normal">
                                                                    </a>
                                                            @endforeach
                                                        </ul>
                                                        {{--<button class="btn btn-primary" style="margin-top: 10px;" onclick="submitRoles('{{$user->id}}', '{{$role->id}}')">--}}
                                                        {{--Update Permissions--}}
                                                        {{--</button>--}}

                                                    </div>

                                                    @if( $user->id != Auth::user()->id && in_array('admin', $admin_roles) )
                                                        <div class="col-xs-4 small"><br>
                                                            <a data-toggle="modal"
                                                               data-target="#viewModal"
                                                               id="modalButton"
                                                               href="#viewModal"
                                                               data-id="{{$user->id}}"
                                                               data-title="Job Team"
                                                               data-view="{{ route('remove-job-team-member',[
                                                   'ref' => $user->id,
                                                   'comp' => get_current_company()->id,
                                                   'job' => $job['id']
                                                   ]) }}"
                                                               data-type="normal"><i class="fa fa-close"></i>
                                                                Remove</a></a>
                                                        </div>
                                                    @endif
                                                    <div class="clearfix"></div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    <hr>

                                    <br><br>
                                    <h5 class="no-margin"> <!-- <i class="fa fa-lg fa-users"></i> --> Invites</h5>
                                    <hr>
                                    @if( count( @$job_team_invites->where('job_id', $job->id) ) > 0 )
                                        <ul class="list-group">

                                            @foreach($job_team_invites->where('job_id', $job->id) as $job_team_invite)
                                                <li class="list-group-item">
                                                    <div class="col-xs-2"><img width="100%" alt=""
                                                                               src="{{ isset($user) ? default_picture( @$user, 'user' ) : null }}"
                                                                               class="img-circle"></div>
                                                    <div class="col-xs-6">
                                                        <h5> {{ $job_team_invite->name }}</h5>
                                                        <p>{{ $job_team_invite->email }}</p>
                                                    </div>


                                                    <div class="col-xs-4 small"><br>
                                                        @if($job_team_invite->is_accepted)
                                                            <i class="fa fa-check"></i> Accepted</span>
                                                        @elseif($job_team_invite->is_declined)
                                                            <i class="fa fa-times"></i> Declined</span>
                                                        @else
                                                            <i class="fa fa-hourglass"></i> Pending</span>

                                                             <a  class="btn btn-default btn-small" href="{{ route('resend-job-team-invite', $job_team_invite->id) }}">Resend Invite</a>
                                                        @endif
                                                    </div>



                                                    <div class="clearfix"></div>
                                                </li>
                                            @endforeach

                                        </ul>
                                    @endif

                                </div>

                                <div class="col-xs-5" id="Section2">
                                    <h5 class="no-margin">Add New Team member <span class="pull-right"><i
                                                    class="fa fa-lg fa-user-plus"></i></span></h5>
                                    <hr>
                                    
                                    @if(Auth::user()->is_super_admin || $user->can('can-add-job-team-members'))
                                    <a aria-controls="AddTeamMember" aria-expanded="false" class="btn btn-warning"
                                       data-toggle="collapse" data-target="#AddTeamMember" href="#AddTeamMember"><i
                                                class="fa fa-user-plus"></i> Add New Member</a>
                                    @endif


                                    <div id="AddTeamMember" class="collapse">
                                        <!--div class="alert alert-success"><i class="fa fa-check fa-lg"></i>
                                             &nbsp; Your mail has been sent. Refresh page to send more.
                                         </div-->
                                        <br/><br/>
                                        @if(!env('RMS_STAND_ALONE'))
                                            <form action="{{ route('job-team-add') }}" method="post" id="JobTeamAdd">
                                                {!! csrf_field() !!}
                                                <div class="form-group">
                                                    <label for="">Internal</label>
                                                    <input type="radio" name="internal" value="internal" id="internal">
                                                    <label for="">External</label>
                                                    <input type="radio" name="external" value="external" id="external">
                                                </div>

                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <div id="hiddenForm">
                                                            <div id="external_div">
                                                                <label for="">Name: </label>
                                                                <input type="text" id="name" name="name" value=""
                                                                       class="form-control">
                                                                <small><em>The name of the team member</em></small>
                                                                <br><br>
                                                                <input type="hidden" name="email_from"
                                                                       value="{{ get_current_company()->email }}"
                                                                       class="form-control">
                                                                <input type="hidden" name="job_id"
                                                                       value="{{ $job->id }}"
                                                                       class="form-control">
                                                                <label for="">Email: </label>
                                                                <input type="text" name="email" id="email_to"
                                                                       placeholder="email addresses here"
                                                                       class="form-control">
                                                                <small><em>The email address of the team member</em>
                                                                </small>
                                                                <br><br>
                                                            </div>
                                                            <div id="internal_div">
                                                                <label for="">Select Employee from {{env('STAFFSTRENGTH_NAME') ?? 'HRMS'}}</label>
                                                                <select type="text" class="form-control" name=""
                                                                        id="employeeSelect">
                                                                    <option value="{{null}}">--Select Employee--
                                                                    </option>
                                                                </select>

                                                            </div>

                                                        </div>
                                                        <div class="common-fields">
                                                            <div class="for-group">
                                                                <label for="">Role Name</label>
                                                                <input name="role_name" type="text"
                                                                       class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="role">Permissions</label>
                                                                <select class="select2 form-control" multiple
                                                                        name="role[]"
                                                                        id="role" class="form-control">
                                                                    @foreach($roles as $role)
                                                                        <option value="{{ $role->id }}">{{ ucwords($role->display_name) }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group" style="display:none" id="stepDiv">
                                                                <label for="role">Steps on this service</label>
                                                                <select class="select2 form-control" multiple
                                                                        name="steps[]" id="step" class="form-control">
                                                                    @foreach($job->workflow->workflowSteps as $step)
                                                                        @if($step->type == 'interview')
                                                                            <option value="{{ $step->id }}">{{ ucwords($step->name) }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <label for="">Access: </label>
                                                            <select name="access" id="access" class="form-control"
                                                                    required>
                                                                <option value="job" hidden>"{{ $job->title }}"</option>
                                                            </select>
                                                            <label for="editor1">Invite Mail</label>
                                                            <textarea rows="10" cols="30" id="editor1" name="body_mail"
                                                                      style="visibility: hidden; display: none;">
                                       &lt;p&gt;Hello,&lt;br&gt;


                                        Regarding the ongoing recruitment process at {{ ucwords( get_current_company()->name ) }} company for the job of {{ ucwords( $job->title ) }}, this is to inform you that you have been invited to join the recruitment team.
                                        You would be required to collaborate with your team in selecting the candidate(s) who best suit(s) the job.


                                       </textarea>
                                                            <script>

                                                                CKEDITOR.replace('editor1');
                                                            </script>

                                                            <br>
                                                            <p>
                                                                <!-- <a class="btn btn-line btn-sm" aria-controls="collapseWYSIWYG" aria-expanded="false" href="#collapseWYSIWYG" data-toggle="collapse" role="button"><i class="fa fa-times"></i> &nbsp; Cancel</a> -->
                                                                <a aria-controls="AddTeamMember" aria-expanded="false"
                                                                   class="btn btn-line btn-sm" data-toggle="collapse"
                                                                   data-target="#AddTeamMember" href="#AddTeamMember">
                                                                    Cancel</a>

                                                                <!-- <a class="btn btn-success btn-sm pull-right" aria-controls="collapseWYSIWYG" aria-expanded="false" href="#collapseWYSIWYG" data-toggle="collapse" role="button">Send Mail &nbsp; <i class="fa fa-send"></i></a> -->
                                                                <input class="btn btn-success btn-sm pull-right"
                                                                       id="sendMail"
                                                                       type="submit" value="Send mail">
                                                                <!-- <button class="btn btn-success btn-sm pull-right" aria-controls="collapseWYSIWYG" aria-expanded="false" href="#collapseWYSIWYG" data-toggle="collapse" role="button" type="submit">Send Mail &nbsp;  <i class="fa fa-send"></i></button> -->
                                                            </p>
                                                        </div>

                                                    </div>
                                                </div>

                                            </form>
                                        @else
                                            <form action="{{ route('job-team-add') }}" method="post"
                                                  id="JobTeamAdd-noEnv">
                                                {!! csrf_field() !!}

                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <div id="">
                                                            <div id="">
                                                                <label for="">Name: </label>
                                                                <input type="text" id="name" name="name" value=""
                                                                       class="form-control">
                                                                <small><em>The name of the team member</em></small>
                                                                <br><br>
                                                                <input type="hidden" name="email_from"
                                                                       value="{{ get_current_company()->email }}"
                                                                       class="form-control">
                                                                <input type="hidden" name="job_id"
                                                                       value="{{ $job->id }}"
                                                                       class="form-control">
                                                                <label for="">Email: </label>
                                                                <input type="text" name="email" id="email_to"
                                                                       placeholder="email addresses here"
                                                                       class="form-control">
                                                                <small><em>The email address of the team member</em>
                                                                </small>
                                                                <br><br>
                                                            </div>

                                                        </div>
                                                        <div class="">
                                                            <div class="for-group">
                                                                <label for="">Role Name</label>
                                                                <input name="role_name" type="text"
                                                                       class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="role">Permissions</label>
                                                                <select class="select2 form-control" multiple
                                                                        name="role[]"
                                                                        id="role" class="form-control">
                                                                    @foreach($roles as $role)
                                                                        <option value="{{ $role->id }}">{{ ucwords($role->display_name) }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group" style="display:none" id="stepDiv">
                                                                <label for="role">Steps on this service</label>
                                                                <select class="select2 form-control" multiple
                                                                        name="steps[]" id="step" class="form-control">
                                                                    @foreach($job->workflow->workflowSteps as $step)
                                                                        @if($step->type == 'interview')
                                                                            <option value="{{ $step->id }}">{{ ucwords($step->name) }}</option>
                                                                        @endif
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <label for="">Access: </label>
                                                            <select name="access" id="access" class="form-control"
                                                                    required>
                                                                <option value="job" hidden>"{{ $job->title }}"</option>
                                                            </select>
                                                            <label for="editor1">Invite Mail</label>
                                                            <textarea rows="10" cols="30" id="editor1" name="body_mail"
                                                                      style="visibility: hidden; display: none;">
                                       &lt;p&gt;Hello,&lt;br&gt;


                                        Regarding the ongoing recruitment process at {{ ucwords( get_current_company()->name ) }} company for the job of {{ ucwords( $job->title ) }}, this is to inform you that you have been invited to join the recruitment team.
                                        You would be required to collaborate with your team in selecting the candidate(s) who best suit(s) the job.


                                       </textarea>
                                                            <script>

                                                                CKEDITOR.replace('editor1');
                                                            </script>

                                                            <br>
                                                            <p>
                                                                <!-- <a class="btn btn-line btn-sm" aria-controls="collapseWYSIWYG" aria-expanded="false" href="#collapseWYSIWYG" data-toggle="collapse" role="button"><i class="fa fa-times"></i> &nbsp; Cancel</a> -->
                                                                <a aria-controls="AddTeamMember" aria-expanded="false"
                                                                   class="btn btn-line btn-sm" data-toggle="collapse"
                                                                   data-target="#AddTeamMember" href="#AddTeamMember">
                                                                    Cancel</a>

                                                                <!-- <a class="btn btn-success btn-sm pull-right" aria-controls="collapseWYSIWYG" aria-expanded="false" href="#collapseWYSIWYG" data-toggle="collapse" role="button">Send Mail &nbsp; <i class="fa fa-send"></i></a> -->
                                                                <input class="btn btn-success btn-sm pull-right"
                                                                       id="sendMail"
                                                                       type="submit" value="Send mail">
                                                                <!-- <button class="btn btn-success btn-sm pull-right" aria-controls="collapseWYSIWYG" aria-expanded="false" href="#collapseWYSIWYG" data-toggle="collapse" role="button" type="submit">Send Mail &nbsp;  <i class="fa fa-send"></i></button> -->
                                                            </p>
                                                        </div>

                                                    </div>
                                                </div>

                                            </form>
                                        @endif
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
                <!--/tab-content-->

            </div>
        </div>
        @else
        @include('job.board.includes.job-deleted')
        @endif
        </div>
        </section>
        <script src="{{ secure_asset('js/jquery.form.js') }}"></script>

        <script>
            $(document).ready(function () {
                var employees = [];
                $('#JobTeamAdd').ajaxForm({
                    headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
                    beforeSubmit: btn,
                    success: showResponse
                });

                $('#JobTeamAdd-noEnv').ajaxForm({
                    headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
                    beforeSubmit: btn,
                    success: showResponse
                });
                $('#hiddenForm').hide();
                $('#external_div').hide();
                $('#internal_div').hide();
                $('.common-fields').hide();

                $('#internal').change(function () {
                    $('#hiddenForm').show();

                    if ($('#internal').is(":checked")) {
                        $('#external').prop('checked', false);
                        $('.common-fields').show();
                        $('#internal_div').show();
                        $('#external_div').hide();
                        $("#employeeSelect").select2();
                        $.ajax({
                            url: "{{ route('fetch-employees') }}",
                            type: "get",
                            success: function (response) {
                                employees = response;
                                $("#employeeSelect").append(response.map(function (item) {
                                    var name = item.first_name + ' ' + item.last_name;
                                    return "<option value=" + item.id + ">" + name + "</option>";
                                })).trigger("change");
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                $.growl.error({message: 'Could not fetch employees please try again'});
                            }
                        });
                    } else {
                        $('#external').prop('checked', true);
                        $('#internal_div').hide();
                        $('#external_div').hide();
                    }
                });

                $('#external').change(function () {
                    $('#hiddenForm').show();
                    $('.common-fields').show();

                    if ($('#external').is(":checked")) {
                        $('#internal').prop('checked', false);
                        $('#external_div').show();
                        $('#internal_div').hide();

                    } else {
                        $('#internal').prop('checked', true);
                        $('#external_div').hide();
                        $('#internal_div').show();

                    }
                });

                $('#employeeSelect').on('change', function () {
                    employee = employees.find(employee => employee.id == $('#employeeSelect').val());
                    $('#name').val(employee.first_name + ' ' + employee.last_name);
                    $('#email_to').val(employee.email);
                });
                /*$('body #removeTeamMember').on('click', function(){
                    $comp = $(this).data('comp');
                    $id = $(this).data('id');
                    $job = $(this).data('job');
                    $(this).closest('.list-group-item').remove();

                    $.post("{{ route('remove-job-team-member') }}",{ ref: $id, comp: $comp, job: $job }, function(response){

            });
        });*/


                function btn() {
                    $('#sendMail').attr('disabled', 'disabled').prepend('<div class="pull-right">' + '{!! preloader() !!}' + '</div>');
                }

                function showResponse(res) {
                    $('#sendMail').removeAttr('disabled');
                    $('#AddTeamMember').removeClass('in');
                    $('#email_to').val('');
                    $('#name').val('');
                    $('#role').val(null);

                    if (res.status == true) {
                        $.growl.notice({message: res.message});
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    } else {
                        if (typeof (res.message) === 'object') {
                            $.each(res.message, function (index, value) {
                                $.growl.error({message: value});
                            });
                        } else {
                            $.growl.error({message: res.message});
                        }

                    }

                }

                $('#role').change(function () {

                    var roleIds = $('#role option:selected').toArray().map(item => item.value);
                    var isInterviewIdInRoleIdsArray = roleIds.includes("{{$interviewer_id}}");

                    if (isInterviewIdInRoleIdsArray == true) {
                        $('#stepDiv').show();
                    } else {
                        $('#stepDiv').hide();
                    }

                });

                function btn() {
                    $('#sendMail').attr('disabled', 'disabled').prepend('<div class="pull-right">' + '{!! preloader() !!}' + '</div>');
                }

                function showResponse(res) {
                    $('#sendMail').removeAttr('disabled');
                    $('#AddTeamMember').removeClass('in');
                    $('#email_to').val('');
                    $('#name').val('');
                    $('#role').val(null);

                    if (res.status == true) {
                        $.growl.notice({message: res.message});
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    } else {
                        if (typeof (res.message) === 'object') {
                            $.each(res.message, function (index, value) {
                                $.growl.error({message: value});
                            });
                        } else {
                            $.growl.error({message: res.message});
                        }

                    }

                }

            });

            function submitRoles(user_id, role_id) {
                if(role_id == "{{$interviewer_id}}" && $('.role-' + user_id + '-' + role_id).is(':checked')) {
                    $('.modalButton-'+user_id+'-'+role_id).click();
                } else {
                    var checked = $('.role-' + user_id + '-' + role_id).is(':checked') ? 1 : 0,
                        job_id = {!! $job->id !!};
                    $.ajax({
                        url: "{{ route('persis-role') }}",
                        type: "post",
                        data: {user_id, role_id, job_id, checked},
                        success: function (response) {
                            $.growl.notice({message: 'updated successfully'});

                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            $.growl.error({message: 'something went wrong.. please try again'});
                        }
                    });
                }

            }

        </script>
        <div class="separator separator-small"><br></div>
@endsection
