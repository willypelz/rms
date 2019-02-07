<form action="{{$callback_url}}" id="ss-form" method="post">
    <input type="hidden" value="{{$requisition_id}}" name="requisition_id">
    <input type="hidden" value="{{$job_link}}" name="job_lnk">
    <input type="hidden" value="{{$api_key}}" name="api_key">
</form>
<script>
    document.getElementById('ss-form').submit();
</script>