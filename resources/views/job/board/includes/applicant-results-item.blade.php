@if( $result['response']['numFound'] > 0 )
                      
  @foreach( @$result['response']['docs'] as $cv )
  
  
  <div class="comment media" data-cv="{{ $cv['id'] }}">
  <hr>
      <span class="col-md-2 col-sm-3">
        <a href="{{ route('applicant-profile', $cv['application_id'][ array_search( $jobID, $cv['job_id'] ) ] ) }}" target="_blank"  class="pull-left">
            <img alt="" src="{{ default_picture( $cv ) }}" class="media-object " width="100%">
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
              <a data-toggle="modal" data-target="#viewModal" id="modalButton" href="#viewModal" data-title="Shortlist?" data-view="{{ route('modal-shortlist') }}" data-app-id="{{ $cv['application_id'][ array_search( $jobID, $cv['job_id'] ) ] }}" data-cv="{{ $cv['id'] }}" data-type="normal">Shortlist</a>
              <span class="text-muted">·</span>
              <!-- <a href="#" data-toggle="modal" data-target="#reviewCv[data-user='{{ @$cv['id'] }}']" id="reviewBtn-{{ $cv['application_id'][ array_search( $jobID, $cv['job_id'] ) ] }}">Comment</a> -->
              <a data-toggle="modal" data-target="#viewModal" id="modalButton" href="#viewModal" data-title="Comment" data-view="{{ route('modal-comment') }}" data-app-id="{{ $cv['application_id'][ array_search( $jobID, $cv['job_id'] ) ] }}" data-cv="{{ $cv['id'] }}" data-type="normal">Comment</a>
              <span class="text-muted">·</span>
              <a data-toggle="modal" data-target="#viewModal" id="modalButton" href="#viewModal" data-title="Assess" data-view="{{ route('modal-assess') }}" data-app-id="{{ $cv['application_id'][ array_search( $jobID, $cv['job_id'] ) ] }}" data-cv="{{ $cv['id'] }}" data-type="wide">Test</a>
              <span class="text-muted">·</span>
              <a data-toggle="modal" data-target="#viewModal" id="modalButton" href="#viewModal" data-title="Interview" data-view="{{ route('modal-interview') }}" data-app-id="{{ $cv['application_id'][ array_search( $jobID, $cv['job_id'] ) ] }}" data-cv="{{ $cv['id'] }}" data-type="normal">Interview</a>
              <span class="text-muted">·</span>
              <a data-toggle="modal" class="text-danger" data-target="#viewModal" id="modalButton" href="#viewModal" data-title="Reject?" data-view="{{ route('modal-reject') }}" data-app-id="{{ $cv['application_id'][ array_search( $jobID, $cv['job_id'] ) ] }}" data-cv="{{ $cv['id'] }}" data-type="normal">Reject</a>

              <span class="pull-right hide">
                  <a class="text-muted" href="#">Background Check</a>
                  <span class="text-muted">·</span>
              </span>
          </small>



      </div>
  </div>


<div class="modal fade" tabindex="-1" id="reviewCv" data-user="{{ @$cv['id'] }}" role="dialog" aria-labelledby="reviewCv">
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
    </div>
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




@else
  <li class="row">
    <div class="text-center text-muted">
    <i class="fa fa-frown-o fa-3x"></i>
      <h3>There are no Applicants in this Section.</h3>
    </div>
  </li>
@endif