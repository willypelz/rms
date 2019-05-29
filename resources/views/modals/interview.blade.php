
  {!! @$applicant_badge !!}
<!-- <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script> -->

<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datetimepicker.min.css') }}"> -->
  @if($is_a_reschedule == true)
    <div class="alert alert-danger">
      You have already scheduled this interview for {{ date('D, j-n-Y, h:i A', strtotime($interview_record->date))  }},
      if refill this form, you will be rescheduling it for another date
    </div>
  @endif

<form class="">
  <div class="form-group">
    <!--<label>Location</label>-->
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
        <input type="text" class="form-control" id="interview-location" placeholder="Location" required>
    </div>
    <!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
    <!--<span id="inputGroupSuccess1Status" class="sr-only">(success)</span>-->
  </div>
  <div class="form-group">
    <!--<label>Location</label>-->
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        <input type="text" name="expiry_date" class="datepicker form-control" id="interview-time" placeholder="Open Date" required>
    </div>
  </div>

  <div class="form-group">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
        <input type="number" name="duration" class="form-control" id="interview-duration" placeholder="Enter Duration" required>
        <span class="input-group-addon">mins</span>
    </div>
  </div>

  <div class="form-group">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-file"></i></span>
        <input type="file" name="file" class="form-control" id="interview-file" placeholder="Choose File" required>
    </div>
  </div>

  <div class="form-group">
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-user"></i></span>
        <select class="form-control select2" name="interviewer_id[]" id="interviewer_id" multiple required>
          <option value="">--choose interviewer--</option>
          @foreach($interviewers as $key => $interviewer)
            <option value="{{$key}}">{{$interviewer}}</option>
          @endforeach
        </select>
    </div>
  </div>

  <div class="form-group">
    <br>
    <label><strong>Message: </strong></label>
    <textarea class="form-control" id="interview-message" placeholder="Message" required> </textarea>
  </div>

    <div class="pull-right">
        <button type="submit" id="sendInterviewBtn" class="btn btn-success pull-right">Interview</button>
        <div class="separator separator-small"></div>
    </div>
</form>

  <div class="clearfix"></div>



<script type="text/javascript">
 $(document).ready(function(){

  /*$('.datepicker').datepicker({
      format: 'mm/dd/yyyy'
  });*/

  $('.datepicker').datetimepicker();

  var app_ids = <?php echo json_encode($app_ids );?>  ;
  var cv_ids = <?php echo json_encode($cv_ids );?> ;
  var step = "{{ $step }}";
  var stepId = <?php echo $stepId ?>;
  var reschedule = <?php echo $is_a_reschedule ? 'true' : 'false'; ?>;

 	$('body #sendInterviewBtn').on('click',function(e){
    e.preventDefault();
    var file_data = $('#interview-file').prop('files')[0];
    var form_data = new FormData();

    if(file_data == undefined){
      form_data.append('interviewer_id', '');
    }else{
      form_data.append('interview_file', file_data);
    }
    form_data.append('job_id', '{{ $appl->job->id }}');
    form_data.append('cv_ids[]', cv_ids);
    form_data.append('app_ids[]', app_ids);
    form_data.append('location', $('#interview-location').val());
    form_data.append('date', $('#interview-time').val());
    form_data.append('message', $('#interview-message').val());
    form_data.append('duration', $('#interview-duration').val());
    form_data.append('step', step);
    form_data.append('stepId', stepId);
    if($('#interviewer_id').val() == null){
      form_data.append('interviewer_id', '');
    }else{
      form_data.append('interviewer_id[]', $('#interviewer_id').val());
    }
    form_data.append('reschedule', reschedule);
    $field = $(this);

    $.ajax({
        type: 'POST',
        url: "{{ route('invite-for-interview') }}",
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
          if(response.success == false){
            $.each(response.errors, function( index, value )
            {
              $.growl.error({
                message: value
              });
            });
            return;
          }

          $( '#viewModal' ).modal('toggle');
          $.growl.notice({ message: "You have scheduled " + $field.closest('.modal-body').find('.media-heading a').text() + " for an interview" });
          sh.reloadStatus();
        }
    });

 	});
 });
 </script>
