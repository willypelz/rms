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
                            <?php $applicant_step = $appl->job->workflow->workflowSteps->where('slug',$appl->status)->first();  ?>

                            @if( @$applicant_step->type == 'assessment' )
                            <a  data-toggle="modal" data-target="#viewModal" id="modalButton" href="#viewModal" data-title="Test" data-view="{{ route('modal-assess', [
                                       'step' => $applicant_step->name,
                                       'stepSlug' => $applicant_step->slug,
                                       'stepId' => $applicant_step->id
                                       ]) }}" data-app-id="{{ $appl->id }}" data-cv="{{ $appl->cv->id }}" data-type="wide" class="btn btn-sm btn-line pull-right"><i class="fa fa-plus"></i>Request Assessment</a>
                            @endif
                              <!-- <a href="background-check" class="btn btn-line">Medicals</a> -->
                              <div class="clearfix"></div>
                            </h5>
                            <hr>
                          </div>
                        </div>

                    <div  id="paymentSuccess" class="alert-success"></div>
                    <?php // dump($requests->toArray()); ?>


                    <div class="">
                        <div class="panel panel-default">
                            @if(count($requests) > 0)
                            <div class="panel-heading">
                                <h3 class="panel-title">Requested Assesment(s)</h3>
                            </div>
                            @else
                                @if( @$applicant_step->type == 'assessment' )
                                <div class="alert alert-warning">No Assesments has been requested for {{ $appl->cv->first_name }}. <a data-toggle="modal" data-target="#viewModal" id="modalButton" href="#viewModal" data-title="Test" data-view="{{ route('modal-assess', [
                                       'step' => $applicant_step->name,
                                       'stepSlug' => $applicant_step->slug,
                                       'stepId' => $applicant_step->id
                                       ]) }}" data-app-id="{{ $appl->id }}" data-cv="{{ $appl->cv->id }}" data-type="wide">Assess Candidate</a></div>
                                @else

                                    <div class="alert alert-warning">{{ $appl->cv->first_name }} cannot be assessed in {{ $applicant_step->name }} step . </div>

                                @endif
                            @endif

                            @foreach($requests as $req)

                                
                            
                            <div class="panel-body">

                                <div class="row">
                                    <div class="media small">
                                        <div class="col-xs-9">
                                            <div class="media-left pull-left" style="padding-right: 20px;">
                                                <a href="#">
                                                   
                                                    <img class="media-object" alt="64x64" src="https://cdn.insidify.com/dist/img/logos/seamlesstesting.svg" style="width: 100px;">

                                                </a>
                                            </div>
                                             <div class="media-body">
                                                <h5 class="media-heading">{{ $req->test_name }}</h5>
                                                
                                                 <span class="label label-info label-large" >{{ $req->status }}</span> | 
                                                 Requested: {{ human_time($req->created_at, 1) }}
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <p class="text-center">
                                            @if($req->status == 'COMPLETED')    
                                                
                                                <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#viewModal" id="modalButton" href="#viewModal" data-title="Test Result" data-view="{{ route('modal-test-result') }}" data-app-id="{{ $appl->id }}" data-cv="{{ $req->test_id }}" data-type="wide">
                                                    View Result
                                                </button>
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