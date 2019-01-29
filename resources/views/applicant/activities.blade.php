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
                            <a href="{{ route('applicant-activities',  $appl->id) }}" class="btn btn-line"><i class="fa fa-bars"></i> &nbsp; Feeds</a>
                            <!-- <a href="background-check" class="btn"><i class="fa fa-commenting-o"></i> &nbsp; Comments</a> -->
                            <a href="{{ route('applicant-notes',  $appl->id) }}" class="btn"><i class="fa fa-file-text-o"></i> &nbsp; Interview Notes</a>
                            <!-- <a data-toggle="modal" data-target="#viewModal" id="modalButton" href="#viewModal" data-title="Comment" data-view="{{ route('modal-comment') }}" data-app-id="{{ $appl->id }}" data-type="normal" class="btn btn-success pull-right"><i class="fa fa-file-text-o"></i> &nbsp; Add a Comment</a> -->
                            <hr>
                          </div>
                        </div>


                        <div class="row">

                        <div class="col-xs-12">
                          <h6 class="no-margin">
                              <span class="text-brandon text-uppercase">
                              Applicants Activities 
                              </span> 
                              <!-- <span class="pull-right"><a href=""><i class="fa fa-cog"></i>Notification Settings</a></span> -->
                          </h6>
                          <div class="clearfix"><hr></div>
                          
                            <div id="ActivityContent"></div>
                            
                            <style type="text/css">

                              #show_activity_comment{ display: inline-block !important;}

                            </style>

              <!-- <a class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#viewModal" id="modalButton" href="#viewModal" data-title="Comment" data-view="{{ route('modal-comment') }}" data-app-id="{{ $appl->id }}" data-type="normal">Comment</a> -->
                             
                              <div class="clearfix"></div>
                        </div>
                        </div>
                    <!--/tab-content-->                       

                    </div>
                    <!--/tab-content-->

                </div>

            </div>

              <script>
                      $("#ActivityContent").html('{!! preloader() !!}');

                      var activitiesStatus = false;
                     
                      var url = "{{ route('get-activity-content') }}"

                          setTimeout(function(){ getCon(); }, 2000);

                      function getCon(){
                         $.ajax
                        
                        ({
                            type: "POST",
                            url: url,
                            data: ({ rnd : Math.random() * 100000, appl_id:"{{ $appl->id }}", allActivities: activitiesStatus }),
                            success: function(response){
                              activitiesStatus = true;
                            $("#ActivityContent").html(response);

                            }
                        });
                      }


                </script>

        @include('applicant.includes.pagination')

        </div>
    </section>

<div class="separator separator-small"></div>



@endsection