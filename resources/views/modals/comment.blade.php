
  {!! @$applicant_badge !!}              


<div class="form-group">
<textarea class="form-control" id="add_folder" data-app-id="{{ $app_id }}"></textarea>


</div>
                                  
  <div class="pull-right">
      <a href="javascript://" id="writeReviewBtn" data-app-id="{{ $app_id }}" data-cv="{{ $cv_id }}" class="btn btn-success pull-right">Send</a>
      <div class="separator separator-small"></div>
  </div>

  <div class="clearfix"></div>

  <script>
    $(document).ready(function(){
       $('body #writeReviewBtn').on('click', function(){
            $field = $(this);
            $.post("{{ route('write-review') }}", {job_id: '{{ $jobID }}',comment :  $('body textarea[data-app-id="' + $field.data('app-id') + '"]').val() ,job_app_id: $field.data('app-id'), app_ids: app_ids },function(data){
                    // $('#reviewBtn-' + $field.data('app-id') ).trigger('click');
                    
                    $( '#viewModal' ).modal('toggle');
                    $.growl.notice({ message: "You have commented on " + $field.closest('.modal-body').find('.media-heading a').text() });
                    sh.reloadStatus();
                });
        });
    });
  </script>