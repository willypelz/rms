<div class="">
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 view">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                <br>

                <div class="row">
                    <div class="col-sm-5 ">

                        <p class="hide">
                            <!-- Single button -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-line btn-sm dropdown-toggle hide" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Save into Folder &nbsp; <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><i class="fa fa-folder-o"></i> Devlopers</a></li>
                                    <li><a href="#"><i class="fa fa-folder-o"></i> Medicals</a></li>
                                    <li><a href="#"><i class="fa fa-folder-o"></i> Fashion</a></li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="#"><i class="fa fa-plus"></i> Create new</a></li>
                                </ul>
                            </div>
                            <span class="purchase-action hidden">
                                <a href="" class="btn btn-success btn-sm btn-cv-buy" data-count="1" data-cost="500"><i class="fa fa-plus"></i> Purchase CV for N500</a>
                                <button class="btn btn-line btn-sm btn-cv-discard collapse" data-count="1" data-cost="500"><i class="fa fa-trash"></i> Remove from Cart </button>
                            </span>
                        </p>
                    </div>
                    <div class="col-sm-2 hidden">
                        <div class="text-center cv-portrait">
                            <img src="{{ default_picture( $cv ) }}" class="img-circle">
                        </div>
                    </div>
                    <div class="col-sm-5">
                    </div>
                </div>
                <div class="clearfix"></div>

                <div class="tab-content stack" id="cv">


                    <div class="row">
                        <div class="col-sm-12 cv-name text-center">
                            <h2>
                            @if(@$is_applicant || $page == 'pool')
                            {{ @$cv['first_name'].' '.@$cv['last_name'] }}
                            @else
                            {{ @$cv['first_name'].' '.substr(@$cv['last_name'],0,1) }}
                            @endif
                            </h2>
                            <p class="text-muted">{{ @$cv['last_position'] }} at <strong>{{ @$cv['last_company_worked'] }}  </strong>
                            </p>
                            <hr>
                        </div>
                    </div>
                    <div class="unit-box">
                        <div class="row">
                            <div class="col-sm-1 r-left">
                                <span class="glyphicon glyphicon-file"></span>
                            </div>
                            <div class="col-sm-5">
                                <h5>PERSONAL DETAILS</h5>
                                <p class="text-muted">{{-- @$cv['headline'] --}}</p>
                                <ul class="list-unstyled">
                                    <li>
                                    <strong>Sex:</strong>&nbsp; {{ @$cv['gender'] }}</li>
                                    @if(@$is_applicant)
                                    <li>
                                    <strong>Email:</strong>&nbsp; {{ @$cv['email'] }}</li>
                                    <li>
                                    <strong>Phone:</strong>&nbsp; {{ @$cv['phone'] }}</li>
                                    @endif
                                    <li>
                                        <strong>Age:</strong>&nbsp; 
                                        @if(isset($appl->cv))
                                            @if($appl->cv->date_of_birth == '1970-01-01' || is_null($appl->cv->date_of_birth))
                                                -
                                            @else
                                                {{ str_replace('ago', 'old', human_time(@$cv['dob'], 1)) }}

                                                <span class="text-muted">({{ date('M d, Y', strtotime(@$cv['dob'])) }})</span>
                                            @endif
                                        @else
                                            {{ str_replace('ago', 'old', human_time(@$cv['dob'], 1)) }}
                                            <span class="text-muted">({{ date('M d, Y', strtotime(@$cv['dob'])) }})</span>
                                        @endif
                                    </li>
                                    <li><strong>Marital Status:</strong>&nbsp; {{ @$cv['marital_status'] }}.</li>
                                    <li><strong>State of Origin:</strong>&nbsp; {{ @$cv['state_of_origin'] }}.</li>
                                    <li><strong>Location:</strong>&nbsp; {{ @$cv['state'] }}.</li>
                                </ul>
                            </div>
                            <div class="col-sm-1 r-left">
                                <span class="glyphicon glyphicon-briefcase"></span>
                            </div>
                            <div class="col-sm-5">
                                <h5>CAREER SUMMARY</h5>
                                <p class="text-muted">{{-- @$cv['headline'] --}}</p>
                                <ul class="list-unstyled">
                                    <li>
                                    <strong>School:</strong>&nbsp; {{ !is_null(@$cv['school_id']) ? (isset($cv_school->school->name) ? $cv_school->school->name :'N/A' )  : 'N/A' }}</li>
                                    <li>
                                    <strong>Course of Study:</strong>&nbsp; {{(!is_null(@$cv['course_of_study'])) ? (is_array($cv['course_of_study']) ? $cv['course_of_study'][0] : $cv['course_of_study'] )  : 'N/A' }}</li>
                                    <li>
                                    <strong>Highest Qualification:</strong>&nbsp; {{ @$cv['highest_qualification'] }}</li>
                                    <li>
                                    <strong>Grade:</strong>&nbsp; {{ @getGrade( $cv['graduation_grade'] ) }}</li>
                                    <li>
                                    <strong>Completed NYSC:</strong>&nbsp; @if(@$cv['completed_nysc']) Yes @else No @endif.</li>
                                    <li>
                                    <strong>Years of Experience:</strong>&nbsp; {{ @$cv['years_of_experience'] }} {{ (@$cv['years_of_experience'] == 1 ) ? 'year' : 'years' }}</li>
                                    <li>
                                    <strong>Last Position:</strong>&nbsp; {{ @$cv['last_position'] }}</li>
                                    <li>
                                    <strong>Last Company Worked:</strong>&nbsp; {{ @$cv['last_company_worked'] }}.</li>
                                    <li>
                                    <strong>Minimum Remuneration:</strong>&nbsp; {{(!is_null(@$cv['minimum_remuneration'])) ? (is_array($cv['minimum_remuneration']) ? $cv['minimum_remuneration'][0] : $cv['minimum_remuneration'] )  : 'N/A' }}</li>
                                    <li>
                                    <strong>Maximum Remuneration:</strong>&nbsp; {{(!is_null(@$cv['maximum_remuneration'])) ? (is_array($cv['maximum_remuneration']) ? $cv['maximum_remuneration'][0] : $cv['maximum_remuneration'] )  : 'N/A' }}</li>
                                    <li>
                                    <strong>Willing to Relocate?:</strong>&nbsp; @if(@$cv['willing_to_relocate']) Yes @else No @endif.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @if(isset($appl))
                            <div class="unit-box">
                                <div class="row">

                                    <div class="col-xs-1 r-left">
                                        <span class="glyphicon glyphicon-briefcase"></span>
                                    </div>
                                    <div class="col-xs-5">
                                        <h5>ADDITIONAL INFORMATION</h5>
                                        <ul class="list-unstyled">

                                            @foreach($appl->custom_fields as $key => $form)

                                                <li>
                                                    @if (isset($form->form_field->type) && $form->form_field->type == 'FILE')
                                                      <a href="{{asset('uploads/Others/'.$form->value)}}">
                                                        <strong>{{ @$form->form_field->name }}</strong>
                                                      </a>
                                                    @else
                                                      <strong>{{ @$form->form_field->name }}:</strong>&nbsp; {{ $form->value }}</li>
                                                    @endif
                                                <li>

                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            </div>



                    <div class="unit-box">
                        <div class="row">
                            <div class="col-sm-1 r-left">
                                <span class="fa fa-pencil-square-o"></span>
                            </div>
                            <div class="col-sm-11">
                                <h5>Cover Letter</h5>
                                <p class="text-muted">{{ $appl->cover_note }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(!@$is_embedded)
                    @if(!@$is_applicant && $page != 'pool')
                    <div class="" id="cv">
                        <pre>
                                @if(isset($cv['extracted_content'][0] ))
                                    {{ remove_cv_contact( $cv ) }}
                                @endif
                        </pre>
                    </div>
                    @endif
                    @endif
                    @if(@$is_applicant)
                    <div class="unit-box">
                        <div class="row">
                            <div class="col-sm-1 r-left">
                                <span class="glyphicon glyphicon-link"></span>
                            </div>
                            <div class="col-sm-11">
                                <h5>UPLOADED CV</h5>
                                <!--iframe src="https://drive.google.com/gview?url=http://www.nwu.ac.za/files/images/Basic_Curriculum_Vitae_example.pdf&embedded=true" style="width:100%;padding-left: 8px;height:100%" frameborder="1"-->
                                @if( !isset($cv['cv_file']) || $cv['cv_file'] == '' )
                                  <span>Sorry! No uploaded CV for this applicant.</span>
                                @elseif(isset($cv['cv_file']) && ! (file_exists(getEnvData('fileupload').'/CVs/'.($cv['cv_file'] ?? ''))) )
                                  <span>Sorry! The CV for this applicant cannot be found.</span>
                                @else

                                    @if(ends_with(($cv['cv_file'] ?? null), 'jpg')
                                    || ends_with(($cv['cv_file'] ?? null), 'jpeg')
                                    || ends_with(($cv['cv_file'] ?? null), 'png')
                                    || ends_with(($cv['cv_file'] ?? null), 'gif'))

                                    <img src="{{ url( getEnvData('fileupload') ).'/CVs/'.($cv['cv_file'] ?? '') }}" width="100%" />
{{--
                                    @elseif(ends_with($cv['cv_file'], 'doc')
                                    || ends_with($cv['cv_file'], 'docx'))

                                        <iframe src="https://view.officeapps.live.com/op/view.aspx?src={{ url( env('fileupload') ).'/CVs/'.$cv['cv_file'] }}" style="width:100%;padding-left: 8px;height:600px" frameborder="1" allowfullscreen webkitallowfullscreen>
                                            {!! preloader() !!}
                                        </iframe>
                                     --}}
                                    @else

                                    <iframe src="https://docs.google.com/viewer?embedded=true&url={{ url( getEnvData('fileupload') ).'/CVs/'.($cv['cv_file'] ?? '') }}" style="width:100%;padding-left: 8px;height:600px" frameborder="1"  allowfullscreen webkitallowfullscreen>
                                    {!! preloader() !!}
                                    </iframe>
                                    
                                    @endif
                                @endif
                                @if((@$is_applicant || $page == 'pool') && (isset($cv['cv_file']) && $cv['cv_file'] != ""))
                                <div class="pull-right">
                                    <a href="{{ url( getEnvData('fileupload') ).'/CVs/'.$cv['cv_file'] }}" class="btn btn-sm btn-success btn-block" title="Download Dossier">Download CV</a>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <!--/tab-content-->
            </div>
        </div>
    </div>
</div>

