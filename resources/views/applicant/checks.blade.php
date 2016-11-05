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
                            <h5> <span class="text-brandon">Background Check</span>
                            <a  data-toggle="modal" data-target="#viewModal" id="modalButton" href="#viewModal" data-title="Background Check" data-view="{{ route('modal-background-check') }}" data-app-id="{{ $appl->id }}" data-cv="{{ $appl->cv->id }}" data-type="wide" class="btn btn-sm btn-line pull-right"><i class="fa fa-plus"></i>Request Background Check</a>
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
                                <h3 class="panel-title">Requested Background Check(s)</h3>
                            </div>
                            @else
                                <div class="alert alert-warning">No Background checks has been requested for {{ $appl->cv->first_name }}. <a data-toggle="modal" data-target="#viewModal" id="modalButton" href="#viewModal" data-title="Background Check" data-view="{{ route('modal-background-check') }}" data-app-id="{{ $appl->id }}" data-cv="{{ $appl->cv->id }}" data-type="wide"> <i class="fa fa-plus"></i> Request Now</a></div>
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
                                                 Requested: {{ human_time($req->created, 1) }}
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <p>
                                            @if($req->status == 'COMPLETED')    
                                                <button class="btn btn-sm btn-success">
                                                    View Result
                                                </button>
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

  <!-- Background Check Modal -->
  <div class="modal widemodal fade" id="CheckModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin: 18px;">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Background Check</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-xs-7 scroll-450">
                    <div class="">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Past Employment Check</h3>
                            </div>
                            <div class="panel-body">

                                <div class="row">
                                    <div class="media small">
                                        <div class="col-xs-9">
                                            <div class="media-left pull-left" style="padding-right: 20px;">
                                                <a href="#">
                                                    <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNGU5MGRiMmU5YSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE0ZTkwZGIyZTlhIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxNC41IiB5PSIzNi41Ij42NHg2NDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="width: 64px; height: 64px;">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="media-heading">Media heading</h5>
                                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. <a href="#">...more</a>
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <p>&#8358;2000</p>
                                            <button class="btn btn-sm btn-success">
                                                Request
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Criminal Check</h3>
                            </div>
                            <div class="panel-body">

                                <div class="row">
                                    <div class="media small">
                                    <div class="col-xs-9">
                                        <div class="media-left pull-left" style="padding-right: 20px;">
                                            <a href="#">
                                                <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNGU5MGRiMmU5YSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE0ZTkwZGIyZTlhIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxNC41IiB5PSIzNi41Ij42NHg2NDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="width: 64px; height: 64px;">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <h5 class="media-heading">Media heading</h5>
                                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. <a href="#">...more</a>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <p>&#8358;2000</p>
                                        <button class="btn btn-sm btn-success">
                                            Request
                                        </button>
                                    </div>
                                </div>
                                    <div class="media small">
                                        <div class="col-xs-9">
                                            <div class="media-left pull-left" style="padding-right: 20px;">
                                                <a href="#">
                                                    <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNGU5MGRiMmU5YSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE0ZTkwZGIyZTlhIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxNC41IiB5PSIzNi41Ij42NHg2NDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="width: 64px; height: 64px;">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="media-heading">Media heading</h5>
                                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. <a href="#">...more</a>
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <p>&#8358;2000</p>
                                            <button class="btn btn-sm btn-success">
                                                Request
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Past Employment Check</h3>
                            </div>
                            <div class="panel-body">

                                <div class="row">
                                    <div class="media small">
                                        <div class="col-xs-9">
                                            <div class="media-left pull-left" style="padding-right: 20px;">
                                                <a href="#">
                                                    <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNGU5MGRiMmU5YSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE0ZTkwZGIyZTlhIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxNC41IiB5PSIzNi41Ij42NHg2NDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="width: 64px; height: 64px;">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="media-heading">Media heading</h5>
                                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. <a href="#">...more</a>
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <p>&#8358;2000</p>
                                            <button class="btn btn-sm btn-success">
                                                Request
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Criminal Check</h3>
                            </div>
                            <div class="panel-body">

                                <div class="row">
                                    <div class="media small">
                                        <div class="col-xs-9">
                                            <div class="media-left pull-left" style="padding-right: 20px;">
                                                <a href="#">
                                                    <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNGU5MGRiMmU5YSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE0ZTkwZGIyZTlhIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxNC41IiB5PSIzNi41Ij42NHg2NDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="width: 64px; height: 64px;">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="media-heading">Media heading</h5>
                                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. <a href="#">...more</a>
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <p>&#8358;2000</p>
                                            <button class="btn btn-sm btn-success">
                                                Request
                                            </button>
                                        </div>
                                    </div>

                                    <div class="media small">
                                        <div class="col-xs-9">
                                            <div class="media-left pull-left" style="padding-right: 20px;">
                                                <a href="#">
                                                    <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNGU5MGRiMmU5YSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE0ZTkwZGIyZTlhIj48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxNC41IiB5PSIzNi41Ij42NHg2NDwvdGV4dD48L2c+PC9nPjwvc3ZnPg==" data-holder-rendered="true" style="width: 64px; height: 64px;">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h5 class="media-heading">Media heading</h5>
                                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. <a href="#">...more</a>
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <p>&#8358;2000</p>
                                            <button class="btn btn-sm btn-success">
                                                Request
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-5">
                    <h5>Selected Applicant</h5>
                   <div class="scroll-150">
                    <div class="alert alert-info alert-dismissible c-alert" role="alert">
                        <!-- <button type="button" style="font-size:1em" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                        <div class="row">
                            <div class="col-xs-4">
                                <img src="img/avatar.jpg" class="thumbnail no-margin img-responsive" width="145px">
                            </div>
                            <div class="col-xs-8">
                                <p>
                                    <a>Name of Applicant</a><br>
                                    <small>What applicant does</small>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    </div>

                    <!--<a class="btn btn-xs pull-right">-->
                        <!--<i class="fa fa-plus fa-lg"></i> Add Applicant-->
                    <!--</a>-->
                    <div class="clearfix"></div>
                    <hr>
                    <div>
                        <h5>Your Cart</h5>
                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <th>Your Selection</th>
                                <th>Cost (&#8358;)</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Mark</td>
                                <td>4500</td>
                                <td class="text-right">
                                    <a href="">
                                        <i class="fa fa-times-circle text-danger"></i> </a>
                                </td>
                            </tr>
                            <tr>

                                <td>Jacob</td>
                                <td>2500</td>
                                <td class="text-right">
                                <a href="">
                                    <i class="fa fa-times-circle text-danger"></i> </a>
                                </td>

                            </tr>
                            <thead>
                            <tr>
                                <th>Total</th>
                                <th>10 000</th>
                                <th> &nbsp; </th>
                            </tr>
                            </thead>
                            </tbody>
                        </table>
                        <a class="btn btn-danger pull-right">Proceed to Checkout &nbsp;<i class="fa fa-external-link"></i></a>
                        <!--<a class="btn btn-sm pull-left btn-line">Clear Selection &nbsp;<i class="fa fa-refresh"></i></a>-->
                        <div class="clearfix"></div>
                        <hr>
                    </div>

                    <form>
                        <h5>Test Details</h5>
                        <div class="form-group">
                            <!--<label>Location</label>-->
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input type="text" class="form-control" id="" aria-describedby="" placeholder="Location">
                            </div>
                            <!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
                            <!--<span id="inputGroupSuccess1Status" class="sr-only">(success)</span>-->
                        </div>
                        <div class="form-group">
                            <!--<label>Location</label>-->
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control" id="" aria-describedby="" placeholder="Open Date">
                            </div>
                        </div>
                        <div class="form-group">
                            <!--<label>Location</label>-->
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control" id="" aria-describedby="" placeholder="Close Date">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-success pull-right" value="Request Test">
                        <div class="clearfix"></div>
                    </form>
                    <!--<hr>-->
                    <!--<a class="btn btn-primary btn-block">Check for another Applicant</a>-->

                </div>
            </div>
        </div>
      </div>
    </div>
  </div>

@endsection