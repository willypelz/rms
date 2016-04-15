@extends('layout.template-user')

@section('content')
    <section class="applicant">
        <div class="container">

            <div class="row">
            <div class="col-xs-4">
                @include('applicant.includes.badge')
            </div>


                <div class="col-xs-8">
                    @include('applicant.includes.nav')

                    <div class="tab-content" id="">

                              <div class="row">
                                <div class="col-xs-12 text-danger text-brandon text-light">
                                  <h4><i class="fa fa-envelope"></i> &nbsp; Messages</h4>
                                </div>
                              </div>



                                <div class="row">
                                  <div class="message-content">
                                  
                                      <div class="msg-box">
                                          <div class="date">{{ date('M d, Y') }}</div>
                                          <div class="">
                                              <h5>{{ $appl->cv->first_name.' '.$appl->cv->last_name }} <em>({{ $appl->cv->tagline }})</em></h5>
                                              <p>{{ $appl->cover_note }}</p>
                                          </div>
                                      </div>
                                  
                                      <form class="form-horizontal" role="form">
                                          <div class="form-group">
                                              <label for="msg" class="col-xs-12">Reply to {{ $appl->cv->first_name.' '.$appl->cv->last_name }}:</label>
                                              <div class="col-xs-12">
                                                  <textarea class="form-control short" id="msg" rows="3"></textarea>
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <div class="col-xs-12">
                                                  <button type="submit" class="btn btn-success">Reply</button>
                                              </div>
                                          </div>
                                      </form>
                                  
                                  
                                  
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