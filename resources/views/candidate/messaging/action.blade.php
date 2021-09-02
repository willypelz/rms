
Are you sure you want to send message to {{ $count_applicants }} @if($count_applicants > 1) applicants @else applicant @endif ?


<div class="pull-right">
    <a href="{{ route('send-bulk-message', $params) }}" id="" class="btn btn-success pull-right">Yes</a>
    <div class="separator separator-small"></div>
</div>

<div class="pull-right" style="margin-right:10px;">
    <a href="javascript://" class="btn btn-danger pull-right" data-dismiss="modal">No</a>
    <div class="separator separator-small"></div>
</div>

<div class="clearfix"></div>


<script type="text/javascript">
   
</script>