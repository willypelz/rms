<ul class="nav nav-tabs ">
    <li class="active"><a href="{{ route('applicant-profile',  $appl->id) }}">Resume (CV)</a>
    </li>
    <li><a href="{{ route('applicant-messages',  $appl->id) }}">Message</a>
    </li>
    <li><a href="">Background Checks</a>
    </li>
    <li><a href="notes">Interview Notes</a>
    </li>
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" type="button" id="dropOptions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">More &nbsp; <i class="fa fa-caret-down"></i></a>
          <ul class="dropdown-menu" aria-labelledby="dropOptions">
            <li><a href="#">Medicals</a></li>
            <li><a href="#">Assessments</a></li>
          </ul>
    </li>
</ul>