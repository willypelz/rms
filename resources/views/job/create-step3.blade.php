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

                            <div class="col-md-8 col-md-offset-2">
                                <div class="fa-stack">
                                    <i class="fa fa-circle-alt fa-stack-2x"></i>
                                    <span class="fa-stack-1x"></span>
                                </div>
                                <div
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <hr>
                                </div>
                                <div class="col-xs-7">
                                    <a href="/jobs/create-step2" type="submit" id="SaveDraft" class="text-dark">
                                        <i class="fa fa-arrow-left"></i>
                                        Previous step
                                    </a>
                                </div>
                                <div class="col-xs-5">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button id="post-job-btn" type="submit" class="btn btn-primary btn-block">
                                                Save As Draft
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
