
  {!! @$applicant_badge !!}              

                                  
  <div class="pull-right">
      <a href="javascript://" id="rejectBtn" data-app-id="{{ $app_id }}" data-cv="{{ $cv_id }}" class="btn btn-success pull-right">Yes</a>
      <div class="separator separator-small"></div>
  </div>
	
 <div class="pull-right" style="margin-right:10px;">
      <a href="javascript://" id="closeRejectModal" data-app-id="{{ $app_id }}" data-cv="{{ $cv_id }}" class="btn btn-danger pull-right">No</a>
      <div class="separator separator-small"></div>
  </div>

  <div class="clearfix"></div>




 <script type="text/javascript">
 $(document).ready(function(){
 	
 	$('body #closeRejectModal').on('click',function(){
 		$( '#viewModal' ).modal('toggle');
 	});

 	$('body #rejectBtn').on('click',function(){
 		
 		$.post("{{ route('mass-action') }}", {job_id: '{{ $appl->job->id }}',cv_ids :  ["{{ $cv_id }}"],status: 'REJECTED' },function(data){

 				$( '#viewModal' ).modal('toggle');
            
        });

 	});
 });
 </script>