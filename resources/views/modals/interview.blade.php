@if(!isset($appl->job->id))
 <div class="text-danger"> <h5>Cannot proceed! No applicants found</h5></div>
@else
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
<!-- <form id="preview_form" class=""> -->
<div class="form-group">
  <!--<label>Location</label>-->
  <div class="input-group">
    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
    <input required type="text" class="form-control" id="interview-location" placeholder="Location" required>
  </div>
  <!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
  <!--<span id="inputGroupSuccess1Status" class="sr-only">(success)</span>-->
</div>
<div class="form-group">
  <!--<label>Location</label>-->
  <div class="input-group">
    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
    <input required type="text" name="expiry_date" class="datepicker form-control" id="interview-time" placeholder="Open Date" required>
  </div>
</div>
<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
    <input required type="number" name="duration" class="form-control" id="interview-duration" placeholder="Enter Duration" required>
    <span class="input-group-addon">mins</span>
  </div>
</div>
<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="fa fa-file"></i></span>
    <input required type="file" name="file" class="form-control" id="interview-file" placeholder="Choose File" required>
  </div>
</div>
<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="fa fa-user"></i></span>
    <select placeholder="Choose Interviewer" class="select2" name="interviewer_id[]" id="interviewer_id" multiple="multiple" required style="width: 100% !important;">
      <option disabled value="">--choose interviewer--</option>
      @foreach($interviewers as $key => $interviewer)
      <option value="{{$key}}">{{$interviewer}}</option>
      @endforeach
    </select>
  </div>
  <input type="hidden" name="">
</div>
<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon"><i class="fa fa-file"></i></span>
    <select placeholder="Choose Interview Note" class="select2" name="interview_template_ids[]" id="interview_notes" multiple="multiple" required style="width: 100% !important;">
      <option disabled value="">--choose interview note--</option>
      @foreach($interview_notes as $key => $interview_note)
      <option value="{{$interview_note->id}}">{{$interview_note->name}}</option>
      @endforeach
    </select>
  </div>
  <input type="hidden" name="">
</div>
<div class="form-group">
  <br>
  <label><strong>Message: </strong></label>
  <textarea class="form-control" id="interview-message" placeholder="Message" required> </textarea>
</div>
<div class="pull-right">
  <button type="submit" id="previewInterviewBtn" class="btn btn-info " onclick="showForm('previewInterviewBtn')">Preview Invite</button>
  <button type="submit" id="sendInterviewBtn" class="btn btn-success " onclick="showForm('sendInterviewBtn')">Send Invite</button>
</div>
<!-- </form> -->
<div class="clearfix"></div>
<script type="text/javascript">
  $('#interviewer_id').select2();
  $('#interview_notes').select2();
  $('.datepicker').datetimepicker();
  var form_data = new FormData();
  var app_ids = <?php echo json_encode($app_ids); ?>;
  var cv_ids = <?php echo json_encode($cv_ids); ?>;
  var step = "{{ $step }}";
  var stepId = <?php echo $stepId ?>;
  var reschedule = <?php echo $is_a_reschedule ? 'true' : 'false'; ?>;

  function showForm(type) {
    var type = type;
    var file_data = $('#interview-file').prop('files')[0];
    if (file_data == undefined) {
      form_data.append('interviewer_id', '');
    } else {
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
    if ($('#interviewer_id').val() == null) {
      form_data.append('interviewer_id', '');
    } else {
      form_data.append('interviewer_id[]', $('#interviewer_id').val());
    }
    if ($('#interview_notes').val() == null) {
      form_data.append('interview_template_ids[]', '');
    } else {
      form_data.append('interview_template_ids[]', $('#interview_notes').val());
    }
    form_data.append('reschedule', reschedule);
    $field = $(this);
    if (type == 'previewInterviewBtn') {
      var url = "{{route('invite-for-interview-preview')}}";
    } else {
      var url = "{{ route('invite-for-interview') }}";
    }
    $.ajax({
      type: 'POST',
      url: url,
      contentType: false,
      processData: false,
      data: form_data,
      success: function(response) {
        if (response.success == false) {
          $.each(response.errors, function(index, value) {
            $.growl.error({
              message: value
            });
          });
          return;
        }
        if (type == 'previewInterviewBtn') {
          var w = window.open();
          $(w.document.body).html(response);

        } else {
          $('#viewModal').modal('toggle');
          $.growl.notice({
            message: "You have scheduled " + $field.closest('.modal-body').find('.media-heading a').text() + " for an interview"
          });
          sh.reloadStatus();
          setTimeout(function() {
            location.reload();
          }, 5000);
        }

      }
    });
    // });
  }
</script>
@endif