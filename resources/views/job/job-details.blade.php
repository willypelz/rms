@extends('layout.template-guest')

<link rel="stylesheet" type="text/css" href="{{ asset('font/flaticon.css') }}">

@section('navbar')    
<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="{{ $job['title'] }}">
<meta itemprop="description" content="Apply Now / Share">
<meta itemprop="image" content="{{ asset('uploads/'.$company->logo) }}">

<!-- Twitter Card data -->
<meta name="twitter:card" content="Seamless Hiring">
<!-- <meta name="twitter:site" content="@publisher_handle"> -->
<meta name="twitter:title" content="{{ $job['title'] }}">
<meta name="twitter:description" content="Apply Now / Share">
<!-- <meta name="twitter:creator" content="@author_handle"> -->
<meta name="twitter:image" content="{{ asset('uploads/'.$company->logo) }}">
<!-- <meta name="twitter:data1" content="$3">
<meta name="twitter:label1" content="Price">
<meta name="twitter:data2" content="Black">
<meta name="twitter:label2" content="Color"> -->

<!-- Open Graph data -->
<meta property="og:title" content="{{ $job['title'] }}" />
<meta property="og:type" content="article" />
<meta property="og:url" content="{{ url($company->slug.'/job/'.$job->id.'/'.str_slug($job->title)) }}" />
<meta property="og:image" content="{{ asset('uploads/'.$company->logo) }}" />
<meta property="og:description" content="Apply Now / Share" />
<meta property="og:site_name" content="{{ url('') }}" />
<!-- <meta property="og:price:amount" content="15.00" />
<meta property="og:price:currency" content="USD" /> -->
@show()

@section('footer')    
@show()


