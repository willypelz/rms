@extends('layout.template-user')
@section('content')

<section class="s-div text-white" style="margin-bottom: 40px; height: 130px"><br>
      <div class="container">
      <div class="row">
        <div class="col-xs-12">
        <h4 class="text-green-light"><i class="fa fa-briefcase"></i> Send Bulk Message: <strong><a class="text-white" href="" target="_blank"> 5 Applicants </a></strong></h4>
        </div>
      </div>
      </div>
      <br>
</section>

<section class="applicant no-pad">
  <div class="container">
    @include('applicant.includes.pagination')
    
    <div class="row">
      <div class="col-xs-2">
      </div>
      <div class="col-xs-10">
        <div class="tab-content" id="">
          <div class="row">
            <div class="col-xs-12 text-danger text-brandon text-light">
              <h4><i class="fa fa-envelope"></i> &nbsp; Messages</h4>
            </div>
          </div>
          <div class="row">
            <div class="message-content">

                        @include('layout.alerts')

              
              <br><br>
              <b>Recipients</b>
              @foreach($job_applications as $key=>$jb)
                @if($key < 10)
                  <p class="text-left "> {{ $key+1 }}) {{ $jb->cv->name }}</p>
                @endif

                @if($key > 9)
                  ......
                @endif
              @endforeach
              
              <form class="form-horizontal" role="form" method="post" action="" enctype='multipart/form-data'>
                <div class="form-group">

                  <div class="col-xs-12">
                    <textarea class="form-control short" name="message" id="summernote" class="form-control" rows="7" required></textarea>
                  </div>
                  <div class="col-xs-12"><br>
                    <small>Attachement (Optional)</small>
                    <input type="file" name="attachment" name="attachment">
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-xs-12">
                    <button type="submit" class="btn btn-success">Send Message</button>
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#summernote').summernote({
    height: 200
  });
});
</script>
@endsection