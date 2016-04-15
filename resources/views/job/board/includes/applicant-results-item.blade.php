@if( $result['response']['numFound'] > 0 )
                      
  @foreach( @$result['response']['docs'] as $cv )
  
  <hr>
  <div class="comment media">
      <span class="col-md-2 col-sm-3">
        <a href="{{ route('applicant-profile', $cv['id'] ) }}"  class="pull-left">
            <img alt="" src="{{ default_picture( $cv ) }}" class="media-object " width="100%">
        </a>
      </span>
      <div class="media-body">
          <input type="checkbox" class="media-body-check pull-right">
          <h4 class="media-heading text-muted"><a href="{{ route('applicant-profile', $cv['id'] ) }}">{{ ucwords( $cv['first_name']. " " . $cv['last_name'] ) }}</a>
          </h4>
          <p>{{ @$cv['tagline'] }}</p>
          <small>
              <span class="text-muted">18 minutes ago</span>
              &nbsp;
              <a id='showCvBtn' data-toggle="modal" data-target="#showCv[data-user='{{ @$cv['id'] }}']">Cv</a>
              <span class="text-muted">·</span>
              <a href="#">Review</a>
              <span class="text-muted">·</span>
              <a href="#">Assess</a>
              <span class="text-muted">·</span>
              <a href="#">Interview</a>
              <span class="text-muted">·</span>
              <a href="#">Reject</a>

              <span class="pull-right">
                  <a class="text-muted" href="#">other items</a>
                  <span class="text-muted">·</span>
                  <a class="text-muted" href="#">option1</a>
                  <span class="text-muted">·</span>
                  <a class="text-muted" href="#">option2</a>
              </span>
          </small>



      </div>
  </div>
<div class="modal fade no-border" id="showCv" data-user="{{ @$cv['id'] }}" tabindex="-1" role="dialog" aria-labelledby="cvViewModalLabel" aria-hidden="false">
  @include('cv-sales.includes.cv-preview')
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



<script type="text/javascript">

  $(document).ready(function(){
        if($('#pagination').data("twbs-pagination")){
            $('#pagination').twbsPagination('destroy');
        }

       $('#pagination').twbsPagination({
        totalPages: "{{ ceil( $result['response']['numFound'] / 20 ) }}",
        visiblePages: 7,
        initiateStartPageClick: false,
        onPageClick: function (event, page) {
          console.log(page,filters);
            $('#page-content').text('Page ' + page);
            $('.search-results').html("Loading");
            var url = "{{ (@$is_saved) ? url('cv/saved') : url('cv/search')   }}";
            var pagination_url = "";
            $.get(pagination_url, {search_query: $('#search_query').val(), start: ( page - 1 ) , filter_query : filters },function(data){
                //console.log(response);
                // var response = JSON.parse(data);
                // console.log(data.search_results);
                $('.search-results').html(data.search_results);
            });
        }
    });
  });
</script>

@else
  <li class="row">
    <div class="text-center text-muted">
    <i class="fa fa-frown-o fa-3x"></i>
      <h3>Not Found. Please Search again.</h3>
    </div>
  </li>
@endif