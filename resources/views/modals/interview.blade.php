
  {!! @$applicant_badge !!}              

<!-- <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script> -->

<script src="{{ asset('js/moment.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
<!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datetimepicker.min.css') }}"> -->

<div class="form-group">
  <!--<label>Location</label>-->
  <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
      <input type="text" required class="form-control" id="interview-location" aria-describedby="" placeholder="Location">
  </div>
  <!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
  <!--<span id="inputGroupSuccess1Status" class="sr-only">(success)</span>-->
</div>
<div class="form-group">
  <!--<label>Location</label>-->
  <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
      <input type="text" name="expiry_date" class="datepicker form-control" required id="interview-time" aria-describedby="" placeholder="Open Date">
  </div>
</div>

<div class="form-group">
  <br>
  <label><strong>ADDITIONAL NOTE: </strong></label>
  <textarea class="form-control" id="interview-message" placeholder="Message"> </textarea>
</div>
                                  
  <div class="pull-right">
      <a href="javascript://" id="sendInterviewBtn" class="btn btn-success pull-right">Interview</a>
      <div class="separator separator-small"></div>
  </div>

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

 	$('body #sendInterviewBtn').on('click',function(){
 		
 		var data = {
 						job_id: '{{ $appl->job->id }}',
 						cv_ids :  cv_ids,
            app_ids: app_ids,
 						location:  $('#interview-location').val(),
 						date:  $('#interview-time').val(),
 						message:  $('#interview-message').val(),
            step : step,
            stepId : stepId,
 					};
        $field = $(this);
 		$.post("{{ route('invite-for-interview') }}", data ,function(data){

 				$( '#viewModal' ).modal('toggle');
        $.growl.notice({ message: "You have scheduled " + $field.closest('.modal-body').find('.media-heading a').text() + " for an interview" });
        sh.reloadStatus();
            
        });

 	});
 });
 </script>