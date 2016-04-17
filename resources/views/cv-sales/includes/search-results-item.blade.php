@if( $result['response']['numFound'] > 0 )
                      
  @foreach( @$result['response']['docs'] as $cv )
  
<li class="row">
      <span class="col-md-2 col-sm-3">
          <a class="" href="my-cv.html">

              <img class="media-object job-team-img" width="100%" src="{{ default_picture( $cv ) }}" alt="">
          </a>
      </span>

      <span class="col-md-10 col-sm-9">
              <h4 class="text-muted">
              <a href="javascript://" id='showCvBtn' data-toggle="modal" data-target="#showCv[data-user='{{ @$cv['id'] }}']">{{ ucwords( $cv['first_name']. " " . $cv['last_name'] ) }}</a>
                  <span class="small">
                  
                  @if(@$cv['dob'])
                    . {{ \App\Libraries\Utilities::getAge($cv['dob']) }}
                  
                  @endif
                  <!--<span class="label label-primary">INSIDIFY</span>-->
              </h4>
              <p>{{ @$cv['last_position'].' at '.@$cv['last_company_worked'] }}</p>

              <div class="description">
                  <p class="sub-box excerpt-p text-muted hidden"><i>bodied security men and women needed in a hotel. Must be smart and able to work in a corporate environment</i></p>
                  <br>
                  @if(@$is_saved)
                    <span class="details-small">
                      <!-- <span class="small text-danger no-margin pull-right">Purchased Thu 12-03-16</span> -->
                      <span class="small text-muted" id="saved_folders_view"></span>
                    </span>
                  @endif
                <p class="">
                      <!-- Single button -->
                  @if( Auth::check() )
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
                    <a href="javascript://" class="btn btn-line btn-sm" id='showCvBtn' data-toggle="modal" data-target="#showCv[data-user='{{ @$cv['id'] }}']">Preview CV</a>

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



<script type="text/javascript">

  $(document).ready(function(){
        if($('#pagination').data("twbs-pagination")){
            $('#pagination').twbsPagination('destroy');
        }

       $('#pagination').twbsPagination({
        totalPages: "{{ ceil( $result['response']['numFound'] / 20 ) }}",
        visiblePages: 5,
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
                $('#showing').html(data.showing)
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