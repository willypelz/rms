@extends('layout.template-default')
<style>
  .section-tab{
    padding: 3em 0;
  }
  .list-prod .list-group-item{
    padding: 20px 25px;
  }
</style>
@section('content')
  <!-- <an-ins an-type="EVENT" an-data="{id:9}" an-action="PAGE_LOADED"></an-ins> -->
  <section class="s-div dark homepage">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-sm-offset-2 text-center">
          <div class="pagehead text-white">
            <!-- <img src="" alt="SeamlessHiring logo" width="100%"> -->
            <!-- <i class="fa fa-skype fa-inverse fa-5x hidden-sm"></i>&nbsp;  -->
            <div class="separator separator-small"><br></div>
            <h1 class="fa-3x bold text-brandon text-light no-margin"><span class="">Everything</span> You Need To Hire, In One Place!</h1>
            <div class="col-xs-4 col-xs-offset-4">
              <hr>
            </div>
            <div class="clearfix"></div>
            <p class="lead text-light no-margin">Cut cost, shorten recruitment time and increase the quality of hires drastically with the compact, easy-to-use recruitment solution.</p>
            <br><br>
            <p><a href="register" class="btn btn-lg btn-success">Get Started for Free &nbsp; <i class="fa fa-chevron-right"></i></a></p>

          </div>
        </div>
      </div>
    </div>
    <!-- <div class="visible-xs navituder"></div> -->
    <div  class="no-pad navitude navituder">

      <div class="btn-group hidden-xs btn-group-justified btn-tabs home-tabs no-pad no-margin" role="tab-list" aria-label="...">

        <div class="btn-group" role="group">
          <a href="#tab-1" aria-controls="tab-1" role="tab-1" data-toggle="tab" type="button" class="btn btn-line text-capitalize">
              <span class="">
              <span class="hidden-xs"> <h2>
              <span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
                <i class="fa fa-send fa-stack-1x"></i>
              </span>
              </h2> <br> Broadcast Jobs <br> everywhere.</span><br></span>
            <i class="hidden-xs fa fa-arrow-right pull-right fa-abx fa-lg"></i>

            <i class="hidden-sm hidden-md hidden-lg fa fa-3x fa-send fa-stack-1x "></i>
          </a>
        </div>

        <div class="btn-group" role="group">
          <a href="#tab-2" aria-controls="tab-2" role="tab-2" data-toggle="tab" type="button" class="btn btn-line text-capitalize">
              <span class="">
              <span class="hidden-xs"> <h2>
              <span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
                <i class="fa fa-briefcase fa-stack-1x text"></i>
              </span>
              </h2> <br> Organize, Sort & <br> Track Applicants</span><br></span>
            <i class="hidden-xs fa fa-arrow-right pull-right fa-abx fa-lg"></i>

            <i class="hidden-sm hidden-md hidden-lg fa fa-3x fa-briefcase fa-stack-1x  text"></i>
          </a>
        </div>

        <div class="btn-group" role="group">
          <a href="#tab-3" aria-controls="tab-3" role="tab-3" data-toggle="tab" type="button" class="btn btn-line text-capitalize">
              <span class="">
              <span class="hidden-xs"> <h2>
              <span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
                <i class="fa fa-pencil-square-o fa-stack-1x"></i>
              </span>
              </h2> <br> Conduct Online <br> Recruitment Tests</span><br></span>
            <i class="hidden-xs fa fa-arrow-right pull-right fa-abx fa-lg"></i>

            <i class="hidden-sm hidden-md hidden-lg fa fa-3x fa-pencil-square-o fa-stack-1x"></i>
          </a>
        </div>

        <div class="btn-group" role="group">
          <a href="#tab-4" aria-controls="tab-4" role="tab-4" data-toggle="tab" type="button" class="btn btn-line text-capitalize text-muted">
              <span class="">
              <span class="hidden-xs"> <h2>
              <span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
                <i class="fa fa-heartbeat fa-stack-1x"></i>
              </span>
              </h2> <br> Run Background & <br> Medical Checks</span><br></span>
            <i class="hidden-xs fa fa-arrow-right pull-right fa-abx fa-lg"></i>

            <i class="hidden-sm hidden-md hidden-lg fa fa-3x fa-heartbeat fa-stack-1x"></i>

          </a>
        </div>

        <div class="btn-group" role="group">
          <a href="#tab-5" aria-controls="tab-5" role="tab-5" data-toggle="tab" type="button" class="btn btn-line text-capitalize text-muted">
              <span class="">
              <span class="hidden-xs"> <h2>
              <span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
                <i class="fa fa-cloud-download fa-stack-1x"></i>
              </span>
              </h2> <br> Save & Download <br> the Entire Process</span><br></span>
            <!-- <small class="text-muted hidden-xs">Edit your settings</small> -->

            <i class="hidden-sm hidden-md hidden-lg fa fa-3x fa-cloud-download fa-stack-1x "></i>
          </a>
        </div>
      </div>

    </div>

  </section>



  <div class="tab-content no-margin">

    <section id="tab-1" role="tabpanel" class="section-tab white tab-pane active">
      <div class="container">
        <div class="row">
          <div class=" text-center">
            <!-- <h2 class="no-margin text-brandon">1</h2><br> -->
            <h2 class="text-light animated text-brandon fadeIn no-margin"><span class="text-blue">Seamlessly Attract</span> Talent From Everywhere.</h2>
            <div class="clearfix"></div>
            <hr class="hr-bg"><br>
          </div>

          <div class="col-sm-5 animated slideInLeft">
            <!-- <div class="separator separator-small hidden-xs"><br><br></div> -->
            <p class="lead text-muted">You don’t need to go from site to site to post jobs. Job posting is now seamless and simple! Create your jobs here and advertise them on various distribution channels, in just a few clicks!</p>

            <table class="table hidden">
              <thead>
              <tr>
                <th>Job Sites</th>
                <th>Newspapers</th>
                <th>Social Media</th>
                <th>Your Website</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <th scope="row">Insidify.com</th>
                <td>Guardian</td> <td>Facebook</td>
                <td>Embed</td>
              </tr>
              <tr>
                <th scope="row">Jobberman.com</th>
                <td>Punch</td>
                <td>Twitter</td>
                <td>Referral</td>
              </tr>
              <tr>
                <th scope="row">NgCareers.com</th>
                <td>Vanguard</td>
                <td>LinkedIn</td>
                <td></td>
              </tr>
              <tr>
                <th scope="row">MyJobmag.com</th>
                <td>The Nation</td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <th scope="row">PushCV.com</th>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <th scope="row">Efritin.com</th>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              </tbody>
            </table>
            <p class="">Job Sites</p>
            <ul class="list-inline">
              <li><img width="175px" src="img/newlogo.png" alt=""></li>
              <li><img width="175px" src="img/justjobs.png" alt=""></li>
              <!-- <li><img src="img/jobzilla.jpeg" alt=""></li> -->
              <li><img width="175px" src="img/logo6.png" alt=""></li>
              <li><img width="175px" src="img/jobzilla.jpg" alt=""></li>
              <!-- <li><img width="75px" src="img/careers24.jpeg" alt=""></li> -->
            </ul>
            <p class="hidden">Newspapers</p>
            <ul class="list-inline">
              <li><img src="" alt=""></li>
              <li><img src="" alt=""></li>
              <li><img src="" alt=""></li>
            </ul>
            <p class="hidden">Social Media</p>
            <ul class="list-inline hidden">
              <li href="https://www.facebook.com/insidifyhq?ref=hl&ref_type=bookmark" class="">
                         <span class="fa-stack fa-2x">
                           <i class="fa fa-circle fa-stack-2x text-"  style="color:#3b5998"></i>
                           <i class="fa fa-facebook fa-stack-1x fa-inverse" ></i>
                         </span>
              </li>

              <li href="https://twitter.com/insidifyhq" class="">
                         <span class="fa-stack fa-2x">
                           <i class="fa fa-circle fa-stack-2x text-"  style="color:#0084b4"></i>
                           <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                         </span>
              </li>

              <li href="https://www.linkedin.com/company/insidify-com?trk=biz-companies-cym" class="">
                         <span class="fa-stack fa-2x">
                           <i class="fa fa-circle fa-stack-2x text-primary"></i>
                           <i class="fa fa-linkedin fa-stack-1x fa-inverse"></i>
                         </span>
              </li>
            </ul>
            <!-- <p><i class="fa fa-plus"></i> Your Website</p>
            <ul class="list-inline">
              <li><img src="" alt=""></li>
              <li><img src="" alt=""></li>
              <li><img src="" alt=""></li>
            </ul> -->
          </div>
          <div class="col-sm-5 col-sm-offset-1 animated slideInRight">
            <img src="img/ats-1.jpg" width="100%" alt="">
          </div>
          <div class="col-sm-12 text-center"><br>
            <a href="#tab-2" aria-controls="tab-2" role="tab-2" data-toggle="tab" type="button" class=" btn btn-lg btn-line text-capitalize">Next &nbsp; <i class="fa fa-chevron-right"></i></a>

          </div>
        </div>
      </div>
    </section>

    <section id="tab-2" role="tabpanel" class="section-tab white tab-pane">
      <div class="container">

        <div class="row">

          <div class=" text-center">
            <!-- <h2 class="no-margin text-brandon">1</h2><br> -->
            <h2 class="text-light animated text-brandon fadeIn no-margin">Tracking Applicants is now <span class="text-blue">unbelievably easy!</span></h2>
            <div class="clearfix"></div>
            <hr class="hr-bg"><br>
          </div>

          <div class="col-sm-6 animated slideInLeft">
            <div class="separator separator-small hidden-xs"><br><br></div>

            <p class="lead text-muted">You will see that the ease and speed with which you’ll be able to find the best candidates and run through the entire recruitment process is almost magical!</p>

            <p class=""><ul class="list-unstyled">
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Sort and filter based on almost any criteria</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Move candidates along the recruitment channel</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Recruit with your team</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Make notes and comments on candidates</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Schedule interviews</li>
            </ul></p>

          </div>
          <div class="col-sm-6 animated zoomIn">
            <img src="img/ats-2.jpg" width="100%" alt="">
          </div>
          <div class="col-sm-12"><br>
            <a href="#tab-1" aria-controls="tab-1" role="tab-1" data-toggle="tab" type="button" class="btn-lg btn btn-line text-capitalize"><i class="fa fa-chevron-left"></i> &nbsp; Previous</a>
            <a href="#tab-3" aria-controls="tab-3" role="tab-3" data-toggle="tab" type="button" class="pull-right btn btn-lg btn-line text-capitalize">Next &nbsp; <i class="fa fa-chevron-right"></i></a>
          </div>
        </div></div>
    </section>

    <section id="tab-3" role="tabpanel" class="section-tab white tab-pane">
      <div class="container">

        <div class="row">
          <div class=" text-center">
            <!-- <h2 class="no-margin text-brandon">1</h2><br> -->
            <h2 class="text-light animated text-brandon fadeIn no-margin"><span class="text-blue">Sieve the Best </span> from the Rest, seamlessly!</h2>
            <div class="clearfix"></div>
            <hr class="hr-bg"><br>
          </div>

          <div class="col-sm-6 animated slideInLeft">
            <p class="lead text-muted">Choose from several tests or upload yours seamlessly with our Applicant Testing Technology.</p>

            <p class=""><ul class="list-unstyled">
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; IQ Tests</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Aptitude Tests</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Personality Tests</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Skill Tests</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Upload your own Test</li>
            </ul></p><br>

            <p>With our e-invigilator technology, thousands of candidates can take your tests with ease on their phones, tabs and computers anywhere in the world and you get the results instantly.</p>


          </div>
          <div class="col-sm-5 col-sm-offset-1 animated slideInRight">
            <img src="img/ats-3.jpg" width="100%" alt="">
          </div>
          <div class="clearfix"></div>
          <br>
          <div class="col-sm-12">
            <div class="">
              <a href="#tab-2" aria-controls="tab-2" role="tab-2" data-toggle="tab" type="button" class=" btn btn-lg btn-line text-capitalize"><i class="fa fa-chevron-left"></i> &nbsp; Previous</a>
              <a href="#tab-4" aria-controls="tab-4" role="tab-4" data-toggle="tab" type="button" class="pull-right btn btn-lg btn-line text-capitalize">Next &nbsp; <i class="fa fa-chevron-right"></i></a>
            </div>
          </div>
        </div></div>
    </section>

    <section id="tab-4" role="tabpanel" class="section-tab white tab-pane">
      <div class="container">

        <div class="row">
          <div class="col-sm-12 animated fadeIn text-center">
            <!-- <h2 class="no-margin text-brandon">1</h2><br> -->
            <h2 class="no-margin text-brandon text-light"><span class="text-blue">Run Background and Medical Checks</h2>
            <div class="clearfix"></div>
            <hr class="hr-bg">
            <p class="lead text-muted">We have partnered with Background Check International, Mecure Healthcare and St. Nicholas Hospital to provide you with full background and medical checks in just a few clicks. Upon ordering these checks, our partners will fulfil the entire process, while you simply get the results – in record time!</p>

            <hr class="hr-bg">
          </div>

          <div class="col-sm-4 animated zoomIn">

            <p class="text-brandon text-danger">Background Checks</p>

            <p class=""><ul class="list-unstyled">
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Academic Certificate Verfication</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Previous Employment</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Professional Certificate Verification</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; WAEC Certificate Verification</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Personal Reference Check</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Address Confirmation</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Credit Check</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Criminal Record Check</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; NYSC Certificate Verification</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Criminal Check</li>
            </ul></p><br>

          </div>



          <div class="col-sm-4 animated zoomIn">

            <p class="text-brandon text-danger">Medical Checks</p>

            <p class=""><ul class="list-unstyled">
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Full Medical History</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Vital Signs</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Blood Group</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Genotype</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Retroviral Screening V1&2</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Hepatitis B sAg</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Pregnancy Test</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Urinalysis: Colour, appearance and pH</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Chest X-ray</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; ECG</li>
            </ul></p><br>

          </div>

          <div class="col-sm-4 animated zoomIn">
            <img src="img/bci.jpg" width="100%" alt="">
          </div>

          <div class="clearfix"></div><br>

          <div class="col-sm-12">
            <a href="#tab-3" aria-controls="tab-3" role="tab-3" data-toggle="tab" type="button" class="btn-lg btn btn-line text-capitalize"><i class="fa fa-chevron-left"></i> &nbsp; Previous</a>
            <a href="#tab-5" aria-controls="tab-5" role="tab-5" data-toggle="tab" type="button" class="pull-right btn-lg btn btn-line text-capitalize">Next &nbsp; <i class="fa fa-chevron-right"></i></a>
          </div>


          </p>

        </div>


      </div>
    </section>

    <section id="tab-5" role="tabpanel" class="section-tab white tab-pane">
      <div class="container">

        <div class="row">
          <div class=" text-center">
            <!-- <h2 class="no-margin text-brandon">1</h2><br> -->
            <h2 class="animated fadeIn col-sm-12 no-margin text-brandon text-light"><span class="text-blue">Save and Download</span> the Entire Process</h2>
            <div class="clearfix"></div>
            <hr class="hr-bg"><br></div>

          <div class="col-sm-6 animated slideInLeft">
            <p class="lead text-muted">Because you hired seamlessly from A to Z, you have won yourself the right to download the entire recruitment process seamlessly!</p>

            <p>For each of your candidates, you can download:</p>

            <p class=""><ul class="list-unstyled">
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; The CV</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Cover Letter</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Team Comments and Reviews</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Test Results</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Interview notes</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Background Check Reports</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Medical Test Reports</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Messages and Interactions</li>
              <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Statistics.</li>
            </ul></p><br>


          </div>
          <div class="col-sm-6 hidden-xs animated slideInRight">
            <img src="img/ats-5.jpg" width="100%" alt="">
          </div>

          <div class="col-sm-12 text-center"><br>

            <p class="text-center"><br>
              <a href="{{ url('register') }}" class="btn btn-success btn-lg">Great? Get Started!</a>
            </p>

          </div>

        </div></div>
    </section>
  </div>

  <section class="no-pad white">

  </section>

  <section id="sec-seamless" class="grey">
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-md-offset-1 text-center">
          <h1 class=" text- text-brandon"><i class="fa text-blue fa-play-circle"></i> &nbsp;Video Job Posting</h1>
          <p class="l-sp-5">SELL YOUR BRAND TO APPLICANTS EXCLUSIVELY!</p>
          <div class="col-xs-4 col-xs-offset-4"><hr></div>
          <div class="clearfix"></div>
          <p class="lead" data-wow-duration="1s">Our 1st-in-Africa SeamlessHiring video job posting feature provides you with a personal, more human way to introduce your company, role details, expectations and other valuable information to job seekers. Now, you can exclusively sell your brand and workplace culture to prospective applicants.</p>
          <br>
        </div>
        <div class="clearfix"></div>
        <div class="pad pad-xs"><br></div>
        <div class="">
          <!-- <div class="col-md-6"><br>
            <img src="https://seamlesshiring.com/img/ats-2.jpg" width="100%" alt="" class="wow fadeInLeft">
          </div> -->
          <div class="col-md-12">
            <div class="well blue-bg text-dark well-lg  fadeInRight wow fadeInRight animated">

              <h4 class="text-uppercase text-center l-sp-5 text-white">This way you get:</h4><br>


              <div class="col-sm-6">
                <div class="well well-lg h4"><i class="fa text-blue fa-2x fa-heart pull-left"></i> &nbsp; Applicants to know a lot more about your brand and actually fall in love with it.</div>
              </div>

              <div class="col-sm-6">
                <div class="well well-lg h4"><i class="fa text-blue fa-2x fa-lightbulb-o pull-left"></i> &nbsp; A chance to test the comprehension and mental prowess of your applicants through the video.</div>
              </div>

              <div class="col-sm-6">
                <div class="well well-lg h4"><i class="fa text-blue fa-2x fa-sort-amount-asc pull-left"></i> &nbsp; To sort applicants based on their performance following a test.</div>
              </div>

              <div class="col-sm-6">
                <div class="well well-lg h4"><i class="fa text-blue fa-2x fa-street-view pull-left"></i> &nbsp; To choose from a pool of successful candidates who already love your brand.</div>
              </div>

              <!-- <div class="col-md-12 text-center">
                <img src="img/screen-vid.png" width="75%" alt="">
              </div> -->

              <div class="clearfix"></div><br>
            </div>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="pad pad-xs"></div>
        <div class="col-xs-12">
          <br>
          <p class="text-center lsp3 text-lighter wow fadeInUp"><a href="{{ url('register') }}" class=" btn btn-success btn-lg">Start Posting </a></p>
        </div>
      </div>
    </div>
  </section>
  <section class="white">
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-md-offset-1 text-center">
          <h1 class=" text-brandon"><i class="fa text-green fa-users"></i> &nbsp;Team Recruitment</h1>
          <p class="l-sp-5">HIRE COLLABORATIVELY WITH YOUR TEAM </p>
          <div class="col-xs-4 col-xs-offset-4"><hr></div>
          <div class="clearfix"></div>
          <p class="lead" data-wow-duration="1s">There is no limit to the number of team members you can invite to join you in hiring the best. Every team member has their own dedicated account and login access to view and track applicants and carry out other specified functions within the recruitment process.</p>
          <br>
        </div>
        <div class="clearfix"></div>
        <div class="pad pad-xs"><br></div>
        <div class="col-md-8 col-md-offset-2 text-center">
          <div class="row">
            <div class="col-sm-3 col-xs-6"><img class="img-circle" height="100px" width="100px" src="https://cdn.insidify.com/dist/img/faces/001-avatar-2.png" alt=""></div>
            <div class="col-sm-3 col-xs-6"><img class="img-circle" height="100px" width="100px" src="https://cdn.insidify.com/dist/img/faces/008-social-5.png" alt=""></div>
            <div class="col-sm-3 col-xs-6"><img class="img-circle" height="100px" width="100px" src="https://cdn.insidify.com/dist/img/faces/005-social-8.png" alt=""></div>
            <div class="col-sm-3 col-xs-6"><img class="img-circle" height="100px" width="100px" src="https://cdn.insidify.com/dist/img/faces/004-avatar.png" alt=""></div>
          </div>
          <div class="clearfix"></div>
          <div class="separator separator-small hidden-xs"><br></div>
          <div class="row">
            <div class="col-sm-3 col-xs-6"><img class="img-circle" height="100px" width="100px" src="https://cdn.insidify.com/dist/img/faces/002-avatar-1.png" alt=""></div>
            <div class="col-sm-3 col-xs-6"><img class="img-circle" height="100px" width="100px" src="https://cdn.insidify.com/dist/img/faces/016-people.png" alt=""></div>
            <div class="col-sm-3 col-xs-6"><img class="img-circle" height="100px" width="100px" src="https://cdn.insidify.com/dist/img/faces/010-social-3.png" alt=""></div>
            <div class="col-sm-3 col-xs-6"><img class="img-circle" height="100px" width="100px" src="https://cdn.insidify.com/dist/img/faces/add-circular-button.png" alt=""></div>
          </div>
          <div class="row">

          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="grey">
    <div class="container-fluid text-center">
      <div class="row">
        <div class="col-md-10 col-md-offset-1 text-center">
          <h1 class="text-brandon no-top-margin"><i class="text-blue fa fa-building"></i> &nbsp;They Trust Us</h1>
          <p class="text-uppercase l-sp-5">Join Top Companies using SeamlessHiring</p>
          <div class="col-xs-4 col-xs-offset-4"><hr></div>
          <div class="clearfix"></div>
          <div id="brandSlider" class="owl-carousel owl-theme companies">
            <div class="item">
              <h1 class="text-center no-bottom-margin"><img src="{{asset('img/tib-logo.png')}}" alt="" height="auto" width="auto"></h1>
            </div>
            <div class="item">
              <h1 class="text-center no-bottom-margin"><img src="{{asset('img/cpr-logo.png')}}" alt="" height="auto" width="auto"></h1>
            </div>
            <div class="item">
              <h1 class="text-center no-bottom-margin"><img src="{{asset('img/fmcl-logo.png')}}" alt="" height="auto" width="auto"></h1>
            </div>
            <div class="item">
              <h1 class="text-center no-bottom-margin"><img src="{{asset('img/vla-logo.png')}}" alt="" height="auto" width="auto"></h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="s-div dark no-margin">
    <div class="container">
      <br>
      <div class="row text-center">
        <div class="col-sm-12">
          <p class="lead text-brandon text-white">Recruitment Made Unbelievably Easy.</p>
          <a href="{{ url('register') }}" class="btn btn-success btn-lg"> Get Started for Free! &nbsp; <i class="fa fa-chevron-right"></i></a>
        </div>
      </div><div class="clearfix"><br></div>
      <br>
    </div>
  </section>
  <script>
      $("a[data-toggle='tab']").click(function() {
          $('html,body').animate({
                  scrollTop: $(".navituder").offset().top},
              'slow');
      });
  </script>
  <script>
    $(document).ready(function() {
       $('#brandSlider').owlCarousel({
           items:3,
           dots: false,
           loop:true,
           margin:40,
           autoplay:true,
           autoplayTimeout:2000,
           autoplayHover: false
       });
    });
  </script>
@endsection