@extends('layout.template-default')

@section('content')


<section class="s-div homepage" style="background: #10588a fixed bottom url(img/home-bg2.jpg);">
        <div class="container">
            <div class="row text-center text-light text-white"><br>
                <h1> Solr Nudge</h1>
                <h1 class="lead">Nudge Solr Manually.</h1>
            </div>
        </div>
</section>

 <section class="white">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">

                    <div class="">
                        <br>
                        <div class="pagehead">
                        <form method="post" action="{{route('test-solr-create')}}">
                            @csrf
                            @include('layout.alerts')
                            
                            <div class="col-xs-6 col-xs-offset-3 contact">
                                  @if(Session::has('flash_message'))
                            <div class="alert alert-success">
                              {{Session::get('flash_message')}}<br>
                            </div>
                            @endif
                                <br>
                                <input type="submit" value="Run Solr Update" class="btn btn-primary">
                            </div>
                            </span>
                            </form>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>

@endsection