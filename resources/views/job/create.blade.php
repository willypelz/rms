@extends('layout.template-default')

@section('content')
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
<div class="separator separator-small"></div>

    <section class="no-pad">
        <div class="container">
            <div class="row">

                <div class="col-sm-12">
                    <h5 class="no-margin text-center l-sp-5 text-brandon text-uppercase">Fill in your job details here.</h5><br>
                    <div class="page">
                        <div class="row">

                                 @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                 @endif
                            
                            <div class="col-md-8 col-md-offset-2">
                            <!-- <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio voluptatibus magni officiis id error numquam.</p> -->
                                <form class="job-details" id="myForm" role="job-details" method="post" action="{{ route('post-job') }}">
                                        
                                        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">


                                        
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12"><label for="job-title">job title <span class="text-danger">*</span></label>
                                            <input required id="job_title" type="text" name="job_title" class="form-control" {{ (Request::old('job_title')) ? ' value='. e(Request::old('job_title')) .'' : '' }}>
                                            &nbsp;&nbsp; <small>e.g. Marketer at XYZ limited</small>
                                           </div>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6"><label for="job-title">Location <span class="text-danger">*</span></label>
                                                <select name="job_location" id="location" class="select2" style="width: 303px;">
                                                    <option value="">--choose state--</option>
                                                    @foreach($locations as $state)
                                                    <option value="{{ $state }}" {{ ( @Request::old('job_location') == $state) ? 'selected="selected"' : '' }}  >{{ $state }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                             <!-- <input id="job-title" type="text" name="job_title" class="form-control" {{ (Request::old('job_title')) ? ' value='. e(Request::old('job_title')) .'' : '' }}></div> -->
                                           
                                            <div class="col-sm-6">
                                                    <label for="job-title">Job Type <span class="text-danger">*</span>
                                                    </label>
                                                    
                                                    <select name="job_type" id="job_level" required="" type="text" class="form-control">
                                                            <option value=""> --Choose-- </option>
                                                            <option value="full-time" @if (Request::old('job_type') == 'full-time') selected="selected" @endif>Full-Time</option>
                                                            <option value="part-time" @if (Request::old('job_type') == 'part-time') selected="selected" @endif>Part-Time</option>
                                                            <option value="contract" @if (Request::old('job_type') == 'contract') selected="selected" @endif>Contract</option>
                                                            <option value="intern" @if (Request::old('job_type') == 'intern') selected="selected" @endif>Internship</option>
                                                    </select>
                                            </div>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <div class="row">
                                            
                                            <div class="col-sm-12"><label for="job-loc">Position</label>
                                                <input type="text" name="position" class="form-control" value="{{ Request::old('position')}}">
                                                <small>e.g. Associate Marketer</small>

                                            </div>
                                            
                                        </div>
                                    </div>


                                     <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6"><label for="job-title">Job Specialization  <span class="text-danger">*</span></label>
                                                    <br><select name="specializations[]" id="" multiple="" required class="select2" style="width: 303px;">
                                                        <option value="">--choose specialization</option>
                                                        @foreach($specializations as $s)
                                                            <option value="{{ $s->id }}"  {{ ( @in_array($s->id,Request::old('specializations')) ) ? 'selected="selected"' : '' }}>{{ $s->name }}</option>
                                                        @endforeach
                                                    </select>
                                            </div>                                            

                                            <div class="col-sm-6">
                                                    <label for="job-title">Expiry Date <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="expiry_date" class="datepicker form-control" value="{{ Request::old('expiry_date')}}">

                                                    
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label for="">Summary <span class="text-danger">*</span></label>
                                                <textarea name="Summary" id="editor3" cols="30" rows="4" class="form-control" placeholder="">{{ (Request::old('experience')) ? ' value='. e(Request::old('experience')) .'' : '' }}</textarea>
                                            </div>
                                        </div>
                                    </div> -->
                              
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label for="">Job Details <span class="text-danger">*</span></label>
                                                <textarea name="details" id="editor1" cols="30" rows="6" class="form-control" placeholder="">{{ (Request::old('details')) ? e(Request::old('details')) : '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                   
                                   

                                    <div class="row">
                                            <div class="separator separator-small"></div>
                                        </div>
                                        <hr>
                                   

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-8 col-xs-offset-2 text-center">
                                                <label for="">Your job will be posted automatically on these free job platforms </label>
                                                <small class="text-center text-muted">We will send you an email with the links to the job adverts</small>
                                            </div>
                                            <div class="col-xs-12">
                                                <br>
                                            </div>
                                        <div class="col-xs-6">
                                            <div class="">
                                              @foreach($board1 as $b)  
                                              <label class="btn btn-line btn-sm btn-label btn-block text-left">
                                                <input type="checkbox" class="" autocomplete="off" name="boards[]" value="{{ $b['id'] }}" checked>
                                                <span class="col-xs-5"><img src="{{ $b['img'] }}" width="100%" alt=""></span>
                                                <span class="col-xs-7 text-muted" style="padding-left:0"><b>{{ $b['name'] }}</b><br>{{ $b['url'] }}</span>
                                                <span class="clearfix"></span>
                                              </label>
                                              @endforeach
                                            
                                          </div>
                                        </div>

                                        <div class="col-xs-6">
                                            <div class="">
                                                @foreach($board2 as $jb)
                                              <label class="btn btn-line btn-sm btn-label btn-block text-left">
                                                <input type="checkbox" class="" autocomplete="off" name="boards[]" value="{{ $jb['id'] }}"  checked>
                                                <span class="col-xs-5"><img src="{{ $jb['img'] }}" width="100%" alt=""></span>
                                                <span class="col-xs-7 text-muted" style="padding-left:0"><b>{{ $jb['name'] }}</b><br>{{ $jb['url'] }}</span>
                                                <span class="clearfix"></span>
                                              </label>
                                               @endforeach
                                           
                                          </div>
                                        </div>

                                        <!-- <div class="col-xs-12"><br><p class="text-center">Post this job to see more available job boards</p></div> -->

                                            <div class="col-xs-6 hidden">
                                                <div class="well no-border no-shadow">
                                                    <label for=""><i class="fa fa-folder"></i> Create Job Folder</label> &nbsp;
                                                    <!-- <textarea name="" id="" cols="30" rows="4" class="form-control" placeholder=""></textarea> -->
                                                    <input type="text" class="form-control" placeholder="e.g lawyer2-02-2016"> 
                                                    <small>(This folder will contain all Resumes / CVs and other materials submitted by candidates that apply for the Job. )</small>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">
                                    <div class="col-xs-12"><hr></div>
                                        <div class="col-xs-4">
                                            <a href="job.php" type="submit" id="SaveDraft" class="btn btn-line"><i class="fa fa-save"></i> Save as draft</a>

                                        </div>
                                        <div class="col-sm-4">
                                            <!-- <a href="job.php" target="_blank" type="submit" class="btn pull-right">Preview Job</a> -->
                                        </div>

                                        <div class="col-sm-4">
                                        <button type="submit" class="btn btn-success btn-block">Post job &raquo;</button>
                                        </div>
                                        <div class="separator separator-small"></div>
                                    </div>
                                </form>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                    <!--/tab-content-->

                </div>
            </div>
        </div>
    </section>


    
   

    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>


            <script>

              $('#SaveDraft').click(function(e){
                      e.preventDefault();
                    // $("#myForm").validate();
                    var title = $('#job_title').val()
                    if (title == null || title == "") {
                        alert("Title must be filled out");
                        return false;
                    }

                    var location = $('#location').val()
                    if (location == null || location == "") {
                        alert("location must be filled out");
                        return false;
                    }
                    var token = $('#token').val();

                    var url = "{{ route('job-draft') }}"
                     $.ajax
                    ({
                        type: "POST",
                        url: url,
                        data: ({ rnd : Math.random() * 100000, _token:token, title:title, location:location }),
                        success: function(response){
                             console.log(response)
                        }
                    });



                })

                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                $(document).ready(function(){

                  

                    $('.datepicker').datepicker({
                        format: 'mm/dd/yyyy'
                    });
                

                })
                CKEDITOR.replace( 'editor1' );
                CKEDITOR.replace( 'editor3' );
                CKEDITOR.replace( 'editor2' );
            </script>
    

<div class="separator separator-small"></div>
@endsection