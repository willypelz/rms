<div class="alert alert-info alert-dismissible c-alert" role="alert">
    <div class="comment media">
      <span class="col-md-2 col-sm-3">
        <a href="#" class="pull-left">
            <img alt="" src="{{ default_picture( $cv ) }}" class="media-object " width="100%">
        </a>
      </span>
        <div class="media-body">

            <h4 class="media-heading text-muted"><a href="#">{{ ucwords( $cv->first_name. " " . $cv->last_name ) }}</a>
            </h4>
            <p>{{ @$cv->last_position.' at '.@$cv->last_company_worked }}</p>

        </div>
    </div>
</div>