@section('content')

    <section class="no-pad">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12">
                    <div class="">
                    <div class="separator separator-small"></div>
                        <section class="job-head blue no-margin">
                        <div class="">
                            <div class="row">
                            
                                <div class="col-sm-8 col-sm-offset-2 text-center">
                                    <small class="text-brandon l-sp-5 text-uppercase">job details</small>
                            
                                    <h2 class="job-title">
                                        {{ ucfirst( $job['title'] ) }}
                                    </h2>
                                    <hr>
                                    <ul class="list-inline text-white">
                                        <!--<li><strong>Company:</strong>&nbsp; JobAcess</li>-->
                                        <li>
                                            <strong>&nbsp;Posted:</strong>&nbsp; {{ date('D. j M, Y', strtotime($job['created_at'])) }}</li>
                                        <li>
                                            <strong>&nbsp;Expires:</strong>&nbsp; <?php echo date('d, M Y', strtotime($job['expiry_date'])) ?></li>
                                    </ul>
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
                                    <div class="col-sm-3">
                                        <a href="{{ url('job/apply/'.$job['id'].'/'.str_slug($job['title']) ) }}" class="btn btn-success btn-block">Apply for Job
                                        </a>
                                    </div>

                                        <!-- <div class="col-sm-5">
                                                <span style='color:red' id='saveMailboxResponse'></span>
                                                                                    
                                            <div class="btn-group btn-group-justified">
                                                <div class="btn-group">
                                                    <a href="" onclick="SavetoMailbox(); return false;" id="saveTomyMailbox" class="btn btn-line"> Save <span class="">to mailbox</span></a>
                                                </div>
                                                <div class="btn-group">
                                                    <a href="" class="btn btn-line" data-toggle="modal" data-target="#myModal"> Send<span class=""> to friend</span></a>
                                                </div>
                                            </div>
                                          
                                        </div> -->
                                        <div class="col-sm-4 pull-right">
                                            
                                               <p class="pull-right no-margin">
                                                    Share on &nbsp;
                                                   <a href="https://www.facebook.com/sharer/sharer.php?u={{ url($company->slug.'/job/'.$job->id.'/'.str_slug($job->title)) }}" class="" target="_blank" >
                                                           <span class="fa-stack fa-lg">
                                                             <i class="fa fa-circle fa-stack-2x text-"></i>
                                                             <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                                           </span>
                                                   </a>
                                                                                  
                                                   <a href="https://twitter.com/home?status={{ url($company->slug.'/job/'.$job->id.'/'.str_slug($job->title)) }}" class="" target="_blank" >
                                                           <span class="fa-stack fa-lg">
                                                             <i class="fa fa-circle fa-stack-2x text-"></i>
                                                             <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                                           </span>
                                                   </a>
                                                                                  
                                                   <a href="https://plus.google.com/share?url={{ url($company->slug.'/job/'.$job->id.'/'.str_slug($job->title)) }}" class="" target="_blank" >
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
<!--                                            <h6 class="text-info text-brandon text-uppercase l-sp-5 no-margin">Job details</h6>-->
<!--                                            <br>-->
                                            <div class="row">

                                                <div class="col-xs-6 col-sm-3">
                                                <small class="text-muted">Job Type</small>
                                                <br>
                                                <i class="flaticon-online-job-search"></i>
                                                <h5 class="text-uppercase text-brandon">{{ $job['job_type'] }}</h5>
                                                </div>

                                                <div class="col-xs-6 col-sm-4">
                                                <small class="text-muted">Location</small>
                                                <br>
                                                <i class="flaticon-money"></i>
                                                <h5 class="text-uppercase text-brandon">{{ $job['location'] }}</h5>
                                                </div>

                                                <div class="col-xs-12 col-sm-5">
                                                <small class="text-muted">Specialization(s)</small>
                                                <br>
                                                <i class="flaticon-diploma-1"></i>
                                                <h5 class="text-uppercase text-brandon">
                                                    <?php $specs = array_pluck( $job->specializations->toArray(), 'name' ); ?>
                                                    {{ implode( ',', $specs ) }}


                                                </h5>
                                                </div>
                                                

                                                <div class="col-xs-12">
                                                <hr><h6 class="text-info text-brandon text-uppercase l-sp-5 no-margin">Job Description</h6><hr>
                                                    {!!html_entity_decode( ucfirst( $job['details'] ) )!!}
                                                </div>

                                                <!-- <div class="col-xs-12">
                                                <hr><h6 class="text-info text-brandon text-uppercase l-sp-5 no-margin">Qualifications</h6><hr>
                                                   {!!html_entity_decode( ucfirst( $job['experience'] ) )!!}
                                                </div> -->
                                            </div>

                                            <div class="row">
                                                <div class="col-xs-12"><hr></div>

                                                <div class="col-sm-5">
                                                    <a href="{{ url('job/apply/'.$job['id'].'/'.str_slug($job['title']) ) }}" class="btn btn-success">Apply for Job</a>
                                                </div>
                                                <div class="separator separator-small"></div>
                                            </div>
                                        </div>
                                                
                                       <div class="col-sm-4">
                                            <h6 class="text-brandon text-uppercase l-sp-5 no-margin">company details</h6><br>
                                            <p class="text-muted">{{ $company->name }}</p>
                                            <p><img src="{{ $company->logo }}" alt="" width="60%"></p><br>
                                            <p class="small text-muted">{{ $company->about }}</p>
                                            <p><i class="fa fa-map-marker"></i> {{ $company->address }}</p>
                                            <!--p>
                                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4448.570052456479!2d3.3791209324273184!3d6.618898622434336!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b93a899b7c9b7%3A0x8630de71dbc44ffd!2sMagodo+GRA+Phase+II%2C+Lagos!5e0!3m2!1sen!2sng!4v1457754339276" frameborder="0" width="100%" height="200px" allowfullscreen></iframe>
                                            </p-->
                                            <p>
                                                <i class="fa fa-envelope"></i> @if( $company->is_email_visible ) {{ $company->email }} @endif  <br>
                                                <i class="fa fa-globe"></i> {{ $company->website }}
                                            </p>
                                        </div>
                                        <div class="col-sm-6 col-sm-offset-3 text-center hidden"><!-- <hr> -->
                                            <p >Powered by <a href="http://www.seamlesshiring.com"><i class="fa fa-skype"></i> SeamlessHiring</a> <br>
                                            <small class="text-muted">&copy; {{ date('Y') }}. SeamlessHiring</small></p>
                                        </div>
                                        <div class="clearfix"></div>

                                    </div>
                        
                                </div>
                                    </div>
                        
                                </div>
                                <!--/tab-content-->
                                <div class="page page-sm foot no-bod-rad">
                                    <div class="col-sm-6 col-sm-offset-3 text-center"><!-- <hr> -->
                                        <p><img src="http://cdn.insidify.com/dist/img/logos/seamlesshiring.svg" alt="" width="200px"> </p> 
                                        <p><small class="text-muted"> &nbsp;
                                        &copy; {{ date('Y') }}. Powered by <a href="http://www.seamlesshiring.com"> SeamlessHiring</a></small></p>
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



    <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Send to Friends</h4>
      </div>
      <div class="modal-body">
        <span style='color:red' id="responseData"></span>
      <form action="{{ route('send-to-friends') }}" id="SendJob">
        Email Address<br>
        <input type="text" id="inputemail"  name="emails" class="form-control" placeholder="separate with commas (,)">
        <input type="hidden"  name="jobid" value="{{ $job['id'] }}">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="SendEmailBtn" class="btn btn-primary">Send Email</button>
      </div>
    </div>
    </form>
  </div>
</div>

<script>
                    function SavetoMailbox(){

                        $('#saveTomyMailbox').html('please wait ....')
                        var url = "{{ route('savetoMailbox') }}"
                        $.ajax
                        ({
                            type: "POST",
                            url: url,
                            data: ({ rnd : Math.random() * 100000, jobid:"{{ $job['id'] }}" }),
                            success: function(response){
                                 console.log(response)
                                $('#saveMailboxResponse').html(response);
                                // $('#saveTomyMailbox').html('Save to mailbox')

                                 setTimeout(alertFunc, 1500);
                                    function alertFunc() {
                                       $('#saveMailboxResponse').html('');
                                        $('#saveTomyMailbox').html('Save to mailbox')
                                    }

                            }
                        });
                    }

                    $(document).ready(function() { 

                        
                        
                        $('#SendJob').ajaxForm({
                                beforeSubmit: genPreSubmit,
                                success: function(response){
                                // console.log(response);
                                $("#SendEmailBtn").html('Send Email');
                                $("#responseData").html(response);

                                    setTimeout(alertFunc, 1500);
                                    function alertFunc() {
                                        $('#myModal').modal('hide')
                                        $("#responseData").html('');
                                        $("#inputemail").val('');
                                    }

                                },
                                 reset: true
                         }); 

                        function genPreSubmit(){
                          console.log("We are here....");
                          $("#SendEmailBtn").html('please wait...');

                        }
                    });
</script>



<div class="separator separator-small"><br></div>


@endsection