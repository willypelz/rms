@if( $result['response']['numFound'] > 0 )
                      
  @foreach( @$result['response']['docs'] as $cv )
  
  <?php  $pic = default_color_picture( $cv )  ?>
  
  <div class="comment media" data-cv="{{ $cv['id'] }}" data-app-id="{{ $cv['application_id'][ array_search( $jobID, $cv['job_id'] ) ] }}">
  <hr>
      <span class="col-md-2 col-sm-3">
        <a href="{{ route('applicant-profile', $cv['application_id'][ array_search( $jobID, $cv['job_id'] ) ] ) }}" target="_blank"  class="pull-left">
            <img alt="" src="{{ $pic['image'] }}" style="background:{{ $pic['color'] }};" class="media-object " width="100%">
        </a>
      </span>
      <div class="media-body">
          <input type="checkbox" class="media-body-check check-applicant pull-right">
          <h4 class="media-heading text-muted"><a href="{{ route('applicant-profile', $cv['application_id'][ array_search( $jobID, $cv['job_id'] ) ] ) }}" target="_blank">{{ ucwords( $cv['first_name']. " " . $cv['last_name'] ) }}</a>
          </h4>
          <p>{{ @$cv['last_position'].' at '.@$cv['last_company_worked'] }}</p>
          <small>
              <span class="text-muted">{{ human_time( @$cv['application_date'], 1) }}</span>
              &nbsp;
              <a id="showCvBtn" data-toggle="modal" data-target="#cvModal"  onclick="showCvModal('{{ $cv['id'] }}',true);" >View Cv</a>
              <span class="text-muted">·</span>
              <a href="{{ route('applicant-profile', $cv['application_id'][ array_search( $jobID, $cv['job_id'] ) ] ) }}">View Application</a>
              <span class="text-muted">·</span>

              @if($status != 'SHORTLISTED' && $status != 'ASSESSED' && $status != 'INTERVIEWED' && $status != 'HIRED')
              <a data-toggle="modal" data-target="#viewModal" id="modalButton" href="#viewModal" data-title="Shortlist?" data-view="{{ route('modal-shortlist') }}" data-app-id="{{ $cv['application_id'][ array_search( $jobID, $cv['job_id'] ) ] }}" data-cv="{{ $cv['id'] }}" data-type="normal">Shortlist</a>
              <span class="text-muted">·</span>
              @endif
              <!-- <a href="#" data-toggle="modal" data-target="#reviewCv[data-user='{{ @$cv['id'] }}']" id="reviewBtn-{{ $cv['application_id'][ array_search( $jobID, $cv['job_id'] ) ] }}">Comment</a> -->
              <a data-toggle="modal" data-target="#viewModal" id="modalButton" href="#viewModal" data-title="Comment" data-view="{{ route('modal-comment') }}" data-app-id="{{ $cv['application_id'][ array_search( $jobID, $cv['job_id'] ) ] }}" data-cv="{{ $cv['id'] }}" data-type="normal">Comment</a>
              <span class="text-muted">·</span>

              @if($status != 'ASSESSED' && $status != 'HIRED')
              <a data-toggle="modal" data-target="#viewModal" id="modalButton" href="#viewModal" data-title="Test" data-view="{{ route('modal-assess') }}" data-app-id="{{ $cv['application_id'][ array_search( $jobID, $cv['job_id'] ) ] }}" data-cv="{{ $cv['id'] }}" data-type="wide">Test</a>
              <span class="text-muted">·</span>
              @endif


              @if($status != 'INTERVIEWED' && $status != 'HIRED')
              <a data-toggle="modal" data-target="#viewModal" id="modalButton" href="#viewModal" data-title="Schedule an interview for" data-view="{{ route('modal-interview') }}" data-app-id="{{ $cv['application_id'][ array_search( $jobID, $cv['job_id'] ) ] }}" data-cv="{{ $cv['id'] }}" data-type="normal">Interview</a>
              <span class="text-muted">·</span>

              @endif


              @if(!empty($status))
              <a data-toggle="modal" data-target="#viewModal" id="modalButton" href="#viewModal" data-title="Do you want to return to all?" data-view="{{ route('modal-return-to-all') }}" data-app-id="{{ $cv['application_id'][ array_search( $jobID, $cv['job_id'] ) ] }}" data-cv="{{ $cv['id'] }}" data-type="normal">Return</a>
              <span class="text-muted">·</span>
              @endif

              <a data-toggle="modal" class="text-danger" data-target="#viewModal" id="modalButton" href="#viewModal" data-title="Reject?" data-view="{{ route('modal-reject') }}" data-app-id="{{ $cv['application_id'][ array_search( $jobID, $cv['job_id'] ) ] }}" data-cv="{{ $cv['id'] }}" data-type="normal">Reject</a>

              <span class="dropdown">&nbsp; &middot; &nbsp;
                <a id="checkDrop" type="button" data-toggle="dropdown" aria-expanded="false">Checks
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="checkDrop" style="position:relative; float:right; border: 1px solid rgba(0, 0, 0, 0.03);">
                  <li><a data-toggle="modal" data-target="#viewModal" id="modalButton" href="#viewModal" data-title="Background Check" data-view="{{ route('modal-background-check') }}" data-app-id="{{ $cv['application_id'][ array_search( $jobID, $cv['job_id'] ) ] }}" data-cv="{{ $cv['id'] }}" data-type="wide">Background Check</a></li>
                  <li><a data-toggle="modal" data-target="#viewModal" id="modalButton" href="#viewModal" data-title="Medical Check" data-view="{{ route('modal-medical-check') }}" data-app-id="{{ $cv['application_id'][ array_search( $jobID, $cv['job_id'] ) ] }}" data-cv="{{ $cv['id'] }}" data-type="wide">Medical Check</a></li>
                </ul>
              </span> 

              <span class="pull-right hide">
                  <a class="text-muted" href="#">Background Check</a>
                  <span class="text-muted">·</span>
              </span>
          </small>



      </div>
  </div>


