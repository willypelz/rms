@extends('layout.template-guest')

@section('content')

<section class="s-div dark homepage">
        <div class="container">

           <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="pagehead text-white text-center"> 
                        <!-- <img src="" alt="seamless Hiring logo" width="100%"> -->
                        <!-- <i class="fa fa-skype fa-inverse fa-5x hidden-xs"></i>&nbsp;  -->
                        <div class="separator separator-small"></div>

                       <h1 class="fa-3x no-margin bold hidden-xs">About Seamless Hiring</h1>
                       <h1 class=" hidden-sm hidden-md hidden-lg no-margin bold">About Seamless Hiring</h1>

                       <p class="lead"><br>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus commodi, excepturi doloremque, eius. Nobis fugiat repellat dolor.</p>
                       <div class="row">
                           <!-- <div class="col-xs-12 col-md-6 col-sm-8">
                               <a href="" class="btn btn-success btn-block btn-lg text-uppercase text-bold">No Dulling. Start Now <i class="fa fa-chevron-right"></i></a>
                               </div> -->
                        <form action="" class="form-group"><br>
                           <div class="form-lg hidden-xs">
                             <div class="col-sm-8">
                               <div class="row"><input placeholder="Find something you want" class="form-control input-lg input-talent" type="text"></div>
                             </div>
                             <div class="col-sm-4">
                               <div class="row"><a href="" class="btn btn-lg btn-block btn-warning btn-talent">Find Candidates &nbsp; <span class="hidden-xs"><i class="fa fa-chevron-right"></i></span></a></div>
                             </div>
                           </div>

                           <div class="form-xs hidden-sm hidden-md hidden-lg">
                             <div class="col-sm-8">
                               <div class="">
                                <input placeholder="Find something you want" class="form-control input-lg" type="text"></div>
                             </div>
                             <div class="col-sm-4">
                               <div class=""><a href="" class="no-bod-rad btn btn-lg btn-block btn-warning">Find Candidates &nbsp; <i class="fa fa-chevron-right"></i></a></div>
                             </div>
                           </div>

                        </form>
                        <div class="">
                       <div class="separator separator-small hidden-xs"><br></div>
                          <p>
                            <a href="" class="btn btn-line text-white"><i class="fa fa-bars"></i> &nbsp; Learn More</a>
                            &nbsp; | &nbsp;
                            <a href="" class="btn btn-line text-white"><i class="fa fa-cloud-download"></i> &nbsp; Download Brochure</a>
                          </p>
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
                        <div class="row">
                            <div class="col-sm-7">
                                <h3>
                                    <br>Google for Jobs</h3>
                                <p>Insidify.com works like Google for jobs, collating job openings from ALL major Nigerian job sites, company career pages, newspapers and classifieds, so that you can search for all Nigerian jobs from one place!</p>
                                <p><a href="" class="btn btn-primary radius">Find a job now &nbsp; <span class="glyphicon glyphicon-chevron-right"></span></a>
                                </p>
                            </div>

                            <div class="col-sm-5">
                                <p><img src="img/brws.png" width="100%"></p>
                            </div>
                        </div>


                    </div>
                    <!--/tab-content-->

                </div>
            </div>
        </div>
    </section>
@endsection