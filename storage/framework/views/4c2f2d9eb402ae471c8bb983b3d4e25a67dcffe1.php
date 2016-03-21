<?php $__env->startSection('content'); ?>

<section class="s-div dark homepage">
        <div class="container">

           <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="pagehead text-white text-center"> 
                        <!-- <img src="" alt="seamless Hiring logo" width="100%"> -->
                        <!-- <i class="fa fa-skype fa-inverse fa-5x hidden-xs"></i>&nbsp;  -->
                        <div class="separator separator-small"><br></div>                        
                       <div class="separator separator-small hidden-xs"></div>

                       <h1 class="fa-3x no-margin bold hidden-xs text-brandon text-light">About Seamless Hiring</h1>
                       <h1 class=" hidden-sm hidden-md hidden-lg no-margin  text-brandon text-light">About Seamless Hiring</h1>

                       <p class="lead"><br>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus commodi, excepturi doloremque, eius. Nobis fugiat repellat dolor.</p>
                       <div class="row">
                           <!-- <div class="col-xs-12 col-md-6 col-sm-8">
                               <a href="" class="btn btn-success btn-block btn-lg text-uppercase text-bold">No Dulling. Start Now <i class="fa fa-chevron-right"></i></a>
                               </div> -->
                        <form action="<?php echo e(url('cv/search')); ?>" class="form-group" method="POST"><br>
                          <?php echo csrf_field(); ?>

                           <div class="form-lg hidden-xs">
                             <div class="col-sm-8">
                               <div class="row"><input placeholder="Find something you want" class="form-control input-lg input-talent" name="search_query" type="text"></div>
                             </div>
                             <div class="col-sm-4">
                               <div class="row"><button type="submit" class="btn btn-lg btn-block btn-success btn-talent">Find Candidates &nbsp; <span class="hidden-xs"><i class="fa fa-chevron-right"></i></span></button></div>
                             </div>
                           </div>
                        </form>

                           <div class="form-xs hidden-sm hidden-md hidden-lg">
                             <div class="col-sm-8">
                               <div class="">
                                <input placeholder="Find something you want" class="form-control input-lg" type="text"></div>
                             </div>
                             <div class="col-sm-4">
                               <div class=""><a href="cv-search.php" class="no-bod-rad btn btn-lg btn-block btn-warning">Find Candidates &nbsp; <i class="fa fa-chevron-right"></i></a></div>
                             </div>
                           </div>
                        <div class="col-sm-8 col-sm-offset-2">
                              <div class="separator separator-sm"><br><br></div>
                              <div class="col-sm-6">
                                <a href="" class="btn btn-block btn-line text-white"><i class="fa fa-cloud-download"></i> &nbsp; Download Brochure</a>
                              </div>
                              <div class="col-sm-6">
                                <a href="" class="btn btn-block btn-line text-white"><i class="fa fa-bars"></i> &nbsp; Learn More</a>
                              </div>
                              <div class="clearfix"></div>
                            <!-- <div class="separator separator-small hidden-xs">&nbsp;</div> <--><br>
                        </div>
                       </div>
                    </div>
                </div>
           </div>

        </div>
    </section>

