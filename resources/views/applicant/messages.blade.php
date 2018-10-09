@extends('layout.template-user')
@section('content')
@include('applicant.includes.job-title-bar')
<section class="applicant no-pad">
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
            <div class="col-xs-12 text-danger text-brandon text-light">
              <h4><i class="fa fa-envelope"></i> &nbsp; Messages</h4>
            </div>
          </div>
          <div class="row">
            <div class="message-content">
              
              <div class="msg-box">
                <div class="date">{{ date('M d, Y') }}</div>
                <div class="">
                  <h5>{{ $appl->cv->first_name.' '.$appl->cv->last_name }} <em>{{ ( $appl->cv->tagline != "" ) ? ($appl->cv->tagline) : '' }}</em></h5>
                  <p>{{ $appl->cover_note }}</p>
                </div>
              </div>

              @if( count( $messages ) )
                @foreach( $messages as $message )
                  @if( is_null($message->user_id ) )
                    @php 
                      $media_position = "left"; 
                      $title = $appl->cv->first_name . " " . $appl->cv->last_name; 
                      $user = $appl->cv;  
                    @endphp
                  @else
                    @php 
                      $media_position = "right"; 
                      $title = "Admin";
                      $user = ['first_name' => 'A', 'last_name' => 'D'];
                    @endphp
                  @endif
                  <div class="media"> 

                    <div class="media-left pull-{{ $media_position }}"> <a href="#">
                    <img src="{{ default_picture($user, 'cv') }}" class="media-object" width="64px" height="64px">  </a> </div> 
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
              
              <form class="form-horizontal" role="form" method="post" action="{{ route('admin-send-message') }}" enctype='multipart/form-data'>
                <div class="form-group">

                  <div class="col-xs-12">
                    <input type="hidden" name="application_id" value="{{ $appl->id }}">
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