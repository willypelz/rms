@extends('layout.template-user')

@section('content')
 <div class="separator separator-small"></div>

    <section class="no-pad">
        <div class="container">
            <div class="row">

                <div class="col-sm-12">
                    <h4 class="no-margin text-center text-uppercase l-sp-5">Job Creation</h4><br>
                    <div class="page">

                        <div class="btn-group btn-group-justified btn-progress" role="group" aria-label="...">
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary  text-capitalize"><i class="fa fa-file-text-o"></i>
                            &nbsp; <span class="hidden-xs">job details</span></button>
                          </div>
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-muted text-capitalize disabled"><i class="fa fa-send"></i>
                            &nbsp; <span class="hidden-xs">advertise</span></button>
                          </div>
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-muted text-capitalize disabled"><i class="fa fa-share-alt"></i>
                            &nbsp; <span class="hidden-xs">sharing</span></button>
                          </div>
                          <div class="btn-group" role="group">
                            <button type="button" class="btn btn-muted text-capitalize disabled"><i class="fa fa-search-plus"></i>
                            &nbsp; <span class="hidden-xs">add candidates</span></button>
                          </div>
                        </div>
                        <div class="row">
                            
                            
                            <div class="col-md-8 col-md-offset-2">
                                <form class="job-details" role="job-details" action="{{ url('jobs/advertise') }}">
                                        <div class="row">
                                            <div class="separator separator-small"></div>
                                        </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6"><label for="job-title">job title</label><input id="job-title" type="text" class="form-control"></div>
                                            <div class="col-sm-6"><label for="job-loc">location</label><input id="job-loc" type="text" class="form-control"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <label for="">company description</label>
                                                <textarea name="" id="" cols="30" rows="6" class="form-control" placeholder=""></textarea>
                                            </div>
                                            <div class="col-sm-3">
                                            <label for="">company logo</label>
                                                <div class="well company-logo small text-center" role="company-logo">
                                                    Attach your company logo here<br><br>
                                                    <a href="" class="btn btn-block btn-line">Attach a file</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label for="">Job description</label>
                                                <textarea name="" id="" cols="30" rows="6" class="form-control" placeholder=""></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label for="">Qualification</label>
                                                <textarea name="" id="" cols="30" rows="4" class="form-control" placeholder=""></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label for="">Additional Information</label>
                                                <textarea name="" id="" cols="30" rows="4" class="form-control" placeholder=""></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4 col-sm-offset-4">
                                        <a href="job.php" target="_blank" type="submit" class="btn btn-block">Preview Job</a>
                                        </div>

                                        <div class="col-sm-4">
                                        <button type="submit" class="btn btn-success btn-block">Proceed &raquo;</button>
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

<div class="separator separator-small"></div>
@endsection