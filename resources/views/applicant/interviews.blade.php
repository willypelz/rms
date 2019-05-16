@extends('layout.template-user')
@section('content')
@include('applicant.includes.job-title-bar')
<section class="applicant no-pad">
  <div class="container">
    @include('applicant.includes.pagination')

    <div class="row">
      <div class="col-xs-4">
        @include('applicant.includes.badge')
      </div>
      <div class="col-xs-8">
        @include('applicant.includes.nav')
        <div class="tab-content" id="">
          <div class="row">
            <div class="col-xs-12 text-danger text-brandon text-light">
              <h4><i class="fa fa-user"></i> &nbsp; Interviews</h4>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">

              {{-- Get application cv --}}

              <br>

              @if( count( $interviews ) )
                @foreach( $interviews as $interview )

                    <div class="panel panel-default panel-body">
                      @if($interview->reschedule)
                        <small class="pull-right" style="color:red">rescheduled</small>
                      @endif
                      <br>
                      <h4 class="no-margin"> <i class="fa fa-note"></i>  {{ $interview->message }}</h4>
                      <br>



                    <div>
                      @if( $interview->interview_file)
                        <a class="pull-left" href="{{ asset('uploads/'.$interview->interview_file) }}" target="_blank" > <i class="fa fa-paperclip"></i> Download File</a>
                      @endif
                      <br>
                      <p class="date pull-left">Location: {{ $interview->location }}</p>
                      <p class="date pull-right">Date: {{ date('D. j M, Y', strtotime( $interview->date)) }} at {{ $interview->location }}</p>
                      <div class="clearfix"></div>
                    </div>

                  </div>
                  <br>

                @endforeach
              @endif




            </div>
          </div>

        </div>
        <!--/tab-content-->
      </div>
    </div>
    @include('applicant.includes.pagination')
  </div>
</section>
<div class="separator separator-small"></div>
@endsection
