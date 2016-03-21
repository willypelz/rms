@extends('layout.template-user')

@section('content')

{{-- dd($result) --}}
<pre>

</pre>
<section class="s-div dark">
        <div class="container">

            <div class="row">
                <div class="col-md-6 hidden-sm hidden-xs">
                    <div class=""><br>
                        <h4 class="text-white push-down text-uppercase text-brandon"> <i class="fa fa-street-view"></i> Talent Pool</h4>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <form action="{{ url('cv/search') }}" class="form-group" method="POST"><br>
                      {!! csrf_field() !!}
                       <div class="form-lg">
                         <div class="col-xs-10">
                           <div class="row"><input placeholder="Find something you want" name="search_query" id="search_query" value="{{ $search_query }}" class="form-control input-lg input-talent" type="text"></div>
                         </div>
                         <div class="col-xs-2">
                           <div class="row">
                               <button type="submit" class="btn btn-lg btn-block btn-success btn-talent">
                               <!-- Find <span class="hidden-sm hidden-xs">Candidates</span>  -->
                               <i class="fa fa-search fa-lg"></i>
                               </button>
                           </div>
                         </div>
                       </div>
                    </form>

                </div>
            </div>

        </div>
    </section>

    <section class="no-pad">
        <div class="container">
            <div class="row">

                <div class="col-md-12">

                    <div class="content rounded ">

        <div class="row">
{{-- file_get_contents("http://127.0.0.1:5000/extract?file_name=".( "http://files.insidify.com/uploads/cv/adeigbe_musibau_2015.doc" ) ) --}}


            <div class="col-sm-8">

                  <div class="" id="search-results">

                    <ul class="search-results">
                      
                       @include('cv-sales.includes.search-results-item')

                      
                      
                    </ul>
                
              </div> <!--/tab-content-->

            </div>
            <!-- End of col-9 -->

            <div class="col-sm-4">
                <div id="collapseWellCart" class="well well-cart animated slideInUp collapse">
                    <div class="row">
                        <div class="col-md-3 hidden-xs hidden-sm small text-light text-muted">Cart<br>
                              <i class="fa fa-shopping-cart fa-3x"></i>
                            </span>
                        </div>
                        <div class="col-md-4 col-xs-3 col-sm-3 small text-left text-muted text-light"> Items<br>
                            <span id="item-count">
                                    <span class="bounceInDown fa-2x" style="display: inline-block;">0</span>
                            </span>
                        </div>
                        <div class="col-md-5 col-xs-9 col-sm-9 small text-right text-muted text-light"> Cost<br>
                            <span class="pull-right fa-2x">
                                &#8358; 
                                <span id="price-total" >0</span> 
                            </span>
                        </div>
                    </div><hr>
                    <div class="row">
                        <div class="col-xs-6"><a href="#" target="_blank" data-toggle="modal" data-target="#myInvoice" class="btn btn-block btn-danger btn-sm btn-cart-checkout"> Checkout &raquo;</a></div>
                        <div class="col-xs-6"><button class="btn btn-block btn-line btn-sm btn-cart-clear text-muted"><i class="fa fa-close"></i> Clear</button></div>
                    </div>
                </div>
              @if( $result['response']['numFound'] > 0 )
              <div class="panel-group filter-div" id="accordion">


                  <div class="panel panel-default" style="border-width: 3px">
                    <div class="panel-heading">
                      <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                          Filter Result here
                        </a>
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="pull-right"><img src="{{ asset('img/up.png') }}"></a>
                      </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                      <div class="panel-body">
                          <p class="border-bottom-thin text-muted">Gender<i class="glyphicon glyphicon-user pull-right"></i></p>
                          <div class="checkbox-inline">
                              {{--*/ $other_gender = 0  /*--}}
                              @foreach( $result['facet_counts']['facet_fields']['gender'] as $key => $gender )
                                  @if( $key % 2 == 0 && ( $gender == 'male' || $gender == 'female' ))
                                    
                                    <label class="normal"><input type="checkbox" class="" data-field="gender" data-value="{{ $gender }}"> {{ ucwords( $gender )." (".$result['facet_counts']['facet_fields']['gender'][ $key + 1 ].")" }}</label> <br>
                                  @else

                                    {{--*/ @$other_gender += $result['facet_counts']['facet_fields']['gender'][ $key + 1 ] /*--}}

                                  @endif
                              @endforeach

                              <label class="normal"><input type="checkbox" class="" data-field="gender" data-value="null"> unspecified {{ " (".$other_gender.")" }}</label> <br>
                          </div>

                          <p>--</p>

                        <p class="border-bottom-thin text-muted">Marital Status<i class="glyphicon glyphicon-map-marker pull-right"></i></p>
                          <div class="checkbox-inline">
                              {{--*/ $other_marital_status = 0  /*--}}
                              @foreach( $result['facet_counts']['facet_fields']['marital_status'] as $key => $marital_status )
                                  @if( $key % 2 == 0 &&  $marital_status != ''  && $marital_status != "0"  )
                                    
                                    <label class="normal"><input type="checkbox" class="" data-field="marital_status" data-value="{{ $marital_status }}"> {{ ucwords( $marital_status )." (".$result['facet_counts']['facet_fields']['marital_status'][ $key + 1 ].")" }}</label> <br>
                                  @else

                                    {{--*/ @$other_marital_status += $result['facet_counts']['facet_fields']['gender'][ $key + 1 ] /*--}}

                                  @endif
                              @endforeach

                              <label class="normal"><input type="checkbox" class=""> unspecified {{ " (".$other_marital_status.")" }}</label> <br>
                          </div>
                        
                        <p>--</p>

                        <p class="border-bottom-thin text-muted">School<i class="glyphicon glyphicon-map-marker pull-right"></i></p>
                          <div class="checkbox-inline">
                              {{--*/ $other_edu_school = 0  /*--}}
                              @foreach( $result['facet_counts']['facet_fields']['edu_school'] as $key => $edu_school )
                                  @if( $key % 2 == 0 &&  $edu_school != ''  && $edu_school != "0"  )
                                    
                                    <label class="normal"><input type="checkbox" class="" data-field="edu_school" data-value="{{ $edu_school }}"> {{ ucwords( $edu_school )." (".$result['facet_counts']['facet_fields']['edu_school'][ $key + 1 ].")" }}</label> <br>
                                  @else

                                    {{--*/ @$other_edu_school += $result['facet_counts']['facet_fields']['gender'][ $key + 1 ] /*--}}

                                  @endif
                              @endforeach

                              <label class="normal"><input type="checkbox" class=""> unspecified {{ " (".$other_edu_school.")" }}</label> <br>
                          </div>


                        <p>--</p>

                        <p class="border-bottom-thin text-muted">Company<i class="glyphicon glyphicon-map-marker pull-right"></i></p>
                          <div class="checkbox-inline">
                              {{--*/ $other_exp_company = 0  /*--}}
                              @foreach( $result['facet_counts']['facet_fields']['exp_company'] as $key => $exp_company )
                                  @if( $key % 2 == 0 &&  $exp_company != ''  && $exp_company != "0"  )
                                    
                                    <label class="normal"><input type="checkbox" class="" data-field="exp_company" data-value="{{ $exp_company }}"> {{ ucwords( $exp_company )." (".$result['facet_counts']['facet_fields']['exp_company'][ $key + 1 ].")" }}</label> <br>
                                  @else

                                    {{--*/ @$other_exp_company += $result['facet_counts']['facet_fields']['gender'][ $key + 1 ] /*--}}

                                  @endif
                              @endforeach

                              <label class="normal"><input type="checkbox" class=""> unspecified {{ " (".$other_exp_company.")" }}</label> <br>
                          </div>


                        <p>--</p>

                        <p class="border-bottom-thin text-muted">Grade<i class="glyphicon glyphicon-map-marker pull-right"></i></p>
                          <div class="checkbox-inline">
                              {{--*/ $other_edu_grade = 0  /*--}}
                              @foreach( $result['facet_counts']['facet_fields']['edu_grade'] as $key => $edu_grade )
                                  @if( $key % 2 == 0 &&  $edu_grade != ''  && $edu_grade != "0" && $edu_grade != "-Choose-" )
                                    
                                    <label class="normal"><input type="checkbox" class="" data-field="edu_grade" data-value="{{ $edu_grade }}"> {{ ucwords( $edu_grade )." (".$result['facet_counts']['facet_fields']['edu_grade'][ $key + 1 ].")" }}</label> <br>
                                  @else

                                    {{--*/ @$other_edu_grade += $result['facet_counts']['facet_fields']['gender'][ $key + 1 ] /*--}}

                                  @endif
                              @endforeach

                              <label class="normal"><input type="checkbox" class=""> unspecified {{ " (".$other_edu_grade.")" }}</label> <br>
                          </div>
                          <div><a href="#" class="more-link read-more-show "><small>See More</small></a></div>
                          
                          <!-- <div><small class="">&nbsp; <a href="" class="">See More</a></small></div> -->




                      </div>
                    </div>
                  </div>
                </div>
                @endif
            </div> <!--/col-sm-4-->

            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group text-right">
                        <a data-toggle="modal" data-target="#myInvoice" href="#" target="_blank" type="submit" class="btn btn-danger disabled btn-cart-checkout">Proceed to payment &raquo;</a>
                    </div>
                </div>
            </div>

        </div>

    </div>

                

            </div>
        </div>
    </section>

<script type="text/javascript">
    $(document).ready(function(){
        filters = [];

        $('.filter-div input[type=checkbox').on('change',function(){
            console.log("changed");

            var filter = $(this).attr('data-field') + ':"' + $(this).attr('data-value') + '"';
            var index = $.inArray( filter, filters );
            console.log( filter + "---" + index );
            if( index == -1 )
            {
              filters.push( filter );
            }
            else
            {
                filters.splice(index, 1);
            }

            $('.search-results').html("Loading");
            $.post("{{ url('cv/filter_search') }}", {search_query: $('#search_query').val(), filter_query : filters },function(data){
                //console.log(data);
                $('.search-results').html(data);
            });
        });
    });
</script>


@endsection

