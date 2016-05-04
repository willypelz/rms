@extends('layout.template-user')

@section('content')

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">

  <div class="separator separator-small"></div>

    <section class="no-pad">
        <div class="container">
            <div class="row">

                <div class="col-sm-12">
                    <h4 class="no-margin text-center text-brandon text-uppercase l-sp-5">
                        @if(!empty($job))   
                            Job Creation
                        @else
                            Upload CVs to Your Talent Pool
                        @endif    
                    </h4><br>
                    <div class="page">

                        
                        @if(!empty($job))    
                        <div class="btn-group btn-group-justified" role="group" aria-label="...">
                          <div class="btn-group" role="group">
                            <a href="create-job.php" type="button" class="btn btn-line text-capitalize"><i class="fa fa-file-text-o"></i>
                            &nbsp; <span class="hidden-xs">1. job details</span></a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="advertise-job.php" type="button" class="btn btn-line text-capitalize"><i class="fa fa-send"></i>
                            &nbsp; <span class="hidden-xs">2. advertise</span></a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="share-job.php" type="button" class="btn btn-line text-capitalize"><i class="fa fa-share-alt"></i>
                            &nbsp; <span class="hidden-xs">3. sharing</span></a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="addCan-job.php" type="button" class="btn btn-primary text-capitalize text-muted"><i class="fa fa-search-plus"></i>
                            &nbsp; <span class="hidden-xs">4. add candidates</span></a>
                          </div>
                        </div>
                        @endif

        <div class="row">
        </div>
                        <div class="row">
                            
                            
                            <div class="col-xs-12">
                                <div class="row tab-content ">
                                <div class="col-sm-12">

                                @if(!empty($job)) 
                                    <h4 class="text-center">Bring in the Databases! </h4>
                                    <!-- <p class="text-center"> You can find candidates from our massive database of professionals OR from your own database.</p><hr> -->
                                @else
                                    <h4 class="text-center">Add Candidates to your Talent Pool</h4>


                                @endif    
                                


                                    <div class="col-sm-6 col-sm-offset-3 text-center @if(empty($job)) col-sm-offset-3 @endif">

                                    <p>
                                        Do you already have relevant resumes in a folder somewhere?
                                        Upload them here and add them to your pool of applicants.

                                    </p><br>
                                       <form action="{{ route('upload-file') }}" method="post" class=""> 
                                            <div class="form-group fileinput fileinput-new input-group" data-provides="fileinput">
                                              <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                              <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span>
                                                <input type="file" name="cv-upload-file" placeholder="zip">
                                              </span>
                                              <a href="#" class="input-group-addon  fileinput-exists btn btn-danger" style="    background-color: #d9534f; color:white;" data-dismiss="fileinput">Remove</a>
                                            </div><br>

                                            <button onclick="UploadFile(); return false;" id="UploadCvFileBtn" class="btn btn-success text-capitalize">
                                                    <i class="fa fa-file-text-o"></i>&nbsp; <span class="hidden-xs">Import file</span>
                                            </button>
                                        </form>

                                        <div id="funcMsg" style="color:red"></div>

                                        
                                    </div>


                                    @if(!empty($job))     
                                    <div class="col-sm-5 col-sm-offset-2 hidden">
                                        <div class="alert alert-success text-right">
                                            <h4>We found 6315 applicants that match your job.</h4><br>

                                        <a href="{{ route('job-board', [$jobid]) }}" type="button" class="btn btn-success text-capitalize pull-right">See CVs that Match your Job</a>

                                        <div class="clearfix"></div>
                                        </div>
                                        <!--p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia suscipit, enim minus pariatur vitae eum reiciendis? Laborum quasi repudiandae ad aliquam, qui veniam ex ut at eveniet iste, facere sequi.
                                        </p-->
                                    </div>
                                    @endif

                                    <div class="col-sm-12 hidden">
                                        

                                        <h5 class="no-margin text-center text-success hidden">
                                            <i class="fa fa-spinner fa-pulse"></i> &nbsp;
                                            Importing Candidates
                                        </h5>


                                        @if(!empty($job)) 
                                        
                                        <div class="col-sm-12 text-center"><hr><a href="{{ route('job-board', $jobid) }}" class="btn btn-line btn-cart-checkout">Go to Job Dashboard &raquo;</a></div>

                                        @else

                                        <div class="col-sm-12"><hr><a href="{{ url('cv/talent-pool') }}" class="pull-right btn btn-danger btn-cart-checkout">Go to Talent Pool &raquo;</a></div>

                                        @endif

                                        

                                    </div>
                                </div>

                                

                    </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                    <!--/tab-content-->

                </div>
            </div>
        </div>
    </section>

    <script>
        function UploadFile(){
            // console.log('cool')
            $('#UploadCvFileBtn').text('Please wait...')
             setTimeout(after(), 3000);
        }

         function after(){
                $('#UploadCvFileBtn').text('Import from file');
                $('#funcMsg').html('Uploaded successfully');
            }


    </script>

<div class="separator separator-small"></div>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>

@endsection