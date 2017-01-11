@extends('layout.template-default')
@section('content')
<div class="separator separator-small"></div>
<section class="no-pad">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <!-- <div class="btn-group btn-group-justified btn-progress" role="group" aria-label="...">
          
          <div class="btn-group" role="group">
            <button type="button" class="btn active text-capitalize"><i class="fa fa-send"></i>
            &nbsp; <span class="hidden-xs">Job Promotion</span></button>
          </div>
          <div class="btn-group" role="group">
            <a href="addCan-job.php" type="button" class="btn btn-line text-capitalize text-muted"><i class="fa fa-plus"></i>
              &nbsp; <span class="hidden-xs">Add candidates</span></a>
            </div>
          </div>
          <div> -->
            
            <div class="page">
              <div class="row" >
                <div class="col-xs-12">
                  <h2 class="text-center"><i class="fa fa-check-circle fa-2x text-success"></i></h2>
                  <p class="lead text-center"><a href="">{{ ucfirst( $job->title ) }} </a><br> This Job has been succesfully created.</p><hr>
                  <div class="col-xs-8 col-xs-offset-2">
                  <h5 class="text-center">Below are free job boards where your job will be posted. You can copy the link of your job or share them from here. You can find this section on the <a href="{{ url('dashboard') }}">job dashboard here.</a></h5><br></div>
                  <!-- <div class="well hidden">
                    <ul class="list-inline">
                      <li><img src="{{ url('/') }}/img/linkedin-logo.png" alt="" width="100px" align="right"> &nbsp; </li>
                      <li><img src="{{ url('/') }}/img/logo-full.png" alt="" width="100px" align="right"> &nbsp; </li>
                      <li><img src="{{ url('/') }}/img/efritin-logo.png" alt="" width="100px" align="right"> &nbsp; </li>
                      <li><img src="{{ url('/') }}/img/job_informant.PNG" alt="" width="100px" align="right"> &nbsp; </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div> -->
                  <div>
                    <!-- <h4 class="text-center"> Share this job!  <br> -->
                    <!-- <small>Because we want you to find the best talents.</small> -->
                    <!-- </h4> -->
                    <!-- <hr style="width: 45%"> -->
                    <div class="col-xs-12 hidden">
                      <div class="well">
                        <div class="row">
                          <div class="col-xs-7 small">
                            <h5>Job Url</h5>
                            <a href="{{ url(get_current_company()->slug.'/job/'.$job->id.'/'.str_slug($job->title)) }}">{{ url(get_current_company()->slug.'/job/'.$job->id.'/'.str_slug($job->title)) }}</a>
                          </div>
                          <div class="col-xs-5">
                            <h5>Social Media sharing</h5>
                            
                            <ul class="list-inline">
                              <li>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url(get_current_company()->slug.'/job/'.$job->id.'/'.str_slug($job->title)) }}" class="" target="_blank" >
                                  <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x text-" style="color:#3b5998"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                  </span>
                                </a>
                              </li>
                              
                              <li>
                                <a href="https://twitter.com/home?status={{ url(get_current_company()->slug.'/job/'.$job->id.'/'.str_slug($job->title)) }}" class="" target="_blank" >
                                  <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x text-" style="color:#0084b4"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                  </span>
                                </a>
                              </li>
                              
                              <li>
                                <a href="https://plus.google.com/share?url={{ url(get_current_company()->slug.'/job/'.$job->id.'/'.str_slug($job->title)) }}" class="" target="_blank" >
                                  <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x text-danger" style="color:#007bb6"></i>
                                    <i class="fa fa-google fa-stack-1x fa-inverse"></i>
                                  </span>
                                </a>
                              </li>
                              <li>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ url(get_current_company()->slug.'/job/'.$job->id.'/'.str_slug($job->title)) }}" class="" target="_blank" >
                                  <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x text-" style="color:#007bb6"></i>
                                    <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
                                  </span>
                                </a>
                              </li>
                              <!-- https://www.linkedin.com/shareArticle?mini=true&url=&title=&summary=&source= -->
                            </ul>
                          </div>
                          <div class="clearfix"></div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-xs-7">
                        <!-- <h5 class="text-center">Below are free job boards where your job will be posted. You can copy the link of your job or share them from here. You can find this section on the <a href="{{ url('dashboard') }}">job dashboard here.</a></h5><br> -->
                        <div class="">
                          <div class="panel panel-default">
                            
                            <div class="panel-heading">
                              <h3 class="panel-title">Free Job Boards
                              <span class="pull-right text-warning"><i class="fa fa-check-circle"></i> {{ $approved_count }} approved &nbsp; &middot; &nbsp;<i class="fa fa-hourglass-half"></i> {{ $pending_count }} Pending</span>
                            </div>
                            <div class="panel-body" style="height: 520px; overflow: auto;">
                              
                              @foreach($subscribed_boards as $subscribed_board)
                              <?php
                              // $sub_key = array_search($b['id'], array_pluck( $subscribed_boards, 'id' ) );
                              if(@$subscribed_board['pivot']['url'] != null && @$subscribed_board['pivot']['url'] != '')
                              {
                              $status = 'approved';
                              }
                              else
                              {
                              $status = 'pending';
                              }
                              // $status = ( in_array($b['id'], $subscribed_boards) ) ? 'disabled checked' : '';
                              // $approved = ( in_array($b['id'], $subscribed_boards) ) ? 'disabled checked' : '';
                              ?>
                              
                              <div class="row job-board {{$status}}">
                                <div class="col-xs-3"><br>
                                  <img src="{{ $subscribed_board['img'] }}" alt="{{ $subscribed_board['name'] }} logo" width="90%" align="right">
                                </div>
                                <div class="col-xs-6">
                                  @if(@$subscribed_board['pivot']['url'] != null && @$subscribed_board['pivot']['url'] != '')
                                  <h5 title="Your Job is live on this website">{{ $subscribed_board['name'] }} <i class="fa fa-check-circle text-success"></i> </h5><input type="text" class="form-control" value="{{ $subscribed_board['pivot']['url'] }}" readonly>
                                  @else
                                  <h5>{{ $subscribed_board['name'] }} &nbsp;&nbsp;<i class="fa fa-hourglass-half text-muted"></i>pending approval</h5><input type="text" class="form-control" value="your url will appear here" disabled="">
                                  @endif
                                  <!-- <div class="clearfix"></div>
                                  <p class="small text-muted">&uarr; Link to job on insidify.com</p> -->
                                </div>
                                <div class="col-xs-3">
                                  <h5>Share this link</h5>
                                  <ul class="list-inline">
                                    <li class="no-pad no-margin">
                                      <a href="https://www.facebook.com/sharer/sharer.php?u={{ @$subscribed_board['pivot']['url'] }}" class="btn-disabled" target="_blank" >
                                        <span class="fa-stack fa-lg">
                                          <i class="fa fa-square fa-stack-2x text-"></i>
                                          <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                        </span>
                                      </a>
                                    </li>
                                    
                                    <li class="no-pad no-margin">
                                      <a href="https://twitter.com/home?status={{ @$subscribed_board['pivot']['url'] }}" class="btn-disabled" target="_blank" >
                                        <span class="fa-stack fa-lg">
                                          <i class="fa fa-square fa-stack-2x text-"></i>
                                          <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                        </span>
                                      </a>
                                    </li>
                                    
                                    <li class="no-pad no-margin">
                                      <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ @$subscribed_board['pivot']['url'] }}" class="btn-disabled" target="_blank" >
                                        <span class="fa-stack fa-lg">
                                          <i class="fa fa-square fa-stack-2x text-"></i>
                                          <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
                                        </span>
                                      </a>
                                    </li>
                                  </ul>
                                </div>
                                <div class="clearfix"></div>
                                <hr>
                              </div>
                              @endforeach
                              <!-- <u class="text-center"><a href=""><i class="fa fa-plus"></i> Add Job board</u></a> -->
                            </div>
                          </div>
                        </div>
                      </div>







                      <!-- Paid Boards -->
                      <!-- <div class="col-xs-5"> -->
                        <!-- <h5 class="text-center">Below are free job boards where your job will be posted. You can copy the link of your job or share them from here. You can find this section on the <a href="{{ url('dashboard') }}">job dashboard here.</a></h5><br> -->
                        
                      <!-- </div> -->

                      <div class="col-xs-5">
                        
                        <div class="well text-center">
                          <p class="lead">For a wider and better reach, you can promote this job on more job boards and <i>newspapers.</i></p>
                          <p>
                            <a href="{{ url('jobs/advertise-your-job/'.$job->id.'/'.str_slug($job['title'])) }}" class="btn btn-danger btn-" target="_blank">
                              <i class="fa fa-send"></i> Promote Job now
                            </a>
                          </p>
                        </div>
                        <div class="text-center">
                          <a href="{{ route('add-candidates', false) }}" class="btn btn-success"> <i class="fa fa-cloud-upload"></i> Upload CV to this Job</a> &nbsp;
                          <a href="{{ url('dashboard') }}" class="btn btn-line">Go to Your Dashboard <i class="fa fa-arrow-right"></i></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- <a href="{{ url('my-jobs') }}" class="btn btn-primary">View My Jobs</a> -->
                  <!-- <a href="" class="btn btn-primary">Promote job on more job boards</a>
                  <a href="" class="btn btn-line">Upload CVs to this job</a> -->
                  <!-- <div class="clearfix"></div> -->
                  <br>
                  <!-- <p>
                    <a href="" class="btn btn-line">Upload CVs for this job <i class="fa fa-folder"></i></a>
                  </p> -->
                </div>
              </div>
              
            </div>
            <!--/tab-content-->
          </div>
        </div>
      </div>
    </section>
    
    <div class="separator separator-small"></div>
    
    @endsection