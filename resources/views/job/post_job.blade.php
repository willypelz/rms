@extends('layout.template-default')
@section('content')

    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <div class="separator separator-small"></div>
    <section class="no-pad">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page">
                        <div class="row">
                            <div class="col-sm-6">
                                <h5 class="no-margin l-sp-5 text-brandon text-uppercase">
                                    Create Your Job Posting
                                </h5>
                                <p>Fill in your job requirements</p>

                                @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            </div>
                            <div class="col-sm-6">
                                <div class="row progress-tabs">
                                    <div class="progress-tab active">
                                        <span class="fa-stack">
                                            <i class="fa fa-stack-2x fa-circle "></i>
                                            <span class="fa-stack-1x">1</span>
                                        </span>
                                        Job Description
                                    </div>
                                    <div class="progress-tab">
                                        <span class="fa-stack">
                                            <i class="fa fa-stack-2x fa-circle"></i>
                                            <span class="fa-stack-1x">2</span>
                                        </span>
                                        Application fields
                                    </div>
                                    <div class="progress-tab ">
                                        <span class="fa-stack">
                                            <i class="fa fa-stack-2x fa-circle"></i>
                                            <span class="fa-stack-1x">3</span>
                                        </span>
                                        Confirmation
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <hr>
                                </div>
                            </div>
                            <br>

                            <div class="col-md-8 col-md-offset-2">
                                <!-- <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio voluptatibus magni officiis id error numquam.</p> -->
                                <form action="{{ route('job-draft') }}" class="job-details" id="myForm" role="job-details" method="post">

                                    <div class="text-center">
                                        <h4>Add your job description details here</h4>
                                        <br>
                                    </div>

                                     @php
                                        $job_type = NULL;
                                        $job_title = NULL;
                                        $job_location = NULL;
                                        $job_position = NULL;
                                        $expiry_date = NULL;
                                        $workflowId = NULL;
                                        $details = NULL;
                                        $experience = NULL;
                                        $jobId = NULL;
                                        if(!is_null($job)){
                                            $job_type = $job->job_type;
                                            $job_title = $job->title;
                                            $job_position = $job->position;
                                            $job_location = $job->location;
                                            $expiry_date = $job->expiry_date;
                                            $workflowId = $job->workflow_id;
                                            $details = $job->details;
                                            $experience = $job->experience;
                                            $jobId = $job->id;
                                        }


                                    @endphp

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="job-loc">Job Title
                                                    <span style="color:red" class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="title" value="{{ $job_title }}" id="job_title" class="form-control" required>
                                                <small>e.g. Marketer at {{ get_current_company()->name }}</small>
                                            </div>

                                        </div>
                                    </div>


                                    <input type="hidden" name="job_id" value="{{ $jobId }}">

                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="job-title">
                                                    Location
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <select required
                                                        name="location"
                                                        id="location"
                                                        class="form-control job_location"
                                                        type="text"
                                                        style="width: 303px;">
                                                    <option value="">--choose state--</option>
                                                    @foreach($locations as $state)
                                                        <option value="{{ $state }}" {{ ( $job_location == $state) ? 'selected="selected"' : '' }} >{{ $state }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                                            
                                           
                                            <div class="col-sm-6">
                                                <label for="job-title">Job Type <span class="text-danger">*</span>
                                                </label>

                                                <select name="job_type" id="job_level" required type="text" class="form-control job_type" >
                                                    <option value=""> --Choose--</option>
                                                      <option value="full-time"
                                                            @if ($job_type == 'full-time') selected="selected" @endif>
                                                        Full-Time
                                                    </option>
                                                    <option value="part-time"
                                                            @if ($job_type == 'part-time') selected="selected" @endif>
                                                        Part-Time
                                                    </option>
                                                    <option value="contract"
                                                            @if ($job_type == 'contract') selected="selected" @endif>
                                                        Contract
                                                    </option>
                                                    <option value="intern"
                                                            @if ($job_type == 'intern') selected="selected" @endif>
                                                        Internship
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">

                                            <div class="col-sm-12">
                                                <label for="job-loc">Position
                                                    <span class="text-danger">*</span>
                                                </label>
                                                 <input type="text" name="position" class="form-control position"
                                                   value="{{ $job_position }}"
                                                   required>
                                                <small>e.g. Associate Marketer</small>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="job-title">Job Specialization
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <br>
                                                <select name="specializations[]" id="specialization" multiple required
                                                        class="select2" style="width: 303px;">
                                                    @foreach($specializations as $s)
                                                        <option value="{{ $s->id }}" {{ ( in_array($s->id, $job_specilizations) ) ? 'selected="selected"' : '' }}>{{ $s->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="job-title">Expiry Date <span class="text-danger">*</span>
                                                </label>
                                                <input type="text"
                                                       name="expiry_date"
                                                       value="{{ $expiry_date }}"
                                                       class="datepicker form-control expiry_date"
                                                       autocomplete="off"
                                                       required>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="workflowId">
                                                    Job Workflow
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <select name="workflow_id"
                                                        id="workflowId"
                                                        class="form-control"
                                                        style="width: 100%;"
                                                        required>
                                                    <option value="">- Select Workflow -</option>
                                                    @foreach($workflows as $workflow)
                                                        <option {{ ( $workflowId == $workflow->id) ? 'selected="selected"' : '' }} value="{{ $workflow->id }}">{{ $workflow->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div id="showWorkFlowSteps"></div>

                                            </div>
                                            <div>
                                                <input name="is_for"
                                                       id="isFor"
                                                       type="hidden"
                                                       class="form-control"
                                                       style="width: 100%;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label for="">Job Details <span class="text-danger">*</span></label>
                                                <textarea name="details"
                                                          id="editor1"
                                                          cols="30"
                                                          rows="6"
                                                          class="form-control job_details"
                                                          placeholder=""
                                                          required>{!! $details !!}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label for="">Experience<span class="text-danger">*</span></label>
                                                <textarea name="experience"
                                                          id="editor3"
                                                          cols="30"
                                                          rows="6"
                                                          class="form-control experience"
                                                          placeholder=""
                                                          required>
                                                    {!! $experience !!}
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>

                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <hr>
                                </div>
                                <div class="col-xs-7" >
                                    <a style="display: none;" href="/jobs/create-step2" type="submit" id="previous_step" class="btn job-posting-text-dark">
                                        <i class="fa fa-arrow-left"></i>
                                        Previous step
                                    </a>
                                </div>
                                <div class="col-xs-5">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a id="SaveDraft" data-toggle="modal" data-target="#savedAsDraft" class="btn btn-primary btn-block">
                                                Save and continue later
                                            </a>
                                        </div>
                                        <div class="col-sm-6">
                                            <button id="post-job-next-btn" type="submit" class="btn btn-success btn-block">
                                                Next
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="separator separator-small"></div>
                            </div>

                                </form>


                            <div class="clearfix"></div>

                            <div id="savedAsDraft" class="modal fade" tabindex="-1" role="dialog">
                                <div class="modal-dialog " role="document">
                                    <div class="modal-content">
                                        <div class="modal-body ">
                                            <div class="text-center">
                                                <br>
                                                <i class="fa fa-check text-success fa-4x"></i>
                                                <h5>Your job posting has been saved as draft</h5>
                                                <div class="pad-ft">
                                                    <button class="btn btn-success">Go to your Dashboard</button>
                                                </div>
                                            </div>

                                        </div>

                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div>
                        </div>
                    </div>
                    <!--/tab-content-->
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <div class="separator separator-small"></div>

    <script type="text/javascript">

        function checkIfWorkFlowIsSelected(){
            console.log($('#workflowId').val());
            getWorkFlowSteps($('#workflowId').val());
        }

            checkIfWorkFlowIsSelected();

        
        $('#workflowId').on('change', function() {
            getWorkFlowSteps(this.value);
        });

        function getWorkFlowSteps(Id) {
            if(Id.length){
                var url = "{{ url('settings/workflow/steps/view') }}/"+Id;
                  $.ajax({ url: url,
                    type:'GET', success:function(res){
                        $('#showWorkFlowSteps').html(res);
                    } 
                 });
            }else{
                $('#showWorkFlowSteps').html('');
            }
        }

       
        // Field ID and FieldName
        function isFormValid(fieldId, fieldName) {
            
            if (fieldId == null || fieldId == "") {
                alert(fieldName+" must be filled");
                return false;
            }
            return true;
        }


        $('#SaveDraft').click(function (e) {
            e.preventDefault();

                
            var title = $('#job_title').val();
            if (title == null || title == "") {
                alert("Title must be filled");
                return false;
            }
            var details = editor.getData();
            if (details == null || details == "") {
                alert("details must be filled");
                return false;
            }

            var location = $('.job_location option:selected').val();
            if (location == null || location == "") {
                alert("location must be filled");
                return false;
            }

            var token = $('#token').val();
            var url = "{{ route('job-draft') }}";


            var specializations = $('#specialization').val();

            var location = $('.job_location option:selected').val();
            var job_type = $('.job_type option:selected').val();
            var position = $('.position').val();
            var expiry_date = $('.expiry_date').val();
            var workflowId = $('#workflowId').val();
            var experience = exp.getData();

             $.ajax({ url: url,
                    type:'POST',
                    data: { _token: '{{ csrf_token() }}', title: title, details: details, location: location, job_type: job_type, position: position, expiry_date: expiry_date, experience: experience, specializations:specializations, workflow_id:workflowId, job_id:"{{ $jobId }}", is_ajax:'true' },
                         success:function(res){
                            if(res.status == 200){

                                if(!res.is_update){
                                    setTimeout(function(){ window.location.href = res.redirect_url; }, 1200);
                                }else{

                                }
                                
                            }
                    } 
                 });


        });


        var editor = CKEDITOR.replace('editor1');
        var exp = CKEDITOR.replace('editor3');

    </script>
@endsection
