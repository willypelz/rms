@extends('layout.template-guest')

@section('navbar')    
@show()

@section('footer')
@show()

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>


    <section class="no-pad">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12">
                    <div class="">
                        <section class="job-head blue no-margin">
                        <div class="">
                            <div class="row">
                            
                                <div class="col-sm-12 text-center">
                                    <small class="text-brandon l-sp-5 text-uppercase">Career Page</small>
                            
                                    <h2 class="job-title">
                                        {{ @$company->name }}
                                    </h2>
                                    <hr>
                                    <ul class="list-inline text-white">
                                        <!--<li><strong>Company:</strong>&nbsp; JobAcess</li>-->
                                        <li>
                                            <strong>&nbsp;{{ count(@$company->jobs) }}</strong>&nbsp; Job Opening(s)</li>
                                    </ul>
                            
                                    <button class="btn btn-success pull-right" id="get-embed" data-clipboard-text="{{ $embed }}">
                                        <small class="">
                                            <span class="glyphicon glyphicons-embed-close"></span>
                                            &nbsp; < /> &nbsp; Get Embed
                                        </small>
                                    </button>


                                    <div class="clearfix"></div>
                                    <script src="{{ asset('js/jquery-1.11.1.min.js') }}"></script>
                                    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.growl.css') }}" />

                                    <script type="text/javascript">
                                        var clipboard = new ClipboardJS('#get-embed');

                                        clipboard.on('success', function(e) {
                                            $.growl.notice({ message: "Embed copied to clipboard" });
                                            alert("Embed copied to clipboard");
                                        });
                                    </script>
                                    
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
                                                        @if( @$company->jobs )
                                                            @foreach(@$company->jobs as $job)
                                                            <li>
                                                                <h4><a href="{{ url(@$company->slug.'/job/'.$job->id.'/'.str_slug($job->title)) }}"  target="_blank">{{ $job->title }}</a>
                                                                </h4>
                                                                <div class="dt">
                                                                    <strong>Location:</strong> {{ $job->location }} .  &nbsp; 
                                                                    <strong>Posted:</strong> {{ human_time($job->created_at, 1) }}.  &nbsp; 
                                                                    <strong>Expiry:</strong>{{ human_time($job->expiry_date, 1) }}. &nbsp; 
                                                                </div>
                                                                <div class="description">
                                                                    <p>{{ str_limit(strip_tags($job->details), 200) }}</p>

                                                                        <a href="{{ url(@$company->slug.'/job/'.$job->id.'/'.str_slug($job->title)) }}"  target="_blank"><i class="fa fa-envelope"></i> Email to a friend</a> &nbsp; - &nbsp;
                                                                        <a href="{{ url(@$company->slug.'/job/'.$job->id.'/'.str_slug($job->title)) }}"  target="_blank"><i class="fa fa-edit"></i> View Job Details</a>
                                                                    </span>
                                                                </div><hr>
                                                            </li>

                                                            @endforeach
                                                        @endif
                                                       
                                            
                                                        </ul>
                                            
                                            
                                                        <!--a href="" class="btn btn-line load">
                                                            <span class="glyphicon glyphicon-repeat"></span>&nbsp; Load more</a-->
                                            
                                            </div>                                            
                                        </div>
                                                
                                        <div class="col-sm-4">
                                            <h6 class="text-brandon text-uppercase l-sp-5 no-margin">company details</h6><br>
                                            <p class="text-muted">{{ @$company->name }}</p>
                                            <p><img src="{{ @$company->logo }}" alt="" width="60%"></p><br>
                                            <p class="small text-muted" style="text-align: justify;">{{ @$company->about }}</p><br>
                                            <p><i class="fa fa-map-marker"></i> <b>Address</b></p>
                                            <p><pre style="padding: 0;word-wrap: normal;word-break: break-word;border: 0;background: none;overflow: overlay;white-space: pre-wrap;">{{ @$company->address }}</pre></p><hr>
                                            <!--p>
                                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4448.570052456479!2d3.3791209324273184!3d6.618898622434336!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b93a899b7c9b7%3A0x8630de71dbc44ffd!2sMagodo+GRA+Phase+II%2C+Lagos!5e0!3m2!1sen!2sng!4v1457754339276" frameborder="0" width="100%" height="200px" allowfullscreen></iframe>
                                            </p-->
                                            <p>
                                                <i class="fa fa-envelope"></i> {{ @$company->email }}  <br>
                                                <i class="fa fa-globe"></i> {{ @$company->website }}
                                            </p>
                                        </div>
                                        <div class="col-sm-6 col-sm-offset-3 text-center hidden"><!-- <hr> -->
                                            <p >Powered by <a href="http://www.seamlesshiring.com"><i class="fa fa-skype"></i> SeamlessHiring</a> <br>
                                            <small class="text-muted">&copy; {{ date('Y') }}. SeamlessHiring</small></p>
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
                                        <p><img src="{{ url('/') }}/img/seamlesshiring-logo.png" alt="" width="225px"> </p>
                                        <p><small class="text-muted">Powered by <a href="http://www.seamlesshiring.com"> SeamlessHiring</a> &nbsp;
                                        &copy; <?php echo date('Y') ?>. SeamlessHiring</small></p>
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
