<div class="modal widemodal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin: 18px;">×</button>
        <h4 class="modal-title" id="myModalLabel">{{ ( @$title ) ? @$title : 'Default Title' }}</h4>
      </div>
      <div class="modal-body">
          {!! preloader() !!}
      </div>
    </div>
  </div>
</div>