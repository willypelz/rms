@if( $result['response']['numFound'] > 0  )
                      
  @foreach( @$result['response']['docs'] as $cv )
  
  <?php  $pic = default_color_picture( $cv )  ?>
  
<li class="row">
      <span class="col-md-2 col-sm-3">
          <a class="" href="my-cv.html">

              <img class="media-object job-team-img" width="100%" src="{{ $pic['image'] }}" style="background:{{ $pic['color'] }};" alt="">
          </a>
      </span>

      <span class="col-md-10 col-sm-9">
              <h4 class="text-muted">
              <a href="javascript://" id='showCvBtn' data-toggle="modal" data-target="#showCv[data-user='{{ @$cv['id'] }}']">
                @if(@$is_applicant)
                    {{ ucwords( $cv['first_name'].' '.$cv['last_name'] ) }}
                @else
                    {{ ucwords( $cv['first_name'].' '.substr($cv['last_name'],0,1) ) }}
                @endif
              </a>
                  <span class="small">
                  
                  @if(@$cv['dob'])
                    . {{ \App\Libraries\Utilities::getAge($cv['dob']) }}
                  
                  @endif
                  <!--<span class="label label-primary">INSIDIFY</span>-->
              </h4>
              <p>{{ @$cv['last_position'].' at '.@$cv['last_company_worked'] }}</p>

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
                  @if( $page == 'saved' )
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
                      <ul class="dropdown-menu" id="folders" data-folders="{{ @implode( ':', @$cv['company_folder_id'] ) }}" data-cv="{{ @$cv['id'] }}">
                        

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

                    @if( $page == 'pool' )
                        <a href="javascript://" class="btn btn-line btn-sm" id="showCvBtn" data-toggle="modal" data-target="#cvModal"  onclick="showCvModal('{{ $cv['id'] }}',true);">Preview CV</a>
                    @else
                        <a href="javascript://" class="btn btn-line btn-sm" id="showCvBtn" data-toggle="modal" data-target="#showCv[data-user='{{ @$cv['id'] }}']">Preview CV</a>
                    @endif
                    
                  
                  @if(@$can_purchase)
                    <span class="purchase-action">
                          @if(@$is_saved)
                            <a href="javascript://" class="btn btn-sm btn-line pull-right" title="Delete CV" id='removeSavedCV' data-user='{{ @$cv['id'] }}'><i class="fa fa-trash no-margin"></i></a>
                          @endif

                          <?php 
                            if($ids != null)
                              $in_cart = in_array($cv['id'], $ids);
                            else
                              $in_cart = "";
                          ?>
                          
                          @if($in_cart)
                            <button id="cartRemove{{ $cv['id'] }}" class="btn btn-line btn-sm btn-cv-discard" data-count="1" data-cost="500"><i class="fa fa-trash"></i> Remove from Cart </button>
                          @else
                            <a href="" id="cartAdd{{ $cv['id'] }}" class="btn btn-success btn-sm btn-cv-buy" data-count="1" data-cost="500"><i class="fa fa-plus"></i> Purchase CV for N500</a>
                            <button id="cartRemove{{ $cv['id'] }}" class="btn btn-line btn-sm btn-cv-discard collapse" data-count="1" data-cost="500"><i class="fa fa-trash"></i> Remove from Cart </button>
                          @endif

                  </span>
                  @endif

                </p>
              </div>
      </span>

</li><hr>
<div class="modal fade no-border" id="showCv" data-user="{{ @$cv['id'] }}" tabindex="-1" role="dialog" aria-labelledby="cvViewModalLabel" aria-hidden="false">
  @include('cv-sales.includes.cv-preview')
</div>
<script>
    $(document).ready(function(){

        var id = "{{ $cv['id'] }}";
        var url = "{{ route('cart') }}"
        
        $("#cartAdd"+id).click(function(){
            // console.log(url)
            $.ajax
            ({
              type: "POST",
              url: url,
              data: ({ rnd : Math.random() * 100000, cv_id: id, type:'add', name:"{{ $cv['first_name']. " " . $cv['last_name'] }}", 'qty':1, 'price':500, "_token":"{{ csrf_token() }}"}),
              success: function(response){
                
                console.log(response);
                
              }
          });

        });


        $("#cartRemove"+id).click(function(){
            // console.log(url)
            $.ajax
            ({
              type: "POST",
              url: url,
              data: ({ rnd : Math.random() * 100000, cv_id: id, type:'remove', "_token":"{{ csrf_token() }}"}),
              success: function(response){
                
                console.log(response);
                
              }
          });

        });

        $("#clearCart").click(function(){
            // console.log(url)
            $.ajax
            ({
              type: "POST",
              url: url,
              data: ({ rnd : Math.random() * 100000, cv_id: id, type:'clear', "_token":"{{ csrf_token() }}"}),
              success: function(response){
                
                console.log(response);
                
              }
          });

        });


    })

</script>
@endforeach

@if( $page == 'pool' )
  
  {{-- */ $pagination_url = url('cv/talent-pool') /* --}}

@elseif( $page == 'saved' )
  
  {{-- */ $pagination_url = url('cv/saved') /* --}}
  
@elseif( $page == 'purchased' )
  
  {{-- */ $pagination_url = url('cv/purchased') /* --}}
  
@elseif( $page == 'search' )

  {{-- */ $pagination_url = url('cv/search') /* --}}

@endif


<script type="text/javascript">

  $(document).ready(function(){
        if($('#pagination').data("twbs-pagination")){
            $('#pagination').twbsPagination('destroy');
        }

       $('#pagination').twbsPagination({
        totalPages: "{{ ceil( $result['response']['numFound'] / 20 ) }}",
        visiblePages: 5,
        startPage: parseInt( "{{ ( intval( $start / 20 ) + 1 ) }}" ),
        initiateStartPageClick: false,
        onPageClick: function (event, page) {
          console.log(page,filters);
            $('#page-content').text('Page ' + page);
            $('.search-results').html('{!! preloader() !!}');
            var url = "{{ (@$is_saved) ? url('cv/saved') : url('cv/search')   }}";
            var pagination_url = "{{ $pagination_url }}";
            $.get(pagination_url, {search_query: $('#search_query').val(), start: ( page - 1 ) , filter_query : filters , age: age_range },function(data){
                //console.log(response);
                // var response = JSON.parse(data);
                // console.log(data.search_results);
                $('#showing').html(data.showing)
                $('.search-results').html(data.search_results);
            });
        }
    });
  });
</script>

@if(count(@$result['response']['docs']) < 1)
    <li class="row">
      <div class="text-center text-muted">
      <i class="fa fa-frown-o fa-3x"></i>
        <h3>
          
          @if( $page == 'search' )
              Not Found. Please Search again.
          @elseif( $page == 'pool' )
              Sorry you have no more CVs in your pool
          @elseif( $page == 'saved' )
              Sorry you have no more Saved CVs
          @elseif( $page == 'purchased' )
              Sorry you have no more purchased any CVs
          @endif
        </h3>
      </div>
    </li>
@endif

@else
  <li class="row">
    <div class="text-center text-muted">
    <i class="fa fa-frown-o fa-3x"></i>
      <h3>
        
        @if( $page == 'search' )
            Not Found. Please Search again.
        @elseif( $page == 'pool' )
            Sorry you have no CVs in your pool
        @elseif( $page == 'saved' )
            Sorry you have no Saved CVs
        @elseif( $page == 'purchased' )
            Sorry you have not purchased any CVs
        @endif
      </h3>
    </div>
  </li>
@endif