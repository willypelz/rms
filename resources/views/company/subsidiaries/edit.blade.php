@extends('layout.template-default')

@section('content')
    <script src="{{ asset('js/jquery.slugify.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
    <div class="separator separator-small"></div>

    <section class="no-pad">
        <div class="container">
            <div class="row">

                <div class="col-sm-12">
                    <div class="page">
                        <div class="row">
                            <h5 class="no-margin text-center l-sp-5 text-brandon text-uppercase">
                                Edit Subsidiary Company
                            </h5>
                            <hr>
                            <br>
                            <div class="col-sm-8 col-sm-offset-2">
                                <div>
                                <!-- <form role="form" class="form-signup" method="POST" action="{{ route('registration') }}" type='file'> -->
                                    {!! Form::open(array('route'=>'edit-company','method'=>'POST', 'id'=>'SignUPform', 'files'=>true, 'class'=>'form-signup', 'role'=>'form')) !!}

                                    {!! csrf_field() !!}
                                    <input type="hidden" name="subsidiary_creation_page" value="true">
                                    <input type="hidden" name="company_id" value="{{$company->id}}">

                                    <div class="row">

                                        <div class="col-sm-6 col-sm-offset-3 text-center">
                                            <div class="form-group{{ $errors->has('about_company') ? ' has-error' : '' }}">
                                                <label class="col-md-12" for="">Subsidiary Logo</label>
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput"
                                                         style="width: 200px; height: 150px;"></div>
                                                    <div>
                                                <span class="btn btn-default btn-file">
                                                    <span class="fileinput-new">Select image</span><span
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
                                                <label for="">Subsidiary Company name</label>
                                                <input type="text" class="form-control" id="name" placeholder=""
                                                       name="name" value="{{ $company->name }}" required>
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label for="">Subsidiary Company Email</label>
                                                <input type="text" class="form-control" id="" placeholder=""
                                                       name="email" value="{{  $company->email }}" readonly>
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="col-sm-6">
                                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                                <label for="">Subsidiary Company Phone</label>
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
                                                <label for="">Subsidiary Company Website</label>
                                                <input type="text" class="form-control" id="" placeholder=""
                                                       name="website" value="{{ $company->website }}" readonly>
                                                @if ($errors->has('website'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('website') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                                <label for="">Subsidiary Company Address</label>
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
                                                <label for="">About Subsidiary Company</label>
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
                                            <button type="submit" class="btn btn-primary btn-block">Update Subsidiary Company</button>
                                        </div>


                                    </div>
                                    </form>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
@endsection

