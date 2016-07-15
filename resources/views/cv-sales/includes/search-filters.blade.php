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

              <p class="border-bottom-thin text-muted">Keyword search<i class="glyphicon glyphicon-user pull-right"></i></p>
              <div class="input-group">
                
                <input type="text" class="form-control" id="search_keyword" placeholder="keyword">
                <a class="btn btn-small input-group-addon" href="#" onclick="searchKeyword(); return false;" >GO</a>
              </div>
              <p></p> 

          @if( @$status == 'ASSESSED' )
                  <p class="border-bottom-thin text-muted">Test Name<i class="glyphicon glyphicon-user pull-right"></i></p>
                    <div class="checkbox-inline">
                        {{--*/ $other_test_name = 0  /*--}}
                        {{--*/ $index = 0  /*--}}
                        @foreach( $result['facet_counts']['facet_fields']['test_name'] as $key => $test_name )
                            @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['test_name'][ $key + 1 ] != 0  )
                              
                              {{--*/ $index++  /*--}}
                              <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="test_name" data-value="{{ $test_name }}" > {{ ucwords( $test_name )." (".$result['facet_counts']['facet_fields']['test_name'][ $key + 1 ].")" }}</label> <br></div>
                            @else

                              {{--*/ @$other_test_name += $result['facet_counts']['facet_fields']['test_name'][ $key + 1 ] /*--}}

                            @endif
                        @endforeach

                        <div class="hide"><label class="normal"><input type="checkbox"  class="" data-field="test_name" data-value="null"> unspecified {{ " (".$other_test_name.")" }}</label> <br></div>
                    </div>
                    
                    @if($index > 4)
                      <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
                    @endif
                    <p></p>


                    
                    <p class="border-bottom-thin text-muted">Test Status<i class="glyphicon glyphicon-user pull-right"></i></p>
                      <div class="checkbox-inline">
                          {{--*/ $other_test_status = 0  /*--}}
                          {{--*/ $index = 0  /*--}}
                          @foreach( $result['facet_counts']['facet_fields']['test_status'] as $key => $test_status )
                              @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['test_status'][ $key + 1 ] != 0  )
                                
                                {{--*/ $index++  /*--}}
                                <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="test_status" data-value="{{ $test_status }}" > {{ ucwords( $test_status )." (".$result['facet_counts']['facet_fields']['test_status'][ $key + 1 ].")" }}</label> <br></div>
                              @else

                                {{--*/ @$other_test_status += $result['facet_counts']['facet_fields']['test_status'][ $key + 1 ] /*--}}

                              @endif
                          @endforeach

                          <div class="hide"><label class="normal"><input type="checkbox"  class="" data-field="test_status" data-value="null"> unspecified {{ " (".$other_test_status.")" }}</label> <br></div>
                      </div>
                      
                      @if($index > 4)
                        <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
                      @endif
                      <p></p>
                    




                    <p class="border-bottom-thin text-muted">Test Score<i class="glyphicon glyphicon-user pull-right"></i></p>
                      <div class="checkbox-inline">
                          {{--*/ $other_test_score = 0  /*--}}
                          {{--*/ $index = 0  /*--}}
                          @foreach( $result['facet_counts']['facet_fields']['test_score'] as $key => $test_score )
                              @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['test_score'][ $key + 1 ] != 0  )
                                
                                {{--*/ $index++  /*--}}
                                <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="test_score" data-value="{{ $test_score }}" > {{ ucwords( $test_score )." (".$result['facet_counts']['facet_fields']['test_score'][ $key + 1 ].")" }}</label> <br></div>
                              @else

                                {{--*/ @$other_test_score += $result['facet_counts']['facet_fields']['test_score'][ $key + 1 ] /*--}}

                              @endif
                          @endforeach

                          <div class="hide"><label class="normal"><input type="checkbox"  class="" data-field="test_score" data-value="null"> unspecified {{ " (".$other_test_score.")" }}</label> <br></div>
                      </div>
                      
                      @if($index > 4)
                        <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
                      @endif
                      <p></p>

          @else
    



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

                        <div class="hide"><label class="normal"><input type="checkbox"  class="" data-field="gender" data-value="null"> unspecified {{ " (".@$other_folder_name.")" }}</label> <br></div>
                    </div>
                    
                    @if($index > 4)
                      <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
                    @endif
                    <p></p>

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
              <p></p>
              


            @if( @$age )
              <!-- <div><small class="">&nbsp; <a href="" class="">See More</a></small></div> -->
              <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/7.0.2/bootstrap-slider.min.js"></script>
              <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/7.0.2/css/bootstrap-slider.min.css" />
                

                <p class="border-bottom-thin text-muted">Age<i class="glyphicon glyphicon-birthday pull-right"></i></p>
                     <p class="text-center">
                        <input id="age-slider" type="text" class="span2" value="" data-slider-min="1" data-slider-max="200" data-slider-step="1" data-slider-value="{{ '['.$age[0].','.$age[1].']' }}"/> 
                        <div class="text-center">
                          <b class="col-sm-2 pull-left" style="color: #bbb;">1</b>
                          <b  class="col-sm-2 pull-right" style="color: #bbb;">200</b>
                          <small id="age-range"> {{ $age[0].' - '.$age[1].' years' }} </small>
                        </div>
                       <div class="clearfix"></div>
                     </p>

                    <p></p>

              <style type="text/css">
                #ex1Slider .slider-selection {
                  background: #BABABA;
                }
              </style>      
          
              <script type="text/javascript">
                  $(document).ready(function(){
                      $("#age-slider").slider({
                        // formatter: function(value,a) {

                        //   return 'Current value: ' + value + "  ";
                        // }
                      });
                      $("#age-slider").on("slideStop", function(slideEvt) {
                        
                        age_range = slideEvt.value;

                        $('#age-range').html( slideEvt.value[0] + ' - ' + slideEvt.value[1] + ' years' )
                        $("#age-slider").performFilter();
                      });
                  });
              </script>
        @endif
            

            <p class="border-bottom-thin text-muted">Highest Education<i class="glyphicon glyphicon-map-marker pull-right"></i></p>
              <div class="checkbox-inline">
                  {{--*/ $other_highest_qualificationl = 0  /*--}}
                  {{--*/ $index = 0  /*--}}
                  @foreach( $result['facet_counts']['facet_fields']['highest_qualification'] as $key => $highest_qualification )
                      @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['highest_qualification'][ $key + 1 ] != 0 &&  $highest_qualification != ''  && $highest_qualification != "0"  )
                        
                        {{--*/ $index++  /*--}}
                        <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="highest_qualification" data-value="{{ $highest_qualification }}"> {{ ucwords( $highest_qualification )." (".$result['facet_counts']['facet_fields']['highest_qualification'][ $key + 1 ].")" }}</label> <br></div>
                      @else

                        {{--*/ @$other_highest_qualification += $result['facet_counts']['facet_fields']['highest_qualification'][ $key + 1 ] /*--}}

                      @endif
                  @endforeach

                  <div class="hide"><label class="normal"><input type="checkbox"  class=""> unspecified {{ " (".$other_highest_qualification.")" }}</label> <br></div>
              </div>
              
              @if($index > 4)
                <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
              @endif

            <p></p>

            <p class="border-bottom-thin text-muted">Location<i class="glyphicon glyphicon-map-marker pull-right"></i></p>
              <div class="checkbox-inline">
                  {{--*/ $other_state = 0  /*--}}
                  {{--*/ $index = 0  /*--}}

                  @foreach( $result['facet_counts']['facet_fields']['state'] as $key => $state )
                      @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['state'][ $key + 1 ] != 0 )
                        
                        {{--*/ $index++  /*--}}
                        <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="state" data-value="{{ $state }}"> {{ ucwords( $state )." (".$result['facet_counts']['facet_fields']['state'][ $key + 1 ].")" }}</label> <br></div>
                      @else

                        {{--*/ @$other_state += $result['facet_counts']['facet_fields']['state'][ $key + 1 ] /*--}}

                      @endif
                  @endforeach

                  <div class="hide"><label class="normal"><input type="checkbox"  class=""> unspecified {{ " (".$other_state.")" }}</label> <br></div>
              </div>
              
              @if($index > 4)
                <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
              @endif

              <p></p>

              <p class="border-bottom-thin text-muted">Willing to Relocate?<i class="glyphicon glyphicon-map-marker pull-right"></i></p>
              <div class="checkbox-inline">
                  {{--*/ $other_willing_to_relocate = 0  /*--}}
                  {{--*/ $index = 0  /*--}}

                  @foreach( $result['facet_counts']['facet_fields']['willing_to_relocate'] as $key => $willing_to_relocate )
                      @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['willing_to_relocate'][ $key + 1 ] != 0 )
                        
                        {{--*/ $index++  /*--}}
                        <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="willing_to_relocate" data-value="{{ $willing_to_relocate }}"> 
                        @if( $willing_to_relocate == "true")
                          {{  "Yes (".$result['facet_counts']['facet_fields']['willing_to_relocate'][ $key + 1 ].")" }}
                        @elseif( $willing_to_relocate == "false")
                          {{  "No (".$result['facet_counts']['facet_fields']['willing_to_relocate'][ $key + 1 ].")" }}
                        @endif
                        </label> <br></div>
                      @else

                        {{--*/ @$other_willing_to_relocate += $result['facet_counts']['facet_fields']['willing_to_relocate'][ $key + 1 ] /*--}}

                      @endif
                  @endforeach

                  <div class="hide"><label class="normal"><input type="checkbox"  class=""> unspecified {{ " (".$other_willing_to_relocate.")" }}</label> <br></div>
              </div>
              
              @if($index > 4)
                <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
              @endif

              <p></p>

            <p class="border-bottom-thin text-muted">Last Position held<i class="glyphicon glyphicon-map-marker pull-right"></i></p>
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

            <p></p>

            <p class="border-bottom-thin text-muted">Last Company Worked at<i class="glyphicon glyphicon-map-marker pull-right"></i></p>
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

            <p></p>

            @if(false)
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
            <p></p>

            <p class="border-bottom-thin text-muted">State of Origin<i class="glyphicon glyphicon-map-marker pull-right"></i></p>
              <div class="checkbox-inline">
                  {{--*/ $other_state_of_origin = 0  /*--}}
                  {{--*/ $index = 0  /*--}}
                  @foreach( $result['facet_counts']['facet_fields']['state_of_origin'] as $key => $state_of_origin )
                      @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['state_of_origin'][ $key + 1 ] != 0 &&  $state_of_origin != ''  && $state_of_origin != "0" && $state_of_origin != "-Choose-" )
                        
                        {{--*/ $index++  /*--}}
                        <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="state_of_origin" data-value="{{ $state_of_origin }}"> {{ ucwords( $state_of_origin )." (".$result['facet_counts']['facet_fields']['state_of_origin'][ $key + 1 ].")" }}</label> <br></div>
                      @else

                        {{--*/ @$other_state_of_origin += $result['facet_counts']['facet_fields']['state_of_origin'][ $key + 1 ] /*--}}

                      @endif
                  @endforeach

                  <div class="hide"><label class="normal"><input type="checkbox"  class=""> unspecified {{ " (".$other_state_of_origin.")" }}</label> <br></div>
              </div>
              
              @if($index > 4)
                <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
              @endif

              <p></p>

              @endif

        @if( @$age )
     

      <p class="border-bottom-thin text-muted">Years of Experience<i class="glyphicon glyphicon-birthday pull-right"></i></p>
             <p class="text-center">
                <input id="exp_years-slider" type="text" class="span2" value="" data-slider-min="0" data-slider-max="200" data-slider-step="1" data-slider-value="{{ '['.$exp_years[0].','.$exp_years[1].']' }}"/> 
                <div class="text-center">
                  <b class="col-sm-2 pull-left" style="color: #bbb;">0</b>
                  <b  class="col-sm-2 pull-right" style="color: #bbb;">200</b>
                  <small id="exp_years-range"> {{ $exp_years[0].' - '.$exp_years[1].' years' }} </small>
                </div>
               <div class="clearfix"></div>
             </p>

            <p></p>
            
      <script type="text/javascript">
          $(document).ready(function(){
              $("#exp_years-slider").slider({
                // formatter: function(value,a) {

                //   return 'Current value: ' + value + "  ";
                // }
              });
              $("#exp_years-slider").on("slideStop", function(slideEvt) {
                
                exp_years_range = slideEvt.value;

                $('#exp_years-range').html( slideEvt.value[0] + ' - ' + slideEvt.value[1] + ' years' )
                $("#exp_years-slider").performFilter();
              });
          });
      </script>


        @endif

      

      @endif 
  <!-- end of if when it is not assessed -->

          </div>
        </div>
      </div>
    </div>
    @endif