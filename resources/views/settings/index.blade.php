@extends('settings.base')

@section('main-content')
    <script src="{{ asset('js/jquery.slugify.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
    <section class="no-pad">
        <div class="container">
            <div class="section_card">
                <div class="section_title">
                    <b>Page Settings</b>
                </div>
                <hr class="hr_divider">

                <div class="section_content row">
                    <div class="dash_navigation_pane col-md-4">
                     @include('settings.includes.navigation')
                    </div>
                    <div class="col-md-8">
                        <div class="content">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    {!! Form::open(array('route'=>'edit-company','method'=>'POST', 'id'=>'SignUPform', 'files'=>true, 'class'=>'form-signup', 'role'=>'form')) !!}
                                    @include('layout.alerts')

                                    {!! csrf_field() !!}
                                    <input type="hidden" name="company_creation_page" value="true">
                                    <input type="hidden" name="company_id" value="{{$company->id}}">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3 text-center">
                                            <div class="form-group{{ $errors->has('logo') ? ' has-error' : '' }}">
                                                <label class="col-md-12" for="">Company Logo</label>
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                                         style="width: 200px; height: 150px;"></div>
                                                    <div>
                                                <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span
                                                            class="fileinput-exists">Change</span>
                                                 <?php  echo Form::file('logo'); ?>
                                                </span>
                                                        <a href="#" class="btn btn-default fileinput-exists"
                                                           data-dismiss="fileinput">Remove</a>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label for=""> Company name  <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="name" placeholder=""
                                                       name="name" value="{{ $company->name }}" required>
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                                <label for="">Company url</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">http://</span>
                                                    <input type="text" class="form-control slug" id="" placeholder=""
                                                           name="slug" value="{{  $company->slug }}" readonly>
                                                    <span class="input-group-addon">.seamlesshiring.com</span>

                                                </div>
                                                @if ($errors->has('slug'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('slug') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label for=""> Company Email  <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" id="" placeholder=""
                                                       name="email" value="{{  $company->email }}" required>
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="col-sm-6">
                                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                                <label for=""> Company Phone  <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="" placeholder=""
                                                       name="phone" value="{{ $company->phone }}" required>
                                                @if ($errors->has('phone'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
                                                <label for=""> Company Website</label>
                                                <input type="text" class="form-control" id="" placeholder=""
                                                       name="website" value="{{ $company->website }}" required>
                                                <small>e.g. https://site_name.com</small>
                                                @if ($errors->has('website'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('website') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                                <label for=""> Company Address  <span class="text-danger">*</span></label>
                                                <textarea name="address" class="form-control" id="" cols="30" rows="10"
                                                          required>{{ $company->address }}</textarea>
                                                @if ($errors->has('address'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
                                                <label for="">About Company  <span class="text-danger">*</span></label>
                                                <textarea name="about" class="form-control" id="" cols="30"
                                                          rows="10" required>{{ $company->about }}</textarea>
                                                @if ($errors->has('about'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('about') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">

                                        <div class="col-sm-4 col-sm-offset-8">
                                            <button type="submit" class="btn btn-success btn-block">Update  Company</button>
                                        </div>


                                    </div>
                                    </form>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
@endsection
