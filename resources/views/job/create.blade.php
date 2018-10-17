@extends('layout.template-default')
@section('content')
    <style>
        .img-form {
            height: 80px;
            width: 130px;
            margin-right: 20px;
            margin-bottom: 10px;
        }
    </style>
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <div class="separator separator-small"></div>
    <section class="no-pad">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page">
                        <div class="row">
                            <h5 class="no-margin text-center l-sp-5 text-brandon text-uppercase">Fill in your job
                                requirements here.</h5>
                            <hr>
                            <br>
                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            
                            <div class="col-md-8 col-md-offset-2">
                                <!-- <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio voluptatibus magni officiis id error numquam.</p> -->
                                <form class="job-details" id="myForm" role="job-details" method="post"
                                      action="{{ route('post-job') }}">
                                    
                                    <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12"><label for="job-title">job title <span
                                                            class="text-danger">*</span></label>
                                                <input required id="job_title" type="text" name="job_title"
                                                       class="form-control" {{ (Request::old('job_title')) ? ' value='. e(Request::old('job_title')) .'' : '' }}>
                                                <small>e.g. Marketer at {{ get_current_company()->name }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6"><label for="job-title">Location <span
                                                            class="text-danger">*</span></label>
                                                <select name="job_location" id="location" class="select2"
                                                        style="width: 303px;">
                                                    <option value="">--choose state--</option>
                                                    @foreach($locations as $state)
                                                        <option value="{{ $state }}" {{ ( @Request::old('job_location') == $state) ? 'selected="selected"' : '' }} >{{ $state }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        <!-- <input id="job-title" type="text" name="job_title" class="form-control" {{ (Request::old('job_title')) ? ' value='. e(Request::old('job_title')) .'' : '' }}></div> -->
                                            
                                            <div class="col-sm-6">
                                                <label for="job-title">Job Type <span class="text-danger">*</span>
                                                </label>
                                                
                                                <select name="job_type" id="job_level" required="" type="text"
                                                        class="form-control">
                                                    <option value=""> --Choose--</option>
                                                    <option value="full-time"
                                                            @if (Request::old('job_type') == 'full-time') selected="selected" @endif>
                                                        Full-Time
                                                    </option>
                                                    <option value="part-time"
                                                            @if (Request::old('job_type') == 'part-time') selected="selected" @endif>
                                                        Part-Time
                                                    </option>
                                                    <option value="contract"
                                                            @if (Request::old('job_type') == 'contract') selected="selected" @endif>
                                                        Contract
                                                    </option>
                                                    <option value="intern"
                                                            @if (Request::old('job_type') == 'intern') selected="selected" @endif>
                                                        Internship
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            
                                            <div class="col-sm-12"><label for="job-loc">Position</label>
                                                <input type="text" name="position" class="form-control"
                                                       value="{{ Request::old('position')}}">
                                                <small>e.g. Associate Marketer</small>
                                            </div>
                                        
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6"><label for="job-title">Job Specialization <span
                                                            class="text-danger">*</span></label>
                                                <br><select name="specializations[]" id="" multiple="" required
                                                            class="select2" style="width: 303px;">
                                                    <option value="">--choose specialization</option>
                                                    @foreach($specializations as $s)
                                                        <option value="{{ $s->id }}" {{ ( @in_array($s->id,Request::old('specializations')) ) ? 'selected="selected"' : '' }}>{{ $s->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-6">
                                                <label for="job-title">Expiry Date <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="expiry_date" class="datepicker form-control"
                                                       value="{{ Request::old('expiry_date')}}" autocomplete="off">
                                            
                                            </div>
                                        </div>
                                    </div>
                                
                                <!-- <div class="form-group">
            <div class="row">
                <div class="col-xs-12">
                    <label for="">Summary <span class="text-danger">*</span></label>
                    <textarea name="Summary" id="editor3" cols="30" rows="4" class="form-control" placeholder="">{{ (Request::old('experience')) ? ' value='. e(Request::old('experience')) .'' : '' }}</textarea>
                </div>
            </div>
        </div> -->
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label for="workflowId">
                                                    Job Workflow
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <select name="workflow_id"
                                                        id="workflowId"
                                                        class="select2"
                                                        style="width: 100%;">
                                                    <option value="">- Select Workflow -</option>
                                                    @foreach($workflows as $workflow)
                                                        <option value="{{ $workflow->id }}">{{ $workflow->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label for="">Job Details <span class="text-danger">*</span></label>
                                                <textarea name="details" id="editor1" cols="30" rows="6"
                                                          class="form-control"
                                                          placeholder="">{{ (Request::old('details')) ? e(Request::old('details')) : '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <hr>
                                    <br>
                                    <h3>Job Application Fields</h3>
                                    <br>
                                    
                                    <h4>Default Fields</h4>
                                    <hr>
                                    
                                    {{-- Select all --}}
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label for=""></label>
                                            
                                            </div>
                                            <div class="col-xs-3">
                                                <label style="cursor: pointer;">
                                                    <input type="checkbox" id="is_required_all" style="margin:10px">
                                                    <span class="text-uppercase"><strong>Toggle all</strong></span></label>
                                            </div>
                                            <div class="col-xs-3">
                                                <label style="cursor: pointer;">
                                                    <input type="checkbox" id="is_visible_all" style="margin:10px"
                                                           checked="checked"> <span class="text-uppercase"><strong>Toggle all</strong></span></label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <script type="text/javascript">
                                        $(document).ready(function () {
                                            $('#is_required_all').on('click', function () {
                                                if ($(this).is(':checked')) {
                                                    $('.is_required').prop('checked', 'checked');
                                                }
                                                else {
                                                    $('.is_required').removeProp('checked');
                                                }
                                            });

                                            $('#is_visible_all').on('click', function () {
                                                if ($(this).is(':checked')) {
                                                    $('.is_visible').prop('checked', 'checked');
                                                }
                                                else {
                                                    $('.is_visible').removeProp('checked');
                                                }
                                            });
                                        });
                                    </script>
                                    
                                    @foreach( $application_fields as $key => $application_field )
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label for=""> {{ $application_field }}</label>
                                                
                                                </div>
                                                <div class="col-xs-3">
                                                    <input type="checkbox" name="is_required[{{ $key }}][]"
                                                           class="is_required" style="margin:10px"> Is required
                                                </div>
                                                <div class="col-xs-3">
                                                    <input type="checkbox" name="is_visible[{{ $key }}][]"
                                                           class="is_visible" style="margin:10px" checked="checked"> Is
                                                    visible
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <br>
                                    
                                    
                                    <h4>Custom Fields</h4>
                                    <hr>
                                    <div id="custom_fields"></div>
                                    
                                    
                                    <div class="AddFieldButton">
                                        <a href="#addField" data-toggle="collapse" aria-controls=""
                                           class="btn btn-line btn-sm text-success"
                                           style="background: whitesmoke; border: none; border-radius: 3px 3px 0 0;"><i
                                                    class="fa fa-plus"></i> Add Custom field</a> &nbsp;
                                        <small class="">- Use this to add a custom question or input to the application
                                            form
                                        </small>
                                        <br>
                                    </div>
                                    
                                    <!-- <div class="AddFieldButton">
                                        <a href="#" id="addCustomField" data-toggle="modal" data-target="#Cust_modal" aria-controls="" class="btn btn-line btn-sm text-success"><i class="fa fa-plus"></i> Add Custom field</a> &nbsp;
                                        <small class="">- Use this to add a custom question or input to this form</small><br>
                                    </div> -->
                                    <div id="Cust_modal" class="modal fade" tabindex="-1" role="dialog">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close"><span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h4 class="modal-title">Adding Custom Field</h4>
                                                </div>
                                                <div class="modal-body">
                                                    
                                                    <div id="listFieldItems" class="list-group no-margin">
                                                        <a href="#" class="list-group-item addFieldRadio">
                                                            <img src="input-radio.png" class="img-form pull-left"
                                                                 alt="Radio Buttons">
                                                            <h4 class="list-group-item-heading">Radio Buttons</h4>
                                                            <p class="list-group-item-text">Donec id elit non mi porta
                                                                gravida at eget metus. Maecenas sed diam eget risus
                                                                varius blandit.
                                                            </p>
                                                            <span class="clearfix"></span>
                                                        </a>
                                                        <a href="#" class="list-group-item addFieldDrop">
                                                            <img src="input-radio.png" class="img-form pull-left"
                                                                 alt="Dropdown Option list">
                                                            <h4 class="list-group-item-heading">Dropdown Option
                                                                list</h4>
                                                            <p class="list-group-item-text">Donec id elit non mi porta
                                                                gravida at eget metus. Maecenas sed diam eget risus
                                                                varius blandit.
                                                            </p>
                                                            <span class="clearfix"></span>
                                                        </a>
                                                        <a href="#" class="list-group-item addFieldChck">
                                                            <img src="input-cehecbox.png" class="img-form pull-left"
                                                                 alt="Checkbox">
                                                            <h4 class="list-group-item-heading">Checkbox</h4>
                                                            <p class="list-group-item-text">Donec id elit non mi porta
                                                                gravida at eget metus. Maecenas sed diam eget risus
                                                                varius blandit.
                                                            </p>
                                                            <span class="clearfix"></span>
                                                        </a>
                                                        <a href="#" class="list-group-item addFieldArea">
                                                            <img src="input-textarea.png" class="img-form pull-left"
                                                                 alt="Textarea">
                                                            <h4 class="list-group-item-heading">Textarea</h4>
                                                            <p class="list-group-item-text">For adding long paragraph
                                                                texts
                                                            </p>
                                                            <span class="clearfix"></span>
                                                        </a>
                                                        <a href="#" class="list-group-item addFieldOpt">
                                                            <img src="input-multi.png" class="img-form pull-left"
                                                                 alt="Multiple Options">
                                                            <h4 class="list-group-item-heading">Multiple Options</h4>
                                                            <p class="list-group-item-text">Donec id elit non mi porta
                                                                gravida at eget metus. Maecenas sed diam eget risus
                                                                varius blandit.
                                                            </p>
                                                            <span class="clearfix"></span>
                                                        </a>
                                                        <a href="#" class="list-group-item addFieldFile">
                                                            <img src="input-file.png" class="img-form pull-left"
                                                                 alt="File Upload field">
                                                            <h4 class="list-group-item-heading">File Upload field</h4>
                                                            <p class="list-group-item-text">Donec id elit non mi porta
                                                                gravida at eget metus. Maecenas sed diam eget risus
                                                                varius blandit.
                                                            </p>
                                                            <span class="clearfix"></span>
                                                        </a>
                                                    
                                                    </div>
                                                    
                                                    <div class="dumpField" class="">
                                                        
                                                        <p class="">
                                                            <a id="back2list" href="#" class="pull-right">
                                                                <i class="fa fa-arrow-left"></i> Back to list
                                                            </a>
                                                        </p>
                                                        
                                                        <!-- Adding Radio Buttons -->
                                                        <div class="fieldInput-radio collapse">
                                                            <h4 class="text-warning text-bold">Radio Buttons</h4>
                                                            <div class="form-group">
                                                                <label for="fieldInput-radio-name">Name /
                                                                    Question</label>
                                                                <input type="text" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="fieldInput-radio-desc">Short
                                                                    Description</label>
                                                                <textarea rows="4" class="form-control"></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="fieldInput-radio-opt">Add an Option</label>
                                                                <input type="textarea" rows="4" class="form-control">
                                                                <br>
                                                                <a href="#" class="btn btn-line">+ Add Option</a>
                                                            </div>
                                                        </div>
                                                        <!-- End of Radio Buttons -->
                                                        
                                                        
                                                        <!--  -->
                                                        <div class="fieldInput-dropdown collapse">
                                                            <div class="form-group">
                                                                <label for="name"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <!--  -->
                                                        
                                                        <!--  -->
                                                        <div class="fieldInput-checkbox collapse">
                                                            <div class="form-group">
                                                                <label for="name"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <!--  -->
                                                        
                                                        <!--  -->
                                                        <div class="fieldInput-text collapse">
                                                            <div class="form-group">
                                                                <label for="name"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <!--  -->
                                                        
                                                        <!--  -->
                                                        <div class="fieldInput-textarea collapse">
                                                            <div class="form-group">
                                                                <label for="name"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <!--  -->
                                                        
                                                        <!--  -->
                                                        <div class="fieldInput-options collapse">
                                                            <div class="form-group">
                                                                <label for="name"></label>
                                                            </div>
                                                        </div>
                                                        
                                                        <!--  -->
                                                        
                                                        <!--  -->
                                                        <div class="fieldInput-file collapse">
                                                            <div class="form-group">
                                                                <label for="name"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-line" data-dismiss="modal">
                                                        Cancel
                                                    </button>
                                                    <button type="button" class="btn btn-primary">Add to form</button>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                    
                                    
                                    <script>
                                        // $('#addCustomField').on('click');

                                        $('.addFieldRadio').on('click', function () {
                                            //Hide input list and show designated input settings
                                            $().fadeOut();
                                            $().fadeIn();
                                        });
                                    
                                    </script>
                                    
                                    
                                    <div id="addField" class="well no-shadow no-border no-bod-radius collapse">
                                        
                                        <a href="#addField" data-toggle="collapse"
                                           class="lead no-margin no-pad text-danger fa-2x pull-right">&times;</a>
                                        
                                        <div class="row"><br>
                                            <div class="col-xs-2 col-xs-offset-2 text-uppercase small"><strong>Field
                                                    <br> Label</strong></div>
                                            <div class="col-xs-6"><input class="form-control" type="text"
                                                                         placeholder="Title of field" id="name-box">
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-2 col-xs-offset-2 text-uppercase small"><strong>Field
                                                    <br> Type</strong></div>
                                            <div class="col-xs-6">
                                                <select name="" id="type-box" class="form-control">
                                                    @foreach( get_form_field_types() as $field_type => $field_label )
                                                        <option value="{{ $field_type }}">{{ $field_label }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr>
                                        </div>
                                        <div class="row" id="options-box">
                                            <div class="col-xs-2 col-xs-offset-2 text-uppercase small"><strong>Field
                                                    Options</strong></div>
                                            <div class="col-xs-6">
                                                <input class="form-control" type="text"
                                                       placeholder="Enter options separated by comma">
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-xs-2 col-xs-offset-2 text-uppercase small">
                                                <strong>Required? </strong></div>
                                            <div class="col-xs-6">
                                                <input name="" id="required-box" type="checkbox"/>
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-xs-2 col-xs-offset-2 text-uppercase small">
                                                <strong>Visible? </strong></div>
                                            <div class="col-xs-6">
                                                <input name="" id="visible-box" type="checkbox" checked="checked"/>
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-xs-8 col-xs-offset-2">
                                                <a href="javascript://" class="btn-sm btn btn-success pull-right"
                                                   id="add-field-btn"><i class="fa fa-check"></i> Add field</a>
                                                
                                                <!--                                                    <button href="" class="btn-sm btn btn-line disabled pull-left" ><i class="fa fa-plus"></i> Add another field</button>-->
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group hidden">
                                        <div class="row">
                                            <div class="col-xs-8 col-xs-offset-2 text-center">
                                                <label for="">Your job will be posted automatically on these free job
                                                    platforms </label>
                                                <small class="text-center text-muted">We will send you an email with the
                                                    links to the job adverts
                                                </small>
                                            </div>
                                            <div class="col-xs-12">
                                                <br>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="">
                                                    @foreach($board1 as $b)
                                                        <label class="btn btn-line btn-sm btn-label btn-block text-left">
                                                            <input type="checkbox" class="" autocomplete="off"
                                                                   name="boards[]" value="{{ $b['id'] }}" checked>
                                                            <span class="col-xs-5"><img src="{{ $b['img'] }}"
                                                                                        width="100%" alt=""></span>
                                                            <span class="col-xs-7 text-muted"
                                                                  style="padding-left:0"><b>{{ $b['name'] }}</b><br>{{ $b['url'] }}</span>
                                                            <span class="clearfix"></span>
                                                        </label>
                                                    @endforeach
                                                
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="">
                                                    @foreach($board2 as $jb)
                                                        <label class="btn btn-line btn-sm btn-label btn-block text-left">
                                                            <input type="checkbox" class="" autocomplete="off"
                                                                   name="boards[]" value="{{ $jb['id'] }}" checked>
                                                            <span class="col-xs-5"><img src="{{ $jb['img'] }}"
                                                                                        width="100%" alt=""></span>
                                                            <span class="col-xs-7 text-muted"
                                                                  style="padding-left:0"><b>{{ $jb['name'] }}</b><br>{{ $jb['url'] }}</span>
                                                            <span class="clearfix"></span>
                                                        </label>
                                                    @endforeach
                                                
                                                </div>
                                            </div>
                                            <!-- <div class="col-xs-12"><br><p class="text-center">Post this job to see more available job boards</p></div> -->
                                            <div class="col-xs-6 hidden">
                                                <div class="well no-border no-shadow">
                                                    <label for=""><i class="fa fa-folder"></i> Create Job Folder</label>
                                                    &nbsp;
                                                    <!-- <textarea name="" id="" cols="30" rows="4" class="form-control" placeholder=""></textarea> -->
                                                    <input type="text" class="form-control"
                                                           placeholder="e.g lawyer2-02-2016">
                                                    <small>(This folder will contain all Resumes / CVs and other
                                                        materials submitted by candidates that apply for the Job. )
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <hr>
                                        
                                        </div>
                                        <div class="col-xs-4">
                                            <!-- <a href="job.php" type="submit" id="SaveDraft" class="btn btn-line"><i class="fa fa-save"></i> Save as draft</a> -->
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- <a href="job.php" target="_blank" type="submit" class="btn pull-right">Preview Job</a> -->
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-success btn-block">Post job &raquo;
                                            </button>
                                        </div>
                                        <div class="separator separator-small"></div>
                                    </div>
                                </form>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <!--/tab-content-->
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript">
        var custom_fields = [];
        $('#SaveDraft').click(function (e) {
            e.preventDefault();
// $("#myForm").validate();
            var title = $('#job_title').val()
            if (title == null || title == "") {
                alert("Title must be filled out");
                return false;
            }
            var location = $('#location').val()
            if (location == null || location == "") {
                alert("location must be filled out");
                return false;
            }
            var token = $('#token').val();
            var url = "{{ route('job-draft') }}"
            $.ajax
            ({
                type: "POST",
                url: url,
                data: ({rnd: Math.random() * 100000, _token: token, title: title, location: location}),
                success: function (response) {
                    console.log(response)
                }
            });
        })
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        $(document).ready(function () {
            $('.datepicker').datepicker({
                format: 'mm/dd/yyyy'
            });

            function optionsDisplay() {
                var noOptions = ['TEXT', 'TEXTAREA', 'FILE'];
                if (noOptions.indexOf($('body #addField #type-box').val()) == -1) {
                    $('body #addField #options-box').fadeIn();
                }
                else {
                    $('body #addField #options-box').fadeOut();
                }
            }

            optionsDisplay();
            $('body #addField #type-box').on('change', optionsDisplay);
            $('body #add-field-btn').on('click', function () {
                if ($('body #addField #name-box').val() == "") {
                    $.growl.error({message: "Please enter custom field name."});
                }
                else if ($('body #addField #options-box input').val() == "" && ["TEXT", "TEXTAREA", "FILE"].indexOf($('body #addField #type-box').val()) == -1) {
                    $.growl.error({message: "Please enter custom field option."});
                }
                else {
                    custom_fields.push({
                        'name': $('body #addField #name-box').val(),
                        'type': $('body #addField #type-box').val(),
                        'options': $('body #addField #options-box input').val(),
                        'required': $('body #addField #required-box:checked').length,
                        'visible': $('body #addField #visible-box:checked').length,
                    });
                    $(this).loadCustomFields();
                    $.growl.notice({message: $('body #addField #name-box').val() + " custom field created."});
                    $('body #addField #name-box').val('');
                    $('body #addField #options-box input').val('');
                }
// $('#addField').toggle();
            });
            $.fn.loadCustomFields = function () {
                $('#custom_fields').html('');
                $.each(custom_fields, function (key, field) {
                    $('#custom_fields').append('<div class="well alert-success small text-uppercase" id="custom_field_item" data-key="' + key + '"><i class="fa fa-question-circle fa-lg"></i> <strong>' + field.name + ' *</strong><span class="pull-right"> <a href="" class="hidden" data-key="' + key + '"><i class="fa fa-pencil"></i> EDIT</a> &nbsp; <a href="" class="text-muted" id="remove-custom-field" data-key="' + key + '"><i class="fa fa-times"></i> REMOVE</a></span><input type="text" class="hidden" name="custom_names[]" value="' + field.name + '" /> <input type="text" class="hidden" name="custom_types[]" value="' + field.type + '" /> <input type="text" class="hidden" name="custom_options[]" value="' + field.options + '" /><input type="text" class="hidden" name="custom_required[]" value="' + field.required + '" /><input type="text" class="hidden" name="custom_visible[]" value="' + field.visible + '" /> </div>');
// $('#custom_fields').append('<div class="well small" id="custom_field_item" data-key="' + key + '">Custom Field: ' + field.name + ' <span class="pull-right"><a href="" class="hidden" data-key="' + key + '"><i class="fa fa-pencil"></i> EDIT</a> &nbsp; <a href="" class="text-muted" id="remove-custom-field" data-key="' + key + '"><i class="fa fa-times"></i> REMOVE</a></span> <input type="text" class="hidden" name="custom_names[]" value="' + field.name + '" /> <input type="text" class="hidden" name="custom_types[]" value="' + field.type + '" /> <input type="text" class="hidden" name="custom_options[]" value="' + field.options + '" /> </div>');
                });
// $('#custom_fields').append('<div class="well small" >Custom Field: ' + $('body #addField #name-box').val() + ' <span class="pull-right"><a href="" class=""><i class="fa fa-pencil"></i> EDIT</a> &nbsp; <a href="" class="text-muted" id="remove-custom-field"><i class="fa fa-times"></i> REMOVE</a></span></div>');
            }
            $('body').on('click', '#remove-custom-field', function (e) {
                e.preventDefault();
                key = parseInt($(this).data('key'));
                $.growl.notice({message: custom_fields[key].name + " custom field removed."});
                custom_fields.splice(key, 1);
                $(this).loadCustomFields();
            });
        });
        CKEDITOR.replace('editor1');
        CKEDITOR.replace('editor3');
        CKEDITOR.replace('editor2');
    </script>
    <div class="separator separator-small"></div>
@endsection