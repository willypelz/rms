<ul class="nav nav-pills nav-justified option-aps" id="status_filters" style="overflow:visible">
    @php
        $firstActive = 'active';
    @endphp
    {{--<li class="active">--}}
    {{--<a href="javascript://"--}}
    {{--data-value=""--}}
    {{--data-toggle="tooltip"--}}
    {{--data-placement="top"--}}
    {{--title="List of all the applicants for this job.">--}}
    {{--All--}}
    {{--<span class="badge">{{ $application_statuses['ALL'] }}</span></a>--}}
    {{--</li>--}}

    @foreach($job->workflow->workflowSteps as $workflowStep)
        <li class="{{ $firstActive }}">
            <a href="javascript://"
               data-value="{{ $workflowStep->slug }}"
               data-toggle="tooltip"
               data-placement="top"
               title="{{ $workflowStep->description }}">
                {{ $workflowStep->name }}
                <span class="badge">{{ $application_statuses[$workflowStep->slug] }}</span></a>
        </li>
        @php
            $firstActive = '';
        @endphp
    @endforeach
    {{--<li>
        <a href="javascript://"
           data-value="PENDING"
           data-toggle="tooltip"
           data-placement="top"
           title="All applicants are listed here until at least a recruitment action is taken.">
            Pending
            <span class="badge">{{ $application_statuses['PENDING'] }}</span></a>
    </li>
    <li>
        <a href="javascript://"
           data-value="SHORTLISTED"
           data-toggle="tooltip"
           data-placement="top"
           title="List of candidates selected to proceed in the recruitment process.">
            Shortlist <span class="badge">{{ $application_statuses['SHORTLISTED'] }}</span></a>
    <li>
        <a href="javascript://"
           data-value="ASSESSED"
           data-toggle="tooltip"
           data-placement="top"
           title="Candidates scheduled for testing and those who have been tested.">
            Test
            <span class="badge">{{ $application_statuses['ASSESSED'] }}</span></a>
    </li>
    <li>
        <a href="javascript://"
           data-value="INTERVIEWED"
           data-toggle="tooltip"
           data-placement="top"
           title="Candidates scheduled for an interview and those who have been interviewed.">
            Interview
            <span class="badge">{{ $application_statuses['INTERVIEWED'] }}</span></a>
    </li>
    <li>
        <a href="javascript://"
           data-value="WAITING"
           data-toggle="tooltip"
           data-placement="top"
           title="Candidates currently lined up for approval for the next recruitment stage.">
            Waiting
            <span class="badge">{{ $application_statuses['WAITING'] }}</span></a>
    </li>
    <li>
        <a href="javascript://"
           data-value="HIRED"
           data-toggle="tooltip"
           data-placement="top"
           title="Candidates who have successfully passed through all the recruitment stage and have been hired for this job.">
            Hire
            <span class="badge">{{ $application_statuses['HIRED'] }}</span></a>
    </li>
    <li>
        <a href="javascript://"
           data-value="REJECTED"
           data-toggle="tooltip"
           data-placement="top"
           title="Candidates considered unsuited for the job and have been dismissed from the recruitment process.">
            Reject
            <span class="badge">{{ $application_statuses['REJECTED'] }}</span></a>
    </li>--}}
</ul>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>