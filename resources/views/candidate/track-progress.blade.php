<section class="job-head no-margin">
  <div class="">
    <div class="row">
      <div class="col-sm-8 col-sm-offset-2 text-center">
        
        <h3 class="text-white no-margin">
        Track Your Application Progress
        
        </h3>
        <hr>
        @php $statuses = Auth::guard('candidate')->user()->applications->groupBy('status')  @endphp
        <ul class="list-inline text-white">
          @foreach( $statuses  as $key => $status)
            <li>{{ $status->count(). " ". $key }}</li>
          @endforeach
        </ul>
      </div>
      <div class="clearfix"></div>
      
    </div>
  </div>
</section>
<div class="row">
  <div class="col-sm-12">
    <div class="page no-bod-rad">
      <br>
      <h5 style="margin: 5px 20px;">APPLICANT ID: {{ $applicant_id }}</h5>
      <ul class="list-group list-notify list-track">
        
        @foreach( Auth::guard('candidate')->user()->applications as $application )
          @if($application->job->status == "ACTIVE")
          <li role="candidate-application" class="list-group-item">
            
            <a href="{{ route('candidate-activities', ['application_id' => $application->id ]) }}"><h4 class="no-margin text-info">{{ $application->job->title }}</h4></a>
            <p class="text-uppercase">at <span>{{ $application->job->company->name }}</span></p>
            <div class="hr-xs"></div>
            <p>
              <a href="{{ route('job-view',['jobID'=>$application->job->id,'jobSlug'=>str_slug($application->job->title)]) }}" target="_blank" style="margin-right: 10px;"> View Job</a>
              <label class="label label-lg label-info pull-right"> {{ $application->status }}</label>
              <b>Applied</b>: {{ date('D. j M, Y', strtotime( $application->created)) }}
            </p>
          </li>
          @endif
        @endforeach
        
      </ul>
      <div class="clearfix"></div>
    </div>
  </div>
</div>