<section class="no-pad white">
    <div class="container">
        <div class="row">

            <div class="col-sm-12">

                <div class="">

                    <div class="btn-group btn-group-justified btn-tabs" role="group" aria-label="...">
                      <div class="btn-group" role="group">
                        <a href="dashboard.php" type="button" class="btn btn-line text-capitalize in">
                        <span class="fa-lg"><i class="fa fa-tachometer"></i>
                        <span class="hidden-xs"> &nbsp; Overview</span><br></span>
                        <small class="text-muted hidden-xs">Notifications & Statistics </small>
                        </a>
                      </div>
                      <div class="btn-group" role="group">
                        <a href="your-jobs.php" type="button" class="btn btn-line text-capitalize">
                        <span class="fa-lg"><i class="fa fa-briefcase"></i>
                        <span class="hidden-xs"> &nbsp; Your Jobs</span><br></span>
                        <small class="text-muted hidden-xs">Jobs you have created</small>
                        </a>
                      </div>
                      <div class="btn-group" role="group">
                        <a href="talen-pool.php" type="button" class="btn btn-line text-capitalize">
                        <span class="fa-lg"><i class="fa fa-file-text"></i>
                        <span class="hidden-xs"> &nbsp; Talent Pool</span><br></span>
                        <small class="text-muted hidden-xs">Resumes / CVs</small>
                        </a>
                      </div>
                      <div class="btn-group" role="group">
                        <a href="setting.php" type="button" class="btn btn-line text-capitalize text-muted">
                        <span class="fa-lg"><i class="fa fa-cog"></i>
                        <span class="hidden-xs"> &nbsp; Settings</span><br></span>
                        <small class="text-muted hidden-xs">Edit your settings</small>
                        </a>
                      </div>
                    </div>                            
                    <div class="tab-content tab-content-adjust">



                              
                  <div role="tabpanel" class="tab-pane animated active" id="engine">
                      <div class="row">
                          <div class="container">
                          <!-- <h3 id="" class="text-light text-brandon text-center">The Recruitment Engine</h3><br><br> -->
                          <div class="col-xs-6 img-div">
                          <div class="separator separator-small"></div>
                              <img class="img-responsive img-rounded img-screen animated fadeInUp" src="img/screenshot-AMS.jpg">
                          </div>
                          <div class="col-xs-6">
                              <!-- <h1><i class="fa-5em fa fa-dot-circle-o"></i></h1> -->
                              <h4 class="text-brandon text-uppercase">Applicant Management System</h4>
                              <p>We have developed a one-stop shop for all things recruitment. With the Applicant Management System, you can;</p><br>
                              
                              <ul class="unstyled no-pad no-margin">
                                  <li class="">
                                  <i class="fa fa-check-square fa-lg"></i>
                                  Sort &amp; filter any number of applicants’ CVs within seconds – even if they are millions!</li>
                                  <li class="">
                                  <i class="fa fa-check-square fa-lg"></i>
                                  Manage the entire recruitment process; shortlists, interview lists, waiting lists etc.</li>
                                  <li class="">
                                  <i class="fa fa-check-square fa-lg"></i>
                                  Exchange messages between applicants and various members of your recruitment team.</li>
                                  <li class="">
                                  <i class="fa fa-check-square fa-lg"></i>
                                  Make comments on candidates during the recruitment process.</li>
                              </ul>
                          </div>
                          </div>
                      </div>

                      <div class="row blue">
                          <div class="container">
                          <div class="col-xs-6">
                              <!-- <h1><i class="fa-5em fa fa-users"></i></h1> -->
                              <div class="separator separator-small"></div>
                              <div class="separator separator-small"></div>
                              <h4 class="text-brandon text-uppercase">Interview with your team</h4>
                              You can invite your entire HR team and other stakeholders to join the recruitment process, so as to ensure better assessment of candidates, and to keep relevant parties adequately informed.
                          </div>
                          <div class="col-xs-6 img-div">
                              <img class="img-responsive img-rounded img-screen animated fadeInUp" src="img/screenshot-interview.jpg">
                          </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="container">
                          <div class="col-xs-6 img-div">
                              <img class="img-responsive img-rounded img-screen animated fadeInUp" src="img/screenshot-interview2.jpg">
                          </div>
                          <div class="col-xs-6">
                          <!-- <h1><i class="fa-5em fa fa-users"></i></h1> -->
                          <div class="separator separator-small"></div>
                          <div class="separator separator-small"></div>
                              <h4 class="text-brandon text-uppercase">Make Interview Notes</h4>
                          <p>Right on the recruitment machine. All your interviewers can make interview notes too.</p>
                          </div>
                      </div>
                      </div>

                      <div class="row blue">
                          <div class="container">
                          <div class="col-xs-6">
                          <!-- <h1><i class="fa-5em fa fa-users"></i></h1> -->
                          <div class="separator separator-small"></div>
                          <div class="separator separator-small"></div>
                              <h4 class="text-brandon text-uppercase">Download the entire candidate dossier</h4>
                          Because the recruitment engine does it all; with one click you can download a printable version of the entire recruitment. Candidate’s profile, CV, cover letter, interview notes background &amp; health check results &amp; test results.
                      </div>
                          <div class="col-xs-6 img-div">
                              <img class="img-responsive img-rounded img-screen animated fadeInUp" src="img/screenshot-dossier.jpg">
                          </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="container">
                          <div class="col-xs-6 img-div">
                              <img class="img-responsive img-rounded img-screen animated fadeInUp" src="img/screenshot-match.jpg">
                          </div>
                          <div class="col-xs-6">
                          <!-- <h1><i class="fa-5em fa fa-users"></i></h1> -->
                          <div class="separator separator-small"></div>
                          <br>
                              <h4 class="text-brandon text-uppercase">Find matching candidates from Insidify’s database</h4>
                          When you post a job, the recruitment engine automatically finds matches from our huge database of professionals who did not apply for your job, but are a perfect fit.
                          </div>
                      </div></div>
                  </div>


                  <div role="tabpanel" class="tab-pane animated" id="background">
                      <div class="row">
                          <!-- <h3 class="text-light text-brandon text-center">Background Checks & Medicals</h3> -->
                          <div class="container">
                          <!-- <div class="separator separator-small"></div> -->
                          <div class="col-xs-6 img-div">
                              <img class="img-responsive img-rounded img-screen animated fadeInUp" src="img/screenshot-check.jpg">
                          </div>
                          <div class="col-xs-6">
                              <div class="separator separator-small"></div>
                              <div class="separator separator-small"></div>
                              <h4 class="text-brandon text-uppercase">Background Checks</h4>
                              <p>Run Background Checks on applicants directly from the recruitment engine. This service is delivered in collaboration with Background Check International Limited. </p>

                          </div>
                          </div>
                      </div>
                      <div class="row blue">
                          <div class="container">
                              <div class="col-xs-6">
                              <div class="separator separator-small"></div>
                              <div class="separator separator-small"></div>
                                  <h4 class="text-brandon text-uppercase">Pre-employment Medicals</h4>
                                  <p>We have collaborated with Mecure Healthcare Limited to offer pre-employment Medicals. You order for the test, Mecure does it and results are fed to you via the Engine.</p>
                              </div>
                              <div class="col-xs-6 img-div">
                                  <img class="img-responsive img-rounded img-screen animated fadeInUp" src="img/screenshot-medic.jpg">
                              </div>
                          </div>
                          </div>
                  </div>


                  <div role="tabpanel" class="tab-pane animated" id="test">


                      <div class="row">
                          <!-- <h3 class="text-light text-brandon text-center">Recruitment Testing</h3> -->
                          <!-- <div class="separator separator-small"></div> -->
                          <div class="container">
                          <div class="col-xs-6 img-div">
                              <img class="img-responsive img-rounded img-screen animated fadeInUp" src="img/screenshot-test.jpg">
                          </div>
                          <div class="col-xs-6">
                              <div>
                              <div class="separator separator-small"></div>
                              <!-- <div class="separator separator-small"></div> -->
                                  <h4 class="text-brandon text-uppercase">The Insidify Testing and Assessment Center</h4>
                                  <p>IQ, Personality, Quantitative- any test. Test job applicants either with your own questions or with standard tests by 3rd party pre-employment test providers on Insidify.com. Applicants can take tests online or at any location of your choice. The results are fed to the recruitment engine automatically.</p>

                              </div>
                          </div>
                          </div>
                      </div>


                  </div>


                  <div role="tabpanel" class="tab-pane animated" id="company">

                      <div class="row">
                          <!-- <h3 class="text-light text-brandon text-center">Company Page and More</h3> -->
                              <!-- <div class="separator separator-small"></div> -->
                              <div class="container">
                              <div class="col-xs-6 img-div">
                                  <img class="img-responsive img-rounded img-screen animated fadeInUp" src="img/screenshot-comp.jpg">
                              </div>
                              <div class="col-xs-6">
                                  <div>
                                  <div class="separator separator-small"></div>
                                  <!-- <div class="separator separator-small"></div> -->
                                      <h4 class="text-brandon text-uppercase">Get a Company Page</h4>
                                      <p>The Company page is your company’s personalized page on Insidify.com. It allows you share important information about your company such as company culture, products &amp; services and social media activities. </p>
                              </div>
                              </div>
                              </div>
                          </div>
                          <div class="row blue">
                          <div class="container">
                              <div class="col-xs-6">
                              <div class="separator separator-small"></div>
                              <div class="separator separator-small"></div><br>
                                  <h4 class="text-brandon text-uppercase">Embed Jobs on your own site</h4>
                                  <p> The Job Embed Tool allows you to post a job on Insidify.com, and embed it directly into the career section of your company’s website.</p>

                              </div>
                              <div class="col-xs-6 img-div">
                                  <img class="img-responsive img-rounded img-screen animated fadeInUp" src="img/img-dummy.jpg">
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.template-default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>