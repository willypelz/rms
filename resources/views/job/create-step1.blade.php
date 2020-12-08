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

                            <div class="col-md-8 col-md-offset-2">
                                <!-- <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio voluptatibus magni officiis id error numquam.</p> -->
                                <form class="job-details" id="myForm" role="job-details" method="post">

                                    <div class="text-center">
                                        <h4>Add your job description details here</h4>
                                        <br>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="job-loc">Job Title
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="job_title" class="form-control" required>
                                                <small>e.g. Marketer at a Non-Bank Financial Institution</small>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="job-title">
                                                    Location
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <select required
                                                        name="job_location"
                                                        id="location"
                                                        class="form-control"
                                                        type="text"
                                                        style="width: 303px;">
                                                    <option value="">--choose state--</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-6">
                                                <label for="job-title">Job Type <span class="text-danger">*</span>
                                                </label>

                                                <select name="job_type" id="job_level" required type="text" class="form-control">
                                                    <option value=""> --Choose--</option>
                                                    <option value="full-time">Full-Time</option>
                                                    <option value="part-time">Part-Time</option>
                                                    <option value="contract">Contract</option>
                                                    <option value="intern">Internship</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">

                                            <div class="col-sm-12">
                                                <label for="job-loc">Job Level
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="position" class="form-control" required>
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
                                                    <option value="">--choose specialization</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="job-title">Expiry Date <span class="text-danger">*</span>
                                                </label>
                                                <input type="text"
                                                       name="expiry_date"
                                                       class="datepicker form-control"
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
                                                </select>
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
                                                          class="form-control"
                                                          placeholder=""
                                                          required></textarea>
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
                                                          class="form-control"
                                                          placeholder=""
                                                          required>
                                                </textarea>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <hr>
                                </div>
                                <div class="col-xs-7">
                                    <a href="/jobs/create-step2" type="submit" id="SaveDraft" class="btn job-posting-text-dark">
                                        <i class="fa fa-arrow-left"></i>
                                        Previous step
                                    </a>
                                </div>
                                <div class="col-xs-5">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button id="save-btn" data-toggle="modal" data-target="#savedAsDraft" class="btn btn-primary btn-block">
                                                Save and continue laterA
                                            </button>
                                        </div>
                                        <div class="col-sm-6">
                                            <button id="post-job-btn" type="submit" class="btn btn-success btn-block">
                                                Next
                                            </button>
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
@endsection
