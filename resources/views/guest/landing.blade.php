@extends('layout.template-default')

@section('content')
<!-- <an-ins an-type="EVENT" an-data="{id:9}" an-action="PAGE_LOADED"></an-ins> -->
<section class="s-div dark homepage">
        <div class="container">

           <div class="row">
                <div class="col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">
                    <div class="pagehead text-white text-center"> 
                        <!-- <img src="" alt="SeamlessHiring logo" width="100%"> -->
                        <!-- <i class="fa fa-skype fa-inverse fa-5x hidden-sm"></i>&nbsp;  -->
                        <div class="separator separator-small"><br></div>                        
                       <div class="separator separator-small hidden-xs"></div>

                       <h1 class="fa-3x no-margin bold hidden-xs text-brandon text-light"><span class="text-green-light">Everything</span> You Need To Hire, <br>In One Place!</h1>
                       <h1 class=" hidden-sm hidden-md hidden-lg no-margin  text-brandon text-light"><span class="text-green-light">Everything</span> You Need To Hire, <br>In One Place!</h1>

                       <!-- <p class="p-banner text-light"><br>Broadcast jobs everywhere <span>&nbsp; &xrarr; &nbsp;</span> Collate, Filter and Sort Applicants <span>&nbsp; &xrarr; &nbsp;</span> Track the Recruitment Process <span>&nbsp; &xrarr; &nbsp;</span> Conduct Online Recruitment Tests <span>&nbsp; &xrarr; &nbsp;</span> Run background Checks <span>&nbsp; &xrarr; &nbsp;</span> Do a lot more!</p> -->
                       <div class="row">
                           <!-- <div class="col-sm-12 col-md-6 col-sm-8">
                               <a href="" class="btn btn-success btn-block btn-lg text-uppercase text-bold">No Dulling. Start Now <i class="fa fa-chevron-right"></i></a>
                               </div> -->
                        <form action="{{ url('cv/search') }}" class="form-group">
                        <br class="hidden-xs">
                           <div class="form-lg hidden-xs">
                             <div class="col-sm-8">
                               <div class="row"><input placeholder="e.g Accountant, Lagos" class="form-control input-lg input-talent" name="search_query" type="text"></div>
                             </div>
                             <div class="col-sm-4">
                               <div class="row"><button type="submit" class="btn btn-lg btn-block btn-success btn-talent">Find Candidates &nbsp; <span class="hidden-xs"><i class="fa fa-chevron-right"></i></span></button></div>
                             </div>
                           </div>
                        </form>

                           <div class="form-sm hidden-sm hidden-md hidden-lg">
                              <form action="{{ url('cv/search') }}" class="form-group">
                             <div class="col-sm-8">
                               <div class="">
                                <input placeholder="e.g Accountant, Lagos" class="form-control input-lg" name="search_query"  type="text"></div>
                             </div>
                             <div class="col-sm-4">
                               <div class=""><button type="submit" style="padding:10px 0" class="no-bod-rad btn btn-block btn-warning no-bod-rad">Find Candidates &nbsp; <i class="fa fa-chevron-right"></i></button></div>
                             </div>
                             </form>
                           </div>

                        <div class="col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2 hidden-xs">
                              <div class="separator separator-small"></div>
                              <!-- <p class="text-center fa-3x">&#9661;</p> -->
                              <div class="col-sm-7">
                                <a href="" class=" collapse btn btn-block btn-line text-white"><i class="fa fa-cloud-download"></i> &nbsp; Download Brochure</a>
                                <br class="hidden-sm hidden-md hidden-lg">
                              </div>
                              <div class="col-sm-5">
                                <a href="#features" class=" collapse btn btn-block btn-line text-white"><i class="fa fa-bars"></i> &nbsp; Learn More</a>
                                <span id="features" name="features"></span>
                              </div>
                              <div class="clearfix"></div>
                              <div class="separator separator-small"></div>
                        </div>
                        
                       </div>
                    </div>
                </div>
           </div>

        </div>
    </section>

