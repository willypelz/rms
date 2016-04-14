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

            <p class="border-bottom-thin text-muted">School<i class="glyphicon glyphicon-map-marker pull-right"></i></p>
              <div class="checkbox-inline">
                  {{--*/ $other_edu_school = 0  /*--}}
                  {{--*/ $index = 0  /*--}}
                  @foreach( $result['facet_counts']['facet_fields']['edu_school'] as $key => $edu_school )
                      @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['edu_school'][ $key + 1 ] != 0 &&  $edu_school != ''  && $edu_school != "0"  )
                        
                        {{--*/ $index++  /*--}}
                        <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="edu_school" data-value="{{ $edu_school }}"> {{ ucwords( $edu_school )." (".$result['facet_counts']['facet_fields']['edu_school'][ $key + 1 ].")" }}</label> <br></div>
                      @else

                        {{--*/ @$other_edu_school += $result['facet_counts']['facet_fields']['edu_school'][ $key + 1 ] /*--}}

                      @endif
                  @endforeach

                  <div class="hide"><label class="normal"><input type="checkbox"  class=""> unspecified {{ " (".$other_edu_school.")" }}</label> <br></div>
              </div>
              
              @if($index > 4)
                <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
              @endif

            <p>--</p>

            <p class="border-bottom-thin text-muted">Company<i class="glyphicon glyphicon-map-marker pull-right"></i></p>
              <div class="checkbox-inline">
                  {{--*/ $other_exp_company = 0  /*--}}
                  {{--*/ $index = 0  /*--}}
                  @foreach( $result['facet_counts']['facet_fields']['exp_company'] as $key => $exp_company )
                      @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['exp_company'][ $key + 1 ] != 0 &&  $exp_company != ''  && $exp_company != "0"  )
                        
                        {{--*/ $index++  /*--}}
                        <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="exp_company" data-value="{{ $exp_company }}"> {{ ucwords( $exp_company )." (".$result['facet_counts']['facet_fields']['exp_company'][ $key + 1 ].")" }}</label> <br></div>
                      @else

                        {{--*/ @$other_exp_company += $result['facet_counts']['facet_fields']['exp_company'][ $key + 1 ] /*--}}

                      @endif
                  @endforeach

                  <div class="hide"><label class="normal"><input type="checkbox"  class=""> unspecified {{ " (".$other_exp_company.")" }}</label> <br></div>
              </div>
              
              @if($index > 4)
                <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
              @endif

            <p>--</p>

            <p class="border-bottom-thin text-muted">Grade<i class="glyphicon glyphicon-map-marker pull-right"></i></p>
              <div class="checkbox-inline">
                  {{--*/ $other_edu_grade = 0  /*--}}
                  {{--*/ $index = 0  /*--}}
                  @foreach( $result['facet_counts']['facet_fields']['edu_grade'] as $key => $edu_grade )
                      @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['edu_grade'][ $key + 1 ] != 0 &&  $edu_grade != ''  && $edu_grade != "0" && $edu_grade != "-Choose-" )
                        
                        {{--*/ $index++  /*--}}
                        <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="edu_grade" data-value="{{ $edu_grade }}"> {{ ucwords( $edu_grade )." (".$result['facet_counts']['facet_fields']['edu_grade'][ $key + 1 ].")" }}</label> <br></div>
                      @else

                        {{--*/ @$other_edu_grade += $result['facet_counts']['facet_fields']['edu_grade'][ $key + 1 ] /*--}}

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