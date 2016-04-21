<div class="alert alert-info alert-dismissible c-alert" role="alert">
  {!! @$applicant_badge !!}              
</div>

<div class="form-group">
<textarea class="form-control" id="add_folder" data-app-id="{{ $app_id }}"></textarea>


</div>
                                  
  <div class="pull-right">
      <a href="javascript://" id="writeReviewBtn" data-app-id="{{ $app_id }}" data-cv="{{ $cv_id }}" class="btn btn-success pull-right">Send</a>
      <div class="separator separator-small"></div>
  </div>

  <div class="clearfix"></div>