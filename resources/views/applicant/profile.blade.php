@extends('layout.template-user')

@section('content')
    <section class="no-pad white no-margin"><br>
          <h4 class="text-center">Applicants for: <a href="{{ url('job/activities/'.$appl->job->id  ) }}" target="_blank">{{ $appl->job->title }}</a></h4>
          <br>
    </section>
    <section class="no-pad applicant">
        <div class="container">
        <div class="row">
          <div class="col-xs-12"><br>
            <h5 class="text-brandon text-center">
              <a href="#" class="pull-left text-muted"><i class="fa fa-arrow-left"></i> &nbsp; Prev</a>
              1 of 20
              <a href="" class="pull-right">Next &nbsp; <i class="fa fa-arrow-right"></i></a>
            </h5>
          </div>
          <div class="col-xs-12">
            <div class="separator separator-small"></div>
          </div>
        </div>
            <div class="row">
            <div class="col-xs-4">
                
              @include('applicant.includes.badge')  

            </div>


                <div class="col-xs-8">
                    
                    @include('applicant.includes.nav')

                    <div class="tab-content" id="">


                        <div class="unit-box">
                            <div class="row">
                                <div class="col-xs-1 r-left">
                                    <span class="fa fa-user"></span>
                                </div>
                                <div class="col-xs-11">
                                    <h5>PERSONAL INFO</h5>
                                    <p class="text-muted">{{ $appl->cv->tagline }}</p>
                                    <ul class="list-unstyled">
                                        <li>
                                            <strong>Gender:</strong>&nbsp; {{ $appl->cv->gender }}</li>
                                        <li>
                                            <strong>Email:</strong>&nbsp; {{ $appl->cv->email }}</li>
                                        <li>
                                            <strong>Phone:</strong>&nbsp; {{ $appl->cv->phone }}</li>
                                        <li>
                                            <strong>Age:</strong>&nbsp; 27 years old
                                            <span class="text-muted">({{ date('M d, Y') }})</span>
                                        </li>
                                        <li>
                                            <strong>Address:</strong>&nbsp; {{ $appl->cv->location }}.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="unit-box">
                            <div class="row">
                                <div class="col-xs-1 r-left">
                                    <span class="fa fa-pencil-square-o"></span>
                                </div>
                                <div class="col-xs-11">
                                    <h5>Cover Letter</h5>
                                    <p class="text-muted">{{ $appl->cover_note }}</p>

                                    <p class="text-muted">{{ $appl->cv->headline }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        <div class="col-xs-1 r-left">
                          <span class="fa fa-file-text-o"></span>
                        </div>
                          <div class="col-xs-11">
                            <h5>Curriculum Vitae</h5>
                            <pre class="iframe-cv" width="100%" frameborder="0">
                              
                              {{ $appl->cv->extracted_content }}
                            </pre>
                            
                          </div>
                        </div>

                    </div>
                    <!--/tab-content-->

                </div>

            </div>

        <div class="row">
          <div class="col-xs-12"><hr>
            <h5 class="text-brandon text-center">
              <a href="#" class="pull-left text-muted"><i class="fa fa-arrow-left"></i> &nbsp; Prev</a>
              1 of 20
              <a href="" class="pull-right">Next &nbsp; <i class="fa fa-arrow-right"></i></a>
            </h5><hr>
          </div>
          <div class="col-xs-12">
            <div class="separator separator-small"></div>
          </div>
        </div>

        </div>
    </section>

<div class="separator separator-small"></div>

@endsection