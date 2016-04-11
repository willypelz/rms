@extends('layout.template-default')

@section('content')

<section class="s-div dark homepage">
        <div class="container">

           <div class="row">
                <div class="col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">
                    <div class="pagehead text-white text-center"> 
                        <!-- <img src="" alt="seamless Hiring logo" width="100%"> -->
                        <!-- <i class="fa fa-skype fa-inverse fa-5x hidden-sm"></i>&nbsp;  -->
                        <div class="separator separator-small"><br></div>                        
                       <div class="separator separator-small hidden-xs"></div>

                       <h1 class="fa-3x no-margin bold hidden-xs text-brandon text-light">About Seamless Hiring</h1>
                       <h1 class=" hidden-sm hidden-md hidden-lg no-margin  text-brandon text-light">About Seamless Hiring</h1>

                       <p class="lead"><br>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus commodi, excepturi doloremque, eius. Nobis fugiat repellat dolor.</p>
                       <div class="row">
                           <!-- <div class="col-sm-12 col-md-6 col-sm-8">
                               <a href="" class="btn btn-success btn-block btn-lg text-uppercase text-bold">No Dulling. Start Now <i class="fa fa-chevron-right"></i></a>
                               </div> -->
                        <form action="{{ url('cv/search') }}" class="form-group">
                        <br class="hidden-xs">
                           <div class="form-lg hidden-xs">
                             <div class="col-sm-8">
                               <div class="row"><input placeholder="Find something you want" class="form-control input-lg input-talent" name="search_query" type="text"></div>
                             </div>
                             <div class="col-sm-4">
                               <div class="row"><button type="submit" class="btn btn-lg btn-block btn-success btn-talent">Find Candidates &nbsp; <span class="hidden-xs"><i class="fa fa-chevron-right"></i></span></button></div>
                             </div>
                           </div>
                        </form>

                           <div class="form-sm hidden-sm hidden-md hidden-lg">
                             <div class="col-sm-8">
                               <div class="">
                                <input placeholder="Find something you want" class="form-control input-lg" type="text"></div>
                             </div>
                             <div class="col-sm-4">
                               <div class=""><a href="cv-search.php" class="no-bod-rad btn btn-lg btn-block btn-warning btn-lg no-bod-rad">Find Candidates &nbsp; <i class="fa fa-chevron-right"></i></a></div>
                             </div>
                           </div>
                        <div class="col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">
                              <div class="separator separator-sm"><br><br></div>
                              <div class="col-sm-7">
                                <a href="" class="btn btn-block btn-line text-white"><i class="fa fa-cloud-download"></i> &nbsp; Download Brochure</a>
                                <br class="hidden-sm hidden-md hidden-lg">
                              </div>
                              <div class="col-sm-5">
                                <a href="" class="btn btn-block btn-line text-white"><i class="fa fa-bars"></i> &nbsp; Learn More</a>
                              </div>
                              <div class="clearfix"></div>
                            <!-- <div class="separator separator-small hidden-sm">&nbsp;</div> <--><br>
                        </div>
                       </div>
                    </div>
                </div>
           </div>

        </div>
    </section>

