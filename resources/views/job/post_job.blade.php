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
                            <form action="{{ route('job-draft') }}" class="job-details" id="myForm"
                                  role="job-details" method="post">
                                <div class="col-md-8 col-md-offset-2">
                                    <!-- <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio voluptatibus magni officiis id error numquam.</p> -->


                                    <div class="text-center">
                                        <h4>Add your job description details here</h4>
                                        <br>
                                    </div>

                                    @if ($errors->any())
                                        <ul class="alert alert-danger">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    @php
                                        $job_type = NULL;
                                        $job_title = NULL;
                                        $job_summary = NULL;
                                        $job_location = NULL;
                                        $job_position = NULL;
                                        $expiry_date = NULL;
                                        $workflowId = NULL;
                                        $details = NULL;
                                        $experience = NULL;
                                        $eligibilty = NULL;
                                        $is_private = NULL;
                                        $jobId = NULL;
                                        if(!is_null($job)){
                                            $job_type = $job->job_type;
                                            $job_title = $job->title;
                                            $job_summary = $job->summary;
                                            $job_position = $job->position;
                                            $job_location = $job->location;
                                            $expiry_date = $job->expiry_date;
                                            $workflowId = $job->workflow_id;
                                            $details = $job->details;
                                            $experience = $job->experience;
                                            $eligibilty = $job->is_for;
                                            $is_private = $job->is_private;
                                            $jobId = $job->id;
                                        }

                                        if(($job == null) && isset($thirdPartyData)){
                                          $thirdPartyData = $thirdPartyData->toArray();
                                          $job_title = isset($thirdPartyData['job']) ? $thirdPartyData['job'] : NULL;
                                          $eligibilty = isset($thirdPartyData['request_type']) ? $thirdPartyData['request_type'] : NULL;
                                          $details = isset($thirdPartyData['job_description']) ? $thirdPartyData['job_description'] : NULL;
                                        }
                                        $eligibilty = (env('RMS_STAND_ALONE')) ? "external" : NULL;
                                    @endphp

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="job-loc">Job Title
                                                    <span style="color:red" class="text-danger">*</span>
                                                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="What is the job role?"></i>
                                                </label>
                                                <input type="text" name="title" value="{{ $job_title }}" id="job_title"
                                                       class="form-control" required>
                                                <small>e.g. Marketer at {{ get_current_company()->name }}</small>
                                            </div>

                                        </div>
                                    </div>


                                    <input type="hidden" name="job_id" value="{{ $jobId }}">


                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="job-title">
                                                    Country
                                                    <span class="text-danger">*</span>
                                                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Which country is will the candidate work from?"></i>
                                                </label>
                                                <select required
                                                        name="country"
                                                        id="country"
                                                        class="form-control job_country"
                                                        type="text"
                                                        style="width: 303px;">
                                                    <option value="">--choose country--</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country }}" {{ ( $job_location == $country || (in_array($job_location,$locations) && $country == 'Nigeria')) ? 'selected="selected"' : '' }} >{{ $country }}</option>
                                                    @endforeach
                                                </select>

                                                <div class="state_section @if($errors->has('location') || (in_array($job_location,$locations) || $job_location == 'Nigeria'))  @else hidden @endif" style="margin-top: 10px">
                                                    <label for="job-title">
                                                        Location
                                                        <span class="text-danger">*</span>
                                                        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Which state is will the candidate work from?"></i>
                                                    </label>
                                                    <select required
                                                            name="location"
                                                            id="location"
                                                            class="form-control job_location"
                                                            type="text"
                                                            style="width: 303px;">
                                                        <option value="">--choose state--</option>
                                                        @foreach($locations as $state)
                                                            <option value="{{$state != 'Nigeria' ? $state : 'Across Nigeria' }}" {{ ( str_replace('Nigeria','Across Nigeria',$job_location) == $state) ? 'selected="selected"' : '' }} >{{ $state != 'Nigeria' ? $state : 'Across Nigeria' }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">


                                            <div class="col-sm-6">
                                                <label for="job-title">Job Type <span class="text-danger">*</span>
                                                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="What type of contract agreement?"></i>
                                                </label>

                                                <select name="job_type" id="job_level" required type="text"
                                                        class="form-control job_type">
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
                                                <label for="job-loc">Job Level
                                                    <span class="text-danger">*</span>
                                                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="What job level is required for this job? i.e Associate Marketer"></i>
                                                </label>
                                                <input type="text" name="position" class="form-control position"
                                                       value="{{ $job_position }}"
                                                       required>
                                                <small>e.g. Associate Marketer</small>
                                            </div>


                                            <div class="col-sm-6">
                                                <label for="job-loc">Eligibility
                                                    <span class="text-danger">*</span>
                                                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Who can apply to this job post? Internal: Within your organization. External: outside your organization"></i>
                                                </label>
                                                <select @if($eligibilty) readonly @endif name="eligibility"
                                                        class="form-control" id="is_for">
                                                    <option value=""> -- choose eligibility --</option>
                                                    <option @if ($eligibilty == 'both') selected="selected"
                                                            @endif  value="both"> BOTH
                                                    </option>
                                                    <option @if ($eligibilty == 'internal') selected="selected"
                                                            @endif value="internal"> INTERNAL
                                                    </option>
                                                    <option @if ($eligibilty == 'external') selected="selected"
                                                            @endif selected value="external"> EXTERNAL
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="job-title">Expiry Date <span class="text-danger">*</span>
                                                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="What is the closing date for this job post?"></i>
                                                </label>
                                                <input type="text"
                                                       name="expiry_date"
                                                       value="{{ $expiry_date }}"
                                                       class="datepicker form-control expiry_date"
                                                       autocomplete="off"
                                                       required>
                                            </div>

                                            <div class="col-sm-6">
                                                <br>

                                                <label for="job-loc">Make job private
                                                    <input type="checkbox" id="is_private" value="true"
                                                           name="is_private" @if ($is_private == 1) checked @endif >
                                                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="When a job posting is private, only candidate with the link to the job post can apply"></i>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="job-title">Job Specialization
                                                    <span class="text-danger">*</span>
                                                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="What is the job specialization?"></i>
                                                </label>
                                                <br>
                                                <div id="specialization12">
                                                <select name="specializations[]" id="specialization" multiple required
                                                        class="select2" style="width: 100%;">
                                                    @foreach($specializations as $s)
                                                        <option value="{{ $s->id }}" {{ ( in_array($s->id, $job_specilizations) ) ? 'selected="selected"' : '' }}>
                                                            {{ $s->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                </div>
                                                <span><a data-toggle="modal" data-target="#specializationModal">Add specialization to the list</a></span>

{{--                                                <span><a href="{{ route('specialization') }}">Add specialization to the list</a></span>--}}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="workflowId">
                                                    Job Workflow
                                                    <span class="text-danger">*</span>
                                                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="What workflow should be attached to this job post?"></i>
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
                                                <!--  -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="job-loc">Job Summary
                                                    <span style="color:red" class="text-danger">*</span>
                                                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Job summary: a brief summary of what the job entails"></i>
                                                </label>
                                                <textarea name="summary" id="job_summary" class="form-control"
                                                          required=""> {{ $job_summary }}</textarea>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label for="">Job Details <span class="text-danger">*</span>
                                                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Job details: details about this job posting"></i>
                                                </label>
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
                                                <label for="">Qualification, Skills and Experience<span class="text-danger">*</span>
                                                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Job qualification, skills and experience for this job posting"></i>
                                                </label>
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
                                    <div class="col-xs-7">
                                        <a style="" href="{{ route('job-list') }}" type="submit"
                                           id="previous_step"
                                           class="btn job-posting-text-dark">
                                            <i class="fa fa-backward"></i>
                                            Cancel
                                        </a>
                                    </div>
                                    <div class="col-xs-5">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <a id="SaveDraft" data-toggle="modal" data-target="#savedAsDraft"
                                                   class="btn btn-primary btn-block submitButton">
                                                    Save and continue later
                                                </a>
                                            </div>
                                            <div class="col-sm-6">
                                                <button id="post-job-next-btn" type="submit"
                                                        class="btn btn-success btn-block submitButton">
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
                                                    <a href="{{ route('job-list') }}" class="btn btn-success">Go to job
                                                        list</a>
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
        $(document).ready(function () {
            var country = $('#country');

            country.change(function () {

                if (country.val() == 'Nigeria') {
                    $('.state_section').removeClass('hidden');
                    $('#location').prop('required', true)
                } else {
                    $('.state_section').addClass('hidden');
                    $('#location').prop('required', false)
                }
            });

            $('.submitButton').click(function () {
                if (country.val() != 'Nigeria') {
                    $('#location').prop('required', false)
                }
            })
        });

        function checkIfWorkFlowIsSelected() {
            getWorkFlowSteps($('#workflowId').val())
        }

        checkIfWorkFlowIsSelected()

        $('#workflowId').on('change', function () {
            getWorkFlowSteps(this.value)
        })

        function getWorkFlowSteps(Id) {
            if (Id.length) {
                var url = "{{ url('settings/workflow/steps/view') }}/" + Id
                $.ajax({
                    url: url,
                    type: 'GET', success: function (res) {
                        $('#showWorkFlowSteps').html(res)
                    },
                })
            } else {
                $('#showWorkFlowSteps').html('')
            }
        }

        // Field ID and FieldName
        function isFormValid(fieldId, fieldName) {

            if (fieldId == null || fieldId == '') {
                alert(fieldName + ' must be filled')
                return false
            }
            return true
        }


        $('#SaveDraft').click(function (e) {
            e.preventDefault();


            var title = $('#job_title').val();
            if (title == null || title == "") {
                alert("Title must be filled");
                return false;
            }

            var summary = $('#job_summary').val();
            if (summary == null || summary == "") {
                alert("Summary must be filled");
                return false;
            }

            var details = editor.getData();
            if (details == null || details == "") {
                alert("Details must be filled");
                return false;
            }

            var eligibilty = $('#is_for').val();
            if (eligibilty == null || eligibilty == "") {
                alert("Eligibility must be selected");
                return false;
            }

            var country = $('.job_country option:selected').val();

            if (country == null || country == "") {
                alert("country must be selected");
                return false;
            }

            var location = $('.job_location option:selected').val();
            if ((location == null || location == "") && country == 'Nigeria') {
                alert("location must be filled");
                return false;
            }


            var workflowId = $('#workflowId').val();
            if (workflowId == null || workflowId == "") {
                alert("Workflow must be selected");
                return false;
            }

            var expiry_date = $('.expiry_date').val();
            if (expiry_date == null || expiry_date == "") {
                alert("Expiry Date must be selected");
                return false;
            }


            var token = $('#token').val();
            var url = "{{ route('job-draft') }}";

            var specializations = $('#specialization').val();

            var job_type = $('.job_type option:selected').val();
            var is_for = $('#is_for option:selected').val();
            var position = $('.position').val();
            var is_private = $('#is_private').is(':checked');
            var experience = exp.getData();

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', title: title,
                    details: details, location: location, country: country,
                    eligibilty: is_for, is_private: is_private,
                    job_type: job_type, position: position,
                    expiry_date: expiry_date, experience: experience,
                    specializations: specializations, workflow_id: workflowId,
                    job_id: "{{ $jobId }}", eligibility: eligibilty,
                    summary: summary, is_ajax: 'true'
                },

                success: function (res) {
                    if (res.status == 200) {

                        if (!res.is_update) {
                            setTimeout(function () {
                                window.location.href = res.redirect_url;
                            }, 2000);
                        }
                    }
                }
            });


        });


        var editor = CKEDITOR.replace('editor1')
        var exp = CKEDITOR.replace('editor3')

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection
