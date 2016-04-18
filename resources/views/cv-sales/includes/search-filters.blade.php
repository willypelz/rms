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

              @if(@$is_saved)

                  <p class="border-bottom-thin text-muted">Folder<i class="glyphicon glyphicon-user pull-right"></i></p>
                    <div class="checkbox-inline">
                        {{--*/ $other_gender = 0  /*--}}
                        {{--*/ $index = 0  /*--}}
                        @foreach( $result['facet_counts']['facet_fields']['folder_name'] as $key => $folder_name )
                            @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['folder_name'][ $key + 1 ] != 0 )
                              
                              {{--*/ $index++  /*--}}
                              <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="folder_name" data-value="{{ $folder_name }}" > {{ $folder_name ." (".$result['facet_counts']['facet_fields']['folder_name'][ $key + 1 ].")" }}</label> <br></div>
                            @else

                              {{--*/ @$other_folder_name += $result['facet_counts']['facet_fields']['folder_name'][ $key + 1 ] /*--}}

                            @endif
                        @endforeach

                        <div class="hide"><label class="normal"><input type="checkbox"  class="" data-field="gender" data-value="null"> unspecified {{ " (".$other_folder_name.")" }}</label> <br></div>
                    </div>
                    
                    @if($index > 4)
                      <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
                    @endif
                    <p>--</p>

              @endif

              <p class="border-bottom-thin text-muted">Keyword search<i class="glyphicon glyphicon-user pull-right"></i></p>
              <div class="input-group">
                
                <input type="text" class="form-control" id="search_keyword" placeholder="keyword">
                <a class="btn btn-small input-group-addon" href="#" onclick="searchKeyword(); return false;" >GO</a>
              </div>
              <p>--</p> 



              <p class="border-bottom-thin text-muted">Gender<i class="glyphicon glyphicon-user pull-right"></i></p>
              <div class="checkbox-inline">
                  {{--*/ $other_gender = 0  /*--}}
                  {{--*/ $index = 0  /*--}}
                  @foreach( $result['facet_counts']['facet_fields']['gender'] as $key => $gender )
                      @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['gender'][ $key + 1 ] != 0  && ( $gender == 'male' || $gender == 'female' ))
                        
                        {{--*/ $index++  /*--}}
                        <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="gender" data-value="{{ $gender }}" > {{ ucwords( $gender )." (".$result['facet_counts']['facet_fields']['gender'][ $key + 1 ].")" }}</label> <br></div>
                      @else

                        {{--*/ @$other_gender += $result['facet_counts']['facet_fields']['gender'][ $key + 1 ] /*--}}

                      @endif
                  @endforeach

                  <div class="hide"><label class="normal"><input type="checkbox"  class="" data-field="gender" data-value="null"> unspecified {{ " (".$other_gender.")" }}</label> <br></div>
              </div>
              
              @if($index > 4)
                <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
              @endif
              <p>--</p>

            <p class="border-bottom-thin text-muted">Marital Status<i class="glyphicon glyphicon-map-marker pull-right"></i></p>
              <div class="checkbox-inline">
                  {{--*/ $other_marital_status = 0  /*--}}
                  {{--*/ $index = 0  /*--}}
                  @foreach( $result['facet_counts']['facet_fields']['marital_status'] as $key => $marital_status )
                      @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['marital_status'][ $key + 1 ] != 0 &&  $marital_status != ''  && $marital_status != "0"  )

                          {{--*/ $index++  /*--}}
                        <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="marital_status" data-value="{{ $marital_status }}"> {{ ucwords( $marital_status )." (".$result['facet_counts']['facet_fields']['marital_status'][ $key + 1 ].")" }}</label> <br></div>
                      @else

                        {{--*/ @$other_marital_status += $result['facet_counts']['facet_fields']['marital_status'][ $key + 1 ] /*--}}

                      @endif
                  @endforeach

                  <div class="hide"><label class="normal"><input type="checkbox"  class=""> unspecified {{ " (".$other_marital_status.")" }}</label> <br></div>
              </div>
              
              @if($index > 4)
                <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
              @endif
            <p>--</p>

            <p class="border-bottom-thin text-muted">Last Position<i class="glyphicon glyphicon-map-marker pull-right"></i></p>
              <div class="checkbox-inline">
                  {{--*/ $other_edu_school = 0  /*--}}
                  {{--*/ $index = 0  /*--}}
                  @foreach( $result['facet_counts']['facet_fields']['last_position'] as $key => $last_position )
                      @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['last_position'][ $key + 1 ] != 0 &&  $last_position != ''  && $last_position != "0"  )
                        
                        {{--*/ $index++  /*--}}
                        <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="last_position" data-value="{{ $last_position }}"> {{ ucwords( $last_position )." (".$result['facet_counts']['facet_fields']['last_position'][ $key + 1 ].")" }}</label> <br></div>
                      @else

                        {{--*/ @$other_edu_school += $result['facet_counts']['facet_fields']['last_position'][ $key + 1 ] /*--}}

                      @endif
                  @endforeach

                  <div class="hide"><label class="normal"><input type="checkbox"  class=""> unspecified {{ " (".$other_edu_school.")" }}</label> <br></div>
              </div>
              
              @if($index > 4)
                <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
              @endif

            <p>--</p>

            <p class="border-bottom-thin text-muted">Last Company Worked<i class="glyphicon glyphicon-map-marker pull-right"></i></p>
              <div class="checkbox-inline">
                  {{--*/ $other_exp_company = 0  /*--}}
                  {{--*/ $index = 0  /*--}}
                  @foreach( $result['facet_counts']['facet_fields']['last_company_worked'] as $key => $last_company_worked )
                      @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['last_company_worked'][ $key + 1 ] != 0 &&  $last_company_worked != ''  && $last_company_worked != "0"  )
                        
                        {{--*/ $index++  /*--}}
                        <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="last_company_worked" data-value="{{ $last_company_worked }}"> {{ ucwords( $last_company_worked )." (".$result['facet_counts']['facet_fields']['last_company_worked'][ $key + 1 ].")" }}</label> <br></div>
                      @else

                        {{--*/ @$other_exp_company += $result['facet_counts']['facet_fields']['last_company_worked'][ $key + 1 ] /*--}}

                      @endif
                  @endforeach

                  <div class="hide"><label class="normal"><input type="checkbox"  class=""> unspecified {{ " (".$other_exp_company.")" }}</label> <br></div>
              </div>
              
              @if($index > 4)
                <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
              @endif

            <p>--</p>

            <p class="border-bottom-thin text-muted">State of Origin<i class="glyphicon glyphicon-map-marker pull-right"></i></p>
              <div class="checkbox-inline">
                  {{--*/ $other_edu_grade = 0  /*--}}
                  {{--*/ $index = 0  /*--}}
                  @foreach( $result['facet_counts']['facet_fields']['state_of_origin'] as $key => $state_of_origin )
                      @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['state_of_origin'][ $key + 1 ] != 0 &&  $state_of_origin != ''  && $state_of_origin != "0" && $state_of_origin != "-Choose-" )
                        
                        {{--*/ $index++  /*--}}
                        <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="state_of_origin" data-value="{{ $state_of_origin }}"> {{ ucwords( $state_of_origin )." (".$result['facet_counts']['facet_fields']['state_of_origin'][ $key + 1 ].")" }}</label> <br></div>
                      @else

                        {{--*/ @$other_edu_grade += $result['facet_counts']['facet_fields']['state_of_origin'][ $key + 1 ] /*--}}

                      @endif
                  @endforeach

                  <div class="hide"><label class="normal"><input type="checkbox"  class=""> unspecified {{ " (".$other_edu_grade.")" }}</label> <br></div>
              </div>
              
              @if($index > 4)
                <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
              @endif
              
              <!-- <div><small class="">&nbsp; <a href="" class="">See More</a></small></div> -->




          </div>
        </div>
      </div>
    </div>
    @endif