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
              <h4><i class="fa fa-file"></i> &nbsp; Documents</h4>
            </div>
          </div>
          <div class="row">
            <div class="message-content">

              {{-- Get application cv --}}

              <div class="media">

                <h3 class="text-left">{{ ucwords( implode( '_', array_slice( explode('_', $appl->cv->cv_file) , 1) ) ) }}</h3>
                @if( $appl->cv->cv_file != "" )
                  <a class="pull-left" href="{{ asset('uploads/CVs/'.$appl->cv->cv_file) }}" target="_blank" > <i class="fa fa-paperclip"></i> Download Attachment</a>
                @endif
                <div class="clearfix"></div>
                <div>
                  <small class="date pull-left">{{ date('D. j M, Y', strtotime( $appl->cv->created_at)) }}</small>
                </div>
                
              </div>
              <br>

              @if( count( $documents ) )
                @foreach( $documents as $document )
                 
                  <div class="media"> 

                    <h3 class="text-left">{{ ucwords( implode( '-', array_slice( explode('-', $document->attachment) , 2) ) ) }}</h3>
                    @if( $document->attachment != "" )
                      <a class="pull-left" href="{{ asset('uploads/'.$document->attachment) }}" target="_blank" > <i class="fa fa-paperclip"></i> Download Attachment</a>
                    @endif
                    <div class="clearfix"></div>
                    <div>
                      <small class="date pull-left">{{ date('D. j M, Y', strtotime( $document->created_at)) }}</small>
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