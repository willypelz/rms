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

                                      @if( $user->id != Auth::user()->id && $owner->id == Auth::user()->id )
                                      <div class="col-xs-4 small"><br>
                                          <a class="text-muted" id="removeTeamMember" data-id="{{ $user->id }}" data-comp="{{ get_current_company()->id }}"><i class="fa fa-close"></i> Remove</a></span>
                                      </div>
                                      @endif
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
                                       <label for="">Name: </label>
                                       <input type="text"  name="name" value="" class="form-control">
                                       <small><em>The name of the team member</em></small>

                                       <input type="hidden" name="email_from" value="{{ get_current_company()->email }}" class="form-control">
                                       <input type="hidden" name="job_id" value="{{ $job->id }}" class="form-control">
                                       
                                       <label for="">Email: </label>
                                       
                                       <input type="text" name="email" id="email_to" placeholder="email addresses here" class="form-control">
                                       <small><em>The email address of the team member</em></small>
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
<script src="http://malsup.github.com/jquery.form.js"></script> 

    <script>
        $('#JobTeamAdd').ajaxForm({ 
                headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() },
                beforeSubmit:btn,
                success:showResponse
        }); 

                    function btn(){
                        $('#sendMail').attr('disabled','disabled').prepend('<div class="pull-right">' + '{!! preloader() !!}' + '</div>');
                    }

                    function showResponse(res){
                        console.log(res)
                        
                        $('#sendMail').removeAttr('disabled');
                        $('#AddTeamMember').removeClass('in');
                        $('#email_to').val('');

                        $.growl.notice({ message: "Email was sent successfully" });


                    }
    </script>

<div class="separator separator-small"><br></div>
@endsection