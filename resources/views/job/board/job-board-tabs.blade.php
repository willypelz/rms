@php
    $user_role = getCurrentLoggedInUserRole();
@endphp

<div class="btn-group btn-group-justified btn-tabs job-dash no-pad text-brandon" role="group" aria-label="...">
                           <div class="btn-group" role="group">
                            <a  @if($user_role->name == 'interviewer') disabled @endif  href="{{ route('job-board', [$job->id]) }}" type="button" class="btn btn-line text-capitalize @if($active_tab == 'activities') in @endif">
                            <span class="fa-lg"><i class="fa fa-bar-chart"></i>
                            <span class="hidden-xs"> &nbsp; Activities</span></span>
                            <!-- <small class="text-muted hidden-xs">Job Statistics</small> -->
                            </a>
                          </div>

                           <div class="btn-group" role="group">
                            <a href="{{ route('job-candidates', [$job->id]) }}" type="button" class="btn btn-line text-capitalize @if($active_tab == 'candidates') in @endif">
                            <span class="fa-lg"><i class="fa fa-users"></i>
                            <span class="hidden-xs"> &nbsp; Applicants</span></span>
                            <!-- <small class="text-muted hidden-xs">See all applicants and their status </small> -->
                            </a>
                          </div>

                          <div class="btn-group hidden" role="group">
                            <a href="{{ route('job-matching', [$job->id]) }}" type="button" class="btn btn-line text-capitalize text-muted @if($active_tab == 'matching') in @endif">
                            <span class="fa-lg"><i class="fa fa-user-md"></i>
                            <span class="hidden-xs"> &nbsp; Matching CVs</span></span>
                            <!-- <small class="text-muted hidden-xs">Edit your settings</small> -->
                            </a>
                          </div>

                          <div class="btn-group" role="group">
                            <a @if($user_role->name != 'admin') disabled @endif href="{{ route('job-promote', [$job->id]) }}" type="button" class="btn btn-line text-capitalize text-muted @if($active_tab == 'promote') in @endif">
                            <span class="fa-lg"><i class="fa fa-send"></i>
                            <span class="hidden-xs"> &nbsp; Promote Job</span></span>
                            <!-- <small class="text-muted hidden-xs">Edit your settings</small> -->
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="{{ route('job-team', [$job->id]) }}" type="button" class="btn btn-line text-capitalize @if($active_tab == 'team') in @endif">
                            <span class="fa-lg"><i class="fa fa-building"></i>
                            <span class="hidden-xs"> &nbsp; Job Team</span></span>
                            <!-- <small class="text-muted hidden-xs">Resumes / CVs</small> -->
                            </a>
                          </div>
                          
</div>