<section class="no-pad white">

          <div class="btn-group btn-group-justified btn-tabs home-tabs no-pad no-margin" role="tab-list" aria-label="...">

            <div class="btn-group" role="group">
              <a href="#tab-1" aria-controls="tab-1" role="tab-1" data-toggle="tab" type="button" class="btn btn-line text-capitalize">
              <span class="fa-lg">
              <span class="hidden-xs text-brandon"> <h2>
              <span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
                <i class="fa fa-send fa-stack-1x"></i>
              </span>
              </h2> <br> Broadcast Jobs everywhere.</span><br></span>
              <i class="hidden-xs fa fa-arrow-right pull-right fa-abx fa-lg"></i>

                <i class="hidden-sm hidden-md hidden-lg fa fa-3x fa-send fa-stack-1x "></i>
              </a>
            </div>

            <div class="btn-group" role="group">
              <a href="#tab-2" aria-controls="tab-2" role="tab-2" data-toggle="tab" type="button" class="btn btn-line text-capitalize">
              <span class="fa-lg">
              <span class="hidden-xs text-brandon"> <h2>
              <span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
                <i class="fa fa-briefcase fa-stack-1x text"></i>
              </span>
              </h2> <br> Organize, Sort & Track Applicants</span><br></span>
              <i class="hidden-xs fa fa-arrow-right pull-right fa-abx fa-lg"></i>

                <i class="hidden-sm hidden-md hidden-lg fa fa-3x fa-briefcase fa-stack-1x  text"></i>
              </a>
            </div>

            <div class="btn-group" role="group">
              <a href="#tab-3" aria-controls="tab-3" role="tab-3" data-toggle="tab" type="button" class="btn btn-line text-capitalize">
              <span class="fa-lg">
              <span class="hidden-xs text-brandon"> <h2>
              <span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
                <i class="fa fa-pencil-square-o fa-stack-1x"></i>
              </span>
              </h2> <br> Conduct Online Recruitment Tests</span><br></span>
              <i class="hidden-xs fa fa-arrow-right pull-right fa-abx fa-lg"></i>

                <i class="hidden-sm hidden-md hidden-lg fa fa-3x fa-pencil-square-o fa-stack-1x"></i>
              </a>
            </div>

            <div class="btn-group" role="group">
              <a href="#tab-4" aria-controls="tab-4" role="tab-4" data-toggle="tab" type="button" class="btn btn-line text-capitalize text-muted">
              <span class="fa-lg">
              <span class="hidden-xs text-brandon"> <h2>
              <span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
                <i class="fa fa-heartbeat fa-stack-1x"></i>
              </span>
              </h2> <br> Run Background & Medical Checks</span><br></span>
              <i class="hidden-xs fa fa-arrow-right pull-right fa-abx fa-lg"></i> 

                <i class="hidden-sm hidden-md hidden-lg fa fa-3x fa-heartbeat fa-stack-1x"></i>

              </a>
            </div>

            <div class="btn-group" role="group">
              <a href="#tab-5" aria-controls="tab-5" role="tab-5" data-toggle="tab" type="button" class="btn btn-line text-capitalize text-muted">
              <span class="fa-lg">
              <span class="hidden-xs text-brandon"> <h2>
              <span class="fa-stack fa-lg">
                <i class="fa fa-circle fa-stack-2x fa-inverse"></i>
                <i class="fa fa-cloud-download fa-stack-1x"></i>
              </span>
              </h2> <br> Save & Download the Entire Process</span><br></span>
              <!-- <small class="text-muted hidden-xs">Edit your settings</small> -->

                <i class="hidden-sm hidden-md hidden-lg fa fa-3x fa-cloud-download fa-stack-1x "></i>
              </a>
            </div>
          </div> 
          
</section>

