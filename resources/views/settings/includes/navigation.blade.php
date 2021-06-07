<div class="sub-menu"><a href="{{ route('page-settings') }}"><i class="fa fa-key"> </i> Company Info</a></div>
<div class="sub-menu"><a href="{{ route('set-privacy-policy') }}"><i class="fa fa-lock"> </i> Privacy Policy</a></div>
@if(config('app.staff_strength_url') && !config('app.rms_stand_alone'))
    <div class="sub-menu btn-block"><a href="{{ route('rms-company-subsidiaries') }}"><i class="fa fa-connectdevelop"> </i>Sync With HRMS Companies </a></div>
@endif
