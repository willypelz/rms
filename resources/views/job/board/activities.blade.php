@extends('layout.template-user')

@section('content')

                    @include('job.board.jobBoard-header')
            
   
            <div class="row">

                <div class="col-sm-12">
                    <div class="page no-bod-rad">
                        <div class="row">


                            @include('job.board.job-board-tabs')
                        
                            <div class="tab-content">

                    <div class="row">                           
                        <!-- applicant -->


                <div class="col-xs-7">

                     <div class="" id="">

                        <div class="row">

                        <div class="col-xs-12">
                          <h6 class="no-margin">
                              <span class="text-brandon text-uppercase">
                              Job Activities 
                              </span> 
                              <!-- <span class="pull-right"><a href=""><i class="fa fa-cog"></i>Notification Settings</a></span> -->
                          </h6>
                          <div class="clearfix"><hr></div>
                            
                            <div id="ActivityContent"></div>
                            <!-- <a href="background-check" class="btn btn-success btn-sm pull-right"><i class="fa fa-commenting-o"></i> &nbsp; Add a Comment</a> -->
                          
                              <div class="clearfix"></div>
                        </div>
                        </div>
                    <!--/tab-content-->                       

                    </div>
                    <!--/tab-content-->

                    <!--/tab-content-->

                </div>

                <script>
                      $("#ActivityContent").html('{!! preloader() !!}');
                     
                      var url = "{{ route('get-activity-content') }}"

                          setTimeout(function(){ getCon(); }, 2000);

                      function getCon(){
                         $.ajax
                        
                        ({
                            type: "POST",
                            url: url,
                            data: ({ rnd : Math.random() * 100000, jobid:"{{ $job->id }}" }),
                            success: function(response){
                            $("#ActivityContent").html(response);

                            }
                        });
                      }


                </script>

                <div class="col-xs-4 col-xs-push-1">
                    <div class="">
                        
                        <h6 class="no-margin pull-right">
                            <span class="text-danger text-brandon text-uppercase">Your Statistics:</span> 
                        </h6>

                        <div class="separator separator-small"></div>

                        <table class="table table-bordered"> 
                        <tbody> 
                        <tr> 
                            <td class="text-center"><h1 class="no-margin text-bold"><a href="jos/list">34</a></h1><small class="text-muted">Jobs Created</small></td> 
                            <td class="text-center"><h1 class="no-margin text-bold"><a href="cv/cv_saved">12,234</a></h1><small class="text-muted">Candidates</small></td> 
                        </tr> 
                        <tr> 
                            <td class="text-center"><h1 class="no-margin text-muted">24</h1><small class="text-muted">Jobs Closed</small></td> 
                            <td class="text-center"><h1 class="no-margin text-bold"><a href="cv/cv_saved">13,234</a></h1><small class="text-muted">Resumes</small></td> 
                        </tr>
                        </tbody> </table>

                        <p class="small">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe ex voluptatem dicta, minima iste magni, eligendi deserunt repellat nesciunt repellendus dolores illo possimus voluptas sit ratione harum libero odio perferendis.</p>
                        <p><a class="btn btn-line" href="">Action</a></p>

                    </div>
                </div>

                                
                        </div>

                    </div>
                        </div>

                    </div>
                    <!--/tab-content-->

                </div>
            </div>
        </div>
    </section>

<div class="separator separator-small"><br></div>
@endsection