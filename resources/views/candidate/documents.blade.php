@extends('layout.template-guest')
<link rel="stylesheet" type="text/css" href="{{ asset('font/flaticon.css') }}">
@section('navbar')
@show()
@section('footer')
@show()
@section('content')
<section class="no-pad">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-10 col-sm-offset-1">
        <div class="separator separator-small"></div>
        <!-- Sidebar -->
        <div class="col-md-3">
          @include('candidate.includes.sidebar')
        </div>
        <!-- Main body -->
        <div class="col-md-9">
          @include('candidate.includes.header')
          <div class="row">
            <div class="col-sm-12">
              <div class="page no-bod-rad">
                <br>
                <div class="col-xs-12">
                  {{-- Get application cv --}}
                  <div class="panel panel-default panel-body">
                    <h4 class="no-margin"> <i class="fa fa-paperclip"></i>
                      {{ ucwords( implode( '_', array_slice( explode('_', $current_application->cv->cv_file) , 1) ) ) }}
                    </h4>
                    <br>
                    <div>
                      @if( $current_application->cv->cv_file != "" )
                      <a class="pull-left" href="{{ asset('uploads/CVs/'.$current_application->cv->cv_file) }}"
                        target="_blank"> <i class="fa fa-paperclip"></i> Download Attachment</a>
                      @endif
                      <small
                        class="date pull-right">{{ date('D. j M, Y', strtotime( $current_application->cv->last_modified)) }}</small>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                  
                  @if( $current_application->cv->optional_attachment_1 != "" )
                    <div class="panel panel-default panel-body">
                      <h4 class="no-margin"> <i class="fa fa-paperclip"></i>
                        {{ ucwords( implode( '_', array_slice( explode('_', $current_application->cv->optional_attachment_1) , 1) ) ) }}
                      </h4>
                      <br>
                      <div>
                        
                        <a class="pull-left" href="{{ asset('uploads/CVs/'.$current_application->cv->optional_attachment_1) }}"
                          target="_blank"> <i class="fa fa-paperclip"></i> Download Attachment</a>                        
                        <small
                          class="date pull-right">{{ date('D. j M, Y', strtotime( $current_application->cv->last_modified)) }}</small>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                  @endif
                  @if( $current_application->cv->optional_attachment_2 != "" )
                    <div class="panel panel-default panel-body">
                      <h4 class="no-margin"> <i class="fa fa-paperclip"></i>
                        {{ ucwords( implode( '_', array_slice( explode('_', $current_application->cv->optional_attachment_2) , 1) ) ) }}
                      </h4>
                      <br>
                      <div>
                        
                        <a class="pull-left" href="{{ asset('uploads/CVs/'.$current_application->cv->optional_attachment_2) }}"
                          target="_blank"> <i class="fa fa-paperclip"></i> Download Attachment</a>                        
                        <small
                          class="date pull-right">{{ date('D. j M, Y', strtotime( $current_application->cv->last_modified)) }}</small>
                        <div class="clearfix"></div>
                      </div>
                    </div>
                  @endif



                  <br>
                  @if( count( $documents ) )
                  @foreach( $documents as $document )
                  <div class="panel panel-default panel-body">
                    <h4 class="no-margin"> <i class="fa fa-paperclip"></i>
                      {{ ucwords( implode( '-', array_slice( explode('-', $document->attachment) , 2) ) ) }}
                      @if ($document->title !="")
                      {{"($document->title)"}}
                      @endif
                    </h4>
                    @if ($document->description !="")
                    <h5>{{"Decription: ".$document->description}}</h5>
                    @endif
                    <div>
                      @if( $document->attachment != "" )
                      <a class="pull-left" href="{{ asset('uploads/'.$document->attachment) }}" target="_blank"> <i
                          class="fa fa-paperclip"></i> Download Attachment</a>
                      @endif
                      <small class="date pull-right">{{ date('D. j M, Y', strtotime( $document->created_at)) }}</small>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                  <br>
                  @endforeach
                  @endif
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <!--/footer-->
          <div class="page page-sm foot no-bod-rad">
            <div class="col-sm-6 col-sm-offset-3 text-center">
              <!-- <hr> -->
              <p><img src="{{ env('SEAMLESS_HIRING_LOGO') }}" alt="" width="200px"> </p>
              <p><small class="text-muted"> &nbsp;
                  &copy; {{ date('Y') }}. Powered by <a href="http://www.seamlesshiring.com"> SeamlessHiring</a></small>
              </p>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  </div>
  </div>
  </div>
</section>
<div class="separator separator-small"><br></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
@endsection