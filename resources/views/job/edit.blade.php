@extends('layout.template-default')

@section('content')
	<?php use Carbon\Carbon; ?>
    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
    <div class="separator separator-small"></div>

    <section class="no-pad">
        <div class="container">
            <div class="row">

                <div class="col-sm-12">
                    <h5 class="no-margin text-center l-sp-5 text-brandon text-uppercase">Edit Job</h5><br>
                    <div class="page">
                        <div class="row">


                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            @php
                            $is_private = $job->is_private;
                            @endphp

                            <div class="col-md-8 col-md-offset-2">
                                <p class="text-center"></p>

                                {!! Form::model($job, [
                                                   'method' => 'POST',
                                                   'url' => ['edit-job', $job->id],
                                                   'class' => 'form-horizontal',
                                                   'role'=>'form',
                                                   'enctype'=>'multipart/form-data'
                                               ]) !!}


                                <div class="row">
                                    <div class="separator separator-small"></div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12" style="padding:0px;"><label for="job-title">job title
                                                <span class="text-danger">*</span></label>
                                            {!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}

                                        </div>
                                    </div>


									<?php
									$joblevel = $job->job_type;
									$loc = $job->location;
									?>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label for="job-title">
                                                    Country
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <select required
                                                        name="country"
                                                        id="country"
                                                        class="form-control job_country"
                                                        type="text"
                                                        style="width: 303px;">
                                                    <option value="">--choose country--</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country }}" {{ ( $loc == $country || (in_array($loc,$locations) && $country == 'Nigeria')) ? 'selected="selected"' : '' }} >
                                                            {{ $country }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="state_section @if($errors->has('location') || (in_array($loc,$locations) || $loc == 'Nigeria'))  @else hidden @endif"
                                                     style="margin-top: 10px">
                                                    <label for="job-title">Location <span
                                                                class="text-danger">*</span></label>
                                                    <select name="job_location" id="location"
                                                            class="select2 form-control" required>
                                                        <option value="">--choose state--</option>
                                                        @foreach($locations as $state)
                                                            <option value="<?= $state != 'Nigeria' ? $state : 'Across Nigeria' ?>" {{ ($state ==  str_replace('Nigeria','Across Nigeria',$loc) )  ? "selected" : "" }} ><?=$state != 'Nigeria' ? $state : 'Across Nigeria'?></option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        <!-- <input id="job-title" type="text" name="job_title" class="form-control" {{ (Request::old('job_title')) ? ' value='. (Request::old('job_title')) .'' : '' }}></div> -->

                                            <div class="col-sm-6">
                                                <label for="job-title">job level <span class="text-danger">*</span>
                                                </label>

                                                <select name="job_type" id="job_level" required type="text"
                                                        class="form-control">
                                                    <option value=""> --Choose--</option>
                                                    <option value="full-time" {{ ( $joblevel == 'full-time' )  ? "selected" : "" }} >
                                                        Full-Time
                                                    </option>
                                                    <option value="part-time" {{ ( $joblevel == 'part-time' )  ? "selected" : "" }} >
                                                        Part-Time
                                                    </option>
                                                    <option value="contract" {{ ( $joblevel == 'contract' )  ? "selected" : "" }} >
                                                        Contract
                                                    </option>
                                                    <option value="intern" {{ ( $joblevel == 'intern' )  ? "selected" : "" }} >
                                                        Internship
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="row">

                                            <div class="col-sm-12"><label for="job-loc">Position</label>
                                                {!! Form::text('position', null, ['class' => 'form-control']) !!}

                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6"><label for="job-title">Post Date <span
                                                            class="text-danger">*</span></label>
                                                <input type="text" class="datepicker form-control"
                                                       value="{{ $job->post_date }}" disabled>


                                            </div>

                                            <div class="col-sm-6">
                                                <label for="job-title">Expiry Date <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" name="expiry_date" autocomplete="off"
                                                       class="datepicker form-control"
                                                       value="{{ ( $job->expiry_date != 0000-00-00 ) ? @Carbon::createFromFormat( 'Y-m-d',  $job->expiry_date)->format('m/d/Y') : '' }}">
                                            </div>

                                            <input type="hidden" name="status" value="ACTIVE">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <br>
                                                <label for="job-loc">Make job private
                                                    <input type="checkbox" id="is_private" value="true" onchange="checkedPrivate()"
                                                           name="is_private" @if ($is_private == 1) checked @endif >
                                                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="When a job posting is private, only candidate with the link to the job post can apply"></i>
                                                </label>
                                            </div>
                                            <div class="col-sm-6 attach_emails">                                        
                                                <label for="job-title">Attach Emails
                                                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Attach Emails to these private jobs"></i>
                                                </label>
                                                <input type="text"
                                                        name="attach_email"
                                                        value=""
                                                        placeholder="you are required to seperate emails by commas"
                                                        class="form-control"
                                                        autocomplete="off"
                                                        >
                                            </div>
                                            <div class="col-sm-6 attach_emails">
                                                <label for="job-title">Bulk Upload Emails
                                                    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Bulk Upload Emails to these private jobs"></i>
                                                </label>
                                                <input type="file"
                                                        name="bulk"
                                                        class="form-control"
                                                >
                                                <small>NB:csv should contain a column "emails"</small>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="job-loc">Remuneration</label>
                                        <div class="row ">
                                            <div class="col-sm-6">
                                                <label for="">Minimum</label>
                                                <input type="number" name="minimum_remuneration"
                                                       value="{{ $job->minimum_remuneration }}"
                                                       id="minimum_remuneration"
                                                       class="form-control">
                                            </div>
                                            <div class="col-sm-6">

                                                <label for="">Maximum</label>
                                                <input type="number" name="maximum_remuneration"
                                                       value="{{ $job->maximum_remuneration }}"
                                                       id="maximum_remuneration"
                                                       class="form-control">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label for="">Job Details <span class="text-danger">*</span></label>
                                                {!! Form::textarea('details', null, ['class' => 'form-control', 'id'=>'editor1', 'required']) !!}
                                            </div>
                                        </div>
                                    </div>
                                <!--  <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label for="">Requirement <span class="text-danger">*</span></label>
                                                <textarea name="requirement" id="editor2" cols="30" rows="4" class="form-control" placeholder="">{{ (Request::old('requirement')) ? ' value='. e(Request::old('requirement')) .'' : '' }}</textarea>
                                            </div>
                                        </div>
                                    </div> -->


                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label for="">Qualification, Skills and Experience</label>
                                            {!! Form::textarea('experience', null, ['class' => 'form-control', 'id'=>'editor3', 'required']) !!}

                                            <!-- <textarea name="additional_info" id="editor3" cols="30" rows="4" class="form-control" placeholder="">{{ (Request::old('additional_info')) ? ' value='. e(Request::old('additional_info')) .'' : '' }}</textarea> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label for="">Benefits</label>
                                                {!! Form::textarea('benefits', null, ['class' => 'form-control', 'id'=>'editor2']) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <hr>
                                        </div>
                                        <div class="col-xs-4">
                                            <a style="" href="{{ route('job-list') }}" type="submit"
                                               id="previous_step"
                                               class="btn job-posting-text-dark">
                                                <i class="fa fa-backward"></i>
                                                Cancel
                                            </a>
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- <a href="job.php" target="_blank" type="submit" class="btn pull-right">Preview Job</a> -->
                                        </div>

                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-success btn-block submitButton">Update
                                                job &raquo;
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







    <script>
        $(document).ready(function () {
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
        let attachEmail = $(".attach_emails");

        if($('#is_private').is(":checked")){
            attachEmail.show();
        }else{
            attachEmail.hide();
        }
            
        function checkedPrivate(){
            if($('#is_private').is(":checked")){
                $(".attach_emails").show();
            }
            else{
                $(".attach_emails").hide();
            }
        }
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        $(document).ready(function () {
            CKEDITOR.replace('editor1');
            CKEDITOR.replace('editor3');
            CKEDITOR.replace('editor2');
            CKEDITOR.replace('editor4')
        })
        $('body .datepicker').datepicker({

            format: 'mm/dd/yyyy'
        });
        
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

    </script>


    <div class="separator separator-small"></div>
@endsection
