@if( $result['response']['numFound'] > 0  )
                      
  @foreach( @$result['response']['docs'] as $cv )
  
  <?php  $pic = default_color_picture( $cv )  ?>
  
<li class="row">
      <span class="col-md-2 col-sm-3">
          <a class="" href="javascript://" id='showCvBtn' data-toggle="modal" data-target="#showCv[data-user='{{ @$cv['id'] }}']">

              <img class="media-object job-team-img" width="100%" src="{{ $pic['image'] }}" style="background:{{ $pic['color'] }};" alt="">
          </a>
      </span>

      <span class="col-md-10 col-sm-9">
              <h4 class="text-muted">
              <a href="javascript://" id='showCvBtn' data-toggle="modal" data-target="#showCv[data-user='{{ @$cv['id'] }}']">
                @if(@$is_applicant || $page == 'pool')
                    {{ ucwords( @$cv['first_name'].' '.@$cv['last_name'] ) }}
                @else
                    {{ ucwords( @$cv['first_name'].' '.substr(@$cv['last_name'],0,1) ) }}
                @endif
              </a>
                  <span class="small">
                  
                  @if(@$cv['dob'] &&  $cv['dob'] != '1970-01-01T00:00:00Z')
                    . {{ \App\Libraries\Utilities::getAge($cv['dob']) }}
                  
                  @endif
                  <!--<span class="label label-primary">INSIDIFY</span>-->
              </h4>
              <p>{{ @$cv['last_position'] }} @if( @$cv['last_company_worked'] != '' ) {{ ' at '.@$cv['last_company_worked'] }}  @endif</p>

              <div class="description">
                  <!-- <p class="sub-box excerpt-p text-muted hidden"><i>bodied security men and women needed in a hotel. Must be smart and able to work in a corporate environment</i></p>
                  <br> -->
                  @if(@$is_saved)
                    <span class="details-small">
                      <!-- <span class="small text-danger no-margin pull-right">Purchased Thu 12-03-16</span> -->
                      <!-- <span class="small text-muted" id="saved_folders_view">
                        
                      </span> -->
                    </span>
                  @endif

                  @if( $page == 'pool' )
                    <?php

                      
                      $applicant_jobs = [];
                      
                      foreach ($myJobs as $key => $job){
                        if( in_array($job['id'], $cv['job_id']) ) 
                        {
                          $applicant_jobs[] = '<a href="'.route('job-candidates', [$job['id']]).'" target="_blank">'.ucwords( $job['title'] ).'</a>';
                        }
                      }

                      if( count($applicant_jobs) > 0 )
                      {
                        $source = '<i class="fa fa-briefcase"></i> Applicant for ';


                        if( count($applicant_jobs) > 1 )
                        {
                          $total_source = $source. implode(', ', $applicant_jobs);
                          $source .= $applicant_jobs[0] ." and <a href='' id='other_applicant_jobs'>".( count( $applicant_jobs ) - 1 )." other Jobs <span id='hidden_other_applicant_jobs' style='display:none;'>".$total_source."</span> </a>";
                        }
                        else
                        {
                          $source .= $applicant_jobs[0];
                        }
                      }
                      else // Check if the upload is available
                      {

                      }


                      

                      
                    ?>
                    <span class="details-small">
                      <!-- <span class="small text-danger no-margin pull-right">Purchased Thu 12-03-16</span> -->
                      <span class="small text-muted" id="saved_folders_view">
                          {!! $source !!}
                      </span>
                    </span>
                    
                  @endif
                <p class="">
                      <!-- Single button -->
                  @if( @$page == 'saved' )
                    @if( Auth::check()  )
                    <div class="btn-group">

                      <button type="button" class="btn btn-line btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if(@$is_saved)
                          Change Folder
                        @else
                          Save into Folder
                        @endif

                         &nbsp; <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu" id="folders" data-folders="{{-- @implode( ':', @$cv['company_folder_id'] ) --}}" data-cv="{{ @$cv['id'] }}">
                        

                        <li role="separator" class="divider"></li>

                        <li>
                            <a href="#" id="add_folder_btn" target="_blank" data-toggle="modal" data-target="#newFolder" ><i class="fa fa-plus"></i> Create new</a>
                        </li>


                      </ul>


                    </div>
                    @else
                        <a href="{{ url('log-in') }}" class="btn btn-line btn-sm dropdown-toggle">Save into Folder</a>
                    @endif

                  @endif

                    @if( @$is_applicant || $page == 'pool' )
                        <a href="javascript://" class="btn btn-line btn-sm" id="showCvBtn" data-toggle="modal" data-target="#cvModal"  onclick="showCvModal('{{ $cv['id'] }}',true);">Preview CV</a>
                    @else
                        <a href="javascript://" class="btn btn-line btn-sm" id="showCvBtn" data-toggle="modal" data-target="#showCv[data-user='{{ @$cv['id'] }}']">Preview CV</a>
                    @endif
                    
                  
                  

                </p>
              </div>
      </span>

</li><hr>

@endforeach


@else
  <br>
    <div class="alert text-center alert-warning">
      <p class="lead" style="">
      <i class="fa-2x fa fa-exclamation-circle"></i><br> 
      @if($page == 'pool')
        No CV found
      @elseif($page == 'search')
        No results found
      @elseif($page == 'saved')
        No saved CV found

      @endif
  
      </p>
    </div>

@endif