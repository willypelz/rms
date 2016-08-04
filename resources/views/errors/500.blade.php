@extends('layout.template-default')

@section('content')


    <section class="white" style="">
        <div class="container">
            <div class="row">

                <div class="col-sm-5 col-sm-offset-1">
                <h2> Whoops! Something went wrong ...</h2><hr>
                   <p class="lead text-muted">Looks like something went wrong. Take this <!-- <a href=""> action <i class="fa fa-refresh"></i> </a> -->. Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                   consequat. </p>
                    
                </div>
                <div class="col-sm-5">
                    <img src="{{ url('/') }}/img/whoops.png" width="65%" class="pull-right" alt="">
                </div>
            </div>
        </div>
    </section>


@endsection