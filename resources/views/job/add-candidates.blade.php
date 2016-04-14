@extends('layout.template-user')

@section('content')

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">

  <div class="separator separator-small"></div>
    <section class="s-div green about hidden">
        <div class="container">

            <div class="row pagehead text-center">
                <h1>About Us</h1>
            </div>

        </div>
    </section>

    <section class="no-pad">
        <div class="container">
            <div class="row">

                <div class="col-sm-12">
                    <h4 class="no-margin text-center text-uppercase l-sp-5">Job Creation</h4><br>
                    <div class="page">

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

        <div class="row">
        </div>
                        <div class="row">
                            
                            
                            <div class="col-xs-12">
                                <div class="row tab-content ">
                                <div class="col-sm-12 text-center">

                                <h4 class="text-center">Add Candidates to this Job</h4>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                <hr>

                                    <div class="col-sm-6">
                                       <form action="{{ route('upload-file') }}" method="post"> 
                                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                              <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                              <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="..."></span>
                                              <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                            </div>

                                            <button onclick="UploadFile(); return false;" id="UploadCvFileBtn" class="btn btn-success text-capitalize">
                                                    <i class="fa fa-file-text-o"></i>&nbsp; <span class="hidden-xs">Import from file</span>
                                            </button>
                                        </form>

                                        <div id="funcMsg" style="color:red"></div>

                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni veniam cumque neque ipsum, id in, nihil sapiente et harum consequuntur expedita ea unde nulla nostrum pariatur nesciunt, dolore soluta ipsa.
                                        </p>
                                    </div>


                                    <div class="col-sm-6">
                                        <a href="job-board.php" type="button" class="btn btn-success text-capitalize"><i class="fa fa-user-md"></i>
                                            &nbsp; <span class="hidden-xs">Find Matching Candidates</span>
                                        </a><p></p>
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia suscipit, enim minus pariatur vitae eum reiciendis? Laborum quasi repudiandae ad aliquam, qui veniam ex ut at eveniet iste, facere sequi.
                                        </p>
                                    </div>

                                    <div class="col-sm-12">
                                        <hr>

                                    <h5 class="no-margin text-center text-success">
                                            <i class="fa fa-spinner fa-pulse"></i> &nbsp;
                                            Importing Candidates
                                        </h5>
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