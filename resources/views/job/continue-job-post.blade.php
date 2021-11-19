@extends('layout.template-default')
@section('content')

    <div class="separator separator-small"></div>
    <section class="no-pad">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page">
                        <div class="row">
                            <div class="col-sm-6">
                                <h5 class="no-margin l-sp-5 text-brandon text-uppercase">
                                    Create Your Job Posting
                                </h5>
                                <p>Fill in your job requirements</p>
                            </div>
                            <div class="col-sm-6">
                                <div class="row progress-tabs">
                                    <div class="progress-tab completed">
                                        <span class="fa-stack">
                                            <i class="fa fa-stack-2x fa-circle "></i>
                                            <span class="fa-stack-1x">1</span>
                                        </span>
                                        Job Description
                                    </div>
                                    <div class="progress-tab active">
                                        <span class="fa-stack">
                                            <i class="fa fa-stack-2x fa-circle"></i>
                                            <span class="fa-stack-1x">2</span>
                                        </span>
                                        Application fields
                                    </div>
                                    <div class="progress-tab ">
                                        <span class="fa-stack">
                                            <i class="fa fa-stack-2x fa-circle"></i>
                                            <span class="fa-stack-1x">3</span>
                                        </span>
                                        Confirmation
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <hr>
                                </div>
                            </div>
                            <br>

                            <form action="{{ route('continue-draft', $job->id) }}" class="job-details" action=""
                                  id="myForm" role="job-details" method="post">
                                <div class="col-md-8 col-md-offset-2">

                                    <div class="text-center">
                                        <h4>Add your job Application Fields</h4>
                                        <br>

                                        <h4><strong>Default Fields</strong></h4>
                                        <hr>
                                    </div>

                                    {{-- Select all --}}
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label for=""></label>

                                            </div>
                                            <div class="col-xs-3">
                                                <label style="cursor: pointer;">
                                                    <input type="checkbox" id="is_required_all" style="margin:10px">
                                                    <span class="text-uppercase"><strong>Toggle
                                                            all</strong></span></label>
                                            </div>
                                            <div class="col-xs-3">
                                                <label style="cursor: pointer;">
                                                    <input type="checkbox" id="is_visible_all" style="margin:10px"
                                                           checked="checked"> <span class="text-uppercase"><strong>
                                                            Toggle all</strong></span></label>
                                            </div>
                                        </div>
                                    </div>


                                    @foreach( $application_fields as $key => $application_field )


                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label for="">{{ $application_field }}</label>
                                                </div>
                                                <div class="col-xs-3">
                                                    <input name="is_required[{{ $key }}][]" type="checkbox"
                                                           class="is_required" style="margin:10px"

                                                           @if(!is_null($selected_fields))
                                                           @if(isset($selected_fields->$key) && $selected_fields->$key->is_required)
                                                           checked="checked"
                                                            @endif
                                                            @endif

                                                    > Is
                                                    required
                                                </div>
                                                <div class="col-xs-3">
                                                    <input type="checkbox" name="is_visible[{{ $key }}][]"
                                                           class="is_visible" style="margin:10px"
                                                           @if(!is_null($selected_fields))
                                                           @if(isset($selected_fields->$key) && $selected_fields->$key->is_visible)
                                                           checked="checked"
                                                           @endif
                                                           @else
                                                           checked="checked"
                                                            @endif
                                                    >
                                                    Is visible
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <br>

                                    <h4>Custom Fields</h4>
                                    <hr>

                                    <div id="custom_fields">
                                        @if(isset($selected_form_fields))
                                            @foreach($selected_form_fields as $key => $form)
                                                <div class="well alert-success small text-uppercase"
                                                     id="custom_field_item" data-key="{{ $key }}">
                                                    <i class="fa fa-question-circle fa-lg"></i>
                                                    <strong>{{ $form->name }} *</strong>
                                                    <span class="pull-right">
                                                        <a href="" class="hidden" data-key="{{ $key }}">
                                                            <i class="fa fa-pencil"></i> EDIT</a> &nbsp;
                                                        <a href="" class="text-muted"
                                                           id="remove-custom-field"
                                                           data-key="{{ $key }}">
                                                            <i class="fa fa-times"></i>
                                                            REMOVE</a></span>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>


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

                                    <div id="addField" class="well no-shadow no-border no-bod-radius collapse">

                                        <a href="#addField"
                                           data-toggle="collapse"
                                           class="lead no-margin no-pad text-danger fa-2x pull-right">
                                            &times;
                                        </a>

                                        <div class="row"><br>
                                            <div class="col-xs-2 col-xs-offset-2 text-uppercase small">
                                                <strong>Field Label</strong>
                                            </div>
                                            <div class="col-xs-6"><input class="form-control" type="text"
                                                                         placeholder="Title of field" id="name-box">
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-2 col-xs-offset-2 text-uppercase small">
                                                <strong>Field Type</strong>
                                            </div>
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
                                            <div class="col-xs-2 col-xs-offset-2 text-uppercase small">
                                                <strong>Field Options</strong></div>
                                            <div class="col-xs-6">
                                                <input class="form-control"
                                                       type="text"
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
                                            </div>
                                        </div>

                                        <div id="hiddenForm"></div>

                                        <div class="form-group hidden">
                                            <div class="row">
                                                <div class="col-xs-8 col-xs-offset-2 text-center">
                                                    <label for="">
                                                        Your job will be posted automatically on these free job
                                                        platforms </label>
                                                    <small class="text-center text-muted">
                                                        We will send you an email with the links to the job adverts
                                                    </small>
                                                </div>
                                                <div class="col-xs-12">
                                                    <br>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="">

                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="">

                                                    </div>
                                                </div>
                                                <div class="col-xs-6 hidden">
                                                    <div class="well no-border no-shadow">
                                                        <label for=""><i class="fa fa-folder"></i> Create Job
                                                            Folder</label>
                                                        &nbsp;
                                                        <input type="text"
                                                               class="form-control"
                                                               placeholder="e.g lawyer2-02-2016">
                                                        <small>
                                                            (This folder will contain all Resumes / CVs and other
                                                            materials submitted by candidates that apply for the Job. )
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br><br>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <hr>
                                    </div>
                                    <div class="col-xs-7">
                                        <a href="{{ route('create-post-job', $job->id) }}" type="submit" id="previousStep"
                                           class="btn job-posting-text-dark">
                                            <i class="fa fa-arrow-left"></i>
                                            Previous step
                                        </a>
                                    </div>
                                    <div class="col-xs-5">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <button id="save-continue-btn" data-target='none' data-toggle="modal"
                                                        data-target="#savedAsDraft"
                                                        class="btn btn-primary btn-block submit-continue">
                                                    Save and continue later
                                                </button>
                                            </div>
                                            <div class="col-sm-6">
                                                <button id="next-job-btn" data-target='redirect'
                                                        class="btn btn-success btn-block submit-continue">
                                                    Next
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separator separator-small"></div>
                                </div>

                            </form>
                            <div class="clearfix"></div>

                            <div id="savedAsDraft" class="modal fade" tabindex="-1" role="dialog">
                                <div class="modal-dialog " role="document">
                                    <div class="modal-content">
                                        <div class="modal-body ">
                                             <div class="text-center">
                                                <br>
                                                <i class="fa fa-check text-success fa-4x"></i>
                                                <h5>Your job posting has been saved as draft</h5>
                                                <div class="pad-ft">
                                                    <a href="{{ route('job-list') }}" class="btn btn-success">Go to job list</a>
                                                </div>
                                            </div>

                                        </div>

                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div>
                        </div>
                    </div>
                    <!--/tab-content-->
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <div class="separator separator-small"></div>


    <script type="text/javascript">


    var custom_fields = JSON.parse('<?php echo json_encode($selected_form_fields); ?>')

    var submitTarget
    $(document).ready(function () {

        $('.submit-continue').click(function (e) {

            submitTarget = $(this).data('target')

            $('#myForm').ajaxForm({
                // target identifies the element(s) to update with the server response
                beforeSubmit: function () {
                    var newElement = '<input type="hidden" name="request_type" value=' + submitTarget + '>'
                    $('#hiddenForm').append($(newElement))
                },
                data: { request_type: submitTarget },

                // success identifies the function to invoke when the server response
                // has been received; here we apply a fade-in effect to the new content
                success: function (res) {
                    $('#savedAsDraft').modal('show');


                    if (res.status == 200) {
                        if (submitTarget == 'redirect') {
                            window.location.href = res.redirect_url
                        }
                    }
                },
            })
        })

        function optionsDisplay () {
            var noOptions = ['TEXT', 'TEXTAREA', 'FILE']
            if (noOptions.indexOf($('body #addField #type-box').val()) == -1) {
                $('body #addField #options-box').fadeIn()
            } else {
                $('body #addField #options-box').fadeOut()
            }
        }

        optionsDisplay()
        $('body #addField #type-box').on('change', optionsDisplay)

        $('body #add-field-btn').on('click', function () {
            if ($('body #addField #name-box').val() == '') {
                $.growl.error({ message: 'Please enter custom field name.' })
            } else if ($('body #addField #options-box input').val() == '' &&
                ['TEXT', 'TEXTAREA', 'FILE'].indexOf($('body #addField #type-box').val()) == -1) {
                $.growl.error({ message: 'Please enter custom field option.' })
            } else {
                custom_fields.push({
                    'name': $('body #addField #name-box').val(),
                    'type': $('body #addField #type-box').val(),
                    'options': $('body #addField #options-box input').val(),
                    'required': $('body #addField #required-box:checked').length,
                    'visible': $('body #addField #visible-box:checked').length,
                })
                $(this).loadCustomFields()
                $.growl.notice({ message: $('body #addField #name-box').val() + ' custom field created.' })
                $('body #addField #name-box').val('')
                $('body #addField #options-box input').val('')
            }
        })

        $.fn.loadCustomFields = function () {
            $('#custom_fields').html('')
            $.each(custom_fields, function (key, field) {
                $('#custom_fields').
                    append(
                        '<div class="well alert-success small text-uppercase" id="custom_field_item" data-key="' + key +
                        '"><i class="fa fa-question-circle fa-lg"></i> <strong>' + field.name +
                        ' *</strong><span class="pull-right"> <a href="" class="hidden" data-key="' + key +
                        '"><i class="fa fa-pencil"></i> EDIT</a> &nbsp; <a href="" class="text-muted" id="remove-custom-field" data-key="' +
                        key +
                        '"><i class="fa fa-times"></i> REMOVE</a></span><input type="text" class="hidden" name="custom_names[]" value="' +
                        field.name + '" /> <input type="text" class="hidden" name="custom_types[]" value="' +
                        field.type + '" /> <input type="text" class="hidden" name="custom_options[]" value="' +
                        field.options + '" /><input type="text" class="hidden" name="custom_required[]" value="' +
                        field.required + '" /><input type="text" class="hidden" name="custom_visible[]" value="' +
                        field.visible + '" /> </div>')

            })
        }
        $('body').on('click', '#remove-custom-field', function (e) {
            e.preventDefault()
            key = parseInt($(this).data('key'))
            $.growl.notice({ message: custom_fields[key].name + ' custom field removed from list. Kindly click next  or (save and continue later) to save changes' })
            custom_fields.splice(key, 1)
            $(this).loadCustomFields()
        })

        $('#is_required_all').on('click', function () {
            if ($(this).is(':checked')) {
                $('.is_required').prop('checked', 'checked')
            } else {
                $('.is_required').removeProp('checked')
            }
        })

        $('#is_visible_all').on('click', function () {
            if ($(this).is(':checked')) {
                $('.is_visible').prop('checked', 'checked')
            } else {
                $('.is_visible').removeProp('checked')
            }
        })
    })


    </script>
@endsection
