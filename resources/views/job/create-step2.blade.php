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
                                    <div class="progress-tab completed">
                                        <span class="fa-stack">
                                            <i class="fa fa-stack-2x fa-circle "></i>
                                            <span class="fa-stack-1x">1</span>
                                        </span>
                                        Job Description
                                    </div>
                                    <div class="progress-tab active">
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
                                        <h4>Add your job Application Fields</h4>
                                        <br>

                                        <h4><strong>Default Fields</strong></h4>
                                        <hr>
                                    </div>

                                    {{-- Select all --}}
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label for=""></label>

                                            </div>
                                            <div class="col-xs-3">
                                                <label style="cursor: pointer;">
                                                    <input type="checkbox" id="is_required_all" style="margin:10px">
                                                    <span class="text-uppercase"><strong>Toggle
                                                            all</strong></span></label>
                                            </div>
                                            <div class="col-xs-3">
                                                <label style="cursor: pointer;">
                                                    <input type="checkbox" id="is_visible_all" style="margin:10px"
                                                           checked="checked"> <span class="text-uppercase"><strong>Toggle
                                                            all</strong></span></label>
                                            </div>
                                        </div>
                                    </div>

                                    @foreach( range(7, 1) as $i )
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label for="">FIRST NAME</label>
                                                </div>
                                                <div class="col-xs-3">
                                                    <input type="checkbox" class="is_required" style="margin:10px"> Is
                                                    required
                                                </div>
                                                <div class="col-xs-3">
                                                    <input type="checkbox" class="is_visible" style="margin:10px"
                                                           checked="checked">
                                                    Is visible
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <br>

                                    <h4>Custom Fields</h4><hr>

                                    <div id="custom_fields"></div>

                                    <div class="AddFieldButton">
                                        <a href="#addField" data-toggle="collapse" aria-controls=""
                                           class="btn btn-line btn-sm text-success"
                                           style="background: whitesmoke; border: none; border-radius: 3px 3px 0 0;"><i
                                                    class="fa fa-plus"></i> Add Custom field</a> &nbsp;
                                        <small class="">- Use this to add a custom question or input to the application
                                            form
                                        </small>
                                        <br>
                                    </div>

                                    <div id="addField" class="well no-shadow no-border no-bod-radius collapse">

                                        <a href="#addField"
                                           data-toggle="collapse"
                                           class="lead no-margin no-pad text-danger fa-2x pull-right">
                                            &times;
                                        </a>

                                        <div class="row"><br>
                                            <div class="col-xs-2 col-xs-offset-2 text-uppercase small">
                                                <strong>Field Label</strong>
                                            </div>
                                            <div class="col-xs-6"><input class="form-control" type="text"
                                                                         placeholder="Title of field" id="name-box">
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-2 col-xs-offset-2 text-uppercase small">
                                                <strong>Field Type</strong>
                                            </div>
                                            <div class="col-xs-6">
                                                <select name="" id="type-box" class="form-control"></select>
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr>
                                        </div>

                                        <div class="row" id="options-box">
                                            <div class="col-xs-2 col-xs-offset-2 text-uppercase small">
                                                <strong>Field Options</strong></div>
                                            <div class="col-xs-6">
                                                <input class="form-control"
                                                       type="text"
                                                       placeholder="Enter options separated by comma">
                                            </div>
                                            <div class="clearfix"></div>

                                            <hr>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-2 col-xs-offset-2 text-uppercase small">
                                                <strong>Required? </strong></div>
                                            <div class="col-xs-6">
                                                <input name="" id="required-box" type="checkbox"/>
                                            </div>
                                            <div class="clearfix"></div>

                                            <hr>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-2 col-xs-offset-2 text-uppercase small">
                                                <strong>Visible? </strong></div>
                                            <div class="col-xs-6">
                                                <input name="" id="visible-box" type="checkbox" checked="checked"/>
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-8 col-xs-offset-2">
                                                <a href="javascript://" class="btn-sm btn btn-success pull-right"
                                                   id="add-field-btn"><i class="fa fa-check"></i> Add field</a>
                                                <!--                                                    <button href="" class="btn-sm btn btn-line disabled pull-left" ><i class="fa fa-plus"></i> Add another field</button>-->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group hidden">
                                        <div class="row">
                                            <div class="col-xs-8 col-xs-offset-2 text-center">
                                                <label for="">
                                                    Your job will be posted automatically on these free job
                                                    platforms </label>
                                                <small class="text-center text-muted">
                                                    We will send you an email with the links to the job adverts
                                                </small>
                                            </div>
                                            <div class="col-xs-12">
                                                <br>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="">

                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="">

                                                </div>
                                            </div>
                                            <!-- <div class="col-xs-12"><br><p class="text-center">Post this job to see more available job boards</p></div> -->
                                            <div class="col-xs-6 hidden">
                                                <div class="well no-border no-shadow">
                                                    <label for=""><i class="fa fa-folder"></i> Create Job Folder</label>
                                                    &nbsp;
                                                    <!-- <textarea name="" id="" cols="30" rows="4" class="form-control" placeholder=""></textarea> -->
                                                    <input type="text"
                                                           class="form-control"
                                                           placeholder="e.g lawyer2-02-2016">
                                                    <small>
                                                        (This folder will contain all Resumes / CVs and other
                                                        materials submitted by candidates that apply for the Job. )
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br><br>
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
                                                Save and continue later
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
