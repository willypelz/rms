 <div class="pull-right">
      <a href="{{ route('download-dossier',['app_id' => $appl->id,'cv_id' => $appl->cv->id ]) }}" target="_blank" class="btn btn-success btn-block">Download</a>
  </div>
  <div class="clearfix"></div>
@include('modals.inc.dossier-content')