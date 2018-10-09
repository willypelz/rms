<section class="job-head no-margin" style="padding-bottom: 0px;">
  <div class="">
    <div class="row">
      <div class="col-sm-8 col-sm-offset-2 text-center">
        
        <h3 class="text-white no-margin">
        {{ $current_application->job->title }}
        </h3>

        
      </div>
      <div class="clearfix"></div>
      
    </div>
  </div><br><br><br>

  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="@if( Route::currentRouteName() == "candidate-activities" ) active @endif"><a href="{{ route('candidate-activities', ['application_id' => $application_id]) }}" >Activities</a></li>
    <li role="presentation" class="@if( Route::currentRouteName() == "candidate-messages" ) active @endif"><a href="{{ route('candidate-messages', ['application_id' => $application_id]) }}">Messages</a></li>
    <li role="presentation" class="@if( Route::currentRouteName() == "candidate-documents" ) active @endif"><a href="{{ route('candidate-documents', ['application_id' => $application_id]) }}">Documents</a></li>
  </ul>
</section>