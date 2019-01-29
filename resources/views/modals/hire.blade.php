
  {!! @$applicant_badge !!}              


                                  
  <div class="pull-right">
      <a href="javascript://" id="shortlistBtn"  class="btn btn-success pull-right">Yes</a>
      <div class="separator separator-small"></div>
  </div>
	
 <div class="pull-right" style="margin-right:10px;">
      <a href="javascript://" id="closeShortlistModal" class="btn btn-danger pull-right">No</a>
      <div class="separator separator-small"></div>
  </div>

  <div class="clearfix"></div>




 <script type="text/javascript">
 $(document).ready(function(){
 	
  var app_ids = <?php echo json_encode($app_ids );?>  ;
  var cv_ids = <?php echo json_encode($cv_ids );?> ;

 	$('body #closeShortlistModal').on('click',function(){
 		$( '#viewModal' ).modal('toggle');
 	});

 	$('body #shortlistBtn').on('click',function(){
 		$field = $(this);
 		$.post("{{ route('mass-action') }}", {job_id: '{{ $appl->job->id }}',cv_ids :  cv_ids, app_ids: app_ids,status: 'HIRED' },function(data){

 				$( '#viewModal' ).modal('toggle');
        $.growl.notice({ message: "You have hired " + $field.closest('.modal-body').find('.media-heading a').text() });
            sh.reloadStatus();
        });

 	});
 });
 </script>