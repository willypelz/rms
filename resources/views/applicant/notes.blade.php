@extends('layout.template-user')

@section('content')
    
    @include('applicant.includes.job-title-bar')
    
    <section class="no-pad applicant">
        <div class="container">
        
        @include('applicant.includes.pagination')

            <div class="row">
            <div class="col-xs-4">            
                
              @include('applicant.includes.badge') 

            </div>


                <div class="col-xs-8">
                    
                
              @include('applicant.includes.nav') 

                    <div class="tab-content" id="">

                        <div class="row">
                          <div class="col-xs-12">
                            <a href="{{ route('applicant-activities',  $appl->id) }}" class="btn"><i class="fa fa-bars"></i> &nbsp; Feeds</a>
                            <!-- <a href="background-check" class="btn"><i class="fa fa-commenting-o"></i> &nbsp; Comments</a> -->
                            <a href="{{ route('applicant-notes',  $appl->id) }}" class="btn btn-line"><i class="fa fa-file-text-o"></i> &nbsp; Interview Notes</a>

                            <hr>
                          </div>
                        </div>


                        <div class="row">

                        <div class="col-xs-12">
                          <h6 class="no-margin">
                              <span class="text-brandon text-uppercase">
                              Notes on Applicant 
                              </span> 
                              <!-- <span class="pull-right"><a href=""><i class="fa fa-cog"></i>Notification Settings</a></span> -->
                          </h6>
                          <div class="clearfix"><hr></div>
                              

                              <ul class="list-group list-notify">
                          
                                <li class="list-group-item" role="candidate-comments">
                          
                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-warning"></i>
                                    <i class="fa fa-commenting-o fa-stack-1x fa-inverse"></i>
                                  </span>
                          
                                  @if( count($interview_notes) > 0 )
                                    @foreach( $interview_notes as $interview_note )
                                        <div class="commenter">
                                          <p>
                                            <a>{{ $interview_note->user->name }}</a> made a note on applicant
                                                <small class="text-muted pull-right">[{{ date('D, j-n-Y, h:i A', strtotime( $interview_note->interview_date ))  }}]</small>
                                          </p>
                                          <blockquote class="h5">
                                            <span role="comment-body text-muted">
                                                <strong>General Comments: </strong>{{ $interview_note->general_comments }} <br><br>
                                                <strong>Recommendations: </strong>{{ $interview_note->recommendation }}
                                                
                                            </span>
                                          </blockquote>
                                        </div>
                                    @endforeach
                                  @else
                                    
                                    <div>
                                      <span>This candidate has not been interviewed</span>
                                    </div>
                                    
                                  @endif
                                </li>
                          
                                
                          
                              </ul>
                              
                              

                          
                              <div class="clearfix"></div>
                        </div>
                        </div>
                    <!--/tab-content-->                       

                    </div>
                    <!--/tab-content-->

                </div>

            </div>

        @include('applicant.includes.pagination')

        </div>
    </section>

<div class="separator separator-small"></div>



@endsection