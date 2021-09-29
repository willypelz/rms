@extends('layout.template-default')

@section('content')

    <div class="separator separator-small"></div>
    @yield('main-content')

    <style>
        .section_card {
            background: #FFFFFF;
            box-shadow: 0px 5px 14px rgba(19, 50, 82, 0.15);
            border-radius: 10px;
            overflow: hidden;
        }

        .section_title {
            padding: 30px 40px 15px;
        }

        .hr_divider {
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
            height: 100%;
            position: absolute;
        }

        .section_content>div {
            position: relative;
        }



        .dash_navigation_pane {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding-bottom: 80%;
        }

        .dash_navigation_pane>div>a{
            text-decoration: none;
        }

        .dash_navigation_pane>div{
            padding: 20px 0px;
        }
        .content{
            border: 1px solid #e1e1e1;
            margin-right: 30px;
            display: flex;
            flex-direction: column;
            -webkit-box-shadow: 3px 3px 3px 3px #ccc;
            -moz-box-shadow:    3px 3px 3px 3px #ccc;
            box-shadow:         1px 2px 3px 1px #ccc;
            border-radius: 5px;
        }
    </style>
    <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
@endsection