<div class="tab-content no-pad no-margin">
  <section id="tab-1" role="tabpanel" class="section-tab white tab-pane active">
    <div class="container">
    <div class="row">
        <div class="text-center">
        <!-- <h2 class="no-margin text-brandon">1</h2><br> -->
        <h5 class="animated fadeIn col-sm-12 no-margin text-brandon text-uppercase l-sp-5"><span class="text-orange">Seamlessly Attract</span> Talent From Everywhere.</h5>
        .
        <div class="clearfix"></div>
        <hr class="hr-bg"><br></div>
      <div class="col-sm-6 animated slideInLeft">
          <p class="lead text-muted">You don’t need to go from site to site to post jobs. Job posting is now Seamless! It’s simple! Create your jobs here and advertise them on all these channels, in just a few clicks!</p>
  
          <table class="table"> 
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
  
      </div>

      <div class="col-sm-6 animated slideInRight">
        <img src="img/ats-1.jpg" width="100%" alt="">
      </div>

      <div class="col-sm-12">
  
          <p><br>
            <div class="col-sm-6">
<!--              <a href="" class="btn btn-success text-brandon"><i class="fa fa-play"></i> &nbsp; See a Video Demonstration</a>-->
            </div>
            <div class="col-sm-6">
              <a href="#tab-2" aria-controls="tab-2" role="tab-2" data-toggle="tab" type="button" class="pull-right btn btn-line text-capitalize">Next &nbsp; <i class="fa fa-chevron-right"></i></a>
            </div>
            
          </p>
      </div>

    </div>
    </div>
  </section>
  
  <section id="tab-2" role="tabpanel" class="section-tab white tab-pane">
    <div class="container">
    
    <div class="row">
        <div class=" text-center">
        <!-- <h2 class="no-margin text-brandon">1</h2><br> -->
        <h5 class="col-sm-12 animated fadeIn no-margin text-brandon text-uppercase l-sp-5">Tracking Applicants is now <span class="text-orange">unbelievably Seamlessly easy!</span></h5>
        <div class="clearfix"></div>
        <hr class="hr-bg"><br></div>
  
      <div class="col-sm-6 animated slideInLeft">
          <p class="lead text-muted">You will see that the ease and speed with which you’ll be able to find the best candidates and run through the entire recruitment process is almost magical!</p>
  
          <p class=""><ul class="list-unstyled">
            <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Collate Applicants from everywhere</li>
            <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Sort and filter based on almost any criteria</li>
            <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Move candidates along the recruitment channel</li>
            <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Recruit with your team</li>
            <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Make notes and comments on candidates</li>
            <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Schedule interviews</li>
            <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Collate interview notes</li>
            <li class="lh-x"><i class="fa fa-check"></i> &nbsp; View several statistics on the recruitment process.</li>
          </ul></p>
  
      </div>
      <div class="col-sm-6 animated zoomIn">
        <img src="img/ats-2.jpg" width="100%" alt="">
      </div>
      <div class="col-sm-12">        
  
          <p><br>
            <div class="col-sm-6">
<!--              <a href="" class="btn btn-success"><i class="fa fa-play"></i> &nbsp; See a Video Demonstration</a>-->
            </div>
            <div class="col-sm-6">
              <a href="#tab-1" aria-controls="tab-1" role="tab-1" data-toggle="tab" type="button" class=" btn btn-line text-capitalize"><i class="fa fa-chevron-left"></i> &nbsp; Previous</a>
              <a href="#tab-3" aria-controls="tab-3" role="tab-3" data-toggle="tab" type="button" class="pull-right btn btn-line text-capitalize">Next &nbsp; <i class="fa fa-chevron-right"></i></a>
            </div>

            
          </p>


      </div>
    </div></div>
  </section>
  
  <section id="tab-3" role="tabpanel" class="section-tab white tab-pane">
    <div class="container">
    
    <div class="row">
        <div class=" text-center">
        <!-- <h2 class="no-margin text-brandon">1</h2><br> -->
        <h5 class="col-sm-12 animated fadeIn no-margin text-brandon text-uppercase l-sp-5"><span class="text-orange">Sieve the Best </span> from the Rest, seamlessly!</h5>
        <div class="clearfix"></div>
        <hr class="hr-bg"><br></div>
  
      <div class="col-sm-6 animated slideInLeft">
          <p class="lead text-muted">Choose from several Tests or upload yours seamlessly with our Applicant Testing Technology.</p>
  
          <p class=""><ul class="list-unstyled">
            <li class="lh-x"><i class="fa fa-check"></i> &nbsp; IQ Tests</li>
            <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Aptitude Tests</li>
            <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Personality Tests</li>
            <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Skill Tests</li>
            <li class="lh-x"><i class="fa fa-check"></i> &nbsp; Upload your own Test</li>
          </ul></p><br>
  
          <p>With our e-invigilator technology, thousands of candidates can take your tests with ease on their phones , tabs and computers anywhere in the world and you will get the results seamlessly, instantly.</p>
  
  
      </div>
      <div class="col-sm-5 col-sm-offset-1 animated slideInRight">
        <img src="img/ats-3.jpg" width="100%" alt="">
      </div>

      <div class="col-sm-12">
        
          <p><br>
            <div class="col-sm-6">
