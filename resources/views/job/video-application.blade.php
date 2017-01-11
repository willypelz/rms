@extends('layout.template-default')

@section('navbar')    

@show()

@section('footer')
@show()


@section('content')
    <link href="{{ asset('css/select2.css') }}" rel="stylesheet">

    <style type="text/css">
        .video-option{ margin-bottom: 20px; }
        .video-option input[type='radio'], .video-option input[type='checkbox']{ margin-left: 10px; }
            
    </style>

    <section class="no-pad">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 col-sm-12">
                    <div class="">
                        <section class="job-head blue no-margin">
                        <div class="">
                            <div class="row">
                            
                                <div class="col-sm-8 col-sm-offset-2 text-center">
                                    <small class="text-brandon l-sp-5 text-uppercase">job title</small>
                            
                                    <h2 class="job-title">
                                        {{ ucfirst( $job['title'] ) }}
                                    </h2>
                                    <hr>
                                    <ul class="list-inline text-white">
                                        <!--<li><strong>Company:</strong>&nbsp; JobAcess</li>-->
                                        <li>
                                            <strong>&nbsp;Posted:</strong>&nbsp; {{ date('D. j M, Y', strtotime($job['created_at'])) }}</li>
                                        <li>
                                            <strong>&nbsp;Expires:</strong>&nbsp; <?php echo date('d, M Y', strtotime($job['expiry_date'])) ?></li>
                                    </ul>
                            
                                    <!-- <div class="badge badge-job badge-job-active">
                                        <small class="">
                                            <span class="glyphicon glyphicon-ok"></span>
                                            &nbsp; Job is active
                                        </small>
                                    </div> -->
                                </div>
                                <div class="clearfix"></div>
                                
                            
                            
                                </div>
                        </div>
                                
                            </section>
                        <div class="row">
                        
                            <div class="col-sm-12">
                                 <div class="page no-bod-rad" style="border-radius: 0 0 0 0">
                                    <div class="row">
                                    <div class=" job-cta">
                                    <div class="col-sm-12">
                                        <h3>Video Application</h3>
                                    </div>
                                        
                                        <div class="clearfix"></div>
                                    </div>

                                        <div class="tab-content">
                                            
                                    <div class="row">
                                        
                                        <div class="col-sm-8">
                                            @if( strtotime($job['expiry_date']) <= strtotime( date('m/d/Y h:i:s a', time()) ) )
                                                <p class="text-center">This application is closed.</p>
                                            @else
                                            <!-- <p class="text-center">Please fill in the information below carefully.</p> -->

                                            <div class="video-content">
                                                <script src="{{ asset('js/mediaelement-and-player.min.js') }}"></script>
                                                <link rel="stylesheet" href="{{ asset('css/mediaelementplayer.css') }}" />

                                                <video controls style="width:100%; height:100%;">
                                                    <!-- MP4 for Safari, IE9, iPhone, iPad, Android, and Windows Phone 7 -->
                                                    <source type="video/mp4" src="{{ asset('uploads/videos/video.mp4') }}" />
                                                    <!-- WebM/VP8 for Firefox4, Opera, and Chrome -->
                                                    <source type="video/webm" src="{{ asset('uploads/videos/video.webm') }}" />
                                                    <!-- Ogg/Vorbis for older Firefox and Opera versions -->
                                                    <source type="video/ogg" src="{{ asset('uploads/videos/video.ogv') }}" />
                                                    <!-- Optional: Add subtitles for each language -->
                                                    <track kind="subtitles" src="subtitles.srt" srclang="en" />
                                                    <!-- Optional: Add chapters -->
                                                    <track kind="chapters" src="chapters.srt" srclang="en" /> 
                                                    <!-- Flash fallback for non-HTML5 browsers without JavaScript -->
                                                    <object width="320" height="240" type="application/x-shockwave-flash" data="flashmediaelement.swf">
                                                        <param name="movie" value="flashmediaelement.swf" />
                                                        <param name="flashvars" value="controls=true&file=myvideo.mp4" />
                                                        <!-- Image as a last resort -->
                                                        <img src="myvideo.jpg" width="320" height="240" title="No video playback capabilities" />
                                                    </object>
                                                </video>

                                                <script type="text/javascript">
                                                    $('video').mediaelementplayer({
                                                        features: ['playpause','progress','current','duration','tracks','volume','fullscreen'],
                                                        /*// if the <video width> is not specified, this is the default
                                                        defaultVideoWidth: 480,
                                                        // if the <video height> is not specified, this is the default
                                                        defaultVideoHeight: 270,
                                                        // if set, overrides <video width>
                                                        videoWidth: -1,
                                                        // if set, overrides <video height>
                                                        videoHeight: -1,
                                                        // width of audio player
                                                        audioWidth: 400,
                                                        // height of audio player
                                                        audioHeight: 30,
                                                        // initial volume when the player starts
                                                        startVolume: 0.8,
                                                        // useful for <audio> player loops
                                                        loop: false,
                                                        // enables Flash and Silverlight to resize to content size
                                                        enableAutosize: true,
                                                        // the order of controls you want on the control bar (and other plugins below)
                                                        features: ['playpause','progress','current','duration','tracks','volume','fullscreen'],
                                                        // Hide controls when playing and mouse is not over the video
                                                        alwaysShowControls: false,
                                                        // force iPad's native controls
                                                        iPadUseNativeControls: false,
                                                        // force iPhone's native controls
                                                        iPhoneUseNativeControls: false, 
                                                        // force Android's native controls
                                                        AndroidUseNativeControls: false,
                                                        // forces the hour marker (##:00:00)
                                                        alwaysShowHours: false,
                                                        // show framecount in timecode (##:00:00:00)
                                                        showTimecodeFrameCount: false,
                                                        // used when showTimecodeFrameCount is set to true
                                                        framesPerSecond: 25,
                                                        // turns keyboard support on and off for this instance
                                                        enableKeyboard: true,
                                                        // when this player starts, it will pause other players
                                                        pauseOtherPlayers: true,
                                                        // array of keyboard commands
                                                        keyActions: []*/
                                                     
                                                    });
                                                </script>

                                                <div class="row">
                                                    <div class="col-xs-12"><hr></div>

                                                    
                                                    <div class="col-xs-12">
                                                        <small>Some description for this if available</small>
                                                    </div> 
                                                        <div class="col-xs-4">
                                                            <!--a href="job.php" target="_blank" type="submit" class="btn btn-line"><i class="fa fa-save"></i> Save as draft</a-->
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <!--a href="job.php" target="_blank" type="submit" class="btn pull-right">Preview Job</a-->
                                                        </div>

                                                        <div class="col-sm-4"> 
                                                            <button type="submit" class="btn btn-success btn-block" onclick="$(this).closest('.video-content').remove(); $('.video-form').fadeIn(); ">Next &raquo;</button>
                                                        </div>
                                                        <div class="separator separator-small"></div>
                                                </div>

                                            </div>

                                            <div class="video-form" style="display:none;">
                                                <form  method="post">
                                                    <div class="row " >
                                                        <div class="col-xs-12">
                                                                <small>May this part needs descriptions?</small>
                                                         </div> <br><br>
                                                        @if( count($video_options) > 0 )
                                                            {{-- */$index=0;/* --}}
                                                            @foreach( $video_options as $video_option )
                                                                
                                                                <div class="col-sm-12 video-option">
                                                                    <label for="video-option">{{ $video_option->name }} <span class="text-danger">*</span></label><br>

                                                                    <?php $options = explode(',', $video_option->options) ?>

                                                                    @if( $video_option->type == 'DROPDOWN')
                                                                        <?php 
                                                                            $select_options = [];
                                                                            foreach ($options as $option) {
                                                                                $select_options[$option] = str_replace( '_', ' ',  ucfirst( $option ) ) ;
                                                                            }
                                                                         ?>
                                                                        {{ Form::select('vo_'.str_slug($video_option->name,'_'), $select_options, null, array('class'=>'form-control', 'required' => 'required')) }}
                                                                    
                                                                    @elseif( $video_option->type == 'RADIO' )
                                                                        @foreach( $options as $option )
                                                                            {{ Form::radio('vo_'.str_slug($video_option->name,'_'), $option,false, array('required' => 'required')) }} {{ $option }}
                                                                        @endforeach
                                                                        
                                                                    @elseif( $video_option->type == 'CHECKBOX' )

                                                                        @foreach( $options as $option )
                                                                            {{ Form::checkbox('vo_'.str_slug($video_option->name,'_').'[]', $option,false, array( 'required' => 'required')) }} {{ $option }}
                                                                        @endforeach
                                                                    
                                                                    @elseif( $video_option->type == 'TEXT' )
                                                                        {{ Form::text('vo_'.str_slug($video_option->name,'_'), null, array('class'=>'form-control', 'required' => 'required')) }}
                                                                    
                                                                    @elseif( $video_option->type == 'TEXTAREA' )
                                                                        {{ Form::textarea('vo_'.str_slug($video_option->name,'_'), null, array('class'=>'form-control', 'required' => 'required')) }}
                                                                    
                                                                    @elseif( $video_option->type == 'MULTIPLE_OPTION' )
                                                                        <?php 
                                                                            $select_options = [];
                                                                            foreach ($options as $option) {
                                                                                $select_options[$option] = str_replace( '_', ' ',  ucfirst( $option ) ) ;
                                                                            }
                                                                         ?>
                                                                        {{ Form::select('vo_'.str_slug($video_option->name,'_').'[]', $select_options, array('multiple'=>'multiple','class'=>'form-control', 'required' => 'required')) }}

                                                                    @elseif( $video_option->type == 'FILE' )
                                                                        <?php 
                                                                            $select_options = [];
                                                                            foreach ($options as $option) {
                                                                                $select_options[$option] = str_replace( '_', ' ',  ucfirst( $option ) ) ;
                                                                            }
                                                                         ?>
                                                                         {{ Form::file('vo_'.str_slug($video_option->name,'_'),array('class'=>'form-control', 'required' => 'required')) }}

                                                                    @endif



                                                                </div> 

                                                                @if( $index % 2  )
                                                                    <div class="clearfix"></div>
                                                                @endif
                                                                {{-- */$index++;/* --}}
                                                            @endforeach
                                                        @endif
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-xs-12"><hr></div>

                                                            <div class="col-xs-4">
                                                                <!--a href="job.php" target="_blank" type="submit" class="btn btn-line"><i class="fa fa-save"></i> Save as draft</a-->
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <!--a href="job.php" target="_blank" type="submit" class="btn pull-right">Preview Job</a-->
                                                            </div>

                                                            <div class="col-sm-4"> 
                                                                <button type="submit" class="btn btn-success btn-block">Submit &raquo;</button>
                                                            </div>
                                                            <div class="separator separator-small"></div>
                                                    </div>

                                                </form>
                                            </div> 
        
                                            @endif   
                                        </div>
                                                
                                        <div class="col-sm-4">
                                            <h6 class="text-brandon text-uppercase l-sp-5 no-margin">company details</h6><br>
                                            <p class="text-muted">{{ $company->name }}</p>

                                            <p><img src="{{ $company->logo }}" alt="" width="60%"></p><br>
                                            <p class="small">{{ $company->about }}</p>
                                            <p><i class="fa fa-map-marker"></i> {{ $company->address }}</p>
                                            <!--p>
                                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4448.570052456479!2d3.3791209324273184!3d6.618898622434336!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b93a899b7c9b7%3A0x8630de71dbc44ffd!2sMagodo+GRA+Phase+II%2C+Lagos!5e0!3m2!1sen!2sng!4v1457754339276" frameborder="0" width="100%" height="200px" allowfullscreen></iframe>
                                            </p-->
                                            <p>
                                                <i class="fa fa-envelope"></i> {{ $company->email }}  <br>
                                                <i class="fa fa-globe"></i> {{ $company->website }}
                                            </p>
                                        </div>
                                        <div class="col-sm-6 col-sm-offset-3 text-center hidden"><!-- <hr> -->
                                            <p >Powered by <a href="http://www.seamlesshiring.com"><i class="fa fa-skype"></i> SeamlessHiring</a> <br>
                                            <small class="text-muted">&copy; {{ date('Y') }}. SeamlessHiring</small></p>
                                        </div>
                                        <div class="clearfix"></div>

                                    </div>

                                    <!--<div class="panel panel-default">-->
                                    <!--<div class="panel-heading">-->
                                    <!--<h4 class="panel-title">Friends who work <p>Medical Doctor, Valuepreneur, Doer... </p></h4>-->
                                    <!--</div>-->
                                    <!--<div class="panel-collapse skill">-->
                                    <!--<div class="panel-body">-->
                                    <!--<a href="#" class="btn btn-info" role="button">CSS</a> <a href="#" class="btn btn-info" role="button">HTML</a> <a href="#" class="btn btn-info" role="button">jQuery</a>-->
                                    <!--</div>-->
                                    <!--</div>-->
                                    <!--</div>-->

                                </div>
                                    </div>

                            </div>

                           
                                <!--/tab-content-->
                                <div class="page page-sm foot no-bod-rad">
                                    <div class="col-sm-6 col-sm-offset-3 text-center"><!-- <hr> -->
                                        <p><img src="{{ url('/') }}/img/logomark2.png" alt="" width="150px"> </p> 
                                        <p><small class="text-muted">Powered by <a href="http://www.seamlesshiring.com"> SeamlessHiring</a> &nbsp;
                                        &copy; 2016. SeamlessHiring</small></p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                        
                            </div>
                            <div class="clearfix"></div>
                            <div class="separator separator-small hidden">
                                <br>
                                    <div class="col-sm-3 col-sm-offset-3">
                                        <a class="btn btn-line btn-block" href="create-job.php">Edit this Job</a>
                                    </div>
                                    <div class="col-sm-3">
                                        <a class="btn btn-danger btn-block" href="create-job.php">Unpublish this Job</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
     <script type="text/javascript">
                                $(document).ready(function() {
                                    $('#datepicker2').datepicker({
                                           dateFormat: "yy-mm-dd",
                                        autoclose: true,
                                        changeMonth: true,
            changeYear: true,
            yearRange: '-100:+0'

                                    });
        $('.select2').select2();

                                });
                            </script>


<div class="separator separator-small"><br></div>
@endsection