@extends('layout.template-user')

@section('content')

                    @include('job.board.jobBoard-header')
            
   
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

                            <ul class="list-group">
                                @foreach($users->users as $user)
                                <li class="list-group-item">
                                    <div class="col-xs-2"><img width="100%" alt="" src="img/avatar.jpg" class="img-circle"></div>
                                    <div class="col-xs-6">
                                        <h5> {{ $user->name }}</h5>
                                        <p>{{ $user->email }}</p>
                                    </div>
                                    <div class="col-xs-4 small"><br>
                                        <span class="pull-right"><a onclick="EditAction({{ $user->id }}); return false" class="" href=""><i class="fa fa-pencil"></i> &nbsp; Edit</a> &nbsp; · &nbsp;
                                            <a class="text-muted" href=""><i class="fa fa-close"></i> Remove</a></span>
                                    </div>
                                    <div class="clearfix"></div>
                                </li>
                                @endforeach
                              
                            </ul>

                        </div>

                        <script>
                          function EditAction(id){
                            console.log(id)

                            $('#Section2').html('Please wait..... loading');

                            var url = "{{ route('ajax-edit-team') }}"
                            console.log(url)
                             $.ajax
                              ({
                                  type: "POST",
                                  url: url,
                                  data: ({ rnd : Math.random() * 100000, user_id:id }),
                                  success: function(response){
                                       console.log(response)

                                       $('#Section2').html(response);
                                  }
                              });
                          }

                        </script>

                        <div class="col-xs-5" id="Section2">
                            <h5 class="no-margin">Add New Team member <span class="pull-right"><i class="fa fa-lg fa-user-plus"></i></span></h5><hr>

                            <a aria-controls="AddTeamMember" aria-expanded="false" class="btn btn-warning" data-toggle="collapse" data-target="#AddTeamMember" href="#AddTeamMember"><i class="fa fa-user-plus"></i> Add New Member</a>

                            <div id="AddTeamMember" class="collapse">
                               <!--div class="alert alert-success"><i class="fa fa-check fa-lg"></i>
                                    &nbsp; Your mail has been sent. Refresh page to send more.
                                </div-->
                                   <form action="">

                                   <div class="form-group">
                                       <label for="">From: </label>
                                       <input type="text" disabled="" value="{{ $users->email }}" class="form-control">
                                       
                                       <label for="">To: </label>
                                       <small>Separate your addresses by a comma</small>
                                       <input type="text" placeholder="email addresses here" class="form-control">
                                   </div>

                                   <label for="editor1">Body of Mail</label>
                                       <textarea rows="10" cols="30" id="editor1" name="" style="visibility: hidden; display: none;">                                       
                                       &lt;p&gt;Hello,&lt;br&gt;

                                       I would like you to join me on the recruitment team for {{ $job->title }}.
Just follow this link “http://seamlesshiring.com” and create a SeamlessHiring 
Account for yourself that will lead you to the recruitment process.

                                          
                                           &lt;/p&gt;
                                           &lt;p&gt;Regards,&lt;/p&gt;
                                           {{ $users->name }}.
                                       </textarea>
                                       <script>
                                          
                                           CKEDITOR.replace( 'editor1' );
                                       </script>
                                   </form>
                                   <br>
                                   <p>
                                       <!-- <a class="btn btn-line btn-sm" aria-controls="collapseWYSIWYG" aria-expanded="false" href="#collapseWYSIWYG" data-toggle="collapse" role="button"><i class="fa fa-times"></i> &nbsp; Cancel</a> -->
                            <a aria-controls="AddTeamMember" aria-expanded="false" class="btn btn-line btn-sm" data-toggle="collapse" data-target="#AddTeamMember" href="#AddTeamMember"><i class="fa fa-user-plus"></i> Cancel</a>

                                       <a class="btn btn-success btn-sm pull-right" aria-controls="collapseWYSIWYG" aria-expanded="false" href="#collapseWYSIWYG" data-toggle="collapse" role="button">Send Mail &nbsp; <i class="fa fa-send"></i></a>
                                   </p>
                               </div>
                        </div>
                                
                        </div>

                    </div>
                        </div>

                    </div>
                    <!--/tab-content-->

                </div>
            </div>
        </div>
    </section>

<div class="separator separator-small"><br></div>
@endsection