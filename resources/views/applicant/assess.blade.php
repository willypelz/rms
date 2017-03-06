@extends('layout.template-user')

@section('content')
    
    @include('applicant.includes.job-title-bar')
    
    <section class="no-pad applicant">
        <div class="container">
        
        @include('applicant.includes.pagination')

            <div class="row">
            <div class="col-xs-4">
                @include('applicant.includes.badge')
            </div>

                <div class="col-xs-8">
                    
                    @include('applicant.includes.nav')

                    <div class="tab-content" id="">

                        <div class="row">
                          <div class="col-xs-12">
                            <h5> <span class="text-brandon">Assesment</span>
                            <a  data-toggle="modal" data-target="#viewModal" id="modalButton" href="#viewModal" data-title="Test" data-view="{{ route('modal-assess') }}" data-app-id="{{ $appl->id }}" data-cv="{{ $appl->cv->id }}" data-type="wide" class="btn btn-sm btn-line pull-right"><i class="fa fa-plus"></i>Request Assessment</a>
                              <!-- <a href="background-check" class="btn btn-line">Medicals</a> -->
                              <div class="clearfix"></div>
                            </h5>
                            <hr>
                          </div>
                        </div>

                    <div  id="paymentSuccess" class="alert-success"></div>


                    <div class="">
                        <div class="panel panel-default">
                            @if(count($requests) > 0)
                            <div class="panel-heading">
                                <h3 class="panel-title">Requested Assesment(s)</h3>
                            </div>
                            @else
                                <div class="alert alert-warning">No Assesments has been requested for {{ $appl->cv->first_name }}. <a data-toggle="modal" data-target="#viewModal" id="modalButton" href="#viewModal" data-title="Test" data-view="{{ route('modal-assess') }}" data-app-id="{{ $appl->id }}" data-cv="{{ $appl->cv->id }}" data-type="wide">Assess Candidate</a></div>
                            @endif

                            @foreach($requests as $req)
                            
                            <div class="panel-body">

                                <div class="row">
                                    <div class="media small">
                                        <div class="col-xs-9">
                                            <div class="media-left pull-left" style="padding-right: 20px;">
                                                <a href="#">
                                                    <img class="media-object" alt="64x64" src="{{ $req->product->provider->logo }}" style="width: 64px; height: 64px;">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="media-heading">{{ $req->product->name }}</h5>
                                                {{ $req->product->summary }}    
                                                 <a href="#">...more</a><br/>
                                                 <span class="label label-info label-large" >{{ $req->status }}</span> | 
                                                 Requested: {{ human_time($req->created_at, 1) }}
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <p>
                                            @if($req->status == 'COMPLETED')    
                                                <!-- <button class="btn btn-sm btn-success">
                                                    View Result
                                                </button> -->
                                                <h3 class="text-primary text-center">SCORE</h3>
                                                <h1 class=" text-center">{{ $req->score }}</h1>
                                            @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </div>

                    </div>                       

                    </div>
                    <!--/tab-content-->

                </div>

            </div>

        @include('applicant.includes.pagination')

        </div>
    </section>

<div class="separator separator-small"></div>

 

@endsection