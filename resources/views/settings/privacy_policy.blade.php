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

                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
