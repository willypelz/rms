@extends('layout.template-default')

@section('navbar')
@show()

@section('footer')
@show()


@section('content')
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet">

    <style type="text/css">
        .custom-field {
            margin-bottom: 20px;
        }

        .custom-field input[type='radio'], .custom-field input[type='checkbox'] {
            margin-left: 10px;
        }

        .candidate {
            padding: 15px 20px;
            background: #eee;
            border: 2px solid #ddd;
        }

        .mt-20 {
            margin-top: 20px;
        }
    </style>

    <section class="no-pad">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12">
                    <div class="">
                        <section class="job-head blue no-margin">
                            <div class="">
                                <div class="row">

                                    <div class="col-sm-8 col-sm-offset-2 text-center">
                                        <small class="text-brandon l-sp-5 text-uppercase">job title</small>

                                        <h2 class="job-title">
                                            {{ ucfirst( $job['title'] ) }}
                                        </h2>
                                        <hr>
                                        <ul class="list-inline text-white">
                                            <!--<li><strong>Company:</strong>&nbsp; JobAcess</li>-->
                                            <li>
                                                <strong>&nbsp;Posted:</strong>&nbsp; {{ date('D. j M, Y', strtotime($job['created_at'])) }}
                                            </li>
                                            <li>
                                                <strong>&nbsp;Expires:</strong>&nbsp; <?php echo date('d, M Y', strtotime($job['expiry_date'])) ?>
                                            </li>
                                        </ul>

                                        <!-- <div class="badge badge-job badge-job-active">
                                            <small class="">
                                                <span class="glyphicon glyphicon-ok"></span>
                                                &nbsp; Job is active
                                            </small>
                                        </div> -->
                                    </div>
                                    <div class="clearfix"></div>


                                </div>
                            </div>

                        </section>
                        <div class="row">

                            <div class="col-sm-12">
                                <div class="page no-bod-rad" style="border-radius: 0 0 0 0">
                                    <div class="row">
                                        <div class=" job-cta">
                                            <div class="col-sm-12">
                                                <h3 class="pull-left">Job Application</h3>
                                                <a class="pull-right candidate"
                                                   href="{{ route('candidate-dashboard') }}"> {{ $candidate->first_name . " " . $candidate->last_name }} </a>
                                            </div>

                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="tab-content">

                                            <div class="row">

                                                <div class="col-sm-8">
                                                    @if( \Carbon\Carbon::now()->diffInDays( \Carbon\Carbon::parse($job->expiry_date), false ) < 0 && !$fromShareURL )
                                                        <p class="text-center">This application is closedB.</p>
                                                    @elseif ( in_array(  $job->status, ['SUSPENDED','DELETED'] ) )
                                                        <p class="text-center">This application is closedA.</p>
                                                    @else
                                                        <p class="text-center">Please fill in the information below
                                                            carefully.</p>

                                                        @include('layout.alerts')


                                                        {!! Form::open(array('class'=>'job-details', 'files'=>true)) !!}

                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"
                                                               id="lar_token">
                                                        <div class="row">
                                                            <div class="separator separator-small"></div>
                                                        </div>
                                @if(isset($fields))
                                                        <div class="form-group">
                                                            <div class="row">

                                                                @if( $fields->first_name->is_visible )
                                                                    <div class="col-sm-6"><label for="job-title">first
                                                                            name @if( $fields->first_name->is_required )
                                                                                <span class="text-danger">*</span>@endif
                                                                        </label><input id="job-title" name='first_name'
                                                                                       value="{{ $candidate->first_name }}"
                                                                                       @if( $fields->first_name->is_required ) required
                                                                                       @endif type="text"
                                                                                       class="form-control"></div>
                                                                @endif

                                                                @if( $fields->last_name->is_visible )
                                                                    <div class="col-sm-6"><label for="job-loc">last
                                                                            name @if( $fields->last_name->is_required )
                                                                                <span class="text-danger">*</span>@endif
                                                                        </label><input id="job-loc" name="last_name"
                                                                                       @if( $fields->last_name->is_required ) required
                                                                                       @endif value="{{ $candidate->last_name }}"
                                                                                       type="text" class="form-control">
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                @if( $fields->email->is_visible )
                                                                    <div class="col-sm-6">
                                                                        <label for="job-title">email @if( $fields->email->is_required )
                                                                                <span class="text-danger">*</span>@endif
                                                                        </label>
                                                                        <input id="job-title" name='email'
                                                                               value="{{ $candidate->email }}"
                                                                               @if( $fields->email->is_required ) required
                                                                               @endif type="email" readonly
                                                                               class="form-control">
                                                                    </div>
                                                                @endif

                                                                @if( $fields->phone->is_visible )
                                                                    <div class="col-sm-6">
                                                                        <label for="job-loc">Phone @if( $fields->phone->is_required )
                                                                                <span class="text-danger">*</span>@endif
                                                                        </label>
                                                                        <input id="job-loc" name="phone"
                                                                               value="{{ @$last_cv->phone }}"
                                                                               @if( $fields->phone->is_required ) required
                                                                               @endif type="text" class="form-control">
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">

                                                                @if( $fields->location->is_visible ||  $fields->state_of_origin->is_visible)
                                                                    <div class="col-sm-6">
                                                                        <label for="job-title">
                                                                            Country of Origin
                                                                            @if( $fields->state_of_origin->is_required || $fields->location->is_required )
                                                                                <span class="text-danger">*</span>@endif
                                                                        </label>
                                                                        <select required
                                                                                name="country"
                                                                                id="country"
                                                                                class="form-control job_country"
                                                                                type="text"
                                                                                style="width: 270px;">
                                                                            <option value="">--choose country--</option>
                                                                            @foreach($countries as $country)
                                                                                <option value="{{ $country }}" {{ ( @$last_cv->location == $country || (in_array(@$last_cv->location,$states) && $country == 'Nigeria')) ? 'selected="selected"' : '' }} >{{ $country }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-6 state_section @if( (Request::old('location')) || $errors->has('location') || (in_array(@$last_cv->location,$states) || @$last_cv->location == 'Nigeria'))  @else hidden @endif"
                                                                         style="margin-top: 10px">
                                                                        <label for="job-title">Current
                                                                            Location @if( $fields->location->is_required )
                                                                                <span class="text-danger">*</span>@endif
                                                                        </label>
                                                                        <select {{( $fields->location->is_required ) ? "required" : "" }}
                                                                                name="location"
                                                                                id="location"
                                                                                class="form-control job_location"
                                                                                type="text"
                                                                                style="width: 270px;">
                                                                            <option value="">--choose--</option>
                                                                            @foreach($states as $state)
                                                                                <option value="{{$state != 'Nigeria' ? $state : 'Across Nigeria' }}" {{ ( str_replace('Nigeria','Across Nigeria',@$last_cv->location) == $state) ? 'selected="selected"' : '' }} >{{ $state != 'Nigeria' ? $state : 'Across Nigeria' }}</option>
                                                                            @endforeach
                                                                        </select>

                                                                    </div>
                                                                @endif


                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                @if( $fields->gender->is_visible )
                                                                    <div class="col-sm-4">
                                                                        <label for="job-title">gender @if( $fields->gender->is_required )
                                                                                <span class="text-danger">*</span>@endif
                                                                        </label>
                                                                        {{ Form::select('gender', array('Male' => 'Male', 'Female' => 'Female'), @$last_cv->gender, array('placeholder'=>'choose', 'class'=>'form-control', ( $fields->gender->is_required ) ? "required" : "" )) }}

                                                                    </div>
                                                                @endif

                                                                @if( $fields->marital_status->is_visible )
                                                                    <div class="col-sm-4">
                                                                        <label for="job-title">marital
                                                                            status @if( $fields->marital_status->is_required )
                                                                                <span class="text-danger">*</span>@endif
                                                                        </label>
                                                                        {{ Form::select('marital_status', array('Single' => 'Single', 'Married' => 'Married', 'Divorced'=>'Divorced', 'Separated'=>'Separated'), @$last_cv->marital_status, array('placeholder'=>'choose', 'class'=>'form-control', ( $fields->marital_status->is_required ) ? "required" : "" )) }}

                                                                    </div>
                                                                @endif

                                                                @if( $fields->date_of_birth->is_visible )
                                                                    <div class="col-sm-4"><label for="job-loc">date of
                                                                            Birth @if( $fields->date_of_birth->is_required )
                                                                                <span class="text-danger">*</span>@endif
                                                                        </label><input id="datepicker2"
                                                                                       name="date_of_birth"
                                                                                       value="{{ @$last_cv->date_of_birth }}"
                                                                                       type="text" class=" form-control"
                                                                                       @if( $fields->date_of_birth->is_required ) required @endif>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>


                                                        <br/>
                                                        <hr/>
                                                        <p class="text-center">Career Summary.</p><Br/>

                                                        <div class="form-group">
                                                            <div class="row">
                                                                @if( $fields->highest_qualification->is_visible )
                                                                    <div class="col-sm-6">
                                                                        <label for="job-title">Highest
                                                                            Qualifications @if( $fields->highest_qualification->is_required )
                                                                                <span class="text-danger">*</span>@endif
                                                                        </label>
                                                                        {{ Form::select('highest_qualification', $qualifications, @$last_cv->highest_qualification, array('placeholder'=>'choose', 'class'=>'form-control', ( $fields->highest_qualification->is_required ) ? "required" : "" )) }}

                                                                    </div>
                                                                @endif

                                                                @if( $fields->years_of_experience->is_visible )
                                                                    <div class="col-sm-6">
                                                                        <label for="">
                                                                            <!-- <i class="fa fa-lock"></i>&nbsp;  -->
                                                                            Years of
                                                                            experience @if( $fields->years_of_experience->is_required )
                                                                                <span class="text-danger">*</span>@endif
                                                                        </label>
                                                                        <select class="form-control"
                                                                                name="years_of_experience"
                                                                                @if( $fields->years_of_experience->is_required ) required @endif>
                                                                            <option>choose one</option>
                                                                            @for( $i = 0; $i <= 50; $i ++ )
                                                                                <option value="{{ $i }}"
                                                                                        @if( @$last_cv->years_of_experience == $i ) selected="selected" @endif >{{ $i }}</option>
                                                                            @endfor

                                                                        </select>

                                                                    </div>
                                                                @endif


                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row">
                                                                @if( $fields->last_company_worked->is_visible )
                                                                    <div class="col-sm-6">
                                                                        <label for="job-title">Last Company
                                                                            Worked @if( $fields->last_company_worked->is_required )
                                                                                <span class="text-danger">*</span>@endif
                                                                        </label>
                                                                        {{ Form::text('last_company_worked', @$last_cv->last_company_worked, array('class'=>'form-control',  ( $fields->last_company_worked->is_required ) ? "required" : "" )) }}

                                                                    </div>
                                                                @endif

                                                                @if( $fields->last_position->is_visible )
                                                                    <div class="col-sm-6">
                                                                        <label for="job-title">Last
                                                                            Position @if( $fields->last_position->is_required )
                                                                                <span class="text-danger">*</span>@endif
                                                                        </label>
                                                                        {{ Form::text('last_position', @$last_cv->last_position, array('class'=>'form-control', ( $fields->last_position->is_required ) ? "required" : "" )) }}

                                                                    </div>
                                                                @endif


                                                            </div>
                                                        </div>


                                                    <!--div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="job-title">State of Origin <span class="text-danger">*</span></label>
                                                {{ Form::select('state_of_origin', array('Lagos' => 'Lagos', 'Abuja' => 'Abuja'), @$last_cv->state_of_origin, array('placeholder'=>'choose', 'class'=>'form-control')) }}

                                                            </div>

                                                            <div class="col-sm-6">
                                                                <label for="job-title">Current Location <span class="text-danger">*</span></label>
{{ Form::select('location', array('Lagos' => 'Lagos', 'Abuja' => 'Abuja'), @$last_cv->location, array('placeholder'=>'choose', 'class'=>'form-control')) }}

                                                            </div>


                                                        </div>
                                                    </div-->


                                                        <div class="form-group">
                                                            <div class="row">
                                                                @if( $fields->willing_to_relocate->is_visible )
                                                                    <div class="col-xs-12">
                                                                        <label for="">Are you willing to
                                                                            relocate? @if( $fields->willing_to_relocate->is_required )
                                                                                <span class="text-danger">*</span>@endif
                                                                        </label><br/>
                                                                        <label>{{ Form::radio('willing_to_relocate', 'yes',  @$last_cv->willing_to_relocate, ( $fields->willing_to_relocate->is_required ) ? ["required"] : null) }}
                                                                            Yes</label>
                                                                        <label>{{ Form::radio('willing_to_relocate', 'no', @!$last_cv->willing_to_relocate, ( $fields->willing_to_relocate->is_required ) ? ["required"] : null) }}
                                                                            No </label>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row">
                                                                @if( $fields->specializations->is_visible )
                                                                    <div class="col-sm-6"><label for="job-title">Your
                                                                            Specialization @if( $fields->specializations->is_required )
                                                                                <span class="text-danger">*</span>@endif
                                                                        </label>
                                                                        <br><select name="specializations[]" multiple=""
                                                                                    id=""
                                                                                    @if( $fields->specializations->is_required ) required
                                                                                    @endif  class="select2"
                                                                                    style="width: 253px;">
                                                                            <option value="">--choose specialization
                                                                            </option>
                                                                            @foreach($specializations as $s)
                                                                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                @endif

                                                                @if( $fields->graduation_grade->is_visible )
                                                                    <div class="col-sm-6">
                                                                        <label for="job-title">Graduation
                                                                            Grade @if( $fields->graduation_grade->is_required )
                                                                                <span class="text-danger">*</span>@endif
                                                                        </label>
                                                                        {{ Form::select('graduation_grade', $grades, @$last_cv->graduation_grade, array('placeholder'=>'choose', 'class'=>'form-control', ( $fields->graduation_grade->is_required ) ? "required" : "" )) }}

                                                                    </div>
                                                                @endif

                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <div class="row">
                                                                @if( $fields->cover_note->is_visible )
                                                                    <div class="col-xs-12">
                                                                        <label for="">Cover
                                                                            Letter @if( $fields->cover_note->is_required )
                                                                                <span class="text-danger">*</span>@endif
                                                                        </label>
                                                                        <textarea name="cover_note" id="" cols="30"
                                                                                  rows="4" class="form-control"
                                                                                  placeholder=""
                                                                                  @if( $fields->cover_note->is_required ) required @endif>{{ @$last_cv->cover_note ??  old('cover_note') }}</textarea>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <div class="row">
                                                                @if( $fields->cv_file->is_visible )
                                                                    <div class="col-xs-12">

                                                                        <label for="">Attach your
                                                                            CV @if( $fields->cv_file->is_required )<span
                                                                                    class="text-danger">*</span>@endif
                                                                        </label>

                                                                        {{ Form::file('cv_file', ( $fields->cv_file->is_required ) ? ["required"] : null ) }}
                                                                    </div>
                                                                    <div class="col-xs-12 mt-20">

                                                                        <label for="">Attachment 1 (Optional)</label>

                                                                        {{ Form::file('optional_attachment_1') }}
                                                                    </div>
                                                                    <div class="col-xs-12 mt-20">
                                                                        <label for="">Attachment 2 (Optional)</label>
                                                                        {{ Form::file('optional_attachment_2') }}
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            {{ Form::hidden('applicant_type', 'external') }}
                                                        </div>


                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <hr>
                                                            </div>

                                                            @if( count($custom_fields) > 0 )
                                                                @php $index=0; @endphp
                                                                @foreach( $custom_fields as $custom_field )

                                                                    <div class="col-sm-6 custom-field">
                                                                        <label for="custom-field">{{ $custom_field->name }} @if( $custom_field->is_required )
                                                                                <span class="text-danger">*</span>@endif
                                                                        </label><br>

                                                                        <?php $options = explode(',', $custom_field->options) ?>

                                                                        @if( $custom_field->type == 'DROPDOWN')
                                                                            <?php
                                                                            $select_options = [];
                                                                            foreach ($options as $option) {
                                                                                $select_options[$option] = str_replace('_', ' ', ucfirst($option));
                                                                            }
                                                                            ?>
                                                                            {{ Form::select('cf_'.str_slug($custom_field->name,'_'), $select_options, null, array('class'=>'form-control', ( $custom_field->is_required ) ? "required" : "")) }}



                                                                        @elseif( $custom_field->type == 'RADIO' )
                                                                            @foreach( $options as $option )
                                                                                {{ Form::radio('cf_'.str_slug($custom_field->name,'_'), $option,false, array( ( $custom_field->is_required ) ? "required" : "" ) ) }} {{ $option }}
                                                                            @endforeach

                                                                        @elseif( $custom_field->type == 'CHECKBOX' )

                                                                            @foreach( $options as $option )
                                                                                {{ Form::checkbox('cf_'.str_slug($custom_field->name,'_').'[]', $option,false, array( ( $custom_field->is_required ) ? "required" : "" )) }} {{ $option }}
                                                                            @endforeach

                                                                        @elseif( $custom_field->type == 'TEXT' )
                                                                            {{ Form::text('cf_'.str_slug($custom_field->name,'_'), null, array('class'=>'form-control', ( $custom_field->is_required ) ? "required" : "" )) }}

                                                                        @elseif( $custom_field->type == 'TEXTAREA' )
                                                                            {{ Form::textarea('cf_'.str_slug($custom_field->name,'_'), null, array('class'=>'form-control', ( $custom_field->is_required ) ? "required" : "" )) }}

                                                                        @elseif( $custom_field->type == 'MULTIPLE_OPTION' )
                                                                            <?php
                                                                            $select_options = [];
                                                                            foreach ($options as $option) {
                                                                                $select_options[$option] = str_replace('_', ' ', ucfirst($option));
                                                                            }
                                                                            ?>
                                                                            {{ Form::select('cf_'.str_slug($custom_field->name,'_').'[]', $select_options, array('multiple'=>'multiple','class'=>'form-control', ( $custom_field->is_required ) ? "required" : "" )) }}

                                                                        @elseif( $custom_field->type == 'FILE' )
                                                                            <?php
                                                                            $select_options = [];
                                                                            foreach ($options as $option) {
                                                                                $select_options[$option] = str_replace('_', ' ', ucfirst($option));
                                                                            }
                                                                            ?>
                                                                            {{ Form::file('cf_'.str_slug($custom_field->name,'_'),array('class'=>'form-control', ( $custom_field->is_required ) ? "required" : "" )) }}

                                                                        @endif


                                                                    </div>

                                                                    @if( $index % 2  )
                                                                        <div class="clearfix"></div>
                                                                    @endif
                                                                    @php $index++;  @endphp
                                                                @endforeach
                                                            @endif

                                                        </div>

                                                        {!! Captcha::display($google_captcha_attributes) !!}



                                                        <div class="row">
                                                            <div class="col-xs-12">
                                                                <hr>
                                                            </div>
                                                            <div class="col-xs-4">
                                                                <!--a href="job.php" target="_blank" type="submit" class="btn btn-line"><i class="fa fa-save"></i> Save as draft</a-->
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <!--a href="job.php" target="_blank" type="submit" class="btn pull-right">Preview Job</a-->

                                                            </div>

                                                            <div class="col-sm-4">
                                                                @if( $job['video_posting_enabled'] )
                                                                    <button type="submit"
                                                                            class="btn btn-success btn-block">Next
                                                                        &raquo;
                                                                    </button>
                                                                @else
                                                                    <button type="submit"
                                                                            class="btn btn-success btn-block">Apply
                                                                        &raquo;
                                                                    </button>
                                                                @endif
                                                            </div>
                                                            <div class="separator separator-small"></div>
                                                        </div>

                                                        @else
                                                            <div>Something went wrong with this job posting, please contact support</div>
                                                        @endif


                                                        <!-- $job->form_fields->toArray() -->

                                                        </form>

                                                    @endif
                                                </div>

                                                @include('settings.includes.company-details')

                                                <div class="col-sm-6 col-sm-offset-3 text-center hidden"><!-- <hr> -->
                                                    <p>Powered by <a href="http://www.seamlesshiring.com"><i
                                                                    class="fa fa-skype"></i> SeamlessHiring</a> <br>
                                                        <small class="text-muted">&copy; {{ date('Y') }}.
                                                            SeamlessHiring</small></p>
                                                </div>
                                                <div class="clearfix"></div>

                                            </div>

                                            <!--<div class="panel panel-default">-->
                                            <!--<div class="panel-heading">-->
                                            <!--<h4 class="panel-title">Friends who work <p>Medical Doctor, Valuepreneur, Doer... </p></h4>-->
                                            <!--</div>-->
                                            <!--<div class="panel-collapse skill">-->
                                            <!--<div class="panel-body">-->
                                            <!--<a href="#" class="btn btn-info" role="button">CSS</a> <a href="#" class="btn btn-info" role="button">HTML</a> <a href="#" class="btn btn-info" role="button">jQuery</a>-->
                                            <!--</div>-->
                                            <!--</div>-->
                                            <!--</div>-->

                                        </div>
                                    </div>

                                </div>


                                <!--/tab-content-->
                                <div class="page page-sm foot no-bod-rad">
                                    <div class="col-sm-6 col-sm-offset-3 text-center"><!-- <hr> -->
                                        <p><img src="{{ url('/') }}/img/seamlesshiring-logo.png" alt="" width="150px">
                                        </p>
                                        <p><small class="text-muted">Powered by <a href="http://www.seamlesshiring.com">
                                                    SeamlessHiring</a> &nbsp;
                                                &copy; {{ date('Y') }}. SeamlessHiring</small></p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                            </div>
                            <div class="clearfix"></div>
                            <div class="separator separator-small hidden">
                                <br>
                                <div class="col-sm-3 col-sm-offset-3">
                                    <a class="btn btn-line btn-block" href="create-job.php">Edit this Job</a>
                                </div>
                                <div class="col-sm-3">
                                    <a class="btn btn-danger btn-block" href="create-job.php">Unpublish this Job</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#datepicker2').datepicker({
                dateFormat: "yy-mm-dd",
                autoclose: true,
                changeMonth: true,
                changeYear: true,
                yearRange: '-100:+0'

            });
            $('.select2').select2();

            var country = $('#country');
            country.change(function () {

                if (country.val() == 'Nigeria') {
                    $('.state_section').removeClass('hidden');
                    $('#location').prop('required', true)
                } else {
                    $('.state_section').addClass('hidden');
                    $('#location').prop('required', false)
                }
            });

            $('.submitButton').click(function () {
                if (country.val() != 'Nigeria') {
                    $('#location').prop('required', false)
                }
            })
        });
    </script>


    <div class="separator separator-small"><br></div>
@endsection
