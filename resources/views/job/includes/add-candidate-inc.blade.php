<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">

<div class="row">
                            
                            
            <div class="col-xs-12">
                <div class="row tab-content ">
                <div class="col-sm-12">

                @if(!empty($job)) 
                    <h1 class="text-center"><i class="fa fa-database"></i></h1>
                    <h4 class="text-center">Bring in the Databases! </h4>
                    <!-- <p class="text-center"> You can find candidates from our massive database of professionals OR from your own database.</p><hr> -->
                @else
                    <h1 class="text-center"><i class="fa fa-user-plus"></i></h1>
                    <h4 class="text-center text-green strong">Add Candidates to your Talent Pool</h4>


                @endif    
                


                    <div class="col-sm-10 col-sm-offset-1 text-center">

                    <p>
                        Do you already have relevant resumes in a folder somewhere?
                        Upload them here and add them to your pool of applicants.

                    </p><br>
                    
                        <div class="progress" style="margin-bottom:0px;display:none;">
                          <div class="progress-bar progress-bar-striped active" role="progressbar"
                          aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                            Uploading
                          </div>
                        </div>
                        <div id="loader"></div>
                        <div class="alert alert-danger" style="display:none;" id="u_f"></div>
                        <div class="alert alert-success" style="display:none;" id="u_s"></div>
                        
                       <form action="{{ route('upload-file') }}" method="post" enctype="multipart/form-data" id="uploadCandidate">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <div class="btn-group" data-toggle="buttons">

                              <!-- <label class="btn btn-line">
                                <input type="radio" name="options" id="upToFolder" autocomplete="off" value="upToFolder"> Upload to Folder
                              </label> -->

                              <!-- <label class="btn btn-line">
                                <input type="radio" name="options" id="upToJob" autocomplete="off" value="upToJob"> Upload to a Job
                              </label> -->
                            </div>
                            <br><br>
                                
                                <label class="pull-left">Select Job</label>
                                <select class="form-control job-opt " name="job">
                                    <option value="">Select Job</option>

                                    @foreach( $myJobs as $myJob )
                                        <option value="{{ $myJob['id'] }}" @if( @$job->id == $myJob['id'] ) selected="selected" @endif>{{ $myJob['title'] }}</option>
                                    @endforeach
                                </select>


                                <select class="form-control hidden folder-opt-select" name="folder">
                                    <option value="0">Select Folder</option>
                                    

                                    @foreach( $myFolders as $folder )
                                        <option value="{{ $folder }}">{{ $folder }}</option>
                                    @endforeach
                                </select>

                                <div class="btn-group folder-opt" style="display:none;">

                                  <button type="button" class="btn btn-line btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Select Folder

                                     &nbsp; <span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu" id="folders" data-folders="{{-- @implode( ':', @$cv['company_folder_id'] ) --}}" data-cv="{{-- @$cv['id'] --}}">
                                    

                                    <li role="separator" class="divider"></li>

                                    <li>
                                        <a href="javascript://"  onclick="//$('#add-folder').show();$('#add-folder').focus();" ><i class="fa fa-plus"></i> Create new</a>
                                    </li>


                                  </ul>

                                    <br><br>
                                </div> 
                                
                                <div class="form-group" id="add-folder" style="display:none;">
                                    <div class="col-xs-6 col-xs-offset-2">
                                        <input type="text" class="form-control" id="add-folder-field" />
                                    </div>
                                    
                                    <div class="col-xs-2">
                                        <button class="form-control" id="add-folder-btn" >Add</button>
                                    </div>
                                    <br><br>
                                </div>
                                
                                
                            </div>
                            
                            <div id="inputer-opt" class="well">

                                <ul class="nav nav-tabs select-type">
                                  <li class="active"><a data-toggle="tab" href="#single" data-value="single">Single Upload</a></li>
                                  <li><a data-toggle="tab" href="#bulk" data-value="bulk">Bulk Upload</a></li>
                                </ul>

                                <div class="tab-content">
                                  <div id="single" class="tab-pane fade in active">
                                    <p class="alert alert-warning">
                                        Allowed extensions are .pdf, .doc, .docx, .txt, .rtf, .pptx, .ppt
                                    </p>

                                    <div class="form-group col-xs-6">
                                        <label for="cv-name" class="pull-left">Firstname</label>
                                        <input type="text" name="cv_first_name" id=cv-name"" class="form-control" />
                                    </div>

                                    <div class="form-group col-xs-6">
                                        <label for="cv-name" class="pull-left">Lastname</label>
                                        <input type="text" name="cv_last_name" id=cv-name"" class="form-control" />
                                    </div>

                                    

                                    <div class="form-group col-xs-6">
                                        <label for="cv-name" class="pull-left">Email</label>
                                        <input type="email" name="cv_email" id=cv-email"" class="form-control" />
                                    </div>

                                    <div class="form-group col-xs-6">
                                        <label for="cv-name" class="pull-left">Phone</label>
                                        <input type="text" name="cv_phone" id=cv-phone"" class="form-control" />
                                    </div>

                                    <div class="form-group col-xs-6">
                                        <label for="gender" class="pull-left">Gender</label>
                                        {{ Form::select('gender', array('Male' => 'Male', 'Female' => 'Female'), 'null', array('placeholder'=>'choose', 'class'=>'form-control', 'required')) }}
                                    </div>


                                    <div class="form-group col-xs-6">
                                        <label for="location" class="pull-left">Current Location</label>
                                        {{ Form::select('location', $states, 'null', array('placeholder'=>'choose', 'class'=>'form-control', 'required')) }}
                                    </div>

                                    <div class="form-group col-xs-6">
                                        <label for="highest_qualification" class="pull-left">Highest Qualification</label>
                                        {{ Form::select('highest_qualification', $qualifications, 'null', array('placeholder'=>'choose', 'class'=>'form-control', 'required')) }}
                                    </div>

                                    <div class="form-group col-xs-6">
                                        <label for="graduation_grade" class="pull-left">Graduation Grade</label>
                                        {{ Form::select('graduation_grade', $grades, 'null', array('placeholder'=>'choose', 'class'=>'form-control', 'required')) }}
                                    </div>

                                    <div class="form-group col-xs-6">
                                        <label for="years_of_experience" class="pull-left">Years of experience</label>
                                        <select name="years_of_experience" class="form-control">
                                            @for($i = 1; $i <= 50; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>


                                    <div class="form-group col-xs-6">
                                        <label for="last_company_worked" class="pull-left">Last Company Worked</label>
                                        {{ Form::text('last_company_worked', null, array('class'=>'form-control', 'required' => 'required')) }}
                                    </div>


                                    <div class="form-group col-xs-6">
                                        <label for="last_position" class="pull-left">Last Position</label>
                                        {{ Form::text('last_position', null, array('class'=>'form-control', 'required' => 'required')) }}
                                    </div>

                                    <div class="form-group text-left col-xs-6">
                                        <label for="willing_to_relocate">Willing to relocate?</label><br/>
                                        <label>{{ Form::radio('willing_to_relocate', 'yes',  false, ['required']) }} Yes</label>
                                        <label>{{ Form::radio('willing_to_relocate', 'no',  false, ['required']) }} No </label>
                                    </div>
                                    <div class="clearfix"></div>
                                    

                                    

                                  </div>
                                  <div id="bulk" class="tab-pane fade">
                                    <p class="">
                                        Please name each file in the archive the candidate's name
                                    </p>
                                    <p class="alert alert-warning">
                                        Allowed extensions are .zip
                                    </p>

                                  </div>
                                </div><br>

                                <input type="hidden" name="type" id="type" value="single" >

                                <div class="form-group fileinput fileinput-new input-group" data-provides="fileinput">
                                  <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>

                                  <span class="input-group-addon btn btn-primary btn-file text-white"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span>
                                    <input type="file" name="cv-upload-file" placeholder="zip"  accept=".zip,.pdf,.doc,.docx,.txt,.rtf,.pptx,.ppt">
                                  </span>
                                  <a href="#" class="input-group-addon  fileinput-exists btn btn-danger" style="    background-color: #d9534f; color:white;" data-dismiss="fileinput">Remove</a>
                                  
                                </div><br>

                                <button type="submit" class="btn btn-success text-capitalize">
                                        <i class="fa fa-file-text-o"></i>&nbsp; <span class="hidden-xs">Import file</span>
                                </button>

                            </div>
                        </form>

                        <div id="funcMsg" class="text text-successs"></div>

                        
                    </div>


                    @if(!empty($job))     
                    <div class="col-sm-5 col-sm-offset-2 hidden">
                        <div class="alert alert-success text-right">
                            <h4>We found 6315 applicants that match your job.</h4><br>

                        <a href="{{ route('job-board', [@$job->id]) }}" type="button" class="btn btn-success text-capitalize pull-right">See CVs that Match your Job</a>

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
                        
                        <div class="col-sm-12 text-center"><hr><a href="{{ route('job-board', @$job->id) }}" class="btn btn-line btn-cart-checkout">Go to Job Dashboard &raquo;</a></div>

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

        $('.select-type a').on('click',function(){
            $('#type').val( $(this).data('value') );
        });
        $('#uploadCandidate').ajaxForm({ 
                headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() },
                beforeSubmit:beforeUpload,
                success:showResponse
        });

        /*$('#upToFolder').on('click', function(){
            $('.job-opt').hide();
            $('.folder-opt').show();

            console.log( "Show Folder", $('.job-opt'), $('.folder-opt') );
        });

        $('#upToJob').on('click', function(){
            $('.folder-opt').hide();
            $('.job-opt').show();
            console.log( "Show Job", $('.job-opt'), $('.folder-opt') );
        });
*/
        $('input[name="options"]').on('change', function(){
            console.log( $(this).val() );
            if( $(this).val() == 'upToFolder' )
            {
                $('.job-opt').hide();
                $('.folder-opt').show();
                // $('#add-folder').show();
            }

            if( $(this).val() == 'upToJob' )
            {
                $('.folder-opt').hide();
                $('#add-folder').hide();
                $('.job-opt').show();
            }

            
                
        });

        $('.job-opt').on('change', function(){
            if( $(this).val() != '' ){
                $('#inputer-opt').show();
            }
            else
            {
                $('#inputer-opt').hide();
            }

        });

        $('#folders').on('click', 'a#folder-item', function(){

            $('body #folder-selector-mark').remove();
            $(this).prepend('<i id="folder-selector-mark" class="fa fa-check"></i>');
            $('.folder-opt-select').val( $(this).text() );
            $('#inputer-opt').show();

        });

        $('#add-folder-btn').on('click', function(e){
            e.preventDefault();
            if( $('#add-folder-field').val() != '' )
            {
                // $('#add-folder-btn').val();
                $('.folder-opt-select').append( '<option selected="selected" value="' + $('#add-folder-field').val() + '">' + $('#add-folder-field').val() + '</option>' );
                $('#folders').prepend( '<li><a id="folder-item" href="javascript://" >' + $('#add-folder-field').val() + '</a></li>' );
                $('#add-folder-field').val('');
                $('#add-folder').hide();
            }
            
        });
    });
          

                    function beforeUpload(){
                        $('#u_f').hide();
                        $('#u_s').hide();

                        $("#loader").html( '{!! preloader() !!}' );
                        $(".progress").show();
                        
                    }

                    function showResponse(response){

                        $("#loader").html( '' );
                       

                        if(response.status)
                        {
                            
                            $('#u_s').text( response.data ).show();
                        }
                        else
                        {
                            $('#u_f').text( response.data ).show();
                        }

                        $(".progress").hide();
                        

                        // $.growl.notice({ message: "The file uploaded is being parsed. You will have access to it in within 48 hours" });

                        // $('#u_s').text( "You will receive email notification once successfully uploaded" ).show();
                    }


</script>
