
  {!! @$applicant_badge !!}              


<div class="form-group">
<textarea class="form-control" id="write_review" ></textarea>


</div>
                                  
  <div class="pull-right">
      <a href="javascript://" id="writeReviewBtn"  class="btn btn-success pull-right">Send</a>
      <div class="separator separator-small"></div>
  </div>

  <div class="clearfix"></div>

  <script>
    $(document).ready(function(){

        var app_ids = <?php echo json_encode($app_ids );?>  ;
  var cv_ids = <?php echo json_encode($cv_ids );?> ;

       $('body #writeReviewBtn').on('click', function(){
            $field = $(this);
            $.post("{{ route('write-review') }}", {job_id: '{{ $jobID }}',comment :  $('#write_review').val() , app_ids: app_ids },function(data){
                    // $('#reviewBtn-' + $field.data('app-id') ).trigger('click');
                    
                    $( '#viewModal' ).modal('toggle');
                    $.growl.notice({ message: "You have commented on " + $field.closest('.modal-body').find('.media-heading a').text() });
                    sh.reloadStatus();
                });
        });
    });
  </script>