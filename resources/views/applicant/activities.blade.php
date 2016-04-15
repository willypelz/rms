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
                            <a href="{{ route('applicant-activities',  $appl->id) }}" class="btn btn-line"><i class="fa fa-bars"></i> &nbsp; Feeds</a>
                            <!-- <a href="background-check" class="btn"><i class="fa fa-commenting-o"></i> &nbsp; Comments</a> -->
                            <a href="{{ route('applicant-notes',  $appl->id) }}" class="btn"><i class="fa fa-file-text-o"></i> &nbsp; Interview Notes</a>
                            <a href="background-check" class="btn btn-success pull-right"><i class="fa fa-file-text-o"></i> &nbsp; Add a Comment</a>
                            <hr>
                          </div>
                        </div>


                        <div class="row">

                        <div class="col-xs-12">
                          <h6 class="no-margin">
                              <span class="text-brandon text-uppercase">
                              Applicants Activities 
                              </span> 
                              <span class="pull-right"><a href=""><i class="fa fa-cog"></i>Notification Settings</a></span>
                          </h6>
                          <div class="clearfix"><hr></div>
                          
                              <ul class="list-group list-notify">
                                <li class="list-group-item" role="candidate-application">
                          
                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-info"></i>
                                    <i class="fa fa-edit fa-stack-1x fa-inverse"></i>
                                  </span>
                          
                                  <h5 class="no-margin text-info">Application</h5>
                                  <p>
                                      <small class="text-muted pull-right">[Wed 12:23pm]</small> 
                                      Applied on Wednesday 12:23pm from hotnaijajobs.com
                                  </p>
                                </li>
                          
                                <li class="list-group-item" role="messaging">
                          
                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-success"></i>
                                    <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                                  </span>
                          
                                  <h5 class="no-margin text-success">Message</h5>
                                  <p>
                                      <small class="text-muted pull-right">[Wed 12:23pm]</small> Olwatosin Oriola reply <a href="jobs/list">your message. Go to Message</a>
                                  </p>
                                  <p>
                                      <small class="text-muted pull-right">[Wed 12:27pm]</small> Olwatosin Oriola reply <a href="jobs/list">your message. Go to Message</a>
                                  </p>
                                </li>
                          
                                <li class="list-group-item" role="candidate-comments">
                          
                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-warning"></i>
                                    <i class="fa fa-commenting-o fa-stack-1x fa-inverse"></i>
                                  </span>
                          
                                  <h5 class="no-margin text-warning">Comments</h5>
                                  <div class="commenter">
                                    <p>
                                      <a>Ernest Ojeh</a> made a comment on applicant
                                          <small class="text-muted pull-right">[Wed 12:23pm]</small>
                                    </p>
                                    <blockquote class="small">
                                      <i role="comment-body text-muted">
                                          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, tempora assumenda fugit alias ab tempore nemo voluptatum reiciendis tenetur beatae eum exercitationem recusandae delectus dicta, accusantium soluta qui accusamus maxime. <!-- <a href="jobs/applicants">Go to job board</a> -->
                                      </i>
                                    </blockquote>
                                  </div>

                                  <div class="commenter">
                                    <p>
                                      <a>Another Team member</a> made a comment on applicant
                                          <small class="text-muted pull-right">[Wed 12:23pm]</small>
                                    </p>
                                    <blockquote class="small">
                                      <i role="comment-body text-muted">
                                          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, tempora assumenda fugit alias ab tempore nemo voluptatum reiciendis tenetur beatae eum exercitationem recusandae delectus dicta, accusantium soluta qui accusamus maxime. <!-- <a href="jobs/applicants">Go to job board</a> -->
                                      </i>
                                    </blockquote>
                                  </div>
                                </li>
                          
                                <li class="list-group-item" role="warning-notifications">
                          
                                 <span class="fa-stack fa-lg i-notify">
                                    <i class="fa fa-circle fa-stack-2x text-danger"></i>
                                    <i class="fa fa-exclamation fa-stack-1x fa-inverse"></i>
                                  </span>
                          
                                  <h5 class="no-margin text-danger">Warnings</h5>
                                  <p>
                                      <small class="text-muted pull-right">[Wed 12:23pm]</small>
                                      You haveYou have not performed <a href=""> this important task</a>
                                  </p>
                                </li>
                          
                              </ul>

                            <a href="background-check" class="btn btn-success btn-sm pull-right"><i class="fa fa-commenting-o"></i> &nbsp; Add a Comment</a>
                          
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