@extends('layout.template-default')

@section('content')


    <section class="white" style="">
        <div class="container">
            <div class="row">

                <div class="col-sm-5 col-sm-offset-1">
                <h2> Sorry, the Page Cannot be found ...</h2><hr>
                   <p class="lead text-muted">The page you are looking for has either been removed or does not exist. You can go back here</p>
                    
                </div>
                <div class="col-sm-5">
                    <img src="{{ url('/') }}/img/not-found.png" width="65%" class="pull-right" alt="">
                </div>
            </div>
        </div>
    </section>


@endsection