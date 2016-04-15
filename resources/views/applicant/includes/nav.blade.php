<style>
    .container{}
</style>
<ul class="nav nav-tabs ">
    <li  @if($nav_type=='profile')class="active"@endif ><a href="{{ route('applicant-profile',  $appl->id) }}">CV</a>
    </li>
    <li  @if($nav_type=='activities')class="active"@endif ><a href="{{ route('applicant-activities',  $appl->id) }}">Activities</a>
    </li>
    <li  @if($nav_type=='message')class="active"@endif ><a href="{{ route('applicant-messages',  $appl->id) }}">Message</a>
    </li>
    <li  @if($nav_type=='checks')class="active"@endif ><a href="{{ route('applicant-checks',  $appl->id) }}">Background Checks</a>
    </li>
    <li  @if($nav_type=='assess')class="active"@endif ><a href="{{ route('applicant-assess',  $appl->id) }}">Assessment</a>
    </li>
    <li  @if($nav_type=='medicals')class="active"@endif ><a href="{{ route('applicant-medicals',  $appl->id) }}">Medicals</a>
    </li>
    <!-- <li class="dropdown">
        <a href="#" class="dropdown-toggle" type="button" id="dropOptions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">&nbsp;<i class="fa fa-caret-down"></i></a>
          <ul class="dropdown-menu" aria-labelledby="dropOptions">
            <li><a href="#">Medicals</a></li>
            <li><a href="#">Assessments</a></li>
          </ul>
    </li> -->
</ul>