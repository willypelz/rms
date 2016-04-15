<ul class="nav nav-pills option-aps" id="status_filters">
    <li class="active"><a href="javascript://" data-value="ALL">All <span class="badge">{{ $result['response']['numFound'] }}</span></a>
    </li>
    <li><a href="javascript://" data-value="PENDING">In Review <span class="badge">{{ $application_statuses['PENDING'] }}</span></a> 
    </li>
    <li><a href="javascript://" data-value="ASSESSED">Assessed <span class="badge">{{ $application_statuses['ASSESSED'] }}</span></a>
    </li>
    <li><a href="javascript://" data-value="INTERVIEWED">Interviewed <span class="badge">{{ $application_statuses['INTERVIEWED'] }}</span></a>
    </li>
    <li><a href="javascript://" data-value="HIRED">Hired <span class="badge">{{ $application_statuses['HIRED'] }}</span></a>
    </li>
    <li><a href="javascript://" data-value="REJECTED">Rejected <span class="badge">{{ $application_statuses['REJECTED'] }}</span></a>
    </li>
</ul><br>
