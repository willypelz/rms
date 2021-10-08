@extends('layout.template-default')
@section('content')

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
                                    <div class="progress-tab completed text-">
                                        <span class="fa-stack">
                                            <i class="fa fa-stack-2x fa-circle "></i>
                                            <span class="fa-stack-1x">1</span>
                                        </span>
                                        Job Description
                                    </div>
                                    <div class="progress-tab completed">
                                        <span class="fa-stack">
                                            <i class="fa fa-stack-2x fa-circle"></i>
                                            <span class="fa-stack-1x">2</span>
                                        </span>
                                        Application fields
                                    </div>
                                    <div class="progress-tab active">
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

                            <div class="col-md-6 col-md-offset-3">
                                <p class="fa-stack text-info">
                                    <i class="fa fa-circle-thin fa-stack-2x"></i>
                                    <span class="fa-stack-1x">1</span>
                                </p>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div>JOB TITLE <span class="text-danger">*</span></div>
                                        <h4 class="no-margin-bottom text-dark">{{ $job->title }}</h4>
                                        <br>
                                    </div>
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6">
                                        <div>LOCATION <span class="text-danger">*</span></div>
                                        <h4 class="no-margin-bottom text-dark">{{ $job->location }}</h4>
                                        <br>
                                    </div>
                                    <div class="col-sm-6">
                                        <div>JOB TYPE <span class="text-danger">*</span></div>
                                        <h4 class="no-margin-bottom text-dark">{{ ucfirst($job->job_type) }}</h4>
                                        <br>
                                    </div>
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6">
                                        <div>POSITION <span class="text-danger">*</span></div>
                                        <h4 class="no-margin-bottom text-dark"> {{ $job->position }} </h4>
                                        <br>
                                    </div>
                                    <div class="col-sm-6">
                                        <div>JOB WORKFLOW <span class="text-danger">*</span></div>
                                        <h4 class="no-margin-bottom text-dark">{{ $job->workflow->name }}</h4>
                                        <br>
                                    </div>
                                    <div class="col-sm-6"> </div>

                                    <div class="col-sm-6">
                                        <div>EXPIRY DATE <span class="text-danger">*</span></div>
                                        <h4 class="no-margin-bottom text-dark">{{ $job->expiry_date }}</h4>
                                        <br>
                                    </div>

                                    <div class="col-sm-12">
                                        <div>JOB SPECIALIZATION <span class="text-danger">*</span></div>
                                        <h4 class="no-margin-bottom text-dark">
                                            {{implode(', ', $job_specializations->toArray())}}
                                        </h4>
                                        <br>
                                    </div>
                                    <div class="col-sm-12">
                                        <div>JOB DETAILS <span class="text-danger">*</span></div>
                                        {!! $job->details !!}
                                        <br>
                                    </div>
                                    <div class="col-sm-12">
                                        <div>JOB EXPERIENCE <span class="text-danger">*</span></div>
                                        {!! $job->experience !!}
                                    </div>
                                    <br>

                                </div>

                                <br>
                                <p class="fa-stack text-info">
                                    <i class="fa fa-circle-thin fa-stack-2x"></i>
                                    <span class="fa-stack-1x">2</span>
                                </p>
                                <h3 class="no-margin">Default Fields</h3>
                                <br>

                                <div class="row">

                                    @foreach($selected_fields as $key => $field)
                                    <div class="col-sm-6">
                                        <p>
                                            @if($field->is_required)
                                                <i class="text-success fa fa-check"></i>
                                            @else
                                                <i class="text-danger fa fa-times"></i>
                                            @endif
                                            {{ str_replace('_', ' ',strtoupper($key)) }}
                                        </p>
                                    </div>
                                    @endforeach

                                </div>

                                <div class="row">
                                    <br>
                                    <h3>Custom Fields</h3>
                                    <br>
                                   @if(isset($selected_form_fields))
                                        @forelse($selected_form_fields as $key => $form)
                                            <div class="well alert-success small text-uppercase" id="custom_field_item" data-key="0">
                                                    <strong>{{ $form->name }} *</strong>
                                            </div>
                                        @empty
                                            <div class="well alert-danger small text-uppercase" id="custom_field_item" data-key="0"><i class="fa fa-question-circle fa-lg"></i> <strong>No Custom Field selected</strong></div>
                                        @endforelse

                                    @endif

                                </div>


                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <hr>
                                </div>

                                <div class="col-xs-7">
                                    <a href="{{ route('continue-draft', $job->id) }}" type="submit" id="previousStep" class="btn job-posting-text-dark">
                                        <i class="fa fa-arrow-left"></i>
                                        Previous step
                                    </a>
                                </div>

                                <div class="col-xs-5">
                                    <div class="row">
                                        <div class="col-sm-6">
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="{{ route('approve-job-post', $job->id) }}" id="post-job-btn" type="submit" class="btn btn-success btn-block">
                                                Confirm
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="separator separator-small"></div>
                            </div>
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
                                                    <a href="{{ route('dashboard') }}" class="btn btn-success">Go to your Dashboard</a>
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


@endsection
