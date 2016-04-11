@extends('layout.template-default')


@section('content')
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
                                            <p class="text-center">Please fill in the information below carefully.</p>

    
                                {!! Form::open(array('url' => 'apply/'.$job->slug, 'class'=>'job-details', 'files'=>true)) !!}

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
                                            <div class="col-sm-4"><label for="job-loc">date of Birth <span class="text-danger">*</span></label><input id="datepicker" name="date_of_birth"  type="text" class="form-control"></div>
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
                                                {{ Form::text('last_company_worked', null, array('class'=>'form-control')) }}

                                            </div>

                                            <div class="col-sm-6">
                                                <label for="job-title">Last Position <span class="text-danger">*</span></label>
                                                {{ Form::text('last_position', null, array('class'=>'form-control')) }}

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


                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label for="">Do you reside in Abuja or are you willing to relocate to Abuja?<span class="text-danger">*</span></label><br/>
                                                <label>{{ Form::radio('willing_to_relocate', 'yes',  false, ['required']) }} Yes</label>
                                                <label>{{ Form::radio('willing_to_relocate', 'no',  false, ['required']) }} No </label>
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
                                        <div class="col-xs-4">
                                            <!--a href="job.php" target="_blank" type="submit" class="btn btn-line"><i class="fa fa-save"></i> Save as draft</a-->
                                        </div>
                                        <div class="col-sm-4">
                                            <!--a href="job.php" target="_blank" type="submit" class="btn pull-right">Preview Job</a-->
                                        </div>

                                        <div class="col-sm-4">
                                        <button type="submit" class="btn btn-success btn-block">Apply &raquo;</button>
                                        </div>
                                        <div class="separator separator-small"></div>
                                    </div>
                                </form>

                                            
                                        </div>
                                                
                                        <div class="col-sm-4">
                                            <h6 class="text-brandon text-uppercase l-sp-5 no-margin">company details</h6><br>
                                            <p class="text-muted">The Infrastructure Bank</p>
                                            <p><img src="{{ asset('InfrastructureBank/assets/tib-logo.jpg') }}" alt="" width="80%"></p><br>
                                            <p class="small">Formerly known as Urban Development Bank of Nigeria Plc, The Infrastructure Bank Plc was established in 1992 under decree No. 51 of the 1992 constitution of the Federal Republic of Nigeria. The Infrastructure Bank Plc is Nigeria's dedicated infrastructure bank providing financial solutions to support key long term infrastructure projects, including transportation infrastructure, municipal common services, mass housing and district development, solid waste management and water provision, and power and renewable energy projects.</p>
                                            <p><i class="fa fa-map-marker"></i> Plot No. 977, Central Business Area, (Adjacent National Mosque), Garki, Abuja</p>
                                            <p>
                                                
                                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3940.053443203597!2d7.490861314878479!3d9.058889993500113!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x104e0bb0172dc2e7%3A0x4e306a178129abb2!2sThe+Infrastructure+Bank+PLC!5e0!3m2!1sen!2s!4v1459173018514" width="100%" height="200px" frameborder="0" style="border:0" allowfullscreen></iframe>
                                            </p>
                                            <p>
                                                <i class="fa fa-envelope"></i> enquiries@tibplc.com <br>
                                                <i class="fa fa-globe"></i> www.infrastructurebankplc.com
                                            </p>
                                        </div>
                                        <div class="col-sm-6 col-sm-offset-3 text-center hidden"><!-- <hr> -->
                                            <p >Powered by <a href="http://www.insidify.com">Insidify.com </a> <br>
                                            <small class="text-muted">&copy; 2016. Insidify.com</small></p>
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

<script type="text/javascript">
    $(document).ready(function() {
        $('#datepicker').datepicker({
            format:'yyyy-mm-dd',
            autoclose: true,

        });
    });
</script>
@endsection