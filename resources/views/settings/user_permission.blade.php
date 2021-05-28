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
                                User Role and Permission Settings
                            </h5>
                            <hr>
                            <br>
                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @endif

                            <div class="col-md-12">
                                @include('layout.alerts')

                                <div class="row">
                                    @foreach($roles as $key => $role)
                                    <div class="col-md-4">
                                        <div class="well dash-well">
                                            <h5 class="text-uppercase lsp3">{{ $role->display_name }}</h5><hr/>
                                            <div class="ad-mgt-scroll">
                                                @foreach($permissions as $permission)
                                                    <label> <input id="sys-con" type="checkbox" name="permissions[]" value="{{$permission->id}}" class="system-control" {{in_array($permission->id, $role->getRolePermission($role->id)) ? "checked" : ''}} onClick="systemControl(this, '{{$key}}')"> {{$permission->name}}</label> <br/>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

{{--                                {{ $roles }}--}}
                                <form id="myForm" method="post"
                                      action="{{ route('save-privacy-policy') }}">

                                    <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">

                                    <hr>
                                    <div class="row">
                                        <div class="col-xs-12"></div>
                                        <div class="col-xs-4"></div>
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-4">
                                            <button id="p-p-btn" type="submit" class="btn btn-success btn-block">
                                                Update Settings
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
@endsection
