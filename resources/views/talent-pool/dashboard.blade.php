@extends('layout.template-user')

@section('content')


<div class="separator separator-small"></div>

    <section class="no-pad">
        <div class="container">
            <div class="row">

                <div class="col-sm-12 ">

                        <div class=" btn-group-justified btn-dash" role="group" aria-label="...">
                          <div class="btn-group" role="group">
                            <a href="{{ route('post-job') }}" type="button" class="btn btn-success text-capitalize in">

                            <span class="fa-lg"><i class="fa fa-tachometer"></i>
                            <span class="hidden-xs text-brandon text-capitalize"> Add Job</span><br></span>
                            <small class="text-white hidden-xs">Post a new Job</small>
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="{{ route('add-candidates', false) }}" type="button" class="btn btn-line text-capitalize">
                            <span class="fa-lg"><i class="fa fa-user-plus"></i>
                            <span class="hidden-xs text-brandon text-capitalize"> Add Candidate</span><br></span>
                            <small class="text-muted hidden-xs">Upload CV in folder</small>
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="{{ url('cv/talent-pool') }}" type="button" class="btn btn-line text-capitalize">
                            <span class="fa-lg"><i class="fa fa-bar-chart"></i>
                            <span class="hidden-xs text-brandon text-capitalize"> View Talent Pool</span><br></span>
                            <small class="text-muted hidden-xs">Resumes / CVs</small>
                            </a>
                          </div>
                          <div class="btn-group" role="group">
                            <a href="#" type="button" class="btn btn-line text-capitalize text-muted">
                            <span class="fa-lg"><i class="fa fa-cogs"></i>
                            <span class="hidden-xs text-brandon text-capitalize"> Settings</span><br></span>
                            <small class="text-muted hidden-xs">Edit your settings</small>
                            </a>
                          </div>
                        </div>
                </div>

                <div class="col-xs-8">

                    <div class="page no-rad-btn">


                        <div class="row">
                        <h6 class="no-margin">
                            <span class="text-brandon text-uppercase">
                            Your Activities: 4 new updates 
                            </span> 
                            <span class="pull-right"><a href=""><i class="fa fa-cog"></i>Notification Settings</a></span>
                        </h6>
                        <div class="clearfix"><hr></div>

                            <div id="ActivityContent"></div>

                            <div class="clearfix"></div>
                      
                        </div>


                    </div>
                    <!--/tab-content-->

                </div>

                <div class="col-xs-4">
                    <div class="page no-rad-btn">
                        
                        <h6 class="no-margin pull-right">
                            <span class="text-danger text-brandon text-uppercase">Your Jobs:</span> 
                        </h6>

                        <div class="separator separator-small"></div>

                        <table class="table table-bordered"> 
                        <tbody> 
                        <tr> 
                            <td class="text-center"><h1 class="no-margin text-bold"><a href="{{ route('job-list') }}">10</a></h1><small class="text-muted">Jobs Created</small></td> 
                            <td class="text-center"><h1 class="no-margin text-bold"><a href="{{ route('job-list') }}">2,504</a></h1><small class="text-muted">Candidates</small></td> 
                        </tr> 
                        <!--tr> 
                            <td class="text-center"><h1 class="no-margin text-muted">24</h1><small class="text-muted">Jobs Closed</small></td> 
                            <td class="text-center"><h1 class="no-margin text-bold"><a href="cv/cv_saved">13,234</a></h1><small class="text-muted">Resumes</small></td> 
                        </tr-->
                        </tbody> </table>

                        <p class="small">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe ex voluptatem dicta, minima iste magni, eligendi deserunt repellat nesciunt repellendus dolores illo possimus voluptas sit ratione harum libero odio perferendis.</p>
                        <p><a href="{{ route('job-list') }}" class="btn btn-default">See My Jobs</a></p>

                    </div>
                </div>

                        
                        <br><br><br>  

                <div class="col-xs-4">
                    <div class="page no-rad-btn">
                        
                        <h6 class="no-margin pull-right">
                            <span class="text-danger text-brandon text-uppercase">Your Talent Pool:</span> 
                        </h6>

                        <div class="separator separator-small"></div>

                        <table class="table table-bordered"> 
                        <tbody> 
                        <tr> 
                            <td class="text-center"><h1 class="no-margin text-bold"><a href="{{ route('job-list') }}">10</a></h1><small class="text-muted">Jobs Created</small></td> 
                            <td class="text-center"><h1 class="no-margin text-bold"><a href="{{ route('job-list') }}">2,504</a></h1><small class="text-muted">Candidates</small></td> 
                        </tr> 
                        <!--tr> 
                            <td class="text-center"><h1 class="no-margin text-muted">24</h1><small class="text-muted">Jobs Closed</small></td> 
                            <td class="text-center"><h1 class="no-margin text-bold"><a href="cv/cv_saved">13,234</a></h1><small class="text-muted">Resumes</small></td> 
                        </tr-->
                        </tbody> </table>

                        <p class="small">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe ex voluptatem dicta, minima iste magni, eligendi deserunt repellat nesciunt repellendus dolores illo possimus voluptas sit ratione harum libero odio perferendis.</p>
                        <p><a href="{{ route('job-list') }}" class="btn btn-default">See My Jobs</a></p>

                    </div>
                </div>


            </div>

            <div class="row">
                <div class="separator separator-small"><br></div>

                <div class="col-xs-12">
                <hr>
                        <h6 class="no-margin">
                            <span class="text-brandon text-uppercase">Your Activities:</span> 4 new updates
                        </h6><br>
                    <div id="owl-posts">
                        
                        @foreach($posts as $post)
                        <div class="owl-item col-sm-3">
                            <div class="panel-body text-left">
                              <p class="post-img">
                                <a href="{{ 'https://insidify.com/discovery/'.$post->slug }}" target="_blank" >
                                  <img src="https://files.insidify.com/{{ $post->picture }}" class="img-responsive" width="100%">
                                </a>
                              </p>
                              <h4 class="post-title"><a href="{{ 'https://insidify.com/discovery/'.$post->slug }}" target="_blank">
                                {{ $post->title }}</a></h4>
                              <p class="">{{ $post->summary }}
                              </p>
                              <p>
                                  <a href="{{ 'https://insidify.com/discovery/'.$post->slug }}" target="_blank" class="btn btn-line">Read</a>
                              </p>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>

        </div>
    </section>

<div class="separator separator-small"></div>

<script>
                      $("#ActivityContent").html('{!! preloader() !!}');
                     
                      var url = "{{ route('get-activity-content') }}"

                      setTimeout(function(){ getCon(); }, 2000);

                      function getCon(){
                         $.ajax
                        ({
                            type: "POST",
                            url: url,
                            data: ({ rnd : Math.random() * 100000, type:"dashboard" }),
                            success: function(response){
                              $("#ActivityContent").html(response);

                            }
                        });
                      }
</script>
@endsection