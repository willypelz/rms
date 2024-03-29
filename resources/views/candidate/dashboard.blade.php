@extends('layout.template-guest')
<link rel="stylesheet" type="text/css" href="{{ asset('font/flaticon.css') }}">
@section('navbar')

@show()
@section('footer')
@show()
@section('content')
    <section class="no-pad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <div class="separator separator-small"></div>
                    
                    @include('layout.alerts')
                    <!-- Sidebar -->
                    
                    <div class="col-md-3">
                        @include('candidate.includes.sidebar')
                    </div>
                    
                    <!-- Main body -->
                    <div class="col-md-9">
                        
                        <div class="tab-content no-pad">
                            {{-- <div role="tabpanel" class="sec-body tab-pane fade" id="sec-job-list">
                                @include('candidate.job-list')
                            </div>
                            
                            <div class="clearfix"></div> --}}
                            
                            <div role="tabpanel" class="sec-body tab-pane active" id="sec-track-progress">
                                @include('candidate.track-progress')
                            </div>
                            
                            <div class="clearfix"></div>
                            
                            {{-- <div role="tabpanel" class="sec-body tab-pane fade" id="sec-notifications">
                                @include('candidate.notification')
                            </div>
                            
                            <div class="clearfix"></div> --}}
                            
                            {{-- <div role="tabpanel" class="sec-body tab-pane fade active in" id="sec-job-details">
                                 @include('candidate.job-details')
                            </div>  --}}
                        </div>
                        
                        
                        <!--/footer-->
                        @include('candidate.includes.footer')
                    
                    
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        
        
        </div>
        <div class="clearfix"></div>
        
        </div>
        </div>
        </div>
    </section>
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <div class="separator separator-small"><br></div>


@endsection