<!--              <a href="" class="btn btn-success"><i class="fa fa-play"></i> &nbsp; See a Video Demonstration</a>-->
            </div>
            <div class="col-sm-6">
              <a href="#tab-2" aria-controls="tab-2" role="tab-2" data-toggle="tab" type="button" class=" btn btn-line text-capitalize"><i class="fa fa-chevron-left"></i> &nbsp; Previous</a>
              <a href="#tab-4" aria-controls="tab-4" role="tab-4" data-toggle="tab" type="button" class="pull-right btn btn-line text-capitalize">Next &nbsp; <i class="fa fa-chevron-right"></i></a>
            </div>

          </p>

      </div>
    </div></div>
  </section>
  
  <section id="tab-4" role="tabpanel" class="section-tab white tab-pane">
    <div class="container">
    
    <div class="row">
        <div class="col-sm-12 animated fadeIn text-center">
        <!-- <h2 class="no-margin text-brandon">1</h2><br> -->
        <h5 class="no-margin text-brandon text-uppercase l-sp-5"><span class="text-orange">Run Background and Medical Checks</h5>
        <div class="clearfix"></div>
        <hr class="hr-bg">
          <p class="lead text-muted">We have partnered with Background Check International and Mecure Healthcare to seamlessly provide you background and medical checks just with a few clicks. After you order for these checks, our partners will fulfill the entire process and all you’ll get is results – in record time!</p>
  
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
  
      <div class="col-sm-12">
  
          <p><br>
            <div class="col-sm-6">
<!--              <a href="" class="btn btn-success"><i class="fa fa-play"></i> &nbsp; See a Video Demonstration</a>-->
            </div>
            <div class="col-sm-6">
              <a href="#tab-3" aria-controls="tab-3" role="tab-3" data-toggle="tab" type="button" class=" btn btn-line text-capitalize"><i class="fa fa-chevron-left"></i> &nbsp; Previous</a>
              <a href="#tab-5" aria-controls="tab-5" role="tab-5" data-toggle="tab" type="button" class="pull-right btn btn-line text-capitalize">Next &nbsp; <i class="fa fa-chevron-right"></i></a>
            </div>

            
            
          </p>
  
      </div>
  
  
    </div></div>
  </section>
  
  <section id="tab-5" role="tabpanel" class="section-tab white tab-pane">
    <div class="container">
    
    <div class="row">
        <div class=" text-center">
        <!-- <h2 class="no-margin text-brandon">1</h2><br> -->
        <h5 class="animated fadeIn col-sm-12 no-margin text-brandon text-uppercase l-sp-5"><span class="text-orange">Save and Download</span> the Entire Process</h5>
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
  
          <p><br>
            <a href="{{ url('register') }}" class="btn btn-danger btn-lg">Great? Get Started!</a>
          </p>
  
      </div>
      <div class="col-sm-6 animated slideInRight">
        <img src="img/ats-5.jpg" width="100%" alt="">
      </div>
    </div></div>
  </section>
</div>


<section class="s-div dark no-margin">
  <div class="container">
    <div class="row text-center">
      <div class="col-sm-12">
        <p class="lead text-brandon text-white">Recruitment Made Unbelievably Easy.</p>
        <a href="{{ url('register') }}" class="btn btn-danger btn-lg"> Get Started</a>
      </div>
    </div><div class="clearfix"><br></div>
  </div>
</section>

<script>
  $('.navbar').removeClass('navbar-fixed-top');
  $('body').addClass('no-pad');
</script>

@endsection