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
                                Configure Privacy Policy here.
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

                            <div class="col-md-8 col-md-offset-2">
                                @include('layout.alerts')
                                <form id="myForm" method="post"
                                      action="{{ route('save-privacy-policy') }}">

                                    <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12"><label for="privacy-policy-url">Privacy Policy URL
                                                    <span class="text-danger">*</span></label>
                                                <input  id="privacy_policy_url" type="url"
                                                       name="privacy_policy_url"
                                                       value=" {{old('privacy_policy_url', ($privacy_policy) ? $privacy_policy->value : '')}}"
                                                       class="form-control">
                                                <small>e.g. https://site_name.com</small>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-xs-12"></div>
                                        <div class="col-xs-4"></div>
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-4">
                                            <button id="p-p-btn" type="submit" class="btn btn-success btn-block">
                                                Update Configuration
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
