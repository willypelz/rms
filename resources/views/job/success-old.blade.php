@extends('layout.template-default')
@section('content')
    
    <style>
        .btn.btn-label.checked {
            border: 3px solid #4bb779;
            background: #e8fbf0;
        }
        
        .btn.btn-label.checked:hover {
            background: #e8fbf0;
        }
    </style>
    
    <script src="https://checkout.simplepay.ng/v2/simplepay.js"></script>
    
    <div class="separator separator-small"></div>
    <section class="no-pad">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <!-- <div class="btn-group btn-group-justified btn-progress" role="group" aria-label="...">
                      
                      <div class="btn-group" role="group">
                        <button type="button" class="btn active text-capitalize"><i class="fa fa-send"></i>
                        &nbsp; <span class="hidden-xs">Job Promotion</span></button>
                      </div>
                      <div class="btn-group" role="group">
                        <a href="addCan-job.php" type="button" class="btn btn-line text-capitalize text-muted"><i class="fa fa-plus"></i>
                          &nbsp; <span class="hidden-xs">Add candidates</span></a>
                        </div>
                      </div>
                      <div> -->
                    
                    <div class="page">
                        <div class="row">
                            <div class="col-xs-12">
                                <h2 class="text-center"><i class="fa fa-check-circle fa-2x text-success"></i></h2>
                                <p class="lead text-center"><a href="">{{ ucfirst( $job->title ) }} </a><br> This Job
                                    has been succesfully created! One more step to finish...
                                </p>
                                <hr>
                                <div class="col-xs-8 col-xs-offset-2">
                                    <h5 class="text-center">Now, below are free job boards where your job will be
                                        posted. Edit your preferences</h5><br></div>
                                
                                <div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <br>
                                    </div>
                                    <?php $index = 0; ?>
                                    @foreach($all_job_boards as $key => $board)
                                        @if( $board['type'] == 'free' )
                                            <?php
                                            // $sub_key = array_search($b['id'], array_pluck( $boards, 'id' ) );
                                            $index++;
                                            if (@$board['pivot']['url'] != null && @$board['pivot']['url'] != '') {
                                                $status = 'approved';
                                            } else {
                                                $status = 'pending';
                                            }
                                            // $status = ( in_array($b['id'], $boards) ) ? 'disabled checked' : '';
                                            // $approved = ( in_array($b['id'], $boards) ) ? 'disabled checked' : '';

                                            $offest = ($index % 2) ? 2 : 0;

                                            ?>
                                            
                                            
                                            <div class="col-xs-4 col-xs-offset-{{ $offest }}">
                                                @if(empty( $subscribed_boards_id ))
                                                    <label class="btn btn-line btn-sm btn-label btn-block checked text-capitalize text-left">
                                                        <input type="checkbox" class="" autocomplete="off"
                                                               checked="checked">
                                                        @elseif( in_array($board['id'], $subscribed_boards_id) )
                                                            <label class="btn btn-line btn-sm btn-label btn-block checked text-capitalize text-left disabled">
                                                                <input type="checkbox" class="" autocomplete="off"
                                                                       checked="checked" disabled="disabled">
                                                                
                                                                @else
                                                                    <label class="btn btn-line btn-sm btn-label btn-block checked text-capitalize text-left">
                                                                        <input type="checkbox" class=""
                                                                               autocomplete="off">
                                                                        @endif
                                                                        <span class="col-xs-6"><img
                                                                                    src="{{ $board['img'] }}"
                                                                                    width="100%" alt=""></span>
                                                                        <span class="col-xs-6"><b
                                                                                    class="name">{{ $board['name'] }}</b></span>
                                                                        <span class="clearfix"></span>
                                                                    </label>
                                            </div>
                                    
                                    @endif
                                @endforeach
                                
                                
                                
                                <!-- <div class="col-xs-4 col-xs-offset-2">
                              <div class="job-brd">
                                <label class="btn btn-line btn-sm btn-label btn-block checked text-capitalize text-left disabled">
                                  <input type="checkbox" class="" autocomplete="off" checked="" disabled="">
                                  <span class="col-xs-6"><img src="{{ asset('img/insidify-logo.png') }}" width="100%" alt=""></span>
                                  <span class="col-xs-6"><b class="name">Insidify Jobs</b><br>www.insidify.com</span>
                                  <span class="clearfix"></span>
                                </label>
                                <label class="btn btn-line btn-sm btn-label btn-block checked text-capitalize text-left">
                                  <input type="checkbox" class="" autocomplete="off" checked="">
                                  <span class="col-xs-6"><img src="https://www.britishcouncil.org.ng/profiles/solas2/themes/britishcouncil/images/desktop/logo-british-council-color.png" width="100%" alt=""></span>
                                  <span class="col-xs-6"><b class="name">Guargian Jobs</b><br>www.insidify.com</span>
                                  <span class="clearfix"></span>
                                </label>
                                <label class="btn btn-line btn-sm btn-label btn-block checked text-capitalize text-left">
                                  <input type="checkbox" class="" autocomplete="off" checked="">
                                  <span class="col-xs-6"><img src="http://www.jobberman.com/img/new/logo.png" width="100%" alt=""></span>
                                  <span class="col-xs-6"><b class="name">Punch Jobs</b><br>www.insidify.com</span>
                                  <span class="clearfix"></span>
                                </label>
                            </div>
                          </div>

                          <div class="col-xs-4">
                              <div class="job-brd">
                                <label class="btn btn-line btn-sm btn-label btn-block checked text-capitalize text-left">
                                  <input type="checkbox" class="" autocomplete="off" checked="">
                                  <span class="col-xs-6"><img src="http://www.jobimu.com/wp-content/uploads/2014/07/cropped-jobimu-logo.jpg" width="100%" alt=""></span>
                                  <span class="col-xs-6"><b class="name">Naij Jobs</b><br>www.insidify.com</span>
                                  <span class="clearfix"></span>
                                </label>
                                <label class="btn btn-line btn-sm btn-label btn-block checked text-capitalize text-left">
                                  <input type="checkbox" class="" autocomplete="off" checked="">
                                  <span class="col-xs-6"><img src="http://www.myjobmag.com/pics/logo6.png" width="100%" alt=""></span>
                                  <span class="col-xs-6"><b class="name">My Job Mag</b><br>www.insidify.com</span>
                                  <span class="clearfix"></span>
                                </label>
                                <label class="btn btn-line btn-sm btn-label btn-block checked text-capitalize text-left">
                                  <input type="checkbox" class="" autocomplete="off" checked="">
                                  <span class="col-xs-6"><img src="http://www.hotnigerianjobs.com/images/banner2.gif" width="100%" alt=""></span>
                                  <span class="col-xs-6"><b class="name">Hot Nigerian Jobs</b><br>www.insidify.com</span>
                                  <span class="clearfix"></span>
                                </label>
                            </div>
                          </div> -->
                                    
                                    <div id="paidJobBoards" class="collapse">
                                        <div class="col-xs-8 col-xs-offset-2">
                                            <hr>
                                        </div>
                                        <div class="clearfix"></div>
                                        <h4 class="text-center text-capitalize">Paid Job boards & Newspapers</h4>
                                        <p class="text-center text-muted">Kindly, make selections from below</p>
                                        <br>
                                        <div id="copyFrom">
                                            <h5 class="col-xs-4 col-xs-offset-2">Job Boards</h5>
                                            <div class="clearfix"></div>
                                            
                                            <div id="fromJob">
                                                <?php $index = 0; ?>
                                                @foreach($all_job_boards as $key => $board)
                                                    @if( $board['type'] == 'paid' && $board['avi'] == 0 )
                                                        <?php

                                                        // $sub_key = array_search($b['id'], array_pluck( $boards, 'id' ) );
                                                        $index++;
                                                        if (@$board['pivot']['url'] != null && @$board['pivot']['url'] != '') {
                                                            $status = 'approved';
                                                        } else {
                                                            $status = 'pending';
                                                        }
                                                        // $status = ( in_array($b['id'], $boards) ) ? 'disabled checked' : '';
                                                        // $approved = ( in_array($b['id'], $boards) ) ? 'disabled checked' : '';

                                                        $offest = ($index % 2) ? 2 : 0;

                                                        ?>
                                                        
                                                        
                                                        <div class="col-xs-4 col-xs-offset-{{ $offest }}">
                                                            @php
                                                                /* Initialize some defaults */
                                                                $label_classes = $input_attributes = '';
                                                            @endphp
                                                            
                                                            @if(in_array($board['id'], $subscribed_boards_id))
                                                                @php
                                                                    $label_classes = 'checked disabled';
                                                                    $input_attributes = 'checked="checked" disabled="disabled"';
                                                                @endphp
                                                            @endif
                                                            
                                                            <label data-id="{{ $board['id'] }}"
                                                                   class="btn paid btn-line btn-sm btn-label btn-block text-capitalize text-left {{ $label_classes }}">
                                                                <input data-id="{{ $board['id'] }}"
                                                                       type="checkbox" class=""
                                                                       autocomplete="off" {{ $input_attributes }}>
                                                                <span class="col-xs-6"><img
                                                                            src="{{ $board['img'] }}"
                                                                            width="100%" alt=""></span>
                                                                <span class="col-xs-6"><b
                                                                            class="name">{{ $board['name'] }}</b><br>
                                                                    <span class="badge badge-danger">&#8358;<span>{{ $board['price'] }}</span></span></span>
                                                                <span class="clearfix"></span>
                                                            </label>
                                                        </div>
                                                    
                                                    @endif
                                                @endforeach
                                            </div>
                                            
                                            <div class="clearfix"></div>
                                            <br>
                                            
                                            <h5 style="display: none"  class="A col-xs-4 col-xs-offset-2">Job Newspapers</h5>
                                            <div class="clearfix"></div>
                                            <div style="display: none" id="fromNews">
                                                <?php $index = 0; ?>
                                                @foreach($all_job_boards as $key => $board)
                                                    @if( $board['type'] == 'paid' && $board['avi'] == 1)
                                                        <?php
                                                        // $sub_key = array_search($b['id'], array_pluck( $boards, 'id' ) );
                                                        $index++;
                                                        if (@$board['pivot']['url'] != null && @$board['pivot']['url'] != '') {
                                                            $status = 'approved';
                                                        } else {
                                                            $status = 'pending';
                                                        }
                                                        // $status = ( in_array($b['id'], $boards) ) ? 'disabled checked' : '';
                                                        // $approved = ( in_array($b['id'], $boards) ) ? 'disabled checked' : '';

                                                        $offest = ($index % 2) ? 2 : 0;

                                                        ?>
                                                        
                                                        
                                                        <div class="col-xs-4 col-xs-offset-{{ $offest }}">
                                                            @php
                                                                /* Initialize some defaults */
                                                                $label_classes = $input_attributes = '';
                                                            @endphp
                                                            
                                                            @if(in_array($board['id'], $subscribed_boards_id))
                                                                @php
                                                                    $label_classes = 'checked disabled';
                                                                    $input_attributes = 'checked="checked" disabled="disabled"';
                                                                @endphp
                                                            @endif
                                                            
                                                            <label class="btn paid btn-line btn-sm btn-label btn-block text-capitalize text-left {{ $label_classes }}">
                                                                
                                                                <input value="{{ $board['id'] }}"
                                                                       type="checkbox"
                                                                       class=""
                                                                       autocomplete="off" {{ $input_attributes }}>
                                                                
                                                                <span class="col-xs-6">
                                                                    <img src="{{ $board['img'] }}"
                                                                         width="100%" alt="">
                                                                </span>
                                                                
                                                                <span class="col-xs-6">
                                                                    <b class="name">{{ $board['name'] }}</b><br>
                                                                    <span class="badge badge-danger">
                                                                        &#8358;
                                                                        <span>
                                                                            {{ $board['price'] }}
                                                                        </span>
                                                                    </span>
                                                                </span>
                                                                
                                                                <span class="clearfix"></span>
                                                            </label>
                                                        
                                                        </div>
                                                    
                                                    @endif
                                                @endforeach
                                            </div>
                                        
                                        </div>
                                    
                                    
                                    </div>
                                    
                                    <div class="col-xs-6 col-xs-offset-3 text-center">
                                        <hr>
                                        
                                        <!-- <p class="hidify">For a wider reach, you can <a class="open-more " data-toggle="collapse" data-target="#paidJobBoards" aria-expanded="false" aria-controls="paidJobBoards">advertise this job on more paid job board</a></p> -->
                                        <br>
                                        
                                        <!-- <a class="open-more btn btn-lg btn-line hidify" data-toggle="collapse" data-target="#paidJobBoards" aria-expanded="false" aria-controls="paidJobBoards">Advertise on more job boards</a> -->
                                        
                                        <!-- <span class="hidify">&nbsp; or &nbsp; </span> -->
                                    <!-- <a href="{{ route('job-candidates', [$job->id]) }}" data-toggle="modal" data-target="#success" id="showPreview" class="btn btn-lg btn-success"><i class="fa fa-check"></i> &nbsp;PROCEED &raquo;</a> -->
                                        <a href="{{ route('job-candidates', [$job->id]) }}" id="showPreview"
                                           class="btn btn-lg btn-success"><i class="fa fa-check"></i> &nbsp;PROCEED
                                            &raquo;</a>
                                        <hr>
                                    <!-- <a href="{{ url('dashboard') }}" class="btn btn-lg btn-success">Post my Job</i></a> -->
                                    </div>
                                    
                                    
                                    <!-- <div class="col-xs-12"><br><p class="text-center">Post this job to see more available job boards</p></div> -->
                                    
                                    <div class="col-xs-6 hidden">
                                        <div class="well no-border no-shadow">
                                            <label for=""><i class="fa fa-folder"></i> Create Job Folder</label> &nbsp;
                                            <!-- <textarea name="" id="" cols="30" rows="4" class="form-control" placeholder=""></textarea> -->
                                            <input type="text" class="form-control" placeholder="e.g lawyer2-02-2016">
                                            <small>
                                                (This folder will contain all Resumes / CVs and other materials
                                                submitted by candidates that apply for the Job. )
                                            </small>
                                        </div>
                                    </div>
                                
                                </div>
                                
                                
                                <br>
                            </div>
                        </div>
                    
                    </div>
                    <!--/tab-content-->
                </div>
            </div>
        </div>
    </section>
    
    <div class="separator separator-small"></div>
    
    <!-- Modal Promote Job -->
    <div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <!-- <div class="modal-header">
              <h4 class="modal-title bold text-bold" id="myModalLabel">Promote <span class="text-warning">{{ ucfirst( $job->title ) }} </span></h4>
            </div> -->
                <div class="modal-body">
                    <div class="row">
                        
                        
                        <p class="text-center lead"><br>
                            <i class="fa fa-check text-success"></i>
                            <span class="text-success">Congrats! Your Job has been posted on the free Job
                                boards! </span>
                            <br> Kindly make payments for the channels below...
                        </p>
                        
                        <div id="" class="">
                            
                            <div class="col-xs-12">
                                <hr>
                            </div>
                            
                            <p class="text-center">For a wider reach, you can advertise this job on more paid job
                                board
                            </p>
                            <div class="clearfix"></div>
                            <!-- <h4 class="text-center text-capitalize">Paid Job boards & Newspapers</h4><br> -->
                            <!-- <div id="preview">
                              <div class="col-xs-5 col-xs-offset-1 pull-left">

                                <h5 class="col-xs-12">Job Boards</h5><div class="clearfix"></div>
                                <div id="job" class="col-xs-12"></div>
                                
                              </div>
                              


                                <div class="col-xs-5 pull-left">
                                    <h5 class="col-xs-12">Job Newspapers</h5><div class="clearfix"></div>

                                    <div id="news" class="col-xs-12"></div>
                                </div>
                                

                            </div> -->
                            <div id="paidJobBoards">
                                <div class="col-xs-8 col-xs-offset-2">
                                    <hr>
                                </div>
                                <div class="clearfix"></div>
                                <h4 class="text-center text-capitalize">Paid Job boards & Newspapers</h4>
                                <p class="text-center text-muted">Kindly, make selections from below</p>
                                <br>
                                <div id="copyFrom">
                                    <h5 class="col-xs-5 col-xs-offset-1">Job Boards</h5>
                                    <div class="clearfix"></div>
                                    
                                    <div id="fromJob">
                                        <?php $index = 0; ?>
                                        @foreach($all_job_boards as $key => $board)
                                            @if( $board['type'] == 'paid' && $board['avi'] == 0 )
                                                <?php
                                                // $sub_key = array_search($b['id'], array_pluck( $boards, 'id' ) );
                                                $index++;
                                                if (@$board['pivot']['url'] != null && @$board['pivot']['url'] != '') {
                                                    $status = 'approved';
                                                } else {
                                                    $status = 'pending';
                                                }
                                                // $status = ( in_array($b['id'], $boards) ) ? 'disabled checked' : '';
                                                // $approved = ( in_array($b['id'], $boards) ) ? 'disabled checked' : '';

                                                $offest = ($index % 2) ? 1 : 0;

                                                ?>
                                                
                                                
                                                <div class="col-xs-5 col-xs-offset-{{ $offest }}">
                                                    @php
                                                        /* Initialize some defaults */
                                                        $label_classes = $input_attributes = '';
                                                    @endphp
                                                    
                                                    @if(in_array($board['id'], $subscribed_boards_id))
                                                        @php
                                                            $label_classes = 'checked disabled';
                                                            $input_attributes = 'checked="checked" disabled="disabled"';
                                                        @endphp
                                                    @endif
                                                    <label data-id="{{ $board['id'] }}"
                                                           class="btn paid btn-line btn-sm btn-label btn-block text-capitalize text-left {{ $label_classes }}">
                                                        <input data-id="{{ $board['id'] }}"
                                                               type="checkbox"
                                                               class=""
                                                               autocomplete="off" {{ $input_attributes }}>
                                                        <span class="col-xs-6"><img
                                                                    src="{{ $board['img'] }}" width="100%"
                                                                    alt="">
                                                        </span>
                                                        <span class="col-xs-6">
                                                            <b
                                                                    class="name">{{ $board['name'] }}</b>
                                                            <br>
                                                            <span class="badge badge-danger">
                                                                &#8358;
                                                                <span>
                                                                    {{ $board['price'] }}
                                                                </span>
                                                            </span>
                                                        </span>
                                                        <span class="clearfix"></span>
                                                    </label>
                                                </div>
                                            
                                            @endif
                                        @endforeach
                                    </div>
                                    
                                    <div class="clearfix"></div>
                                    <br>
                                    
                                    <h5 style="display: none"  class="col-xs-5 col-xs-offset-1">Job Newspapers</h5>
                                    <div class="clearfix"></div>
                                    <div style="display: none" id="fromNews">
                                        <?php $index = 0; ?>
                                        @foreach($all_job_boards as $key => $board)
                                            @if( $board['type'] == 'paid' && $board['avi'] == 1)
                                                <?php
                                                // $sub_key = array_search($b['id'], array_pluck( $boards, 'id' ) );
                                                $index++;
                                                if (@$board['pivot']['url'] != null && @$board['pivot']['url'] != '') {
                                                    $status = 'approved';
                                                } else {
                                                    $status = 'pending';
                                                }
                                                // $status = ( in_array($b['id'], $boards) ) ? 'disabled checked' : '';
                                                // $approved = ( in_array($b['id'], $boards) ) ? 'disabled checked' : '';

                                                $offest = ($index % 2) ? 1 : 0;

                                                ?>
                                                
                                                
                                                <div class="col-xs-5 col-xs-offset-{{ $offest }}">
                                                    @php
                                                        /* Initialize some defaults */
                                                        $label_classes = $input_attributes = '';
                                                    @endphp
                                                    
                                                    @if(in_array($board['id'], $subscribed_boards_id))
                                                        @php
                                                            $label_classes = 'checked disabled';
                                                            $input_attributes = 'checked="checked" disabled="disabled"';
                                                        @endphp
                                                    @endif
                                                    <label data-id="{{ $board['id'] }}"
                                                           class="btn paid btn-line btn-sm btn-label btn-block text-capitalize text-left {{ $label_classes }}">
                                                        <input data-id="{{ $board['id'] }}" type="checkbox"
                                                               class="" autocomplete="off" {{ $input_attributes }}>
                                                        <span class="col-xs-6"><img
                                                                    src="{{ $board['img'] }}" width="100%"
                                                                    alt=""></span>
                                                        <span class="col-xs-6"><b
                                                                    class="name">{{ $board['name'] }}</b><br>
                                                        <!-- <span class="badge badge-danger">&#8358;<span>{{ $board['price'] }}</span></span></span> -->
                                                            <span class="clearfix"></span>
                                                    </label>
                                                </div>
                                            
                                            @endif
                                        @endforeach
                                    </div>
                                
                                </div>
                            
                            
                            </div>
                            
                            <div class="clearfix"></div>
                            <hr>
                            <h3 class="text-center">Total: ₦<span id="total">0</span></h3>
                            <div class="clearfix"></div>
                            <hr>
                            <p class="text-center">
                                Please note that you will be contacted shortly as regards your posting on Newspaper <br><br>
                            
                            </p>
                        </div>
                    
                    </div>
                </div>
                <div class="modal-footer">
                    <!--              <button type="button" class="btn btn-line pull-left" data-dismiss="modal">Cancel</button>-->
                    
                    <a href="{{ route('job-candidates', [$job->id]) }}" class="btn btn-line" id="dashboard">SKIP</a>
                    <a href="#" class="btn btn-primary" id="pay" disabled="disabled"><span class="text"> PROCEED </span><i
                                class="fa fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Upload CV -->
    <div class="modal fade" id="uploadCV" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Upload CVs to this Job</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12">
                        <div class="row tab-content ">
                            <div class="col-sm-12">
                                <h1 class="text-center"><i class="fa fa-user-plus"></i></h1>
                                <h4 class="text-center text-green strong">Add Candidates to your Talent Pool</h4>
                                
                                
                                <div class="col-sm-10 col-sm-offset-1 text-center">
                                    <p>
                                        Do you already have relevant resumes in a folder somewhere?
                                        Upload them here and add them to your pool of applicants.
                                    </p>
                                    <br>
                                    
                                    <div id="loader"></div>
                                    <div class="alert alert-danger" style="display:none;" id="u_f"></div>
                                    <div class="alert alert-success" style="display:none;" id="u_s"></div>
                                    <form action="https://localhost/seamlesshiring/public_html/job/import-cv-file"
                                          method="post" enctype="multipart/form-data" id="uploadCandidate">
                                        <input type="hidden" name="_token"
                                               value="p1au5UXt3AEjM6t41vp4R5Q2LXx5HWFyCAB6eFcg">
                                        <div class="form-group">
                                            <div class="btn-group" data-toggle="buttons">
                                                <!-- <label class="btn btn-line">
                                                  <input type="radio" name="options" id="upToFolder" autocomplete="off" value="upToFolder"> Upload to Folder
                                                </label> -->
                                                <label class="btn btn-line">
                                                    <input type="radio" name="options" id="upToJob" autocomplete="off"
                                                           value="upToJob"> Upload to a Job
                                                </label>
                                            </div>
                                            <br><br>
                                            
                                            <select class="form-control job-opt " name="job">
                                                <option value="">Select Job</option>
                                                <option value="22">Technical Executives at Cell Phone Repairs Stores
                                                </option>
                                                <option value="92">Human Resource Managers at Nachitech Oilfield
                                                    Supplies and Services Limited
                                                </option>
                                                <option value="111">Salesperson/Customer Service at Cell Phone Repair
                                                </option>
                                                <option value="115">Head of Learning and Development</option>
                                                <option value="118">My Job</option>
                                            </select>
                                            <select class="form-control hidden folder-opt-select" name="folder">
                                                <option value="0">Select Folder</option>
                                            
                                            </select>
                                            <div class="btn-group folder-opt" style="display:none;">
                                                <button type="button" class="btn btn-line btn-sm dropdown-toggle"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    Select Folder
                                                    &nbsp; <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" id="folders" data-folders="" data-cv="">
                                                    
                                                    <li role="separator" class="divider"></li>
                                                    <li>
                                                        <a href="javascript://"
                                                           onclick="//$('#add-folder').show();$('#add-folder').focus();"><i
                                                                    class="fa fa-plus"></i> Create new</a>
                                                    </li>
                                                </ul>
                                                <br><br>
                                            </div>
                                            
                                            <div class="form-group" id="add-folder" style="display:none;">
                                                <div class="col-xs-6 col-xs-offset-2">
                                                    <input type="text" class="form-control" id="add-folder-field">
                                                </div>
                                                
                                                <div class="col-xs-2">
                                                    <button class="form-control" id="add-folder-btn">Add</button>
                                                </div>
                                                <br><br>
                                            </div>
                                        
                                        
                                        </div>
                                        
                                        <div id="inputer-opt" class="collapse">
                                            <div class="form-group fileinput fileinput-new input-group"
                                                 data-provides="fileinput">
                                                <div class="form-control" data-trigger="fileinput"><i
                                                            class="glyphicon glyphicon-file fileinput-exists"></i> <span
                                                            class="fileinput-filename"></span></div>
                                                <span class="input-group-addon btn btn-primary btn-file text-white"><span
                                                            class="fileinput-new">Select file</span><span
                                                            class="fileinput-exists">Change</span>
                                                    <input type="file" name="cv-upload-file" placeholder="zip"
                                                           accept=".zip,.pdf,.doc,.docx,.txt,.rtf,.pptx,.ppt">
                                                </span>
                                                <a href="#" class="input-group-addon  fileinput-exists btn btn-danger"
                                                   style="    background-color: #d9534f; color:white;"
                                                   data-dismiss="fileinput">Remove</a>
                                            
                                            </div>
                                            <br>
                                            <small style="margin-top: -20px;display: block;">*Allowed extensions are
                                                .zip, .pdf, .doc, .docx, .txt, .rtf, .pptx, .ppt
                                            </small>
                                            <br>
                                            <button type="submit" class="btn btn-success text-capitalize">
                                                <i class="fa fa-file-text-o"></i>&nbsp; <span class="hidden-xs">Import
                                                    file</span>
                                            </button>
                                        </div>
                                    </form>
                                    <div id="funcMsg" class="text text-successs"></div>
                                
                                </div>
                                
                                <div class="col-sm-12 hidden">
                                    
                                    <h5 class="no-margin text-center text-success hidden">
                                        <i class="fa fa-spinner fa-pulse"></i> &nbsp;
                                        Importing Candidates
                                    </h5>
                                    
                                    <div class="col-sm-12">
                                        <hr>
                                        <a href="https://localhost/seamlesshiring/public_html/cv/talent-pool"
                                           class="pull-right btn btn-danger btn-cart-checkout">Go to Talent Pool »</a>
                                    </div>
                                
                                
                                </div>
                            </div>
                        
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    
    <script>

        var total = 0;
        var job_id = "{{ $job->id }}";
        var has_invoice = false;
        var selected_jobs = 0;
        var invoice_no;

        $('.open-more').click(function () {
            $('.hidify').fadeOut();
        });


        var elem = $('.btn.btn-label > input[type=checkbox]');
        var btn = $('.btn.btn-label');
        var paid = $('#fromJob .btn.btn-label.paid, #fromNews .btn.btn-label.paid');


        btn.on('click', function () {

            if ($(this).children(elem).prop("checked")) {

                $(this).addClass('checked');

            } else {
                $(this).removeClass('checked');
            }
        });

        var index = 0;
        /**
         * ReImplment the clientside paid function
         */

        paid.on('click', function (e) {
            e.stopPropagation();
            index++;
            if (index == 2) {
                index = 0;
                if ($(this).children(elem).prop("checked")) {
                    selected_jobs++;
                    if ($(this).find('.badge-danger span').text()) {
                        total += parseInt($(this).find('.badge-danger span').text());
                    }
                } else {
                    selected_jobs--;
                    if ($(this).find('.badge-danger span').text()) {
                        total -= parseInt($(this).find('.badge-danger span').text());
                        $(this).removeClass('checked');
                    }
                }
                if (selected_jobs > 0) {
                    $('#pay').removeAttr('disabled');
                }
                else {
                    $('#pay').attr('disabled', 'disabled');
                }
                $('#total').text(total);
            }
        });

        var boards = [];

        $('#showPreview').on('click', function (e) {
            e.preventDefault();
            $('#success').modal('show');
            // if( total == 0 )
            // {

            // }
            // else
            // {
            //   e.preventDefault();
            //   $('#success').modal('show');
            // }

            // $('#preview #job').html('');
            // $('#preview #news').html('');
            // boards = [];
            // $('#copyFrom #fromJob .btn.btn-label.paid').each( function(i,el){

            //   if ( $( this ).children(elem).prop( "checked" ) ){
            //       boards.push( $(this).data( 'id' ) );
            //       $('#preview #job').append( $(this).clone() );

            //     }
            // });

            // $('#copyFrom #fromNews .btn.btn-label.paid').each( function(i,el){

            //   if ( $( this ).children(elem).prop( "checked" ) ){
            //         boards.push( $(this).data( 'id' ) );

            //       $('#preview #news').append( $(this).clone() );

            //     }
            // });
// 
        });


        $('#pay').on('click', function () {
            $this = $(this);

            if (has_invoice) {
                loadSimplePay();
            }
            else {

                boards = [];

                paid.children('input[type=checkbox]:checked').each(function (key, el) {
                    boards.push($(this).data('id'));
                });

                $('#success .modal-body').html('{!! preloader() !!}');

                $.ajax
                ({
                    type: "POST",
                    url: "{{ route('show-invoice-pop') }}",
                    data: ({
                        rnd: Math.random() * 100000,
                        type_ids: boards,
                        job_id: job_id,
                        type: 'JOB_BOARD',
                        status: 'UNPAID'
                    }),
                    success: function (response) {

                        $('#success .modal-body').html(response.html);

                        invoice_no = response.invoice_no;
                        has_invoice = true;
                        $this.find('.text').text('PAY NOW');
                        $('#dashboard').text('Go to Dashboard');


                        // if( response == "true" )
                        // {
                        //   $.growl.notice({ message: "Payment Successful " });

                        //   setTimeout( function(){ location.href = "{{ route('job-candidates', [$job->id]) }}"; }, 3000 );
                        // }
                        // else
                        // {
                        //   $.growl.error({ message: "Payment Unsuccessful " });
                        // }
                    }
                });

            }

        });

        function loadSimplePay() {
            total = (total * 0.05) + total;
            var handler = SimplePay.configure({
                token: processPayment, // callback function to be called after token is received
                key: 'test_pu_6afdbcd91aa446ecb7f79a2f29c2b530', // place your api key. Demo: test_pu_*. Live: pu_*
                // image: 'https://seamlesshiring.com/img/seamlesshiring-logo.png' // optional: an url to an image of your choice
            });

            handler.open(SimplePay.CHECKOUT, // type of payment
                {
                    email: 'me@ayolana.com', // optional: user's email
                    phone: '+2348038953794',
                    description: 'Payment for Job Boards', // a description of your choosing
                    // address: '', // user's address
                    // postal_code: '110001', // user's postal code
                    // city: '', // user's city
                    country: 'NG', // user's country
                    amount: total * 100, // value of the purchase, ₦ 1100
                    currency: 'NGN' // currency of the transaction
                });


            function processPayment(token, paid) {


                var url = "{{ route('simplepay') }}";
                $.ajax
                ({
                    type: "POST",
                    url: url,
                    data: ({
                        rnd: Math.random() * 100000,
                        token: token,
                        status: paid,
                        type: 'JOB_BOARD',
                        amount: SimplePay.amountToLower(total),
                        currency: 'NGN',
                        boards: boards,
                        job_id: job_id,
                        invoice_no: invoice_no
                    }),
                    success: function (response) {

                        $('#pay').hide();
                        if (response == "true") {
                            $.growl.notice({message: "Payment Successful "});

                            setTimeout(function () {
                                location.href = "{{ route('job-candidates', [$job->id]) }}";
                            }, 3000);
                        }
                        else {
                            $.growl.error({message: "Payment Unsuccessful "});
                        }
                    }
                });

            }


        }
    </script>
@endsection