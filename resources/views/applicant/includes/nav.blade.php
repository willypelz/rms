<style>
    .container{}
    .nav-tabs > li > a{
        font-size: 12px;
        padding-right: 16.4px;
        padding-left: 16.4px;
    }
</style>
<ul class="nav nav-tabs">
    <li  @if($nav_type=='profile')class="active"@endif ><a href="{{ route('applicant-profile',  $appl->id) }}">CV</a>
    </li>
    <li  @if($nav_type=='activities')class="active"@endif ><a href="{{ route('applicant-activities',  $appl->id) }}">Activities</a>
    </li>
    <li  @if($nav_type=='messages')class="active"@endif ><a href="{{ route('applicant-messages',  $appl->id) }}">Message</a>
    </li>
    <li  @if($nav_type=='checks')class="active"@endif ><a href="{{ route('applicant-checks',  $appl->id) }}">Background Checks</a>
    </li>
    <li  @if($nav_type=='assess')class="active"@endif ><a href="{{ route('applicant-assess',  $appl->id) }}">Test</a>
    </li>
    <li  @if($nav_type=='medicals')class="active"@endif ><a href="{{ route('applicant-medicals',  $appl->id) }}">Medicals</a>
    </li>

    <li  @if($nav_type=='documents')class="active"@endif ><a href="{{ route('applicant-documents',  $appl->id) }}">Documents</a>
    </li>

    <li  @if($nav_type=='interviews')class="active"@endif ><a href="{{ route('applicant-interviews',  $appl->id) }}">Interviews</a>
    </li>
    <!-- <li class="dropdown">
        <a href="#" class="dropdown-toggle" type="button" id="dropOptions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">&nbsp;<i class="fa fa-caret-down"></i></a>
          <ul class="dropdown-menu" aria-labelledby="dropOptions">
            <li><a href="#">Medicals</a></li>
            <li><a href="#">Assessments</a></li>
          </ul>
    </li> -->
</ul>
