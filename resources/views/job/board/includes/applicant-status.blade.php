<ul class="nav nav-pills option-aps" id="status_filters" style="overflow:visible">
    <li class="active"><a href="javascript://" data-value="ALL" data-toggle="tooltip" data-placement="top" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.">All <span class="badge">{{ $result['response']['numFound'] }}</span></a>
    </li>
    <li><a href="javascript://" data-value="PENDING" data-toggle="tooltip" data-placement="top" title="Tooltip on left">Pending <span class="badge">{{ $application_statuses['PENDING'] }}</span></a> 
    </li>
    <li><a href="javascript://" data-value="SHORTLISTED" data-toggle="tooltip" data-placement="top" title="Description goes here">Shortlist <span class="badge">{{ $application_statuses['SHORTLISTED'] }}</span></a>
    <li><a href="javascript://" data-value="ASSESSED" data-toggle="tooltip" data-placement="top" title="Description goes here">Test <span class="badge">{{ $application_statuses['ASSESSED'] }}</span></a>
    </li>
    <li><a href="javascript://" data-value="INTERVIEWED" data-toggle="tooltip" data-placement="top" title="Description goes here">Interview <span class="badge">{{ $application_statuses['INTERVIEWED'] }}</span></a>
    </li>
    <li><a href="javascript://" data-value="WAITING" data-toggle="tooltip" data-placement="top" title="Description goes here">Waiting <span class="badge">{{ $application_statuses['WAITING'] }}</span></a> 
    </li>
    <li><a href="javascript://" data-value="HIRED" data-toggle="tooltip" data-placement="top" title="Description goes here">Hire <span class="badge">{{ $application_statuses['HIRED'] }}</span></a>
    </li>
    <li><a href="javascript://" data-value="REJECTED" data-toggle="tooltip" data-placement="top" title="Description goes here">Reject <span class="badge">{{ $application_statuses['REJECTED'] }}</span></a>
    </li>
</ul>

<script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
</script>