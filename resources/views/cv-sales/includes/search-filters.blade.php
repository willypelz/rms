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

            @if( @$page != 'search' )
              <p class="border-bottom-thin text-muted">Keyword search <i class="fa fa-filter pull-right"></i></p>
              <div class="input-group">

                <input type="text" class="form-control" id="search_keyword" placeholder="Search by name">
                <a class="btn btn-small input-group-addon" href="#" onclick="searchKeyword(); return false;" >GO</a>
              </div>
              <p></p>

            @endif


            <p class="border-bottom-thin text-muted">Pending approval?<i class="fa fa-filter pull-right"></i></p>
              <div class="checkbox-inline">
                  {{--*/ $other_willing_to_relocate = 0  /*--}}
                  {{--*/ $index = 0  /*--}}

                  @foreach( $result['facet_counts']['facet_fields']['is_approved'] as $key => $is_approved )
                      @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['is_approved'][ $key + 1 ] != 0 )

                      @php $index = ($loop->iteration) @endphp

                        {{--*/ $index++  /*--}}
                        <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="is_approved" data-value="{{ $is_approved }}">
                        @if( $is_approved == "true")
                          {{  "No (".$result['facet_counts']['facet_fields']['is_approved'][ $key + 1 ].")" }}
                        @elseif( $is_approved == "false")
                          {{  "Yes (".$result['facet_counts']['facet_fields']['is_approved'][ $key + 1 ].")" }}
                        @endif
                        </label> <br></div>
                      @else

                        {{--*/ @$other_willing_to_relocate += $result['facet_counts']['facet_fields']['willing_to_relocate'][ $key + 1 ] /*--}}

                      @endif
                  @endforeach

                  {{-- <div class="hide"><label class="normal"><input type="checkbox"  class=""> unspecified {{ " (".$other_willing_to_relocate.")" }}</label> <br></div> --}}
              </div>

              @if($index > 4)
                <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
              @endif

              <p></p>

          @if( @$status == 'ASSESSED' )
                  <p class="border-bottom-thin text-muted">Test Name<i class="fa fa-filter pull-right"></i></p>
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



                    <p class="border-bottom-thin text-muted">Test Status<i class="fa fa-filter pull-right"></i></p>
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




                    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.2.3/bootstrap-slider.min.js" integrity="sha256-5nbI9tCmHZc4BwASrfLC1vJlG4NEVJrqF2v5AkPagHk=" crossorigin="anonymous"></script>

              <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.2.3/css/bootstrap-slider.min.css" integrity="sha256-OtZEO9nZAHk5GocvW/Mozi3E3tWtBeBR/nt2U6jxwLQ=" crossorigin="anonymous" />


                <p class="border-bottom-thin text-muted">Completed Test Score<i class="glyphicon glyphicon-birthday pull-right"></i></p>
                     <p class="text-center">
                        <input id="score-slider" type="text" class="span2" value="" data-slider-min="40" data-slider-max="160" data-slider-step="5" data-slider-value="@if(isset($test_score)) {{ '['.$test_score[0].','.$test_score[1].']' }} @endif"/>
                        <div class="text-center">
                          <b class="col-sm-2 pull-left" style="color: #bbb;">40</b>
                          <b  class="col-sm-2 pull-right" style="color: #bbb;">160</b>
                          <small id="score-range"> {{ $test_score[0].' - '.$test_score[1] }} </small>
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
                      $("#score-slider").bootstrapSlider({
                        // formatter: function(value,a) {

                        //   return 'Current value: ' + value + "  ";
                        // }
                      });
                      $("#score-slider").on("slideStop", function(slideEvt) {

                        test_score_range = slideEvt.value;

                        $('#score-range').html( slideEvt.value[0] + ' - ' + slideEvt.value[1] );
                        $("#score-slider").performFilter();
                      });
                  });
              </script>

          <p class="border-bottom-thin text-muted">Age<i class="glyphicon glyphicon-birthday pull-right"></i></p>
                     <p class="text-center">
                        <input id="age-slider" type="text" class="span2" value="" data-slider-min="{{ env('AGE_START') }}" data-slider-max="{{ env('AGE_END') }}" data-slider-step="1" data-slider-value="@if(!is_null($age[0]) && !is_null($age[1])) {{ '['.$age[0].','.$age[1].']' }} @endif"/>
                        <div class="text-center">
                          <b class="col-sm-2 pull-left" style="color: #bbb;">{{ env('AGE_START') }}</b>
                          <b  class="col-sm-2 pull-right" style="color: #bbb;">{{ env('AGE_END') }}</b>
                          <small id="age-range"> {{ $age[0].' - '.$age[1].' years' }} </small>
                        </div>
                       <div class="clearfix"></div>
                     </p>

                    <p></p>

                    <p class="border-bottom-thin text-muted">Minimium Remuneration<i class="glyphicon glyphicon-birthday pull-right"></i></p>
                    <p class="text-center">
                       <input id="age-slider" type="text" class="span2" value="" data-slider-min="0" data-slider-max="1000000000000000" data-slider-step="1" data-slider-value="@if(!is_null($minimum_remuneration[0]) && !is_null($age[1])) {{ '['.$minimum_remuneration[0].','.$age[1].']' }} @endif"/>
                       <div class="text-center">
                         <b class="col-sm-2 pull-left" style="color: #bbb;">{{ env('AGE_START') }}</b>
                         <b  class="col-sm-2 pull-right" style="color: #bbb;">{{ env('AGE_END') }}</b>
                         <small id="age-range"> {{ $age[0].' - '.$age[1].' years' }} </small>
                       </div>
                      <div class="clearfix"></div>
                    </p>

                   <p></p>

                   <p class="border-bottom-thin text-muted">Maximium Remuneration<i class="glyphicon glyphicon-birthday pull-right"></i></p>
                   <p class="text-center">
                      <input id="age-slider" type="text" class="span2" value="" data-slider-min="0" data-slider-max="1000000000000000" data-slider-step="1" data-slider-value="@if(!is_null($age[0]) && !is_null($age[1])) {{ '['.$age[0].','.$age[1].']' }} @endif"/>
                      <div class="text-center">
                        <b class="col-sm-2 pull-left" style="color: #bbb;">{{ env('AGE_START') }}</b>
                        <b  class="col-sm-2 pull-right" style="color: #bbb;">{{ env('AGE_END') }}</b>
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
                      $("#age-slider").bootstrapSlider({
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

             <!--  <p class="border-bottom-thin text-muted">Test Score<i class="fa fa-filter pull-right"></i></p>
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
                      <p></p> -->

          @else




              @if(@$is_saved and false)

                  <p class="border-bottom-thin text-muted">Folder<i class="fa fa-filter pull-right"></i></p>
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



              

              <p class="border-bottom-thin text-muted">Gender<i class="fa fa-filter pull-right"></i></p>
              <div class="checkbox-inline">
                  @php  $other_gender = 0; $genderArray = [];  @endphp
                  {{--*/ $index = 0  /*--}}
                  @foreach( $result['facet_counts']['facet_fields']['gender'] as $key => $gender )
                      @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['gender'][ $key + 1 ] != 0  && ( strtolower($gender) == 'male' || strtolower($gender) == 'female' ))
                        
                        @php $genderArray[] = $gender @endphp
                        {{--*/ $index++  /*--}}
                        <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="gender" data-value="{{ $gender }}" > {{ ucwords( $gender )." (".$result['facet_counts']['facet_fields']['gender'][ $key + 1 ].")" }}</label> <br></div>
                      @else

                        @php 
                          @$other_gender += isset($result['facet_counts']['facet_fields']['gender'][ $key + 1 ]) &&
                          is_numeric($result['facet_counts']['facet_fields']['gender'][ $key + 1 ]) ?
                          $result['facet_counts']['facet_fields']['gender'][ $key + 1 ] : 0;
                          
                          @endphp
                      @endif
                  @endforeach
                  
                  @if($other_gender)
                    <div class="hideA"><label class="normal"><input type="checkbox"  class="" data-field="gender" data-value="null"> unspecified {{ " (".$other_gender.")" }}</label> <br></div>
                  @endif
              </div>

              @if($index > 4)
                <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
              @endif
              <p></p>


              @if( @$page != 'search' and Auth::check())




               <p class="border-bottom-thin text-muted">Cv Source<i class="fa fa-filter pull-right"></i></p>
              <div class="checkbox-inline">
                  @php $other_highest_qualification = 0  @endphp
                  {{--*/ $index = 0  /*--}}
                  @foreach( $result['facet_counts']['facet_fields']['cv_source'] as $key => $cv_source )
                      @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['cv_source'][ $key + 1 ] != 0 &&  $cv_source != ''  && $cv_source != "0"  )

                        {{--*/ $index++  /*--}}
                        <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="cv_source" data-value="{{ $cv_source }}"> {{ ucwords( $cv_source )." (".$result['facet_counts']['facet_fields']['cv_source'][ $key + 1 ].")" }}</label> <br></div>
                      @else

                        @php @$other_highest_qualification += isset($result['facet_counts']['facet_fields']['cv_source'][ $key + 1 ]) &&
                        is_numeric($result['facet_counts']['facet_fields']['cv_source'][ $key + 1 ]) ?
                        $result['facet_counts']['facet_fields']['cv_source'][ $key + 1 ] : 0;
                        @endphp

                      @endif
                  @endforeach

                  <div class="hide"><label class="normal"><input type="checkbox"  class=""> unspecified {{ " (".$other_highest_qualification.")" }}</label> <br></div>
              </div>

              @if($index > 4)
                <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
              @endif

            <p></p>




              @endif

              @if( @$age )


              <!-- <div><small class="">&nbsp; <a href="" class="">See More</a></small></div> -->
              <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/7.0.2/bootstrap-slider.min.js"></script>
              <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/7.0.2/css/bootstrap-slider.min.css" />


                <p class="border-bottom-thin text-muted">Age<i class="glyphicon glyphicon-birthday pull-right"></i></p>
                     <p class="text-center">
                        <input id="age-slider" type="text" class="span2" value="" data-slider-min="{{ env('AGE_START') }}" data-slider-max="{{ env('AGE_END') }}" data-slider-step="1" data-slider-value="@if(!is_null($age[0]) && !is_null($age[1])) {{ '['.$age[0].','.$age[1].']' }} @endif"/>
                        <div class="text-center">
                          <b class="col-sm-2 pull-left" style="color: #bbb;">{{ env('AGE_START') }}</b>
                          <b  class="col-sm-2 pull-right" style="color: #bbb;">{{ env('AGE_END') }}</b>
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
                      $("#age-slider").bootstrapSlider({
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






          <p class="border-bottom-thin text-muted">Years of Experience<i class="glyphicon glyphicon-birthday pull-right"></i></p>
                 <p class="text-center">
                    <input id="exp_years-slider" type="text" class="span2" value="" data-slider-min="{{ env('EXPERIENCE_START') }}" data-slider-max="{{ env('EXPERIENCE_END') }}" data-slider-step="1" data-slider-value="@if(!is_null ($exp_years[0]) && !is_null ($exp_years[1])) {{ '['.$exp_years[0].','.$exp_years[1].']' }} @endif"/>
                    <div class="text-center">
                      <b class="col-sm-2 pull-left" style="color: #bbb;">{{ env('EXPERIENCE_START') }}</b>
                      <b  class="col-sm-2 pull-right" style="color: #bbb;">{{ env('EXPERIENCE_END') }}</b>
                      <small id="exp_years-range"> {{ $exp_years[0].' - '.$exp_years[1].' years' }} </small>
                    </div>
                   <div class="clearfix"></div>
                 </p>

                <p></p>
            <p class="border-bottom-thin text-muted">Graduation Grade<i class="glyphicon glyphicon-birthday pull-right"></i></p>
            <p class="text-center">
                <input id="graduation_grade-slider" type="text" class="span2" value="" data-slider-min="{{ env('GRADUATION_GRADE_START') }}" data-slider-max="{{ env('GRADUATION_GRADE_END') }}" data-slider-step="1" data-slider-value="@if(!is_null ($graduation_grade[0]) && !is_null ($graduation_grade[1])) {{ '['.$graduation_grade[0].','.$graduation_grade[1].']' }} @endif"/>
                <div class="text-center">
                  <b class="col-sm-2 pull-left" style="color: #bbb;">{{ env('GRADUATION_GRADE_START') }}</b>
                  <b  class="col-sm-2 pull-right" style="color: #bbb;">{{ env('GRADUATION_GRADE_END') }}</b>
                  <small id="graduation_grade-range"> {{ $graduation_grade[0].' - '.$graduation_grade[1].' grade' }} </small>
                </div>
              <div class="clearfix"></div>
            </p>

            <p></p>

            <p class="border-bottom-thin text-muted">Minimium Remuneration<i class="glyphicon glyphicon-birthday pull-right"></i></p>
            <p class="text-center">
                <input id="minimium_remuneration-slider" type="text" class="span2" value="" data-slider-min="{{ env('REMUNERATION_MINIMIUM') }}" data-slider-max="{{ env('REMUNERATION_MAXIMIUM') }}" data-slider-step="100" data-slider-value="@if(!is_null ($minimium_remuneration[0]) && !is_null ($minimium_remuneration[1])) {{ '['.$minimium_remuneration[0].','.$minimium_remuneration[1].']' }} @endif"/>
                <div class="text-center">
                  <div class="row">
                    <div class="col-sm-8">
                      <b class="col-sm-2 pull-left" style="color: #bbb;">{{ env('REMUNERATION_MINIMIUM') }}</b>
                      <b  class="col-sm-2 pull-right" style="color: #bbb;">{{ env('REMUNERATION_MAXIMIUM') }}</b>
                      <small id="minimium_remuneration-range"> {{ $minimium_remuneration[0].' - '.$minimium_remuneration[1].' Units' }} </small>
                    </div>
                  </div>
                </div>
              <div class="clearfix"></div>
            </p>

            <p></p>

            <p class="border-bottom-thin text-muted">Maximium Remuneration<i class="glyphicon glyphicon-birthday pull-right"></i></p>
            <p class="text-center">
                <input id="maximium_remuneration-slider" type="text" class="span2" value="" data-slider-min="{{ env('REMUNERATION_MINIMIUM') }}" data-slider-max="{{ env('REMUNERATION_MAXIMIUM') }}" data-slider-step="100" data-slider-value="@if(!is_null ($maximium_remuneration[0]) && !is_null ($maximium_remuneration[1])) {{ '['.$maximium_remuneration[0].','.$maximium_remuneration[1].']' }} @endif"/>
                <div class="text-center">
                  <div class="row">
                    <div class="col-sm-8">
                    <b class="col-sm-2 pull-left" style="color: #bbb;">{{ env('REMUNERATION_MINIMIUM') }}</b>
                    <b  class="col-sm-2 pull-right" style="color: #bbb;">{{ env('REMUNERATION_MAXIMIUM') }}</b>
                    <small id="maximium_remuneration-range"> {{ $maximium_remuneration[0].' - '.$maximium_remuneration[1].' Units' }} </small>
                    </div>
                  </div>
                </div>
              <div class="clearfix"></div>
            </p>

            <p></p>
          <script type="text/javascript">
              $(document).ready(function(){

                setupSliderField("exp_years", "years");
                setupSliderField("graduation_grade", "grade");
                setupSliderField("minimium_remuneration", "unit");
                setupSliderField("maximium_remuneration", "unit");

                function setupSliderField(key, tag){
                      const sliderElement = "#" +  key + "-slider";
                      const sliderRange = "#" +  key + "-range";
                      $(sliderElement).bootstrapSlider({});
                      $(sliderElement).on("slideStop", function(slideEvt) {
                          fieldSetter(key + "_range", slideEvt.value)
                          $(sliderRange).html( slideEvt.value[0] + ' - ' + slideEvt.value[1] + ' ' + tag );
                          $(sliderElement).performFilter();
                      });
                }

              });
          </script>


        @endif

            @if( @$job['video_posting_enabled'] )
            <p class="border-bottom-thin text-muted">Video Application Score<i class="glyphicon glyphicon-birthday pull-right"></i></p>
                 <p class="text-center">
                    <input id="video_application_score-slider" type="text" class="span2" value="" data-slider-min="{{ env('VIDEO_APPLICATION_START') }}" data-slider-max="{{ env('VIDEO_APPLICATION_END') }}" data-slider-step="1" data-slider-value="@if(!is_null ($video_application_score[0]) && !is_null ($video_application_score[1])) {{ '['.$video_application_score[0].','.$video_application_score[1].']' }} @endif"/>
                    <div class="text-center">
                      <b class="col-sm-2 pull-left" style="color: #bbb;">{{ env('VIDEO_APPLICATION_START') }}%</b>
                      <b  class="col-sm-2 pull-right" style="color: #bbb;">{{ env('VIDEO_APPLICATION_END') }}%</b>
                      <small id="video_application_score-range"> {{ $video_application_score[0].' - '.$video_application_score[1].' %' }} </small>
                    </div>
                   <div class="clearfix"></div>
                 </p>

                <p></p>

              <script type="text/javascript">
                  $(document).ready(function(){
                      $("#video_application_score-slider").bootstrapSlider({
                        // formatter: function(value,a) {

                        //   return 'Current value: ' + value + "  ";
                        // }
                      });
                      $("#video_application_score-slider").on("slideStop", function(slideEvt) {

                        video_application_score_range = slideEvt.value;

                        $('#video_application_score-range').html( slideEvt.value[0] + ' - ' + slideEvt.value[1] + ' %' )
                        $("#video_application_score-slider").performFilter();
                      });
                  });
              </script>
          @endif

            <p class="border-bottom-thin text-muted">Highest Education<i class="fa fa-filter pull-right"></i></p>
              <div class="checkbox-inline">
                  @php $other_highest_qualificationl = 0;  
                   $index = 0  @endphp
                  @foreach( $result['facet_counts']['facet_fields']['highest_qualification'] as $key => $highest_qualification )
                      @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['highest_qualification'][ $key + 1 ] != 0 &&  $highest_qualification != ''  && $highest_qualification != "0"  )

                        @php  $index++  @endphp
                        <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="highest_qualification" data-value="{{ $highest_qualification }}"> {{ ucwords( $highest_qualification )." (".$result['facet_counts']['facet_fields']['highest_qualification'][ $key + 1 ].")" }}</label> <br></div>
                      @else

                        @php @$other_highest_qualification += isset($result['facet_counts']['facet_fields']['highest_qualification'][ $key + 1 ])
                        && is_numeric($result['facet_counts']['facet_fields']['highest_qualification'][ $key + 1 ]) ? 
                        $result['facet_counts']['facet_fields']['highest_qualification'][ $key + 1 ] : 0 ;
                        @endphp

                      @endif
                  @endforeach

                  <div class="hide"><label class="normal"><input type="checkbox"  class=""> unspecified {{ " (".$other_highest_qualification.")" }}</label> <br></div>
              </div>

              @if($index > 4)
                <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
              @endif

            <p></p>

           <p class="border-bottom-thin text-muted">Grade<i class="fa fa-filter pull-right"></i></p>
              <div class="checkbox-inline">
                  @php  $other_grade = 0;  
                   $index = 0  @endphp
                  @foreach( $result['facet_counts']['facet_fields']['grade'] as $key => $grade )
                      @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['grade'][ $key + 1 ] != 0 &&  $grade != ''   )

                        @php $index++  @endphp
                        <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="grade" data-value="{{ $grade }}"> {{ ucwords( getGrade( $grade ) )." (".$result['facet_counts']['facet_fields']['grade'][ $key + 1 ].")" }}</label> <br></div>
                      @else

                        @php @$other_grade += $result['facet_counts']['facet_fields']['grade'][ $key + 1 ] @endphp

                      @endif
                  @endforeach

                  <div class="hide"><label class="normal"><input type="checkbox"  class=""> unspecified {{ " (".$other_grade.")" }}</label> <br></div>
              </div>

              @if($index > 4)
                <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
              @endif

            <p></p>

            <p class="border-bottom-thin text-muted">Location<i class="fa fa-filter pull-right"></i></p>
              <div class="checkbox-inline">
                  @php $other_state = 0 ;
                   $index = 0  @endphp

                  @foreach( $result['facet_counts']['facet_fields']['state'] as $key => $state )
                      @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['state'][ $key + 1 ] != 0 )

                      @php $index++  @endphp
                        <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="state" data-value="{{ $state }}"> {{ ucwords( $state )." (".$result['facet_counts']['facet_fields']['state'][ $key + 1 ].")" }}</label> <br></div>
                      @else

                        @php @$other_state += isset($result['facet_counts']['facet_fields']['state'][ $key + 1 ]) &&
                        is_numeric($result['facet_counts']['facet_fields']['state'][ $key + 1 ]) ? 
                        $result['facet_counts']['facet_fields']['state'][ $key + 1 ] : 0;
                        
                        @endphp

                      @endif
                  @endforeach

                  <div class="hide"><label class="normal"><input type="checkbox"  class=""> unspecified {{ " (".$other_state.")" }}</label> <br></div>
              </div>

              @if($index > 4)
                <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
              @endif

              <p></p>

              @if(!env('RMS_STAND_ALONE'))
                <p class="border-bottom-thin text-muted">Applicant Type<i class="fa fa-filter pull-right"></i></p>
                  <div class="checkbox-inline">

                      @foreach( $result['facet_counts']['facet_fields']['applicant_type'] as $key => $type )
                          @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['applicant_type'][ $key + 1 ] != 0 )

                            <div class="{{ ($index > 4 ) ? 'see-more' : '' }}">
                              <label class="normal">
                                <input type="checkbox"  class="" data-field="applicant_type" data-value="{{ $type }}"> {{ ucwords( $type )." (".$result['facet_counts']['facet_fields']['applicant_type'][ $key + 1 ].")" }}
                              </label> <br>
                            </div>
                          @endif
                      @endforeach

                      <div class="hide"><label class="normal"><input type="checkbox"  class=""> unspecified {{ " (".$other_state.")" }}</label> <br></div>
                  </div>
              @endif



               @foreach ($result['facet_counts']['facet_fields']['custom_field_name'] as $key => $custom_field_name)
                 @if($key % 2 == 0  && $result['facet_counts']['facet_fields']['custom_field_name'][ $key + 1 ] != 0)
                   <?php
                      $custom_field_name = explode('--', $custom_field_name);
                    ?>
                   <p class="border-bottom-thin text-muted">{{ isset($custom_field_name[1]) ? trim($custom_field_name[1]) : null }}?<i class="fa fa-filter pull-right"></i></p>
                   @foreach ($result['facet_counts']['facet_fields']['custom_field_value'] as $key => $custom_field_value)
                     @if($key % 2 == 0  && $result['facet_counts']['facet_fields']['custom_field_value'][ $key + 1 ] != 0)
                       <?php
                          $value = explode('--', $custom_field_value);
                        ?>
                       @if ($value[0] == $custom_field_name[0])
                         <div class="{{ ($index > 4 ) ? 'see-more' : '' }}">
                           <label class="normal">
                             <input type="checkbox"  class="" data-field="custom_field_value" data-value="{{ $custom_field_value }}">
                             {{ ucwords( $value[1] )." (".$result['facet_counts']['facet_fields']['custom_field_value'][ $key + 1 ].")" }}
                           </label> <br>
                         </div>
                       @endif
                     @endif
                   @endforeach

                 @endif
               @endforeach

              <p></p>

              <p class="border-bottom-thin text-muted">Willing to Relocate?<i class="fa fa-filter pull-right"></i></p>
              <div class="checkbox-inline">
                  @php $other_willing_to_relocate = 0;
                   $index = 0  @endphp

                  @foreach( $result['facet_counts']['facet_fields']['willing_to_relocate'] as $key => $willing_to_relocate )
                      @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['willing_to_relocate'][ $key + 1 ] != 0 )

                        @php $index++  @endphp
                        <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="willing_to_relocate" data-value="{{ $willing_to_relocate }}">
                        @if( $willing_to_relocate == "true")
                          {{  "Yes (".$result['facet_counts']['facet_fields']['willing_to_relocate'][ $key + 1 ].")" }}
                        @elseif( $willing_to_relocate == "false")
                          {{  "No (".$result['facet_counts']['facet_fields']['willing_to_relocate'][ $key + 1 ].")" }}
                        @endif
                        </label> <br></div>
                      @else

                        @php @$other_willing_to_relocate += isset($result['facet_counts']['facet_fields']['willing_to_relocate'][ $key + 1 ]) &&
                        is_numeric($result['facet_counts']['facet_fields']['willing_to_relocate'][ $key + 1 ]) ?
                        $result['facet_counts']['facet_fields']['willing_to_relocate'][ $key + 1 ] : 0; @endphp

                      @endif
                  @endforeach

                  <div class="hide"><label class="normal"><input type="checkbox"  class=""> unspecified {{ " (".$other_willing_to_relocate.")" }}</label> <br></div>
              </div>

              @if($index > 4)
                <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
              @endif

              <p></p>

            <p class="border-bottom-thin text-muted">Last Position held<i class="fa fa-filter pull-right"></i></p>
              <div class="checkbox-inline">
                  @php $other_edu_school = 0;
                   $index = 0  @endphp
                  @foreach( $result['facet_counts']['facet_fields']['last_position'] as $key => $last_position )
                      @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['last_position'][ $key + 1 ] != 0 &&  $last_position != ''  && $last_position != "0"  )

                        @php $index++  @endphp
                        <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="last_position" data-value="{{ $last_position }}"> {{ ucwords( $last_position )." (".$result['facet_counts']['facet_fields']['last_position'][ $key + 1 ].")" }}</label> <br></div>
                      @else

                        @php @$other_edu_school += isset($result['facet_counts']['facet_fields']['last_position'][ $key + 1 ]) &&
                        is_numeric($result['facet_counts']['facet_fields']['last_position'][ $key + 1 ]) ? 
                        $result['facet_counts']['facet_fields']['last_position'][ $key + 1 ] : 0; @endphp

                      @endif
                  @endforeach

                  <div class="hide"><label class="normal"><input type="checkbox"  class=""> unspecified {{ " (".$other_edu_school.")" }}</label> <br></div>
              </div>

              @if($index > 4)
                <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
              @endif

            <p></p>

            <p class="border-bottom-thin text-muted">Marital Status<i class="fa fa-filter pull-right"></i></p>
              <div class="checkbox-inline">
                  @php $other_marital_status = 0;
                   $index = 0  @endphp
                  @foreach( $result['facet_counts']['facet_fields']['marital_status'] as $key => $marital_status )
                      @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['marital_status'][ $key + 1 ] != 0 &&  $marital_status != ''  && $marital_status != "0"  )

                        @php $index++  @endphp
                        <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="marital_status" data-value="{{ $marital_status }}"> {{ ucwords( $marital_status )." (".$result['facet_counts']['facet_fields']['marital_status'][ $key + 1 ].")" }}</label> <br></div>
                      @else

                        @php @$other_marital_status += isset($result['facet_counts']['facet_fields']['marital_status'][ $key + 1 ]) &&
                        is_numeric($result['facet_counts']['facet_fields']['marital_status'][ $key + 1 ]) ? 
                        $result['facet_counts']['facet_fields']['marital_status'][ $key + 1 ] : 0; @endphp

                      @endif
                  @endforeach

                  <div class="hide"><label class="normal"><input type="checkbox"  class=""> unspecified {{ " (".$other_marital_status.")" }}</label> <br></div>
              </div>

              @if($index > 4)
                <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
              @endif

            <p></p>

            <p class="border-bottom-thin text-muted">State Of Origin<i class="fa fa-filter pull-right"></i></p>
              <div class="checkbox-inline">
                  @php $other_state_of_origin = 0;
                   $index = 0  @endphp
                  @foreach( $result['facet_counts']['facet_fields']['state_of_origin'] as $key => $state_of_origin )
                      @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['state_of_origin'][ $key + 1 ] != 0 &&  $state_of_origin != ''  && $state_of_origin != "0"  )

                        @php $index++  @endphp
                        <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="state_of_origin" data-value="{{ $state_of_origin }}"> {{ ucwords( $state_of_origin )." (".$result['facet_counts']['facet_fields']['state_of_origin'][ $key + 1 ].")" }}</label> <br></div>
                      @else

                        @php @$other_state_of_origin += isset($result['facet_counts']['facet_fields']['state_of_origin'][ $key + 1 ]) &&
                        is_numeric($result['facet_counts']['facet_fields']['state_of_origin'][ $key + 1 ]) ? 
                        $result['facet_counts']['facet_fields']['state_of_origin'][ $key + 1 ] : 0; @endphp

                      @endif
                  @endforeach

                  <div class="hide"><label class="normal"><input type="checkbox"  class=""> unspecified {{ " (".$other_state_of_origin.")" }}</label> <br></div>
              </div>

              @if($index > 4)
                <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
              @endif

            <p></p>

            <p class="border-bottom-thin text-muted">Course of Study<i class="fa fa-filter pull-right"></i></p>
              <div class="checkbox-inline">
                  @php $other_course_of_study = 0;
                   $index = 0  @endphp
                  @foreach( $result['facet_counts']['facet_fields']['course_of_study'] as $key => $course_of_study )
                      @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['course_of_study'][ $key + 1 ] != 0 &&  $course_of_study != ''  && $course_of_study != "0"  )

                        @php $index++  @endphp
                        <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="course_of_study" data-value="{{ $course_of_study }}"> {{ ucwords( $course_of_study )." (".$result['facet_counts']['facet_fields']['course_of_study'][ $key + 1 ].")" }}</label> <br></div>
                      @else

                        @php @$other_course_of_study += isset($result['facet_counts']['facet_fields']['course_of_study'][ $key + 1 ]) &&
                        is_numeric($result['facet_counts']['facet_fields']['course_of_study'][ $key + 1 ]) ? 
                        $result['facet_counts']['facet_fields']['course_of_study'][ $key + 1 ] : 0; @endphp

                      @endif
                  @endforeach

                  <div class="hide"><label class="normal"><input type="checkbox"  class=""> unspecified {{ " (".$other_course_of_study.")" }}</label> <br></div>
              </div>

              @if($index > 4)
                <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
              @endif

            <p></p>

            <p class="border-bottom-thin text-muted">Specialization<i class="fa fa-filter pull-right"></i></p>
              <div class="checkbox-inline">
                  @php $other_specializations = 0;
                   $index = 0  @endphp
                  @foreach( $result['facet_counts']['facet_fields']['specializations'] as $key => $specializations )
                      @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['specializations'][ $key + 1 ] != 0 &&  $specializations != ''  && $specializations != "0"  )

                        @php $index++  @endphp
                        <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="specializations" data-value="{{ $specializations }}"> {{ ucwords( $specializations )." (".$result['facet_counts']['facet_fields']['specializations'][ $key + 1 ].")" }}</label> <br></div>
                      @else

                        @php @$other_specializations += isset($result['facet_counts']['facet_fields']['specializations'][ $key + 1 ]) &&
                        is_numeric($result['facet_counts']['facet_fields']['specializations'][ $key + 1 ]) ? 
                        $result['facet_counts']['facet_fields']['specializations'][ $key + 1 ] : 0; @endphp

                      @endif
                  @endforeach

                  <div class="hide"><label class="normal"><input type="checkbox"  class=""> unspecified {{ " (".$other_specializations.")" }}</label> <br></div>
              </div>

              @if($index > 4)
                <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
              @endif

            <p></p>

            <p class="border-bottom-thin text-muted">Completed Nysc<i class="fa fa-filter pull-right"></i></p>
            <div class="checkbox-inline">
                @php $other_edu_school = 0;
                 $index = 0  @endphp
                @foreach( $result['facet_counts']['facet_fields']['completed_nysc'] as $key => $completed_nysc )
                    @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['completed_nysc'][ $key + 1 ] != 0 &&  $completed_nysc != ''  && $completed_nysc != "0"  )

                      @php $index++  @endphp
                      <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="completed_nysc" data-value="{{ $completed_nysc }}"> {{ ucwords( $completed_nysc )." (".$result['facet_counts']['facet_fields']['completed_nysc'][ $key + 1 ].")" }}</label> <br></div>
                    @else

                      @php @$other_edu_school += isset($result['facet_counts']['facet_fields']['completed_nysc'][ $key + 1 ]) &&
                      is_numeric($result['facet_counts']['facet_fields']['completed_nysc'][ $key + 1 ]) ? 
                      $result['facet_counts']['facet_fields']['completed_nysc'][ $key + 1 ] : 0; @endphp

                    @endif
                @endforeach

                <div class="hide"><label class="normal"><input type="checkbox"  class=""> unspecified {{ " (".$other_edu_school.")" }}</label> <br></div>
            </div>

            @if($index > 4)
              <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
            @endif

          <p></p>

            @if(isset($result['facet_counts']['facet_fields']['edu_school']))
            <p class="border-bottom-thin text-muted">Schools Attended <i class="fa fa-filter pull-right"></i></p>
              <div class="checkbox-inline">
                  @php $edu_school = 0;
                   $index = 0  @endphp
                  @foreach( $result['facet_counts']['facet_fields']['edu_school'] as $key => $school )

                      @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['edu_school'][ $key + 1 ] != 0 &&  $school != ''  && $school != "0"  )

                        @php $index++  @endphp
                        <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="edu_school" data-value="{{ $school }}"> {{ ucwords( $school )." (".$result['facet_counts']['facet_fields']['edu_school'][ $key + 1 ].")" }}</label> <br></div>
                      @else

                        @php @$edu_school += isset($result['facet_counts']['facet_fields']['edu_school'][ $key + 1 ]) &&
                        is_numeric($result['facet_counts']['facet_fields']['edu_school'][ $key + 1 ]) ?
                        $result['facet_counts']['facet_fields']['edu_school'][ $key + 1 ] : 0; @endphp

                      @endif
                  @endforeach

                  <div class="hide"><label class="normal"><input type="checkbox"  class=""> unspecified {{ " (".$edu_school.")" }}</label> <br></div>
              </div>
              @endif
              @if($index > 4)
                <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
              @endif

            <p></p>

            <p class="border-bottom-thin text-muted">Last Company Worked at<i class="fa fa-filter pull-right"></i></p>
              <div class="checkbox-inline">
                  @php $other_exp_company = 0;
                   $index = 0  @endphp
                  @foreach( $result['facet_counts']['facet_fields']['last_company_worked'] as $key => $last_company_worked )
                      {{-- {{dd($key)}} --}}
                      @if( $key % 2 == 0  && $result['facet_counts']['facet_fields']['last_company_worked'][ $key + 1 ] != 0 &&  $last_company_worked != ''  && $last_company_worked != "0"  )

                        @php $index++  @endphp
                        <div class="{{ ($index > 4 ) ? 'see-more' : '' }}"><label class="normal"><input type="checkbox"  class="" data-field="last_company_worked" data-value="{{ $last_company_worked }}"> {{ ucwords( $last_company_worked )." (".$result['facet_counts']['facet_fields']['last_company_worked'][ $key + 1 ].")" }}</label> <br></div>
                      @else

                        @php @$other_exp_company += isset($result['facet_counts']['facet_fields']['last_company_worked'][ $key + 1 ]) &&
                        is_numeric($result['facet_counts']['facet_fields']['last_company_worked'][ $key + 1 ]) ?
                        $result['facet_counts']['facet_fields']['last_company_worked'][ $key + 1 ] : 0; @endphp

                      @endif
                  @endforeach

                  <div class="hide"><label class="normal"><input type="checkbox"  class=""> unspecified {{ " (".$other_exp_company.")" }}</label> <br></div>
              </div>

              @if($index > 4)
                <div><a href="javascript://" class="more-link read-more-show "><small>See More</small></a></div>
              @endif

            <p></p>

            @if(false)
            <p class="border-bottom-thin text-muted">Marital Status<i class="fa fa-filter pull-right"></i></p>
              <div class="checkbox-inline">
                  {{$other_marital_status = 0  }}
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

            <p class="border-bottom-thin text-muted">State of Origin<i class="fa fa-filter pull-right"></i></p>
              <div class="checkbox-inline">
                  {{ $other_state_of_origin = 0  }}
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





      @endif
  <!-- end of if when it is not assessed -->

          </div>
        </div>
      </div>
    </div>
    @endif
