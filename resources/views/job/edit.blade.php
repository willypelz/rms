@extends('layout.template-default')

@section('content')

<div class="separator separator-small"></div>

    <section class="no-pad">
        <div class="container">
            <div class="row">

                <div class="col-sm-12">
                    <h5 class="no-margin text-center l-sp-5 text-brandon text-uppercase">Job Creation</h5><br>
                    <div class="page">
                        <div class="row">


                                 @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                 @endif
                            
                            <div class="col-md-8 col-md-offset-2">
                            <p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio voluptatibus magni officiis id error numquam.</p>
                                    
                                     {!! Form::model($job, [
                                                        'method' => 'POST',
                                                        'url' => ['edit-job', $job->id],
                                                        'class' => 'form-horizontal',
                                                        'role'=>'form'
                                                    ]) !!}
                                    

                                        <div class="row">
                                            <div class="separator separator-small"></div>
                                        </div>

                                        <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12"><label for="job-title">job title <span class="text-danger">*</span></label>
                                                {!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}
                                            
                                        </div>
                                    </div>
                                 
                                    
                                    <?php 
                                        $joblevel = $job->job_type;
                                        $loc = $job->location;
                                        ?>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6"><label for="job-title">Location <span class="text-danger">*</span></label>
                                                <select name="job_location" id="location" class="select2 form-control">
                                                    <option value="">--choose state--</option>
                                                    @foreach($locations as $state)
                                                            <option value="<?= $state ?>"<? if($state == $loc) echo " selected"?>  ><?=$state?></option>
                                                    @endforeach
                                                </select>
                                            </div>
                                             <!-- <input id="job-title" type="text" name="job_title" class="form-control" {{ (Request::old('job_title')) ? ' value='. e(Request::old('job_title')) .'' : '' }}></div> -->
                                           
                                            <div class="col-sm-6">
                                                    <label for="job-title">job level <span class="text-danger">*</span>
                                                    </label>
                                                    
                                                    <select name="job_type" id="job_level" required="" type="text" class="form-control">
                                                            <option value=""> --Choose-- </option>
                                                            <option value="full-time"  <? if('full-time' == $joblevel) echo " selected"?> >Full-Time</option>
                                                            <option value="part-time" <? if('part-time' == $joblevel) echo " selected"?> >Part-Time</option>
                                                            <option value="contract" <? if('contract' == $joblevel) echo " selected"?> >Contract</option>
                                                            <option value="intern" <? if('intern' == $joblevel) echo " selected"?> >Internship</option>
                                                    </select>
                                            </div>
                                        </div>
                                    </div>
                                    

                                     <div class="form-group">
                                        <div class="row">
                                            
                                            <div class="col-sm-12"><label for="job-loc">Position</label>
                                                {!! Form::text('position', null, ['class' => 'form-control', 'required']) !!}

                                            </div>
                                            
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6"><label for="job-title">Post Date <span class="text-danger">*</span></label>
                                                    <input type="text" name="post_date" class="datepicker form-control" value="{{ $job->post_date }}">
                                                <!-- {!! Form::text('post', null, ['class' => 'form-control', 'required']) !!} -->

                                            </div>                                            

                                            <div class="col-sm-6">
                                                    <label for="job-title">Expiry Date <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" name="expiry_date" class="datepicker form-control"  value="{{ $job->expiry_date }}">
                                            </div>

                                            <input type="hidden" name="status" value="PENDING">
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
                                                <label for="">Experience</label>
                                                    {!! Form::textarea('experience', null, ['class' => 'form-control', 'id'=>'editor3', 'required']) !!}

                                                <!-- <textarea name="additional_info" id="editor3" cols="30" rows="4" class="form-control" placeholder="">{{ (Request::old('additional_info')) ? ' value='. e(Request::old('additional_info')) .'' : '' }}</textarea> -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                    <div class="col-xs-12"><hr></div>
                                        <div class="col-xs-4">
                                            <!-- <a href="job.php" target="_blank" type="submit" class="btn btn-line"><i class="fa fa-save"></i> Save as draft</a> -->
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- <a href="job.php" target="_blank" type="submit" class="btn pull-right">Preview Job</a> -->
                                        </div>

                                        <div class="col-sm-4">
                                        <button type="submit" class="btn btn-success btn-block">Update job &raquo;</button>
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
   

    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>




            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                $(document).ready(function(){
                CKEDITOR.replace( 'editor1' );
                CKEDITOR.replace( 'editor3' );
                CKEDITOR.replace( 'editor2' );

                })

                 
            </script>
    

<div class="separator separator-small"></div>
@endsection