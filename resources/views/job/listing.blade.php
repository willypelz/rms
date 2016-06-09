@extends('layout.template-user')

@section('navbar')    
@show()

@section('content')




    <section class="no-pad">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12">
                    <div class="">
                        <section class="job-head blue no-margin">
                        <div class="">
                            <div class="row">
                            
                                <div class="col-sm-12 text-center">
                                    <small class="text-brandon l-sp-5 text-uppercase">job board</small>
                            
                                    <h2 class="job-title">
                                            Name of Company comes here
                                    </h2>
                                    <hr>
                                    <ul class="list-inline text-white">
                                        <!--<li><strong>Company:</strong>&nbsp; JobAcess</li>-->
                                        <li>
                                            <strong>&nbsp;25</strong>&nbsp; Job Openings</li>
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
                                    <div class=" job-cta hidden">
                                        <div class="col-sm-3">
                                            <a href="" class="btn btn-success btn-block"><i class="fa fa-edit"></i> Apply <span class="">for Job</span></a>
                                        </div>
                                        <div class="col-sm-5">                                            
                                            <div class="btn-group btn-group-justified">
                                                <div class="btn-group">
                                                    <a href="" class="btn btn-line"> Save <span class="">to mailbox</span></a>
                                                </div>
                                                <div class="btn-group">
                                                    <a href="" class="btn btn-line"> Send<span class=""> to friend</span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            
                                               <p class="pull-right no-margin">
                                                    Share on &nbsp;
                                                   <a href="" class="">
                                                           <span class="fa-stack fa-lg">
                                                             <i class="fa fa-circle fa-stack-2x text-"></i>
                                                             <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                                           </span>
                                                   </a>
                                                                                  
                                                   <a href="" class="">
                                                           <span class="fa-stack fa-lg">
                                                             <i class="fa fa-circle fa-stack-2x text-"></i>
                                                             <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                                           </span>
                                                   </a>
                                                                                  
                                                   <a href="" class="">
                                                           <span class="fa-stack fa-lg">
                                                             <i class="fa fa-circle fa-stack-2x text-"></i>
                                                             <i class="fa fa-google-plus fa-stack-1x fa-inverse"></i>
                                                           </span>
                                                   </a>
                                               </p>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                        <div class="tab-content">
                        
                                    <div class="row">
                                        
                                        <div class="col-sm-8">
                                            <h6 class="text-brandon text-uppercase l-sp-5 no-margin">Job Openings</h6>
                                            <br>

                                            <div class="" id="">
                                            
                                                    <ul class="search-results">
                                                        @for($i = 0; $i < 6; $i++)
                                                        <li>
                                                            <h4><a href="{{ url('jobs/preview') }}">Security Officer in a hotel</a>
                                                            </h4>
                                                            <div class="dt">Company - Not Specified, Location: Lagos Mainland. Posted: 3 weeks ago</div>
                                                            <div class="description">
                                                                <p>Able bodied security men and women needed in a hotel. Must be smart and able to work in a corporate environment ...</p>

                                                                    <strong>Expiry:</strong>1 week to go. &nbsp; 
                                                                    <a href=""><i class="fa fa-save"></i> Save Job</a> &nbsp; - &nbsp;
                                                                    <a href=""><i class="fa fa-envelope"></i> Email to a friend</a> &nbsp; - &nbsp;
                                                                    <a href=""><i class="fa fa-edit"></i> Apply for this Job</a>
                                                                </span>
                                                            </div><hr>
                                                        </li>

                                                            <h4><a href="{{ url('jobs/preview') }}">Security Officer in a hotel</a>
                                                            </h4>
                                                            <div class="dt">Company - Not Specified, Location: Lagos Mainland. Posted: 3 weeks ago</div>
                                                            <div class="description">
                                                                <p>Able bodied security men and women needed in a hotel. Must be smart and able to work in a corporate environment ...</p>
                                                                <span class="result-details"><a href="">olx.com.ng</a> -
                                                                    <strong>Expiry:</strong>1 week to go. <a href="">Save Job</a> - <a href="">Email to a friend</a> - <a href="">Apply for this Job</a>
                                                                </span>
                                            
                                                                <span class="f-box-wrap clearfix">
                                                                    <ul class="f-box">
                                                                        <li>
                                                                            <a href="">
                                                                                <img src="img/update-poster.jpg">
                                                                            </a>
                                                                            <a href="">
                                                                                <img src="img/update-poster.jpg">
                                                                            </a>
                                                                            <a href="">
                                                                                <img src="img/update-poster.jpg">
                                                                            </a>
                                                                            <em>3 friends work</em>
                                                                        </li>
                                                                
                                                            </ul></span></div><hr>
                                                        </li>
                                                        @endfor
                                            
                                                        <li>
                                                        
                                            
                                                       
                                            
                                                        </ul>
                                            
                                            
                                                        <a href="" class="btn btn-line load">
                                                            <span class="glyphicon glyphicon-repeat"></span>&nbsp; Load more</a>
                                            
                                            </div>                                            
                                        </div>
                                                
                                        <div class="col-sm-4">
                                            <h6 class="text-brandon text-uppercase l-sp-5 no-margin">company details</h6><br>
                                            <p class="text-muted">British Council NG</p>
                                            <p><img src="https://www.britishcouncil.org.ng/profiles/solas2/themes/britishcouncil/images/desktop/logo-british-council-color.png" alt="" width="60%"></p><br>
                                            <p class="small">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus repellendus repellat, temporibus harum asperiores beatae quibusdam, corrupti, cum ipsum neque consequatur. Perspiciatis modi harum fugiat odit blanditiis ipsum, aspernatur nostrum!</p>
                                            <p><i class="fa fa-map-marker"></i> Magodo, Phase 2. Lagos</p>
                                            <p>
                                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4448.570052456479!2d3.3791209324273184!3d6.618898622434336!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b93a899b7c9b7%3A0x8630de71dbc44ffd!2sMagodo+GRA+Phase+II%2C+Lagos!5e0!3m2!1sen!2sng!4v1457754339276" frameborder="0" width="100%" height="200px" allowfullscreen></iframe>
                                            </p>
                                            <p>
                                                <i class="fa fa-envelope"></i> mail@bristishcouncil.org<br>
                                                <i class="fa fa-globe"></i> www.britishcouncil.ng
                                            </p>
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
                                        <img src="{{ url('/') }}/img/logomark2.png" alt="" width="250px">
                                        <p>Powered by <a href="http://www.seamlesshiring.com"> SeamlessHiring</a> <br>
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