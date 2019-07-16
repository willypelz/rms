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
              <div class="panel panel-default panel-body">
                <h4 class="no-margin"> <i class="fa fa-paperclip"></i>
                  {{ ucwords( implode( '_', array_slice( explode('_', $appl->cv->cv_file) , 1) ) ) }}</h4>
                <br>
                <div>
                  @if( $appl->cv != null )
                  <a class="pull-left" href="{{ asset('uploads/CVs/'.$appl->cv->cv_file) }}" target="_blank"> <i
                      class="fa fa-paperclip"></i> Download Attachment</a>
                  <small class="date pull-right">{{ date('M d, Y', strtotime( $appl->cv->last_modified)) }}</small>
                  <div class="clearfix"></div>
                  @endif
                </div>
              </div>
              <br>
              @if( count( $documents ) )
              @foreach( $documents as $document )
              <div class="panel panel-default panel-body">
                <h4 class="no-margin"> <i class="fa fa-paperclip"></i>
                  {{ ucwords( implode( '-', array_slice( explode('-', $document->attachment) , 2) ) ) }}</h4>
                <br>
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
                id="modalButton" href="#attachDocument" data-title="Attach Download">Attach Download</a>
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
        <form role="form" class="form-signin" method="POST" id="request-form" action="">
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
              $field = $(this);
              params = {
                document_title: $('#document_title').val(),
                document_description: $('#document_description').val(),
                document_file: $('#document_file').val(),
              };
              $("body #request-form input").prop("disabled", true);
              $.post("{{ route('upload-document',['appl_id' => $appl->id, 'job_id' => $appl->job->id]) }}", params, function (data) {
                $('#attachDocument').modal('toggle');
                $('#document_title').val("");
                $('#document_description').val("");
                $('#document_file').val("");
                $("body #request-form input").prop("disabled", false);
                $.growl.notice({ message: "Your request has been sent", location: 'tc', size: 'large' });
              });
            });
          });
        </script>
      </div>
    </div>
  </div>
</div>
@endsection