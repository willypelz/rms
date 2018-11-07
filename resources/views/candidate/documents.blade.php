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
                        
                        <!-- Sidebar -->

                        <div class="col-md-3">
                            @include('candidate.includes.sidebar')
                        </div>


                        <!-- Main body -->
                        <div class="col-md-9">



                            @include('candidate.includes.header')

                            <div class="row">
                              <div class="col-sm-12">
                                <div class="page no-bod-rad">
                                  <br>

                                  <div class="message-content">

                                    {{-- Get application cv --}}

                                    <div class="media">

                                      <h3 class="text-left">{{ ucwords( implode( '_', array_slice( explode('_', $current_application->cv->cv_file) , 1) ) ) }}</h3>
                                      @if( $current_application->cv->cv_file != "" )
                                        <a class="pull-left" href="{{ asset('uploads/CVs/'.$current_application->cv->cv_file) }}" target="_blank" > <i class="fa fa-paperclip"></i> Download Attachment</a>
                                      @endif
                                      <div class="clearfix"></div>
                                      <div>
                                        <small class="date pull-left">{{ date('D. j M, Y', strtotime( $current_application->cv->created_at)) }}</small>
                                      </div>
                                      
                                    </div>
                                    <br>

                                    @if( count( $documents ) )
                                      @foreach( $documents as $document )
                                       
                                        <div class="media">

                                          <h3 class="text-left">{{ ucwords( implode( '-', array_slice( explode('-', $document->attachment) , 2) ) ) }}</h3>
                                          @if( $document->attachment != "" )
                                            <a class="pull-left" href="{{ asset('uploads/'.$document->attachment) }}" target="_blank" > <i class="fa fa-paperclip"></i> Download Attachment</a>
                                          @endif
                                          <div class="clearfix"></div>
                                          <div>
                                            <small class="date pull-left">{{ date('D. j M, Y', strtotime( $document->created_at)) }}</small>
                                          </div>
                                          
                                        </div>
                                        <br>

                                      @endforeach
                                    @endif
                                    
                                    
                                    
                                    
                                  </div>
                                  <div class="clearfix"></div>
                                </div>
                              </div>
                            </div>



                            <!--/footer-->
                            <div class="page page-sm foot no-bod-rad">
                                <div class="col-sm-6 col-sm-offset-3 text-center"><!-- <hr> -->
                                <p><img src="http://seamlesshiring.com/img/seamlesshiring-logo.png" alt="" width="200px"> </p>
                                <p><small class="text-muted"> &nbsp;
                                    &copy; {{ date('Y') }}. Powered by <a href="http://www.seamlesshiring.com"> SeamlessHiring</a></small></p>
                                </div>
                                <div class="clearfix"></div>
                            </div>


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


<div class="separator separator-small"><br></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>

@endsection



