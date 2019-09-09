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
              <h4><i class="fa fa-envelope"></i> &nbsp; Messages</h4>
            </div>
          </div>
          <div class="row">
            <div class="message-content">


              @if( count( $messages ) )
              @foreach( $messages as $message )
              @if( is_null($message->user_id ) )
              @php
              $media_position = "left";
              $title = $appl->cv->first_name . " " . $appl->cv->last_name;
              $user = $appl->cv;
              @endphp
              @else
              @php
              $media_position = "right";
              $title = "Admin";
              $user = ['first_name' => 'A', 'last_name' => 'D'];
              @endphp
              @endif
              <div class="media">

                <div class="media-left pull-{{ $media_position }}"> <a href="#">
                    <img src="{{ default_picture($user, 'cv') }}" class="media-object" width="64px" height="64px"> </a>
                </div>
                <div class="media-body">

                  <h4 class="media-heading text-{{ $media_position }}">{{ $title }}</h4>
                  <div class="text-{{ $media_position }} ">{!! $message->message !!}</div>
                  @if( $message->attachment != "" )
                  <a class="pull-{{ $media_position }}" href="{{ asset('uploads/'.$message->attachment) }}"
                    target="_blank"> <i class="fa fa-paperclip"></i> Download Attachment</a>
                  @endif
                  <div class="clearfix"></div>
                  <div>
                    <small
                      class="date pull-{{ $media_position }}">{{ date('D. j M, Y', strtotime( $message->created_at)) }}</small>
                  </div>

                </div>
              </div>
              <br>

              @endforeach
              @endif

              <form class="form-horizontal" role="form" method="post" action="{{ route('admin-send-message') }}"
                enctype='multipart/form-data'>
                <div class="form-group">

                  <div class="col-xs-12">
                    <input type="hidden" name="application_id" value="{{ $appl->id }}">
                    <textarea class="form-control short" name="message" id="summernote" class="form-control" rows="7" required></textarea>
                  </div>

                  <div class="col-xs-12">
                    <br>
                    <label><input type="checkbox" id="attachment" /> <b>Attachment (Optional)</b></label>
                    <br />
                  </div>
                  <div class="col-xs-12" id="attachmentTemplateBlock">
                    <label for="">Title</label>
                    <input type="text" class="form-control" name="document_title" id="document_title">
                    <label for="">Decription</label>
                    <textarea class="form-control short" name="document_description" id="document_description"
                      rows="3"></textarea>
                    <label for="">Document</label>
                    <input type="file" name="document_file" id="attachment">
                  </div>
                </div>
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
  @include('applicant.includes.pagination')
  </div>
</section>
<div class="separator separator-small"></div>

<script>
  $(function () {
    var attachmentTemplate = $('#attachmentTemplateBlock');
    if ($('#attachment').prop('checked')) {
      attachmentTemplate.show();
    } else {
      attachmentTemplate.hide();
    }
    $('#attachment').change(function () {
      if ($(this).prop('checked')) {
        attachmentTemplate.show();
      } else {
        attachmentTemplate.hide();
      }
    });
  });
</script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#summernote').summernote();
  });
</script>
@endsection