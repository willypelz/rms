@extends('layout.template-default')

@section('content')


    <section class="white" style="">
        <div class="container">
            <div class="row">

                <div class="col-sm-5 col-sm-offset-1">
                <h2> Access Denied</h2><hr>
                   <p class="lead text-muted">Sorry, you do not have authorised access/permission to view this page.</p>
                    
                </div>
                <div class="col-sm-5">
                    <img src="{{ url('/') }}/img/denied.png" width="65%" class="pull-right" alt="Access Denied">
                </div>
            </div>
        </div>
    </section>


@endsection