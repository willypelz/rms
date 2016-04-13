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
                                            <div class="col-sm-6"><label for="job-title">job title <span class="text-danger">*</span></label>
                                                {!! Form::text('title', null, ['class' => 'form-control', 'required']) !!}
                                            </div>
                                           
                                            <div class="col-sm-6"><label for="job-loc">location <span class="text-danger">*</span></label>
                                                {!! Form::text('location', null, ['class' => 'form-control', 'required']) !!}
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label for="">Job description / responsibilities <span class="text-danger">*</span></label>
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


                                    <?php 
                                        $job_type = $job->job_type;
                                        $qual = $job->qualification;
                                     ?>
                                     
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4"><label for="job-title">job type <span class="text-danger">*</span></label>
                                                    <select name="job_type" required="" id="job-title" type="text" class="form-control summernote">
                                                             <option value=""> --Choose-- </opition>
                                                            <option value="full-time" @if ($job_type == 'full-time') selected="selected" @endif>Full-Time</opition>
                                                            <option value="part-time" @if ($job_type == 'part-time') selected="selected" @endif>Part-Time</opition>
                                                            <option value="contract" @if ($job_type == 'contract') selected="selected" @endif>Contract</opition>
                                                    </select>
                                            </div>
                                            <div class="col-sm-4"><label for="job-loc">Salary per annum</label>
                                            <input name="salary" type="number" class="form-control" {{ (Request::old('salary')) ? ' value='. e(Request::old('salary')) .'' : '' }}></div>
                                            
                                            <div class="col-sm-4"><label for="job-loc">Minimum Qualification</label>
    
                                            <select class="form-control" name="qualification" required>
                                                    <option value=""> --Choose-- </opition>
                                                   @foreach($qualifications as $q)
                                                    <option value="{{ $q }}" @if($q == $qual) selected="selected" @endif  >{{ $q }}</opition>
                                                    @endforeach
                                            </select></div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label for="">Additional Information</label>
                                                <textarea name="additional_info" id="editor3" cols="30" rows="4" class="form-control" placeholder="">{{ (Request::old('additional_info')) ? ' value='. e(Request::old('additional_info')) .'' : '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                    <div class="col-xs-12"><hr></div>
                                        <div class="col-xs-4">
                                            <a href="job.php" target="_blank" type="submit" class="btn btn-line"><i class="fa fa-save"></i> Save as draft</a>
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