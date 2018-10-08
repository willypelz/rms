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



                            <section class="job-head no-margin">
                              <div class="">
                                <div class="row">
                                  <div class="col-sm-8 col-sm-offset-2 text-center">
                                    
                                    <h3 class="text-white no-margin">
                                      @php $current_application =  Auth::guard('candidate')->user()->applications()->where('id',$application_id)->first();   @endphp
                                    {{ $current_application->job->title }}
                                    
                                    </h3>
                                    <hr>
                                    <ul class="list-inline text-white">
                                      <li>Activities</li>
                                      {{-- <li>&middot;</li>
                                      <li>3 New</li> --}}
                                    </ul>
                                  </div>
                                  <div class="clearfix"></div>
                                  
                                </div>
                              </div>
                            </section>
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="page no-bod-rad">
                                  <br>
                                  <ul class="list-group list-notify ">
                                    @foreach( $activities as $activity )
                                      @if( !in_array($activity->activity_type, $ignore_list) )
                                        <li role="candidate-application" class="list-group-item">
                                          
                                          <span class="fa-stack fa-lg i-notify">
                                            <i class="fa fa-circle fa-stack-2x text-warning"></i>
                                            <i class="fa fa-hourglass-half fa-stack-1x fa-inverse"></i>
                                          </span>
                                          
                                          
                                            @if($activity->activity_type == 'APPLIED')
                                              <h4 class="no-margin text-info">You applied for {{ $current_application->job->title }} at {{ $current_application->job->company->name }} </h4>
                                            @else
                                              <h4 class="no-margin text-info">{{ $current_application->job->company->name }} moved your application to {{ str_replace('-', ' ', $activity->activity_type ) }}</h4>

                                            @endif

                                            <p>
                                              <small class="text-muted pull-right">[{{ date('D. j M, Y', strtotime( $activity->created_at)) }}]</small>
                                              <b>Responed</b>: {{ date('D. j M, Y', strtotime( $activity->created_at)) }}
                                            </p>
                                            
                                          
                                          
                                        </li>
                                      @endif
                                    @endforeach
                                    
                                  </ul>
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