<section class="no-pad white">

          <div class="btn-group btn-group-justified btn-tabs" role="group" aria-label="...">
            <div class="btn-group" role="group">
              <a href="dashboard.php" type="button" class="btn btn-line text-capitalize in">
              <span class="fa-lg"><i class="fa fa-tachometer"></i>
              <span class="hidden-xs text-brandon"> &nbsp; Overview</span><br></span>
              <small class="text-muted hidden-xs">Notifications & Statistics </small>
              </a>
            </div>
            <div class="btn-group" role="group">
              <a href="your-jobs.php" type="button" class="btn btn-line text-capitalize">
              <span class="fa-lg"><i class="fa fa-briefcase"></i>
              <span class="hidden-xs text-brandon"> &nbsp; Your Jobs</span><br></span>
              <small class="text-muted hidden-xs">Jobs you have created</small>
              </a>
            </div>
            <div class="btn-group" role="group">
              <a href="talen-pool.php" type="button" class="btn btn-line text-capitalize">
              <span class="fa-lg"><i class="fa fa-file-text"></i>
              <span class="hidden-xs text-brandon"> &nbsp; Talent Pool</span><br></span>
              <small class="text-muted hidden-xs">Resumes / CVs</small>
              </a>
            </div>
            <div class="btn-group" role="group">
              <a href="setting.php" type="button" class="btn btn-line text-capitalize text-muted">
              <span class="fa-lg"><i class="fa fa-cog"></i>
              <span class="hidden-xs text-brandon"> &nbsp; Settings</span><br></span>
              <small class="text-muted hidden-xs">Edit your settings</small>
              </a>
            </div>
          </div> 



        <div class="">                           
            <div class="tab-content tab-content-adjust">

                              
                  <div role="tabpanel" class="tab-pane animated active" id="engine">
                      <section style="padding-top: 1em">
                          <div class="container">
                          <!-- <h3 id="" class="text-light text-brandon text-center">The Recruitment Engine</h3><br><br> -->
                          <div class="row">
                            <div class="col-sm-6 img-div">

                                <img class="img-responsive img-rounded img-screen animated fadeInUp" src="img/screenshot-AMS.jpg">
                            </div>
                            <div class="col-sm-5 col-sm-offset-1">
                                <!-- <h1><i class="fa-5em fa fa-dot-circle-o"></i></h1> -->
                                <h3 class="text-brandon text-light">Applicant Management System</h3>
                                <p class="lead">We have developed a one-stop shop for all things recruitment. With the Applicant Management System, you can;</p>
                                
                                <ul class="list-unstyled no-pad no-margin lead">
                                    <li class="">
                                    <i class="fa fa-arrow-right fa-lg"></i>
                                    Sort &amp; filter any number of applicants’ CVs within seconds – even if they are millions!</li>
                                    <li class="">
                                    <i class="fa fa-arrow-right fa-lg"></i>
                                    Manage the entire recruitment process; shortlists, interview lists, waiting lists etc.</li>
                                    <li class="">
                                    <i class="fa fa-arrow-right fa-lg"></i>
                                    Exchange messages between applicants and various members of your recruitment team.</li>
                                    <li class="">
                                    <i class="fa fa-arrow-right fa-lg"></i>
                                    Make comments on candidates during the recruitment process.</li>
                                </ul>
                            
                            </div>
                          </div>
                          </div>
                      </section>

                      <section class="blue">
                          <div class="container">
                          <div class="row">
                            <div class="col-sm-6">

                                <h3 class="text-brandon text-light">Interview with your team</h3>
                                <p class="lead">You can invite your entire HR team and other stakeholders to join the recruitment process, so as to ensure better assessment of candidates, and to keep relevant parties adequately informed.</p>
                            </div>
                            <div class="col-sm-6 img-div">
                                <img class="img-responsive img-rounded img-screen animated fadeInUp" src="img/screenshot-interview.jpg">
                            </div>
                          </div>
                          </div>
                      </section>

                      <section>
                          <div class="container">
                          <div class="row">
                            <div class="col-sm-6 img-div">
                                <img class="img-responsive img-rounded img-screen animated fadeInUp" src="img/screenshot-interview2.jpg">
                            </div>
                            <div class="col-sm-6">
                                <h4 class="text-brandon text-">Make Interview Notes</h4>
                            <p class="lead">Right on the recruitment machine. All your interviewers can make interview notes too.</p>
                            </div>
                          </div>
                      </div>
                      </section>

                      <section class="blue">
                          <div class="container">
                          <div class="row">
                            <div class="col-sm-6">
                                <h3 class="text-brandon text-light">Download the entire candidate dossier</h3>
                            <p class="lead">Because the recruitment engine does it all; with one click you can download a printable version of the entire recruitment. Candidate’s profile, CV, cover letter, interview notes background &amp; health check results &amp; test results.</p>
                                                  </div>
                            <div class="col-sm-6 img-div">
                                <img class="img-responsive img-rounded img-screen animated fadeInUp" src="img/screenshot-dossier.jpg">
                            </div>
                          </div>
                          </div>
                      </section>

                      <section class="">
                          <div class="container">
                          <div class="row">
                            <div class="col-sm-6 img-div">
                                <img class="img-responsive img-rounded img-screen animated fadeInUp" src="img/screenshot-match.jpg">
                            </div>
                            <div class="col-sm-6">
                            <br>
                                <h3 class="text-brandon text-light">Find matching candidates from Insidify’s database</h3>
                            <p class="lead">When you post a job, the recruitment engine automatically finds matches from our huge database of professionals who did not apply for your job, but are a perfect fit.</p>
                            </div>
                          </div>
                      </div>
                      </section>
                  </div>


                  <div role="tabpanel" class="tab-pane animated" id="background">
                          <!-- <h3 class="text-light text-brandon text-center">Background Checks & Medicals</h3> -->
                      <section>
                          <!-- <div class="separator separator-small"></div> -->
                          <div class="container">
                            <div class="row">
                              <div class="col-sm-6 img-div">
                                  <img class="img-responsive img-rounded img-screen animated fadeInUp" src="img/screenshot-check.jpg">
                              </div>
                              <div class="col-sm-6">
                                  <h4 class="text-brandon text-uppercase">Background Checks</h4>
                                  <p class="lead">Run Background Checks on applicants directly from the recruitment engine. This service is delivered in collaboration with Background Check International Limited. </p>
                              
                              </div>
                            </div>
                          </div>
                      </section>

                      <section class="blue">
                          <div class="container">
                              <div class="row">
                                <div class="col-sm-6">
                                    <h4 class="text-brandon text-uppercase">Pre-employment Medicals</h4>
                                    <p class="lead">We have collaborated with Mecure Healthcare Limited to offer pre-employment Medicals. You order for the test, Mecure does it and results are fed to you via the Engine.</p>
                                </div>
                                <div class="col-sm-6 img-div">
                                    <img class="img-responsive img-rounded img-screen animated fadeInUp" src="img/screenshot-medic.jpg">
                                </div>
                              </div>
                          </div>
                      </section>
                  </div>


                  <div role="tabpanel" class="tab-pane animated" id="test">


                      <section>
                          <!-- <h3 class="text-light text-brandon text-center">Recruitment Testing</h3> -->
                          <!-- <div class="separator separator-small"></div> -->
                          <div class="container">
                          <div class="col-sm-6 img-div">
                              <img class="img-responsive img-rounded img-screen animated fadeInUp" src="img/screenshot-test.jpg">
                          </div>
                          <div class="col-sm-6">
                              <div>
                              <!-- <div class="separator separator-small"></div> -->
                                  <h4 class="text-brandon text-uppercase">The Insidify Testing and Assessment Center</h4>
                                  <p class="lead">IQ, Personality, Quantitative- any test. Test job applicants either with your own questions or with standard tests by 3rd party pre-employment test providers on Insidify.com. Applicants can take tests online or at any location of your choice. The results are fed to the recruitment engine automatically.</p>

                              </div>
                          </div>
                          </div>
                      </section>


                  </div>


                  <div role="tabpanel" class="tab-pane animated" id="company">

                      <section>
                          <!-- <h3 class="text-light text-brandon text-center">Company Page and More</h3> -->
                              <!-- <div class="separator separator-small"></div> -->
                              <div class="container">
                              <div class="col-sm-6 img-div">
                                  <img class="img-responsive img-rounded img-screen animated fadeInUp" src="img/screenshot-comp.jpg">
                              </div>
                              <div class="col-sm-6">
                                  <div>
                                  <!-- <div class="separator separator-small"></div> -->
                                      <h4 class="text-brandon text-uppercase">Get a Company Page</h4>
                                      <p class="lead">The Company page is your company’s personalized page on Insidify.com. It allows you share important information about your company such as company culture, products &amp; services and social media activities. </p>
                              </div>
                              </div>
                              </div>
                          </section>

                          <section class="blue">
                          <div class="container">
                              <div class="col-sm-6">
                                  <h4 class="text-brandon text-uppercase">Embed Jobs on your own site</h4>
                                  <p class="lead"> The Job Embed Tool allows you to post a job on Insidify.com, and embed it directly into the career section of your company’s website.</p>

                              </div>
                              <div class="col-sm-6 img-div">
                                  <img class="img-responsive img-rounded img-screen animated fadeInUp" src="img/img-dummy.jpg">
                              </div>
                              </div>

                          </section>
                <!--/tab-content-->

            </div>
        </div>
    </div>
</section>
@endsection