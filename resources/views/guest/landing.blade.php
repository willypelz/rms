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
          
</section>
@endsection