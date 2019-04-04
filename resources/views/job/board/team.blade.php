@extends('layout.template-user')

@section('content')

                    @include('job.board.jobBoard-header')

            @if($job['status'] != 'DELETED')
            <div class="row">

                <div class="col-sm-12">
                    <div class="page no-bod-rad">
                        <div class="row">


                            @include('job.board.job-board-tabs')

                      <div class="tab-content">


                        <div class="row">
                          <p>Manage your team members for this job here.</p>
                        <!-- applicant -->
                        <div class="col-xs-7">
                            <h5 class="no-margin"> <!-- <i class="fa fa-lg fa-users"></i> --> Team members</h5><hr>

                            @if( count( @$company->users ) > 0 )
                              <ul class="list-group">

                                  @foreach($company->users as $user)
                                  <li class="list-group-item">
                                      <div class="col-xs-2"><img width="100%" alt="" src="{{ default_picture( $user, 'user' ) }}" class="img-circle"></div>
                                      <div class="col-xs-6">
                                          <h5> {{ $user->name }}</h5>
                                          <p>{{ $user->email }}</p>
                                      </div>

                                      @if( Auth::user()->id == $owner->id &&  $user->id != Auth::user()->id )
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
                                             data-type="normal"><i class="fa fa-close"></i> Remove</a></a>
                                      </div>
                                      @endif
                                      <div class="clearfix"></div>
                                  </li>
                                  @endforeach

                              </ul>
                            @endif

                            <br><br>
                            <h5 class="no-margin"> <!-- <i class="fa fa-lg fa-users"></i> --> Invites</h5><hr>
                            @if( count( @$job_team_invites ) > 0 )
                              <ul class="list-group">

                                  @foreach($job_team_invites as $job_team_invite)
                                  <li class="list-group-item">
                                      <div class="col-xs-2"><img width="100%" alt="" src="{{ default_picture( @$user, 'user' ) }}" class="img-circle"></div>
                                      <div class="col-xs-6">
                                          <h5> {{ $job_team_invite->name }}</h5>
                                          <p>{{ $job_team_invite->email }}</p>
                                      </div>


                                      <div class="col-xs-4 small"><br>
                                          <i class="fa fa-hourglass"></i> Pending</span>
                                      </div>

                                      <div class="clearfix"></div>
                                  </li>
                                  @endforeach

                              </ul>
                            @endif


                        </div>


                        <div class="col-xs-5" id="Section2">
                            <h5 class="no-margin">Add New Team member <span class="pull-right"><i class="fa fa-lg fa-user-plus"></i></span></h5><hr>

                            <a aria-controls="AddTeamMember" aria-expanded="false" class="btn btn-warning" data-toggle="collapse" data-target="#AddTeamMember" href="#AddTeamMember"><i class="fa fa-user-plus"></i> Add New Member</a>

                            <div id="AddTeamMember" class="collapse">
                               <!--div class="alert alert-success"><i class="fa fa-check fa-lg"></i>
                                    &nbsp; Your mail has been sent. Refresh page to send more.
                                </div-->
                                <br/><br/>
                                   <form action="{{ route('job-team-add') }}" method="post" id="JobTeamAdd">
                                    {!! csrf_field() !!}
                                       <div class="form-group">
                                           <label for="" >Internal</label>
                                           <input type="radio" name="internal" value="internal" id="internal">
                                           <label for="">External</label>
                                           <input type="radio" name="external" value="external" id="external">
                                       </div>

                                       <div class="form-group">
                                           <div id="hiddenForm">
                                               <div id="external_div">
                                                   <label for="">Name: </label>
                                                   <input type="text" id="name" name="name" value="" class="form-control" >
                                                   <small><em>The name of the team member</em></small><br><br>
                                                   <input type="hidden" name="email_from" value="{{ get_current_company()->email }}" class="form-control">
                                                   <input type="hidden" name="job_id" value="{{ $job->id }}" class="form-control">
                                                   <label for="">Email: </label>
                                                   <input type="text" name="email" id="email_to" placeholder="email addresses here" class="form-control" >
                                                   <small><em>The email address of the team member</em></small><br><br>
                                               </div>
                                               <div id="internal_div">
                                                   <label for="">Select Employee from HCHub</label>
                                                   <select type="text" class="form-control" name="" id="employeeSelect">
                                                       <option value="{{null}}">--Select Employee--</option>
                                                   </select>

                                               </div>

                                           </div>


                                           <label for="role">Role</label>
                                           <select name="role" id="role" class="form-control">
                                               <option value="{{null}}"> --Select One-- </option>
                                               @foreach($roles as $role)
                                                   <option value="{{$role->id}}">{{getAdminName($role->name)}}</option>
                                               @endforeach
                                           </select>


                                       <label for="">Access: </label>

                                       <select name="access" id="access" class="form-control" required>
                                         <option value="job">"{{ $job->title }}" only</option>
                                         <option value="company">All Jobs</option>
                                       </select>

                                   </div>

                                   <label for="editor1">Invite Mail</label>
                                       <textarea rows="10" cols="30" id="editor1" name="body_mail" style="visibility: hidden; display: none;">
                                       &lt;p&gt;Hello,&lt;br&gt;


