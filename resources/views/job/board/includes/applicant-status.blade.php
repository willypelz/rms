<ul class="nav nav-pills option-aps" id="status_filters">
    <li class="active"><a href="javascript://" data-value="ALL">All <span class="badge">{{ $result['response']['numFound'] }}</span></a>
    </li>
    <!--li><a href="javascript://" data-value="PENDING">Pending <span class="badge">{{ $application_statuses['PENDING'] }}</span></a> 
    </li-->
    <li><a href="javascript://" data-value="SHORTLISTED">Shortlist <span class="badge">{{ $application_statuses['SHORTLISTED'] }}</span></a>
    <li><a href="javascript://" data-value="ASSESSED">Test <span class="badge">{{ $application_statuses['ASSESSED'] }}</span></a>
    </li>
    <li><a href="javascript://" data-value="INTERVIEWED">Interview <span class="badge">{{ $application_statuses['INTERVIEWED'] }}</span></a>
    </li>
    <li><a href="javascript://" data-value="HIRED">Hire <span class="badge">{{ $application_statuses['HIRED'] }}</span></a>
    </li>
    <li><a href="javascript://" data-value="REJECTED">Reject <span class="badge">{{ $application_statuses['REJECTED'] }}</span></a>
    </li>
</ul><br>
