@extends('layout.template-default')

@section('navbar')    
@show()

@section('footer')
@show()


@section('content')
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet">

    <style type="text/css">
        .custom-field{ margin-bottom: 20px; }
        .custom-field input[type='radio'], .custom-field input[type='checkbox']{ margin-left: 10px; }
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
                                            <strong>&nbsp;Posted:</strong>&nbsp; {{ date('D. j M, Y', strtotime($job['created_at'])) }}</li>
                                        <li>
                                            <strong>&nbsp;Expires:</strong>&nbsp; <?php echo date('d, M Y', strtotime($job['expiry_date'])) ?></li>
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
                                        <h3>Job Application</h3>
                                    </div>
                                        
                                        <div class="clearfix"></div>
                                    </div>

                                        <div class="tab-content">

                                    <div class="row">
                                        
                                        <div class="col-sm-8">
                                            @if( \Carbon\Carbon::now()->diffInDays( \Carbon\Carbon::parse($job->expiry_date), false ) < 0 )
                                                <p class="text-center">This application is closed.</p>
                                            @else
                                            <p class="text-center">Please fill in the information below carefully.</p>


                                {!! Form::open(array('class'=>'job-details', 'files'=>true)) !!}

                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="lar_token">
                                        <div class="row">
                                            <div class="separator separator-small"></div>
                                        </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6"><label for="job-title">first name <span class="text-danger">*</span></label><input id="job-title" name='first_name' required type="text" class="form-control"></div>
                                            <div class="col-sm-6"><label for="job-loc">last name <span class="text-danger">*</span></label><input id="job-loc" name="last_name" required type="text" class="form-control"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="job-title">email <span class="text-danger">*</span></label>
                                                <input id="job-title" name='email' required type="email" class="form-control">
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="job-loc">Phone <span class="text-danger">*</span></label>
                                                <input id="job-loc" name="phone" required type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="job-title">State of Origin <span class="text-danger">*</span></label>
                                                {{ Form::select('state_of_origin', $states, 'null', array('placeholder'=>'choose', 'class'=>'form-control', 'required')) }}

                                            </div>

                                            <div class="col-sm-6">
                                                <label for="job-title">Current Location <span class="text-danger">*</span></label>
                                                {{ Form::select('location', $states, 'null', array('placeholder'=>'choose', 'class'=>'form-control', 'required')) }}

                                            </div>


                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label for="job-title">gender <span class="text-danger">*</span></label>
                                                {{ Form::select('gender', array('Male' => 'Male', 'Female' => 'Female'), 'null', array('placeholder'=>'choose', 'class'=>'form-control', 'required')) }}

                                            </div>
                                            <div class="col-sm-4">
                                                <label for="job-title">marital status <span class="text-danger">*</span></label>
                                                {{ Form::select('marital_status', array('Single' => 'Single', 'Married' => 'Married', 'Divorced'=>'Divorced', 'Separated'=>'Separated'), 'null', array('placeholder'=>'choose', 'class'=>'form-control', 'required')) }}

                                            </div>
                                            <div class="col-sm-4"><label for="job-loc">date of Birth <span class="text-danger">*</span></label><input id="datepicker2" required name="date_of_birth"  type="text" class=" form-control"></div>
                                        </div>
                                    </div>
                                    

                                    <br/><hr/>
                                    <p class="text-center">Career Summary.</p><Br/>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="job-title">Highest Qualifications<span class="text-danger">*</span></label>
                                                {{ Form::select('highest_qualification', $qualifications, 'null', array('placeholder'=>'choose', 'class'=>'form-control', 'required')) }}

                                            </div>

                                            <div class="col-sm-6">
                                                <label for=""><!-- <i class="fa fa-lock"></i>&nbsp;  -->Years of experience</label>
                                <select class="form-control" name="years_of_experience" required>
                                            <option>choose one</option>
                                                <option value="1" >1</option>
                                                <option value="2" >2</option>
                                                <option value="3" >3</option>
                                                <option value="4" >4</option>
                                                <option value="5" >5</option>
                                                <option value="6" >6</option>
                                                <option value="7" >7</option>
                                                <option value="8" >8</option>
                                                <option value="9" >9</option>
                                                <option value="10" >10</option>
                                                <option value="11" >11</option>
                                                <option value="12" >12</option>
                                                <option value="13" >13</option>
                                                <option value="14" >14</option>
                                                <option value="15" >15</option>
                                                <option value="16" >16</option>
                                                <option value="17" >17</option>
                                                <option value="18" >18</option>
                                                <option value="19" >19</option>
                                                <option value="20" >20</option>
                                                <option value="21" >21</option>
                                                <option value="22" >22</option>
                                                <option value="23" >23</option>
                                                <option value="24" >24</option>
                                                <option value="25" >25</option>
                                                <option value="26" >26</option>
                                                <option value="27" >27</option>
                                                <option value="28" >28</option>
                                                <option value="29" >29</option>
                                                <option value="30" >30</option>
                                                <option value="31" >31</option>
                                                <option value="32" >32</option>
                                                <option value="33" >33</option>
                                                <option value="34" >34</option>
                                                <option value="35" >35</option>
                                                <option value="36" >36</option>
                                                <option value="37" >37</option>
                                                <option value="38" >38</option>
                                                <option value="39" >39</option>
                                                <option value="40" >40</option>
                                                <option value="41" >41</option>
                                                <option value="42" >42</option>
                                                <option value="43" >43</option>
                                                <option value="44" >44</option>
                                                <option value="45" >45</option>
                                                <option value="46" >46</option>
                                                <option value="47" >47</option>
                                                <option value="48" >48</option>
                                                <option value="49" >49</option>
                                                <option value="50" >50</option>
                                        </select>

                                            </div>


                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="job-title">Last Company Worked <span class="text-danger">*</span></label>
                                                {{ Form::text('last_company_worked', null, array('class'=>'form-control', 'required' => 'required')) }}

                                            </div>

                                            <div class="col-sm-6">
                                                <label for="job-title">Last Position <span class="text-danger">*</span></label>
                                                {{ Form::text('last_position', null, array('class'=>'form-control', 'required' => 'required')) }}

                                            </div>


                                        </div>
                                    </div>


                                    <!--div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="job-title">State of Origin <span class="text-danger">*</span></label>
                                                {{ Form::select('state_of_origin', array('Lagos' => 'Lagos', 'Abuja' => 'Abuja'), 'null', array('placeholder'=>'choose', 'class'=>'form-control')) }}

                                            </div>

                                            <div class="col-sm-6">
                                                <label for="job-title">Current Location <span class="text-danger">*</span></label>
                                                {{ Form::select('location', array('Lagos' => 'Lagos', 'Abuja' => 'Abuja'), null, array('placeholder'=>'choose', 'class'=>'form-control')) }}

                                            </div>


                                        </div>
                                    </div-->


                                   <!--  <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label for="">Do you reside in Abuja or are you willing to relocate to Abuja?<span class="text-danger">*</span></label><br/>
                                                <label>{{ Form::radio('willing_to_relocate', 'yes',  false, ['required']) }} Yes</label>
                                                <label>{{ Form::radio('willing_to_relocate', 'no',  false, ['required']) }} No </label>
                                            </div>
                                        </div>
                                    </div> -->
                                    
                                    <div class="form-group">
                                        <div class="row">

                                           <div class="col-sm-6"><label for="job-title">Your Specialization <span class="text-danger">*</span></label>
                                                    <br><select name="specializations[]" multiple="" id="" required class="select2" style="width: 253px;">
                                                        <option value="">--choose specialization</option>
                                                        @foreach($specializations as $s)
                                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                                        @endforeach
                                                    </select>
                                            </div> 

                                            <div class="col-sm-6">
                                                <label for="job-title">Graduation Grade<span class="text-danger">*</span></label>
                                                {{ Form::select('graduation_grade', $grades, 'null', array('placeholder'=>'choose', 'class'=>'form-control', 'required')) }}

                                            </div> 

                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label for="">Cover Letter (Optional)</label>
                                                <textarea name="cover_note" id="" cols="30" rows="4" class="form-control" placeholder=""></textarea>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label for="">Attach your CV</label>
                                                {{ Form::file('cv_file', ['required']) }}
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="row">
                                    <div class="col-xs-12"><hr></div>
                                        
                                        @if( count($custom_fields) > 0 )
                                            {{-- */$index=0;/* --}}
                                            @foreach( $custom_fields as $custom_field )
                                                
                                                <div class="col-sm-6 custom-field">
                                                    <label for="custom-field">{{ $custom_field->name }} <span class="text-danger">*</span></label><br>

                                                    <?php $options = explode(',', $custom_field->options) ?>

                                                    @if( $custom_field->type == 'DROPDOWN')
                                                        <?php 
                                                            $select_options = [];
                                                            foreach ($options as $option) {
                                                                $select_options[$option] = str_replace( '_', ' ',  ucfirst( $option ) ) ;
                                                            }
                                                         ?>
                                                        {{ Form::select('cf_'.str_slug($custom_field->name,'_'), $select_options, null, array('class'=>'form-control', 'required' => 'required')) }}
                                                    
                                                    @elseif( $custom_field->type == 'RADIO' )
                                                        @foreach( $options as $option )
                                                            {{ Form::radio('cf_'.str_slug($custom_field->name,'_'), $option,false, array('required' => 'required')) }} {{ $option }}
                                                        @endforeach
                                                        
                                                    @elseif( $custom_field->type == 'CHECKBOX' )

                                                        @foreach( $options as $option )
                                                            {{ Form::checkbox('cf_'.str_slug($custom_field->name,'_').'[]', $option,false, array( 'required' => 'required')) }} {{ $option }}
                                                        @endforeach
                                                    
                                                    @elseif( $custom_field->type == 'TEXT' )
                                                        {{ Form::text('cf_'.str_slug($custom_field->name,'_'), null, array('class'=>'form-control', 'required' => 'required')) }}
                                                    
                                                    @elseif( $custom_field->type == 'TEXTAREA' )
                                                        {{ Form::textarea('cf_'.str_slug($custom_field->name,'_'), null, array('class'=>'form-control', 'required' => 'required')) }}
                                                    
                                                    @elseif( $custom_field->type == 'MULTIPLE_OPTION' )
                                                        <?php 
                                                            $select_options = [];
                                                            foreach ($options as $option) {
                                                                $select_options[$option] = str_replace( '_', ' ',  ucfirst( $option ) ) ;
                                                            }
                                                         ?>
                                                        {{ Form::select('cf_'.str_slug($custom_field->name,'_').'[]', $select_options, array('multiple'=>'multiple','class'=>'form-control', 'required' => 'required')) }}

                                                    @elseif( $custom_field->type == 'FILE' )
                                                        <?php 
                                                            $select_options = [];
                                                            foreach ($options as $option) {
                                                                $select_options[$option] = str_replace( '_', ' ',  ucfirst( $option ) ) ;
                                                            }
                                                         ?>
                                                         {{ Form::file('cf_'.str_slug($custom_field->name,'_'),array('class'=>'form-control', 'required' => 'required')) }}

                                                    @endif



                                                </div> 

                                                @if( $index % 2  )
                                                    <div class="clearfix"></div>
                                                @endif
                                                {{-- */$index++;/* --}}
                                            @endforeach
                                        @endif

                                    </div>


                                    <div class="row">
                                    <div class="col-xs-12"><hr></div>
                                        <div class="col-xs-4">
                                            <!--a href="job.php" target="_blank" type="submit" class="btn btn-line"><i class="fa fa-save"></i> Save as draft</a-->
                                        </div>
                                        <div class="col-sm-4">
                                            <!--a href="job.php" target="_blank" type="submit" class="btn pull-right">Preview Job</a-->
                                        </div>

                                        <div class="col-sm-4"> 
                                            @if( $job['video_posting_enabled'] )
                                                <button type="submit" class="btn btn-success btn-block">Next &raquo;</button>
                                            @else
                                                <button type="submit" class="btn btn-success btn-block">Apply &raquo;</button>
                                            @endif
                                        </div>
                                        <div class="separator separator-small"></div>
                                    </div>


                                    

                                            
                                    <!-- $job->form_fields->toArray() -->

                                </form>

                                         @endif   
                                        </div>
                                                
                                        <div class="col-sm-4">
                                            <h6 class="text-brandon text-uppercase l-sp-5 no-margin">company details</h6><br>
                                            <p class="text-muted">{{ $company->name }}</p>

                                            <p><img src="{{ $company->logo }}" alt="" width="60%"></p><br>
                                            <p class="small">{{ $company->about }}</p>
                                            <p><i class="fa fa-map-marker"></i> {{ $company->address }}</p>
                                            <!--p>
                                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4448.570052456479!2d3.3791209324273184!3d6.618898622434336!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b93a899b7c9b7%3A0x8630de71dbc44ffd!2sMagodo+GRA+Phase+II%2C+Lagos!5e0!3m2!1sen!2sng!4v1457754339276" frameborder="0" width="100%" height="200px" allowfullscreen></iframe>
                                            </p-->
                                            <p>
                                                <i class="fa fa-envelope"></i> {{ $company->email }}  <br>
                                                <i class="fa fa-globe"></i> {{ $company->website }}
                                            </p>
                                        </div>
                                        <div class="col-sm-6 col-sm-offset-3 text-center hidden"><!-- <hr> -->
                                            <p >Powered by <a href="http://www.seamlesshiring.com"><i class="fa fa-skype"></i> SeamlessHiring</a> <br>
                                            <small class="text-muted">&copy; {{ date('Y') }}. SeamlessHiring</small></p>
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
                                        <p><img src="{{ url('/') }}/img/seamlesshiring-logo.png" alt="" width="150px"> </p> 
                                        <p><small class="text-muted">Powered by <a href="http://www.seamlesshiring.com"> SeamlessHiring</a> &nbsp;
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
                                $(document).ready(function() {
                                    $('#datepicker2').datepicker({
                                           dateFormat: "yy-mm-dd",
                                        autoclose: true,
                                        changeMonth: true,
            changeYear: true,
            yearRange: '-100:+0'

                                    });
        $('.select2').select2();

                                });
                            </script>


<div class="separator separator-small"><br></div>
@endsection