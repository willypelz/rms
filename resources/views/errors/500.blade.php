@extends('layout.template-default')

@section('content')


    <section class="white" style="">
        <div class="container">
            <div class="row">

                <div class="col-sm-5 col-sm-offset-1">
                <h2> Whoops! Looks like something went wrong ...</h2><hr>
                   <p class="lead text-muted">Since the page you are looking for is currently unavailable, you can:
                        <ul>
                            <li><a  onclick="window.history.back()">Revisit the previous page</a></li>
                            <li><a href="{{ url('/') }}">Return to home page</a></li>
                        </ul>
                    </p>
                    
                </div>
                <div class="col-sm-5">
                    <img src="{{ url('/') }}/img/whoops.png" width="65%" class="pull-right" alt="">
                </div>
            </div>
        </div>
    </section>


@endsection