Regarding the ongoing recruitment process at {{ ucwords( get_current_company()->name ) }} company for the job of {{ ucwords( $job->title ) }}, this is to inform you that you have been invited to join the recruitment team.
You would be required to collaborate with your team in selecting the candidate(s) who best suit(s) the job.


                                       </textarea>
                                       <script>

                                           CKEDITOR.replace( 'editor1' );
                                       </script>

                                   <br>
                                   <p>
                                       <!-- <a class="btn btn-line btn-sm" aria-controls="collapseWYSIWYG" aria-expanded="false" href="#collapseWYSIWYG" data-toggle="collapse" role="button"><i class="fa fa-times"></i> &nbsp; Cancel</a> -->
                            <a aria-controls="AddTeamMember" aria-expanded="false" class="btn btn-line btn-sm" data-toggle="collapse" data-target="#AddTeamMember" href="#AddTeamMember"> Cancel</a>

                                       <!-- <a class="btn btn-success btn-sm pull-right" aria-controls="collapseWYSIWYG" aria-expanded="false" href="#collapseWYSIWYG" data-toggle="collapse" role="button">Send Mail &nbsp; <i class="fa fa-send"></i></a> -->
                                       <input class="btn btn-success btn-sm pull-right" id="sendMail" type="submit" value="Send mail">
                                       <!-- <button class="btn btn-success btn-sm pull-right" aria-controls="collapseWYSIWYG" aria-expanded="false" href="#collapseWYSIWYG" data-toggle="collapse" role="button" type="submit">Send Mail &nbsp;  <i class="fa fa-send"></i></button> -->
                                   </p>

                                   </form>

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
    $(document).ready( function(){
        var employees = [];
        $('#JobTeamAdd').ajaxForm({
                headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() },
                beforeSubmit:btn,
                success:showResponse
        });
        $('#hiddenForm').hide();
        $('#external_div').hide();
        $('#internal_div').hide();

        $('#internal').change(function () {
            $('#hiddenForm').show();

            if($('#internal').is(":checked")) {
                $('#external').prop('checked', false);
                $('#internal_div').show();
                $('#external_div').hide();
                $("#employeeSelect").select2();
                $.ajax({
                    url: "{{ route('fetch-employees') }}",
                    type: "get",
                    success: function (response) {
                        employees = response;
                        $("#employeeSelect").append(response.map( function(item){
                            var name = item.first_name + ' ' + item.last_name;
                            return "<option value="+ item.id +">" + name  + "</option>";
                        })).trigger("change");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
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

            if($('#external').is(":checked")) {
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
    });


                    function btn(){
                        $('#sendMail').attr('disabled','disabled').prepend('<div class="pull-right">' + '{!! preloader() !!}' + '</div>');
                    }

                    function showResponse(res){
                        $('#sendMail').removeAttr('disabled');
                        $('#AddTeamMember').removeClass('in');
                        $('#email_to').val('');
                        $('#name').val('');
                        $('#role').val(null);

                        if( res.status == true )
                        {
                          $.growl.notice({ message: res.message });
                        }
                        else
                        {
                            if(typeof (res.message) === 'object') {
                                $.each(res.message, function( index, value ) {
                                    $.growl.error({message: value});
                                });
                            } else {
                                $.growl.error({message: res.message});
                            }

                        }

                    }
    </script>

<div class="separator separator-small"><br></div>
@endsection
