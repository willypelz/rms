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


                                  <div class="message-content ">
                                    
                                    @if( count( $messages ) )
                                      @foreach( $messages as $message )
                                        @if( is_null($message->user_id ) )
                                          @php 
                                            $media_position = "right"; 
                                            $title = Auth::guard('candidate')->user()->first_name . " " . Auth::guard('candidate')->user()->last_name; 
                                            $user = Auth::guard('candidate')->user();  
                                          @endphp
                                        @else
                                          @php 
                                            $media_position = "left"; 
                                            $title = "Admin";
                                            $user = ['first_name' => 'A', 'last_name' => 'D'];
                                          @endphp
                                        @endif
                                        <div class="media"> 

                                          <div class="media-left pull-{{ $media_position }}"> <a href="#">
                                          <img src="{{ default_picture($user, 'cv') }}" class="media-object" width="64px" height="64px">   </a> </div> 
                                          <div class="media-body"> 

                                          <h4 class="media-heading text-{{ $media_position }}">{{ $title }}</h4> 
                                          <p class="text-{{ $media_position }}">{{ $message->message }}</p>
                                          @if( $message->attachment != "" )
                                            <a class="pull-{{ $media_position }}" href="{{ asset('uploads/'.$message->attachment) }}" target="_blank" > <i class="fa fa-paperclip"></i> Download Attachment</a>
                                          @endif
                                          <div class="clearfix"></div>
                                          <div>
                                            <small class="date pull-{{ $media_position }}">{{ date('D. j M, Y', strtotime( $message->created_at)) }}</small>
                                          </div>
                                          
                                          </div> 
                                        </div>
                                        <br>

                                      @endforeach
                                    @endif
                                    
                                    <form class="form-horizontal" role="form" method="post" action="{{ route('candidate-send-message') }}" enctype='multipart/form-data'>
                                      <div class="form-group">

                                        <div class="col-xs-12">
                                          <input type="hidden" name="application_id" value="{{ $application_id }}">
                                          <textarea class="form-control short" id="message" name="message" rows="3" required></textarea>
                                        </div>
                                        <div class="col-xs-12"><br>
                                          <small>Attachement (Optional)</small>
                                          <input type="file" name="attachment" name="attachment">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="col-xs-12">
                                          <button type="submit" class="btn btn-success">Reply</button>
                                        </div>
                                      </div>
                                    </form>
                                    
                                    
                                    
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
