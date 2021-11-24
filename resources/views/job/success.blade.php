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
                        <div class="col-xs-8">
                          <!-- <h5 class="text-center">Below are free job boards where your job will be posted. You can copy the link of your job or share them from here. You can find this section on the <a href="{{ url('dashboard') }}">job dashboard here.</a></h5><br> -->
                          <div class="">
                            <div class="panel panel-default">
                              
                              <div class="panel-heading">
                                <h3 class="panel-title "><span class="text-uppercase text-black"><b>Free Job Boards</b></span>
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
                        <div class="col-xs-4">
                          
                          <div class="well text-center">
                            <h1 class=""><i class="fa-lg fa text-muted fa-send"></i></h1><br>
                            <p class="h4">For a wider and better reach, you can promote this job on more job boards and <i>newspapers.</i></p>
                            <p>
                              <hr>
                              <!--  <a href="{{ url('jobs/advertise-your-job/'.$job->id.'/'.str_slug($job['title'])) }}" class="btn btn-primary btn-block" target="_blank" data-toggle="modal" data-target="#myModal">
                                Promote Job Now
                              </a> -->
                              <a href="#" class="btn btn-primary btn-block" target="_blank" data-toggle="modal" data-target="#promoteJob">
                                Promote Job Now
                              </a>
                            </p>
                          </div>
                          <p class="text-center">- OR -</p>
                          <div class="well text-center">
                            <h1 class=""><i class="fa-lg fa text-muted fa-cloud-upload"></i></h1><br>
                            <p class="h4">Start with uploading candidates' CVs to this job</p>
                            <p>
                              <hr>
                              
                              <a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#uploadCV">  Upload CV to this Job</a>
                            </p>
                          </div>
                          <div class="text-center">
                            &nbsp;
                          </div>
                        </div>
                        <div class="col-xs-12 text-center">
                          <hr>
                          <a href="{{ url('dashboard') }}" class="btn btn-line">Go to Job Dashboard <i class="fa fa-arrow-right"></i></a>
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
      
      <!-- Modal Promote Job -->
      <div class="modal fade" id="promoteJob" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title bold text-bold" id="myModalLabel">Promote <span class="text-warning">{{ ucfirst( $job->title ) }} </span></h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <!-- <div class="col-xs-12 text-center">
                </div> -->
                
                <div class="col-xs-12">
                  <p class="text-">Select the Job-board and Newspaper where you want your job to appear and click done to forward your request and we will reach you shortly.</p>
                  <div class="well">
                    <h4 class="text-brandon text-uppercase text-danger text-center">
                    <i class="fa fa-star"></i>&nbsp; Paid Job Boards
                    </h4><hr>
                    <!-- <h4>Promote <a href="">Job Title should come here</a>. </h4> -->
                    <!-- <p>Multipying your talent flow. Post your job on more job boards</p> -->
                    <div class="col-sm-4">
                      <div class="thumbnail thumb-box">
                        <div class="caption">
                          <img alt="" src="https://ngcareers.com/public/img/ngc_logo.png" height="45px" style="max-width:100%;"> <hr>
                          <h4 class="">Ngcareers</h4>
                          <p class="small"></p>
                          <p>
                            <span class="purchase-action">
                              <a id="cartAdd" class="btn btn-success " data-count="1" data-id="4" data-cost="1000" data-pass="yf0OPNLMnW8mMFat6DsDzCN9xXCTbjRiGo8vVPz5" data-name="Ngcareers"><i class="fa fa-plus"></i> Post for ₦ 1000</a>
                              
                            </span>
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="thumbnail thumb-box">
                        <div class="caption">
                          <img alt="" src="http://www.jobberman.com/img/new/logo.png" height="45px" style="max-width:100%;"> <hr>
                          <h4 class="">Jobberman.com</h4>
                          <p class="small"></p>
                          <p>
                            <span class="purchase-action">
                              <a id="cartAdd" class="btn btn-success " data-count="1" data-id="5" data-cost="1000" data-pass="yf0OPNLMnW8mMFat6DsDzCN9xXCTbjRiGo8vVPz5" data-name="Jobberman.com"><i class="fa fa-plus"></i> Post for ₦ 1000</a>
                              
                            </span>
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="thumbnail thumb-box">
                        <div class="caption">
                          <img alt="" src="http://1.bp.blogspot.com/-vWFnB2I50PI/T65u315lAHI/AAAAAAAAALY/24h3emm6Z0c/s461/DD1.jpg" height="45px" style="max-width:100%;"> <hr>
                          <h4 class="">Nairacareer.com</h4>
                          <p class="small"></p>
                          <p>
                            <span class="purchase-action">
                              <a id="cartAdd" class="btn btn-success " data-count="1" data-id="6" data-cost="1000" data-pass="yf0OPNLMnW8mMFat6DsDzCN9xXCTbjRiGo8vVPz5" data-name="Nairacareer.com"><i class="fa fa-plus"></i> Post for ₦ 1000</a>
                              
                            </span>
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="thumbnail thumb-box">
                        <div class="caption">
                          <img alt="" src="http://seamlesshiring.com/img/efritin-logo.png" height="45px" style="max-width:100%;"> <hr>
                          <h4 class="">Efritin.com</h4>
                          <p class="small"></p>
                          <p>
                            <span class="purchase-action">
                              <a id="cartAdd" class="btn btn-success " data-count="1" data-id="16" data-cost="1000" data-pass="yf0OPNLMnW8mMFat6DsDzCN9xXCTbjRiGo8vVPz5" data-name="Efritin.com"><i class="fa fa-plus"></i> Post for ₦ 1000</a>
                              
                            </span>
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="thumbnail thumb-box">
                        <div class="caption">
                          <img alt="" src="http://www.hotnigerianjobs.com/images/banner2.gif" height="45px" style="max-width:100%;"> <hr>
                          <h4 class="">HotNigerianjobs.com</h4>
                          <p class="small"></p>
                          <p>
                            <span class="purchase-action">
                              <a id="cartAdd" class="btn btn-success " data-count="1" data-id="17" data-cost="1000" data-pass="yf0OPNLMnW8mMFat6DsDzCN9xXCTbjRiGo8vVPz5" data-name="HotNigerianjobs.com"><i class="fa fa-plus"></i> Post for ₦ 1000</a>
                              
                            </span>
                          </p>
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row hidden">
                      <div class="col-xs-6 col-xs-offset-3"><hr>
                        <i class="fa fa-spin fa-circle-o-notch fa-2x"></i>
                        <p class="">
                          <i class="fa fa-check"></i> Your request has been sent. You will be contacted shortly. Thank you.
                        </p>
                        <a href="" class="btn btn-danger btn-block">Forward Request</a>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                  <div class="well text-center">
                    <h4 class="text-brandon text-uppercase text-danger">
                    <i class="fa fa-star"></i>&nbsp; Paid Newspaper Ads
                    </h4>
                    <br>
                    
                    <div class="col-sm-4">
                      <label for="fl-box-0">
                        <div class="thumbnail thumb-box">
                          <div class="caption">
                            <img alt="" src="http://cdn.guardian.ng/wp-content/themes/guardian2016/img/guardian_logo.png" height="45px" width="100%"> <hr>
                            <h4 class="">TheGuardian</h4>
                            <p class="small"></p>
                            <input type="checkbox" class="fl-box" name="" id="fl-box-0">
                            <p>
                              
                              <span class="purchase-action">
                                
                                <!-- <a href="" class="btn btn-success " data-count="1" onclick="AddBoardCart(7, 1000, 'TheGuardian')" data-cost="1000"><i class="fa fa-plus"></i> Post for &#8358; 1000</a> -->
                                
                              </span>
                              
                            </p>
                          </div>
                        </div>
                      </label>
                    </div>
                    <div class="col-sm-4">
                      <label for="fl-box-1">
                        <div class="thumbnail thumb-box">
                          <div class="caption">
                            <img alt="" src="http://d1phczbdxyh8yo.cloudfront.net/wp-content/uploads/2016/03/21234614/Punch-Logo1-300x89.png" height="45px" width="100%"> <hr>
                            <h4 class="">Punch</h4>
                            <p class="small"></p>
                            <input type="checkbox" class="fl-box" name="" id="fl-box-1">
                            <p>
                              
                              <span class="purchase-action">
                                
                                <!-- <a href="" class="btn btn-success " data-count="1" onclick="AddBoardCart(9, 1500, 'Punch')" data-cost="1500"><i class="fa fa-plus"></i> Post for &#8358; 1500</a> -->
                                
                              </span>
                              
                            </p>
                          </div>
                        </div>
                      </label>
                    </div>
                    <div class="col-sm-4">
                      <label for="fl-box-2">
                        <div class="thumbnail thumb-box">
                          <div class="caption">
                            <img alt="" src="http://thenationonlineng.net/wp-content/uploads/2015/07/logo1.png" height="45px" width="100%"> <hr>
                            <h4 class="">TheNation</h4>
                            <p class="small"></p>
                            <input type="checkbox" class="fl-box" name="" id="fl-box-2">
                            <p>
                              
                              <span class="purchase-action">
                                
                                <!-- <a href="" class="btn btn-success " data-count="1" onclick="AddBoardCart(10, 1200, 'TheNation')" data-cost="1200"><i class="fa fa-plus"></i> Post for &#8358; 1200</a> -->
                                
                              </span>
                              
                            </p>
                          </div>
                        </div>
                      </label>
                    </div>
                    <div class="col-sm-4">
                      <label for="fl-box-3">
                        <div class="thumbnail thumb-box">
                          <div class="caption">
                            <img alt="" src="http://d19lga30codh7.cloudfront.net/wp-content/uploads/2013/12/vanguardlogo.png" height="45px" width="100%"> <hr>
                            <h4 class="">Vanguard</h4>
                            <p class="small"></p>
                            <input type="checkbox" class="fl-box" name="" id="fl-box-3">
                            <p>
                              
                              <span class="purchase-action">
                                
                                <!-- <a href="" class="btn btn-success " data-count="1" onclick="AddBoardCart(11, 1300, 'Vanguard')" data-cost="1300"><i class="fa fa-plus"></i> Post for &#8358; 1300</a> -->
                                
                              </span>
                              
                            </p>
                          </div>
                        </div>
                      </label>
                    </div>
                    
                    <div class="hidden" href="#">
                      <div class="panel panel-default panel-course category-item">
                        <div class="row category-row">
                          <div class="col-xs-3">
                            <img src="http://d19lga30codh7.cloudfront.net/wp-content/uploads/2013/12/vanguardlogo.png" alt="" class="category-icon" width="100%">
                          </div>
                          <div class="col-xs-6">
                            <h4>Name of Newspaper comes here <small></small> </h4>
                            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, esse nam. Deserunt delectus ex enim assumenda.</p> -->
                          </div>
                          <div class="col-xs-3 category-item"><br>
                            <a class="btn btn-block btn-warning pull-right">Request slot</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="hidden" href="#">
                      <div class="panel panel-default panel-course category-item">
                        <div class="row category-row">
                          <div class="col-xs-3 ">
                            <img src="http://cdn.guardian.ng/wp-content/themes/guardian2016/img/guardian_logo.png" alt="" class="category-icon" width="100%">
                          </div>
                          <div class="col-xs-6">
                            <h4>Name of Newspaper comes here <small></small></h4>
                            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, esse nam. Deserunt delectus ex enim assumenda.</p> -->
                          </div>
                          <div class="col-xs-3 category-item"><br>
                            <a class="btn btn-block btn-warning pull-right">Request slot</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row hidden">
                      <div class="col-xs-6 col-xs-offset-3"><hr>
                        <i class="fa fa-spin fa-circle-o-notch fa-2x"></i>
                        <p class="">
                          <i class="fa fa-check"></i> Your request has been sent. You will be contacted shortly. Thank you.
                        </p>
                        <a href="" class="btn btn-danger btn-block">Forward Request</a>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-line" data-dismiss="modal">Cancel</button>
              <button type="button" class="btn btn-primary">Done</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal Upload CV -->
      <div class="modal fade" id="uploadCV" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Upload CVs to this Job</h4>
            </div>
            <div class="modal-body">
              <div class="col-xs-12">
                <div class="row tab-content ">
                  <div class="col-sm-12">
                    <h1 class="text-center"><i class="fa fa-user-plus"></i></h1>
                    <h4 class="text-center text-green strong">Add Candidates to your Talent Pool</h4>
                    
                    
                    <div class="col-sm-10 col-sm-offset-1 text-center">
                      <p>
                        Do you already have relevant resumes in a folder somewhere?
                        Upload them here and add them to your pool of applicants.
                      </p><br>
                      
                      <div id="loader"></div>
                      <div class="alert alert-danger" style="display:none;" id="u_f"></div>
                      <div class="alert alert-success" style="display:none;" id="u_s"></div>
                      <form action="https://localhost/seamlesshiring/public_html/job/import-cv-file" method="post" enctype="multipart/form-data" id="uploadCandidate">
                        <input type="hidden" name="_token" value="p1au5UXt3AEjM6t41vp4R5Q2LXx5HWFyCAB6eFcg">
                        <div class="form-group">
                          <div class="btn-group" data-toggle="buttons">
                            <!-- <label class="btn btn-line">
                              <input type="radio" name="options" id="upToFolder" autocomplete="off" value="upToFolder"> Upload to Folder
                            </label> -->
                            <label class="btn btn-line">
                              <input type="radio" name="options" id="upToJob" autocomplete="off" value="upToJob"> Upload to a Job
                            </label>
                          </div>
                          <br><br>
                          
                          <select class="form-control job-opt " name="job">
                            <option value="">Select Job</option>
                            <option value="22">Technical Executives at Cell Phone Repairs Stores</option>
                            <option value="92">Human Resource Managers at Nachitech Oilfield Supplies and Services Limited</option>
                            <option value="111">Salesperson/Customer Service at Cell Phone Repair</option>
                            <option value="115">Head of Learning and Development</option>
                            <option value="118">My Job</option>
                          </select>
                          <select class="form-control hidden folder-opt-select" name="folder">
                            <option value="0">Select Folder</option>
                            
                          </select>
                          <div class="btn-group folder-opt" style="display:none;">
                            <button type="button" class="btn btn-line btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Select Folder
                            &nbsp; <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" id="folders" data-folders="" data-cv="">
                              
                              <li role="separator" class="divider"></li>
                              <li>
                                <a href="javascript://" onclick="//$('#add-folder').show();$('#add-folder').focus();"><i class="fa fa-plus"></i> Create new</a>
                              </li>
                            </ul>
                            <br><br>
                          </div>
                          
                          <div class="form-group" id="add-folder" style="display:none;">
                            <div class="col-xs-6 col-xs-offset-2">
                              <input type="text" class="form-control" id="add-folder-field">
                            </div>
                            
                            <div class="col-xs-2">
                              <button class="form-control" id="add-folder-btn">Add</button>
                            </div>
                            <br><br>
                          </div>
                          
                          
                        </div>
                        
                        <div id="inputer-opt" class="collapse">
                          <div class="form-group fileinput fileinput-new input-group" data-provides="fileinput">
                            <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                            <span class="input-group-addon btn btn-primary btn-file text-white"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span>
                            <input type="file" name="cv-upload-file" placeholder="zip" accept=".zip,.pdf,.doc,.docx,.txt,.rtf,.pptx,.ppt">
                          </span>
                          <a href="#" class="input-group-addon  fileinput-exists btn btn-danger" style="    background-color: #d9534f; color:white;" data-dismiss="fileinput">Remove</a>
                          
                        </div><br>
                        <small style="margin-top: -20px;display: block;">*Allowed extensions are .zip, .pdf, .doc, .docx, .txt, .rtf, .pptx, .ppt</small><br>
                        <button type="submit" class="btn btn-success text-capitalize">
                        <i class="fa fa-file-text-o"></i>&nbsp; <span class="hidden-xs">Upload File</span>
                        </button>
                      </div>
                    </form>
                    <div id="funcMsg" class="text text-successs"></div>
                    
                  </div>
                  
                  <div class="col-sm-12 hidden">
                    
                    <h5 class="no-margin text-center text-success hidden">
                    <i class="fa fa-spinner fa-pulse"></i> &nbsp;
                    Importing Candidates
                    </h5>
                    
                    <div class="col-sm-12"><hr><a href="https://localhost/seamlesshiring/public_html/cv/talent-pool" class="pull-right btn btn-danger btn-cart-checkout">Go to Talent Pool »</a></div>
                    
                    
                  </div>
                </div>
                
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
    @endsection
