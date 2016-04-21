
  {!! @$applicant_badge !!}              


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
      <input type="datetime-local" required class="datepicker form-control" id="interview-time" aria-describedby="" placeholder="Open Date">
  </div>
</div>

<div class="form-group">
	<input class="form-control" id="interview-message" data-app-id="{{ $app_id }}" placeholder="Message" />
</div>
                                  
  <div class="pull-right">
      <a href="javascript://" id="sendInterviewBtn" data-app-id="{{ $app_id }}" data-cv="{{ $cv_id }}" class="btn btn-success pull-right">Interview</a>
      <div class="separator separator-small"></div>
  </div>

  <div class="clearfix"></div>



<script type="text/javascript">
 $(document).ready(function(){
 	

 	$('body #sendInterviewBtn').on('click',function(){
 		
 		var data = {
 						job_id: '{{ $appl->job->id }}',
 						cv_id :  "{{ $cv_id }}",
 						location:  $('#interview-location').val(),
 						date:  $('#interview-time').val(),
 						message:  $('#interview-message').val()
 					};
 		$.post("{{ route('invite-for-interview') }}", data ,function(data){

 				$( '#viewModal' ).modal('toggle');
            
        });

 	});
 });
 </script>