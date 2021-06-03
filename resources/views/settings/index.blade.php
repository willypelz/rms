@extends('layout.template-default')

@section('content')

    <div class="separator separator-small"></div>
    <section class="no-pad">
        <div class="container">
        <div class="section_card">
            <div class="section_title">
                Nestle PLC / <b>Page Settings</b>
            </div>
            <hr class="hr_divider">

            <div class="section_content row">
                <div class="dash_navigation_pane col-md-4">
                    <div class="sub-menu"><a href="">Company info</a></div>
                    <div><a href="">Password</a></div>
                    <div><a href="">Roles and Permissions</a></div>
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

    <style>
        .section_card {
            background: #FFFFFF;
            /* Dropdown Shadows */
            box-shadow: 0px 5px 14px rgba(19, 50, 82, 0.15);
            border-radius: 10px;
            overflow: hidden;
        }

        .section_title {
            padding: 30px 40px 15px;
        }

        .hr_divider {
            /* Blue/LT2 */
            height: 1px;
            border-width: 0;
            color: #607a96;
            background-color: #607a96;
            margin: 0px;
        }

        .dash_navigation_pane {
            /* Blue/LT3 */
            background: #F4F7FB;
            /* Blue/LT2 */
            border: 1px solid #D8E4F1;
            box-sizing: border-box;
            padding-left: 55px;
        }

        .section_content>div {
            padding-top: 30px;
            padding-bottom: 60px;
        }



        .dash_navigation_pane {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .dash_navigation_pane>div>a{
            text-decoration: none;
        }

        .dash_navigation_pane>div{
            padding: 20px 0px;
        }
        .content{
          border: 1px solid #e1e1e1;
            margin-right: 10px;
        }
        .sub-menu:hover{
            /*color: ;*/
        }
    </style>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
@endsection