<!-- <div class="modal fade" tabindex="-1" id="reviewCv" data-user="{{ @$cv['id'] }}" role="dialog" aria-labelledby="reviewCv">
      <div class="modal-dialog">
        <div class="modal-content">

            <h3 class="text-center">Write a review</h3>


        <section class="no-pad" id='ContentAREA'>
                <div class="">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="content rounded">
                                <div id="message"></div>
                                <div class="form-group">
                                    <textarea class="form-control" id="add_folder" data-app-id="{{ $cv['application_id'][ array_search( $jobID, $cv['job_id'] ) ] }}"></textarea>
                              
                                    
                                  </div>
                                  <div class="clearfix"></div>
                              <div class="pull-right">
                                  <a href="javascript://" id="writeReviewBtn" data-app-id="{{ $cv['application_id'][ array_search( $jobID, $cv['job_id'] ) ] }}" data-cv="{{ $cv['id'] }}" class="btn btn-success pull-right">Send</a>
                                  <div class="separator separator-small"></div>
                              </div>
        
                            </div>
                        </div>
                    </div>
                </div>
         </section>
        </div>
      </div>
    </div> -->
<!--script>
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

</script-->
@endforeach

<script type="text/javascript">
  total_candidates = "{{ $result['response']['numFound'] }}";
  
  $(document).ready(function(){
        if($('#pagination').data("twbs-pagination")){
            $('#pagination').twbsPagination('destroy');
        }

       $('#pagination').twbsPagination({
        totalPages: "{{ ceil( $result['response']['numFound'] / 20 ) }}",
        visiblePages: 5,
        initiateStartPageClick: false,
        startPage: parseInt( "{{ ( intval( $start / 20 ) + 1 ) }}" ),
        onPageClick: function (event, page) {
          // console.log(page,filters);
            scrollTo('.job-progress-xs')
            $('#page-content').text('Page ' + page);
            $('.result-label').html('')
            $('#pagination').hide();
            $('.search-results').html('{!! preloader() !!}');
            var url = "{{ (@$is_saved) ? url('cv/saved') : url('cv/search')   }}";
            var pagination_url = "{{ route('job-candidates', $jobID) }}";
            $.get(pagination_url, {search_query: $('#search_query').val(), start: ( page - 1 ) , filter_query : filters,status : status_filter },function(data){
                //console.log(response);
                // var response = JSON.parse(data);
                // console.log(data.search_results);
                $('.result-label').html(data.showing)
                $('.search-results').html(data.search_results);
                $('#pagination').show();
            });
        }
    });
  });
</script>



@else
  <li class="row">
    <div class="text-center text-muted">
    <i class="fa fa-frown-o fa-3x"></i>
      <h3>There are no Applicants in this Section.</h3>
    </div>
  </li>
@endif