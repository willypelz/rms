@extends('layout.template-default')

@section('content')


  <section class="s-div homepage">
        <!-- <div class="container">

            <div class="row text-center text-brandon text-light text-white"><br>
                <h3> <i class="fa fa-frown-o fa-2x"></i><br> Whoops! Something went wrong ...</h3>
            </div>

        </div> -->
    </section>


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

    <section class="white" style="">
        <div class="container">
            <div class="row">

                <div class="col-sm-5 col-sm-offset-1">
                <h2> Access Denied</h2><hr>
                   <p class="lead text-muted">Sorry, you do not have authorised access to view this page.</p>
                    
                </div>
                <div class="col-sm-5">
                    <img src="{{ url('/') }}/img/denied.png" width="65%" class="pull-right" alt="">
                </div>
            </div>
        </div>
    </section>

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