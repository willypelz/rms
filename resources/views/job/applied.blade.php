@extends('layout.template-default')

@section('navbar')    
@show()

@section('footer')
@show()


@section('content')
<link href="{{ asset('css/owl.carousel.css') }}" rel="stylesheet">
<script src="{{ asset('js/owl.carousel.js') }}"></script>
<script>
    $(document).ready(function(){

      $("#owl-posts2").owlCarousel({
          navigation: true,
          items: 3,
          responsive: false,
          scrollPerPage: false,
          pagination: true,
          autoPlay: false,
          // rewindNav: false,
          navigationText: [
            "<span class='fa fa-chevron-left'></span>",
            "<span class='fa fa-chevron-right'></span>"
          ],

      });

});
</script>    

<style>footer{opacity:0;}</style>

    <section class="no-pad">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12">
                    <div class="">
                        <section class="job-head blue no-margin">
                        <div class="">
                            <div class="row">
                            
                                <div class="col-sm-8 col-sm-offset-2 text-center">
                                    <small class="text-brandon l-sp-5 text-uppercase">job title</small>
                            
                                    <h2 class="job-title">
                                        {{ $job->title }}
                                    </h2>
                                    <hr>
                                    <ul class="list-inline text-white">
                                        <!--<li><strong>Company:</strong>&nbsp; JobAcess</li>-->
                                        <li>
                                            <strong>&nbsp;Posted:</strong>&nbsp; {{ date('d M, Y', strtotime($job->post_date)) }}</li>
                                        <li>
                                            <strong>&nbsp;Expires:</strong>&nbsp; {{ date('d M, Y', strtotime($job->expiry_date)) }}</li>
                                    </ul>
                            
                                    <!-- <div class="badge badge-job badge-job-active">
                                        <small class="">
                                            <span class="glyphicon glyphicon-ok"></span>
                                            &nbsp; Job is active
                                        </small>
                                    </div> -->
                                </div>
                                <div class="clearfix"></div>
                                
                            
                            
                                </div>
                        </div>
                                
                            </section>
                        
                        <div class="row">
                        
                            <div class="col-sm-12">
                                <div class="page no-bod-rad" style="border-radius: 0 0 0 0">
                                    <div class="row">
                                    <div class=" job-cta">

                                    <div class="col-sm-5 col-sm-offset-4">
                                        
                                       <span class="">
                                           <ul class="list-inline no-margin">
                                            Share Job on  &nbsp;
                                               <li>
                                                   <a href="https://www.facebook.com/sharer/sharer.php?u={{ url($company->slug.'/job/'.$job->id.'/'.str_slug($job->title)) }}" class="" target="_blank" >
                                                           <span class="fa-stack fa-lg">
                                                             <i class="fa fa-circle fa-stack-2x text-"></i>
                                                             <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                                           </span>
                                                   </a>
                                               </li>
                                                                              
                                               <li>
                                                   <a href="https://twitter.com/home?status={{ url($company->slug.'/job/'.$job->id.'/'.str_slug($job->title)) }}" class="" target="_blank" >
                                                           <span class="fa-stack fa-lg">
                                                             <i class="fa fa-circle fa-stack-2x text-"></i>
                                                             <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                                           </span>
                                                   </a>
                                               </li>
                                                                              
                                               <li>
                                                   <a href="https://plus.google.com/share?url={{ url($company->slug.'/job/'.$job->id.'/'.str_slug($job->title)) }}" class="" target="_blank" >
                                                           <span class="fa-stack fa-lg">
                                                             <i class="fa fa-circle fa-stack-2x text-"></i>
                                                             <i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
                                                           </span>
                                                   </a>
                                               </li>
                                                                              
                                               <li>
                                                   <a href="" class="">
                                                           <span class="fa-stack fa-lg">
                                                             <i class="fa fa-circle fa-stack-2x text-"></i>
                                                             <i class="fa fa-envelope fa-stack-1x fa-inverse"></i>
                                                           </span>
                                                   </a>
                                               </li>
                                           </ul>
                                       </span>
                                    </div>
                                    <div class="clearfix"></div>
                                    </div>

                                        <div class="tab-content">
                        
                                    <div class="row">
                                        
                                         <div class="col-sm-8 col-sm-offset-2 text-center">
                                            <!-- <h6 class="text-brandon text-uppercase l-sp-5 no-margin">Application Report</h6> -->
                                            
                                            <br>
  
                                            @if( @$already_applied == true )
                                              
                                              <h3 class="text-brandon">Congratulations!</h3> 
                                              <p class="lead">Your have previously applied for this job.</p> 

                                              <p>You can <a href="https://insidify.com/register" target="_blank">Sign up</a> to <a href="https://insidify.com/" target="_blank">Insidify.com</a> to receive updates on this job and find several other jobs like this from all over the internet.</p> 

                                              <p>
                                                  <a href="https://insidify.com/register" target="_blank" class="btn btn-success btn-lg">Sign up Here</a>
                                              </p>
    

                                            @else
                                              <h3 class="text-brandon">Congratulations!</h3> 
                                              <p class="lead">Your application has been submitted.</p> 

                                              <p>You can <a href="https://insidify.com/register" target="_blank">Sign up</a> to <a href="https://insidify.com/" target="_blank">Insidify.com</a> to receive updates on this job and find several other jobs like this from all over the internet.</p> 

                                              <p>
                                                  <a href="https://insidify.com/register" target="_blank" class="btn btn-success btn-lg">Sign up Here</a>
                                              </p>

  
                                            @endif

                                            <br>
                                        </div>

                                                
                                        <div class="col-sm-5 hidden">
                                            <!-- <h6 class="text-brandon text-uppercase l-sp-5 no-margin">similar jobs</h6><br> -->

                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title"><i class="fa fa-briefcase"></i>&nbsp;
                                                    Similar Job Offers</h4>
                                                </div>
                                                <div class="panel-collapse">
                                                    <div class="panel-body">
                                                        <ul class="list-unstyled sep">
                                                        
                                                        
                                                             <li><a href="https://insidify.com/jobs/in/722461/financial-and-administrative-manager-job-at-camris-international-inc"> Financial and Administrative Manager Job at CAMRIS International, Inc. </a> <br>
                                                                    <small class="text-muted"> CAMRIS International  - </small>
                                                                </li>
                                                             <li><a href="https://insidify.com/jobs/in/721752/consortium-grants-manager-job-at-the-international-rescue-committee"> Consortium Grants Manager Job at The International Rescue Committee </a> <br>
                                                                    <small class="text-muted"> IRC - International Rescue Committee  - </small>
                                                                </li>
                                                             <li><a href="https://insidify.com/jobs/in/721947/finance-administration-manager-at-the-niger-state-community-and-social-development-agency-ngcsda"> Finance Administration Manager at the Niger State Community and Social Development Agency (NGCSDA) </a> <br>
                                                                    <small class="text-muted"> The Niger State Community and Social Development Agency (NGCSDA)  - </small>
                                                                </li>
                                                             <li><a href="https://insidify.com/jobs/in/722186/oando-nigeria-plc-recruiting"> Oando Nigeria Plc Recruiting </a> <br>
                                                                    <small class="text-muted"> Oando Plc  - </small>
                                                                </li>
                                                             <li><a href="https://insidify.com/jobs/in/722234/senior-analyst-customer-payment-solutions-job-at-first-bank-of-nigeria-fbn"> Senior Analyst, Customer Payment Solutions Job at First Bank of Nigeria (FBN) </a> <br>
                                                                    <small class="text-muted"> First Bank Nigeria (FBN)  - </small>
                                                                </li>
                                                                                                   
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-sm-12"><hr></div>


                                        <div class="col-sm-12">
                                            <h6 class="text-brandon">
                                                See some useful articles that can help your career
                                            </h6><br>
                    <div id="owl-posts2" class="hidden-sm">
                        @if( count($posts) > 0 )
                           @foreach(@$posts as $post)
                            <div class="owl-item col-sm-4">
                                <div class="panel-body text-left">
                                  <p class="post-img">
                                    <a href="https://insidify.com/discovery/{{ $post->slug }}" >
                                      <img src="https://files.insidify.com/{{ $post->picture }}" class="img-responsive" width="100%">
                                    </a>  
                                  </p>
                                  <h4 class="post-title"><a href="https://insidify.com/discovery/{{ $post->slug }}">{{ $post->title }}</a></h4>
                                  <p class="">{!! $post->summary !!} 
                                  </p>
                                  <p>
                                      <a href="https://insidify.com/discovery/{{ $post->slug }}" class="btn btn-danger">Read</a>
                                  </p>
                                </div>
                            </div>
                          @endforeach  

                        @endif
                    </div>
                                            
                                        </div>


                                        <div class="col-sm-12"><hr></div>

                                        <div class="col-sm-8 col-sm-offset-2 text-center">
                                            <!-- <h6 class="text-brandon text-uppercase l-sp-5 no-margin">Application Report</h6> -->
                                            <Br/><Br/>

                                            <p>
                                                <a href="https://insidify.com/latest-jobs-in-nigeria" target="_blank" class="btn btn-success btn-lg">See Latest Verified Jobs in Nigeria Here</a>
                                            </p><br>
                                        </div>


                                        <div class="col-sm-6 col-sm-offset-3 text-center hidden"><!-- <hr> -->
                                            <p >Powered by <a href="http://www.seamlesshiring.com"><i class="fa fa-skype"></i> SeamlessHiring</a> <br>
                                            <small class="text-muted">&copy; 2016. SeamlessHiring</small></p>
                                        </div>
                                        <div class="clearfix"></div>

                                    </div>
                        
                                    <!--<div class="panel panel-default">-->
                                    <!--<div class="panel-heading">-->
                                    <!--<h4 class="panel-title">Friends who work <p>Medical Doctor, Valuepreneur, Doer... </p></h4>-->
                                    <!--</div>-->
                                    <!--<div class="panel-collapse skill">-->
                                    <!--<div class="panel-body">-->
                                    <!--<a href="#" class="btn btn-info" role="button">CSS</a> <a href="#" class="btn btn-info" role="button">HTML</a> <a href="#" class="btn btn-info" role="button">jQuery</a>-->
                                    <!--</div>-->
                                    <!--</div>-->
                                    <!--</div>-->
                        
                                </div>
                                    </div>
                        
                                </div>
                                <!--/tab-content-->
                                <div class="page page-sm foot no-bod-rad">
                                    <div class="col-sm-6 col-sm-offset-3 text-center"><!-- <hr> -->
                                        <p>Powered by <a href="http://www.seamlesshiring.com"><i class="fa fa-skype"></i> SeamlessHiring</a> <br>
                                        <small class="text-muted">&copy; 2016. SeamlessHiring</small></p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                        
                            </div>
                            <div class="clearfix"></div>
                            <div class="separator separator-small hidden">
                                <br>
                                    <div class="col-sm-3 col-sm-offset-3">
                                        <a class="btn btn-line btn-block" href="create-job.php">Edit this Job</a>
                                    </div>
                                    <div class="col-sm-3">
                                        <a class="btn btn-danger btn-block" href="create-job.php">Unpublish this Job</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<div class="separator separator-small"><br></div>


@endsection