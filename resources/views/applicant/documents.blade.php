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
            <div class="col-xs-12">
              {{-- Get application cv --}}
              
              @if( $appl->cv->cv_file != null || $appl->cv->cv_file != "")
              <div class="panel panel-default panel-body">
                <h4 class="no-margin"> <i class="fa fa-paperclip"></i>
                  {{ ucwords( implode( '_', array_slice( explode('_', $appl->cv->cv_file) , 1) ) ) }}</h4>
                <br>
                <div>
                  <a class="pull-left" href="{{ asset('uploads/CVs/'.$appl->cv->cv_file) }}" target="_blank"> <i
                      class="fa fa-paperclip"></i> Download Attachment</a>
                  <small class="date pull-right">{{ date('M d, Y', strtotime( $appl->cv->last_modified)) }}</small>
                  <div class="clearfix"></div>
                  </div>
              </div>
              @else
              <div class="panel panel-default panel-body">
                <h5 class="text-center">No CV attachment</h5>
              </div>
              @endif
              <br>
              @if( count( $documents ) )
              @foreach( $documents as $document )
              <div class="panel panel-default panel-body">
                <h4 class="no-margin"> <i class="fa fa-paperclip"></i>
                  {{ ucwords( implode( '-', array_slice( explode('-', $document->attachment) , 2) ) ) }} @if ($document->title !="")
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
                  <small class="date pull-right">{{ date('M d, Y', strtotime( $document->created_at)) }}</small>
                  <div class="clearfix"></div>
                  @endif
                </div>
              </div>
              <br>
              @endforeach
              @endif
              <a class="btn btn-sm btn-line text-uppercase pull-right" data-toggle="modal" data-target="#attachDocument"
                id="modalButton" href="#attachDocument" data-title="Attach Document">Attach Document</a>
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
<div class="modal widemodal fade" id="attachDocument" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="false">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin: 18px;">×</button>
      </div>
      <div class="modal-body">
        <form role="form" class="form-signin" method="POST" enctype="multipart/form-data" id="request-form" action="">
          {!! csrf_field() !!}
          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="">Title</label>
                <input type="text" class="form-control" name="document_title" id="document_title" required>
              </div>
              <div class="form-group">
                <label for="">Decription</label>
                <textarea class="form-control" name="document_description" required id="document_description" cols="30"
                  rows="10"></textarea>
              </div>
              <div class="form-group">
                <label for="">Document</label>
                <input type="file" name="document_file" id="document_file" required>
              </div>
            </div>
          </div>
          <div class="row"><br>
            <div class="col-sm-10 col-sm-offset-1 col-md-12 col-sm-offset-0">
              <button type="submit" class="btn btn-success btn-block">Upload Document &raquo;</button>
            </div>
          </div>
        </form>
        <script>
          $(document).ready(function () {
            $('body #request-form').on('submit', function (e) {
              e.preventDefault();
              var formdata = new FormData(this);
              $.ajax({
                url: "{{ route('upload-document',['appl_id' => $appl->id, 'job_id' => $appl->job->id]) }}",
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (data) {
                  $.growl.notice({ message: data.data });
                  location.reload().delay(3000);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                   $.growl.error({ message: "Error While Uploading" });
                }
               
              });
            });
          });
        </script>
      </div>
    </div>
  </div>
</div>
@endsection