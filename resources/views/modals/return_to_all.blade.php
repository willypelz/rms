
  {!! @$applicant_badge !!}              


                                  
  <div class="pull-right">
      <a href="javascript://" id="shortlistBtn" data-app-id="{{ $app_id }}" data-cv="{{ $cv_id }}" class="btn btn-success pull-right">Yes</a>
      <div class="separator separator-small"></div>
  </div>
	
 <div class="pull-right" style="margin-right:10px;">
      <a href="javascript://" id="closeShortlistModal" data-app-id="{{ $app_id }}" data-cv="{{ $cv_id }}" class="btn btn-danger pull-right">No</a>
      <div class="separator separator-small"></div>
  </div>

  <div class="clearfix"></div>




 <script type="text/javascript">
 $(document).ready(function(){
 	
 	$('body #closeShortlistModal').on('click',function(){
 		$( '#viewModal' ).modal('toggle');
 	});

  $field = $(this);
 	$('body #shortlistBtn').on('click',function(){
 		
 		$.post("{{ route('mass-action') }}", {job_id: '{{ $appl->job->id }}',cv_ids :  ["{{ $cv_id }}"],status: 'PENDING' },function(data){

 				$( '#viewModal' ).modal('toggle');
        $.growl.notice({ message: "You have returned " + $field.closest('.modal-body').find('.media-heading a').text() + " to all" });
            
        });

 	});
 });
 </script>