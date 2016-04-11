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
                                <form class="job-details" role="job-details" method="post" action="{{ route('post-job') }}">
                                        
                                        {!! csrf_field() !!}

                                        <div class="row">
                                            <div class="separator separator-small"></div>
                                        </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6"><label for="job-title">job title <span class="text-danger">*</span></label>
                                            <input id="job-title" type="text" name="job_title" class="form-control" {{ (Request::old('job_title')) ? ' value='. e(Request::old('job_title')) .'' : '' }}></div>
                                           
                                            <div class="col-sm-6"><label for="job-loc">location <span class="text-danger">*</span></label>
                                            <input id="job-loc" name="job_location" type="text" class="form-control" {{ (Request::old('job_location')) ? ' value='. e(Request::old('job_location')) .'' : '' }}></div>
                                        </div>
                                    </div>
                               <!--      <div class="form-group hidden">
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <label for="">company description <span class="text-danger">*</span></label>
                                                <textarea name="" cols="30" rows="6" class="form-control" placeholder=""></textarea>
                                            </div>
                                            <div class="col-sm-3">
                                            <label for="">company logo <span class="text-danger">*</span></label>
                                                <div class="well company-logo small text-center" role="company-logo">
                                                    Attach your company logo here<br><br>
                                                    <a href="" class="btn btn-block btn-line">Attach a file</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label for="">Job description / responsibilities <span class="text-danger">*</span></label>
                                                <textarea name="job_description" id="editor1" cols="30" rows="6" class="form-control" placeholder="">{{ (Request::old('job_description')) ? ' value='. e(Request::old('job_description')) .'' : '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <label for="">Requirement <span class="text-danger">*</span></label>
                                                <textarea name="requirement" id="editor2" cols="30" rows="4" class="form-control" placeholder="">{{ (Request::old('requirement')) ? ' value='. e(Request::old('requirement')) .'' : '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-4"><label for="job-title">job type <span class="text-danger">*</span></label>
                                                    <select name="job_type" required="" id="job-title" type="text" class="form-control summernote">
                                                             <option value=""> --Choose-- </opition>
                                                            <option value="full-time" @if (Request::old('job_type') == 'full-time') selected="selected" @endif>Full-Time</opition>
                                                            <option value="part-time" @if (Request::old('job_type') == 'part-time') selected="selected" @endif>Part-Time</opition>
                                                            <option value="contract" @if (Request::old('job_type') == 'contract') selected="selected" @endif>Contract</opition>
                                                    </select>
                                            </div>
                                            <div class="col-sm-4"><label for="job-loc">Salary per annum</label>
                                            <input name="salary" type="number" class="form-control" {{ (Request::old('salary')) ? ' value='. e(Request::old('salary')) .'' : '' }}></div>
                                            
                                            <div class="col-sm-4"><label for="job-loc">Minimum Qualification</label>

                                            <select class="form-control" name="qualification" required>
                                                    <option value=""> --Choose-- </opition>
                                                   @foreach($qualifications as $q)
                                                    <option value="{{ $q }}" @if (Request::old('qualification') == "{{ $q }}") selected="selected" @endif>{{ $q }}</opition>
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

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-8 col-xs-offset-2 text-center">
                                                <label for="">Make my Job automatically posted for free on the Job sites below</label>
                                                <small class="text-center text-muted">kindly post your job to see more available job sites.</small>
                                            </div>
                                            <div class="col-xs-12">
                                                <br>
                                            </div>
                                        <div class="col-xs-6">
                                            <div class="">
                                              @foreach($board1 as $b)  
                                              <label class="btn btn-line btn-sm btn-label btn-block text-capitalize text-left">
                                                <input type="checkbox" class="" autocomplete="off" name="boards[]" value="{{ $b['id'] }}" checked>
                                                <span class="col-xs-6"><img src="{{ $b['img'] }}" width="100%" alt=""></span>
                                                <span class="col-xs-6"><b>{{ $b['name'] }}</b><br>{{ $b['url'] }}</span>
                                                <span class="clearfix"></span>
                                              </label>
                                              @endforeach
                                            
                                          </div>
                                        </div>

                                        <div class="col-xs-6">
                                            <div class="">
                                                @foreach($board2 as $jb)
                                              <label class="btn btn-line btn-sm btn-label btn-block text-capitalize text-left">
                                                <input type="checkbox" class="" autocomplete="off" name="boards[]" value="{{ $jb['id'] }}"  checked>
                                                <span class="col-xs-6"><img src="{{ $jb['img'] }}" width="100%" alt=""></span>
                                                <span class="col-xs-6"><b>{{ $jb['name'] }}</b><br>{{ $jb['url'] }}</span>
                                                <span class="clearfix"></span>
                                              </label>
                                               @endforeach
                                           
                                          </div>
                                        </div>

                                        <!-- <div class="col-xs-12"><br><p class="text-center">Post this job to see more available job boards</p></div> -->

                                            <div class="col-xs-6 hidden">
                                                <div class="well no-border no-shadow">
                                                    <label for=""><i class="fa fa-folder"></i> Create Job Folder</label> &nbsp;
                                                    <!-- <textarea name="" id="" cols="30" rows="4" class="form-control" placeholder=""></textarea> -->
                                                    <input type="text" class="form-control" placeholder="e.g lawyer2-02-2016"> 
                                                    <small>(This folder will contain all Resumes / CVs and other materials submitted by candidates that apply for the Job. )</small>
                                                </div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">
                                    <div class="col-xs-12"><hr></div>
                                        <div class="col-xs-4">
                                            <a href="job.php" target="_blank" type="submit" class="btn btn-line"><i class="fa fa-save"></i> Save as draft</a>
                                        </div>
                                        <div class="col-sm-4">
                                            <a href="job.php" target="_blank" type="submit" class="btn pull-right">Preview Job</a>
                                        </div>

                                        <div class="col-sm-4">
                                        <button type="submit" class="btn btn-success btn-block">Post job &raquo;</button>
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