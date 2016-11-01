<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">

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
                


                    <div class="col-sm-10 col-sm-offset-1 text-center">

                    <p>
                        Do you already have relevant resumes in a folder somewhere?
                        Upload them here and add them to your pool of applicants.

                    </p><br>
                        
                        <div id="loader"></div>
                        <div class="alert alert-danger" style="display:none;" id="u_f"></div>
                        <div class="alert alert-success" style="display:none;" id="u_s"></div>
                       <form action="{{ route('upload-file') }}" method="post" enctype="multipart/form-data" id="uploadCandidate">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <select class="form-control">
                                    <option value=""></option>

                                    @foreach( $myJobs as $job )
                                        <option value="{{ $job['id'] }}">{{ $job['title'] }}</option>
                                    @endforeach
                                </select>
                                
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group fileinput fileinput-new input-group" data-provides="fileinput">
                              <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>

                              <span class="input-group-addon btn btn-primary btn-file text-white"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span>
                                <input type="file" name="cv-upload-file" placeholder="zip" multiple="multiple" accept=".zip,.pdf,.doc,.docx,.txt,.rtf,.pptx,.ppt">
                              </span>
                              <a href="#" class="input-group-addon  fileinput-exists btn btn-danger" style="    background-color: #d9534f; color:white;" data-dismiss="fileinput">Remove</a>
                              
                            </div><br>
                            <small style="margin-top: -20px;display: block;">*Allowed extensions are .zip, .pdf, .doc, .docx, .txt, .rtf, .pptx, .ppt</small><br>

                            <button type="submit" class="btn btn-success text-capitalize">
                                    <i class="fa fa-file-text-o"></i>&nbsp; <span class="hidden-xs">Import file</span>
                            </button>
                        </form>

                        <div id="funcMsg" class="text text-successs"></div>

                        
                    </div>


                    @if(!empty($job))     
                    <div class="col-sm-5 col-sm-offset-2 hidden">
                        <div class="alert alert-success text-right">
                            <h4>We found 6315 applicants that match your job.</h4><br>

                        <a href="{{ route('job-board', [@$jobid]) }}" type="button" class="btn btn-success text-capitalize pull-right">See CVs that Match your Job</a>

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
                        
                        <div class="col-sm-12 text-center"><hr><a href="{{ route('job-board', @$jobid) }}" class="btn btn-line btn-cart-checkout">Go to Job Dashboard &raquo;</a></div>

                        @else

                        <div class="col-sm-12"><hr><a href="{{ url('cv/talent-pool') }}" class="pull-right btn btn-danger btn-cart-checkout">Go to Talent Pool &raquo;</a></div>

                        @endif

                        

                    </div>
                </div>

                

    </div>
            </div>
            <div class="clearfix"></div>
        </div>

<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script> -->
<script type="text/javascript">

    $(document).ready( function(){
        $('#uploadCandidate').ajaxForm({ 
                headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() },
                beforeSubmit:beforeUpload,
                success:showResponse
        });
    });
          

                    function beforeUpload(){
                        $('#u_f').hide();
                        $('#u_s').hide();

                        $("#loader").html( '{!! preloader() !!}' );
                    }

                    function showResponse(response){

                        $("#loader").html( '' );
                       

                        // if(response.status)
                        // {
                            
                        //     $('#u_s').text( response.data ).show();
                        // }
                        // else
                        // {
                        //     $('#u_f').text( response.data ).show();
                        // }
                        

                        // $.growl.notice({ message: "The file uploaded is being parsed. You will have access to it in within 48 hours" });

                        $('#u_s').text( "The file uploaded is being parsed. You will have access to it within 48 hours" ).show();
                    }


</script>