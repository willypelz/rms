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
                <h2> Access Denied</h2><hr>
                   <p class="lead text-muted">Sorry, you do not have authorised access to view this page.</p>
                    
                </div>
                <div class="col-sm-5">
                    <img src="{{ url('/') }}/img/denied.png" width="65%" class="pull-right" alt="">
                </div>
            </div>
        </div>
    </section>


@endsection