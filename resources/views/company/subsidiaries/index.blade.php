@extends('layout.template-default')

@section('content')
    <div class="separator separator-small"></div>
    <section class="no-pad">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page">
                        <div class="row">
                            <h5 class="no-margin text-center l-sp-5 text-brandon text-uppercase">
                                Company Subsidiaries
                            </h5>
                            <hr>
                            <br>
                            <div class="panel-body">

                                @include('layout.alerts')

                                @if(env('RMS_STAND_ALONE'))
                                    <a  href="{{ url('company/subsidiaries/create') }}"
                                         style="margin-bottom:15px"
                                         class="btn btn-primary pull-right"><i class="fa fa-plus-circle"></i> Subsidiaries
                                    </a>
                                @endif
                                <table class="table" id="myTable">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($subsidiaries as $key => $subsidiary)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>
                                                {{$subsidiary->name}}
                                            </td>
                                            <td>
                                                {{$subsidiary->email}}
                                            </td>
                                            <td>
                                                {{$subsidiary->phone}}
                                            </td>
                                            <td>
                                                {{($subsidiary->is_active) ? "Active" : "Inactive"}}
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button"
                                                            id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="true">
                                                        Action
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                        <li><a href="{{ url('company/subsidiaries/' . $subsidiary->id) }}"><i class="fa fa-pencil-square-o"></i> Edit Subsidiary</a></li>
                                                        <li role="separator" class="divider"></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--/tab-content-->
                </div>
            </div>
        </div>
    </section>

    <div class="modal widemodal fade" id="subsidiariesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Add Company Subsidiaries</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user-permission') }}" method="post" id="SuperAdmin">
                        {!! csrf_field() !!}
                        <input type="hidden" name="mod" value="1">
                        <div class="form-group">
                            {!! Form::open(array('route'=>'add-company','method'=>'POST', 'id'=>'SignUPform', 'files'=>true, 'class'=>'form-signup', 'role'=>'form')) !!}

                            {!! csrf_field() !!}

                            <div class="row">

                                <div class="col-sm-6 col-sm-offset-3 text-center">
                                    <div class="form-group{{ $errors->has('about_company') ? ' has-error' : '' }}">
                                        <label class="col-md-12" for="">Company Logo</label>
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
                                            <div>
                                                <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span>
                                                 <?php  echo Form::file('logo'); ?>
                                                </span>
                                                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                            </div>
                                        </div>


                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                                        <label for="">Company name</label>
                                        <input type="text" class="form-control" id="company_name" placeholder="" name="company_name" value="{{ old('company_name') }}" required>
                                        @if ($errors->has('company_name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('company_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                        <label for="">Company url</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">http://</span>
                                            <input type="text" class="form-control slug" id="" placeholder="" name="slug" value="{{ old('slug') }}" required>
{{--                                            <span class="input-group-addon">.seamlesshiring.com</span>--}}
                                        </div>
                                        @if ($errors->has('slug'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('slug') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('company_email') ? ' has-error' : '' }}">
                                        <label for="">Company Email</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="company_email" value="{{ old('company_email') }}" required>
                                        @if ($errors->has('company_email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('company_email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-sm-6">
                                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                        <label for="">Phone</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="phone" value="{{ old('phone') }}" required>
                                        @if ($errors->has('phone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
                                        <label for="">Website</label>
                                        <input type="text" class="form-control" id="" placeholder="" name="website" value="{{ old('website') }}" required>
                                        @if ($errors->has('website'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('website') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                        <label for="">Address</label>
                                        <textarea name="address" class="form-control" id="" cols="30" rows="10" required>   {{ old('address') }} </textarea>
                                        @if ($errors->has('address'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group{{ $errors->has('about_company') ? ' has-error' : '' }}">
                                        <label for="">About Company</label>
                                        <textarea name="about_company" class="form-control" id="" cols="30" rows="10" required>{{ old('about_company') }}</textarea>
                                        @if ($errors->has('about_company'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('about_company') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>



                            </div>

                            <div class="row">

                                <div class="col-sm-6 col-sm-offset-3">
                                    <button type="submit" class="btn btn-success btn-block">Add</button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
