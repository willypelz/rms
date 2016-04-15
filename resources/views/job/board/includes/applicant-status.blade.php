<ul class="nav nav-pills option-aps">
    <li class="active"><a href="#">All <span class="badge">{{ $result['response']['numFound'] }}</span></a>
    </li>
    <li><a href="#">In Review <span class="badge">{{ $application_statuses['PENDING'] }}</span></a> 
    </li>
    <li><a href="#">Assessed <span class="badge">{{ $application_statuses['ASSESSED'] }}</span></a>
    </li>
    <li><a href="#">Interviewed <span class="badge">{{ $application_statuses['INTERVIEWED'] }}</span></a>
    </li>
    <li><a href="#">Hired <span class="badge">{{ $application_statuses['HIRED'] }}</span></a>
    </li>
    <li><a href="#">Rejected <span class="badge">{{ $application_statuses['REJECTED'] }}</span></a>
    </li>
</ul><br>
