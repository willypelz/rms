@extends('settings.base')

@section('main-content')

    <section class="no-pad">
        <div class="container">
            <div class="section_card">
                <div class="section_title">
                    <b>Page Settings</b>
                </div>
                <hr class="hr_divider">

                <div class="section_content row">
                    <div class="dash_navigation_pane col-md-4">
                        <div class="sub-menu"><a href="{{ route('page-settings') }}"><i class="fa fa-key"> </i> Company Info</a></div>
                        <div class="sub-menu"><a href="{{ route('set-privacy-policy') }}"><i class="fa fa-lock"> </i> Privacy Policy</a></div>
                    </div>
                    <div class="col-md-8">
                        <div class="content">
                            <div class="row">
                                @if ($errors->any())
                                    <ul class="alert alert-danger">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                                <div class="col-md-10 col-md-offset-1">
                                    @include('layout.alerts')
                                    {!! Form::open(array('route'=>'edit-company','method'=>'POST', 'id'=>'SignUPform', 'files'=>true, 'class'=>'form-signup', 'role'=>'form')) !!}

                                    {!! csrf_field() !!}
                                    <input type="hidden" name="company_creation_page" value="true">
                                    <input type="hidden" name="company_id" value="{{$company->id}}">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                <label for=""> Company name</label>
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
                                                <label for=""> Company Email</label>
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
                                                <label for=""> Company Phone</label>
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
                                                @if ($errors->has('website'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('website') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                                <label for=""> Company Address</label>
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
                                                <label for="">About  Company</label>
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
@endsection
