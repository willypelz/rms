@extends('layout.template-user')

@section('content')

    <!-- <div class="container text-brandon text-uppercase h5 separator separator-small" style=""><i class="fa fa-tachometer"></i> Your Dashboard</div> -->
   
    <section class="s-div dashboard" style="background-position: center 73px;">
        <div class="container">
           
            <div class="row">
                @include('layout.alerts')
                <div class="col-sm-12 "><br>

                    <h4 class="text-white">
                        Welcome Admin, <span class="small pull-right text-white">
                            <i class="fa fa-calendar"></i> <?php echo date("l, d/m/Y") . "<br>"; ?>
                        </span>
                    </h4>

                    @if(checkIfUserHasCompanyPermission())
                        <div class=" btn-group-justified btn-dash" role="group" aria-label="...">
                            <div class="btn-group" role="group">
                                <a href="{{ route('post-job') }}" type="button"
                                   class="btn btn-success text-capitalize in">
                                    <span class="fa-lg"><i class="fa fa-briefcase"></i>
                                        <span class="hidden-xs text-brandon"> Post a Job</span><br></span>
                                    <small class="text-white hidden-xs">
                                        Broadcast Jobs everywhere
                                    </small>
                                </a>
                            </div>
                            <div class="btn-group" role="group">
                                <a href="{{ route('add-candidates', false) }}" type="button"
                                   class="btn btn-line text-capitalize">
                                    <span class="fa-lg"><i class="fa fa-user-plus"></i>
                                        <span class="hidden-xs text-brandon text-capitalize"> Upload
                                            Candidates</span><br></span>
                                    <small class="text-muted hidden-xs">Upload CVs to your Talent
                                        Pool</small>
                                </a>
                            </div>
                            <div class="btn-group" role="group">
                                <a href="{{ url('cv/talent-pool') }}" type="button"
                                   class="btn btn-line text-capitalize">
                                    <span class="fa-lg"><i class="fa fa-bar-chart"></i>
                                        <span class="hidden-xs text-brandon text-capitalize">
                                            Explore Talent Pool</span><br></span>
                                    <small class="text-muted hidden-xs">Your Talent Database</small>
                                </a>
                            </div>
                            <!--  <div class="btn-group" role="group">
                               <a href="#" type="button" class="btn btn-line text-capitalize text-muted">
                               <span class="fa-lg"><i class="fa fa-cogs"></i>
                               <span class="hidden-xs text-brandon text-capitalize"> Settings</span><br></span>
                               <small class="text-muted hidden-xs">Edit your settings</small>
                               </a>
                             </div> -->
                        </div>
                    @endif
                    <br>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </section>

    <br>

    <section class="no-pad">
        <div class="container">
            <div class="row">

                <div class="col-xs-8">

                    <div class="page no-rad-btn">


                        <div class="row">
                            <h6 class="no-margin">
                                <span class="text-brandon text-uppercase">
                                    All Activities:
                                </span>
                                <!-- <span class="pull-right"><a href=""><i class="fa fa-cog"></i>Notification Settings</a></span> -->
                            </h6>
                            <div class="clearfix">
                                <hr>
                            </div>

                            <div id="ActivityContent"></div>

                            <div class="clearfix"></div>

                            <div class="row" id="showAll" style="display:none">
                                <div class="col-sm-6 col-sm-offset-3 text-center">
                                    <div id="act_loader"
                                         style="display:none">{!! preloader() !!}</div>
                                    <button onclick="getCon(true); activities_index++"
                                            class="btn btn-default">Show more activities 
                                    </button>
                                </div>
                            </div>

                        </div>


                    </div>
                    <!--/tab-content-->

                </div>

                <div class="col-xs-4">
                    <div class="page no-rad-btn">

                        <h6 class="no-margin pull-right">
                            <span class="text-danger text-brandon text-uppercase">Quick
                                Stats:</span>
                        </h6>

                        <div class="separator separator-small"></div>

                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td class="text-center"><h1 class="no-margin text-bold"><a
                                                    href="{{ route('job-list') }}">{{ $jobs_count }}</a>
                                        </h1><small class="text-muted">Jobs</small></td> <!--
                            <td class="text-center"><h1 class="no-margin text-bold"><a href="{{ url('cv/talent-pool') }}">{{ $talent_pool_count }}</a></h1><small class="text-muted">Talent pool</small></td>  -->
                                </tr>
                            <!-- <tr>
                            <td class="text-center"><h1 class="no-margin text-bold"><a href="#">{{ $saved_cvs_count }}</a></h1><small class="text-muted">Purchased Cvs</small></td> 

                            <td class="text-center"><h1 class="no-margin text-bold"><a href="#">{{ $purchased_cvs_count }}</a></h1><small class="text-muted">Saved Cvs</small></td> 
                        </tr> -->
                            </tbody>
                        </table>

                        <!-- <p class="small">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe ex voluptatem dicta, minima iste magni, eligendi deserunt repellat nesciunt repellendus dolores illo possimus voluptas sit ratione harum libero odio perferendis.</p> -->
                        <p><a href="{{ route('job-list') }}" class="centre btn btn-default">See My
                                Jobs</a></p>

                    </div>
                </div>


            </div>

            @if( isset($posts) )
                <div class="row">
                    <div class="separator separator-small"><br></div>

                    <div class="col-xs-12">
                        <hr>
                        <h6 class="no-margin">
                            <span class="text-brandon text-uppercase"> Discovery for
                                Employers:</span> 4 new updates
                        </h6><br>
                        <div id="owl-posts">

                            @if( count( @$posts ) > 0 )
                                @foreach($posts as $post)
                                    <div class="owl-item col-sm-3">
                                        <div class="panel-body text-left">
                                            <p class="post-img">
                                                <a href="{{ 'https://insidify.com/discovery/'.$post->slug }}"
                                                   target="_blank">
                                                    <img src="https://files.insidify.com/{{ $post->picture }}"
                                                         class="img-responsive" width="100%">
                                                </a>
                                            </p>
                                            <h4 class="post-title"><a
                                                        href="{{ 'https://insidify.com/discovery/'.$post->slug }}"
                                                        target="_blank">
                                                    {{ $post->title }}</a></h4>
                                            <p class="hidden">{{ $post->summary }}
                                            </p>
                                        <!-- <p>
                                    <a href="{{ 'https://insidify.com/discovery/'.$post->slug }}" target="_blank" class="btn btn-line">Read</a>
                                </p> -->
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>

            @endif


        </div>
    </section>

    <div class="separator separator-small"></div>

    <script>
    var activities_index = 1;
    let counterShowActivitiesClicked = 0;
    $('#ActivityContent').html('{!! preloader() !!}');

    var url = "{{ route('get-activity-content') }}";

    setTimeout(function () { getCon(); }, 2000);

    function getCon(allActivities = false) {
        if(++counterShowActivitiesClicked > 2){
            actionOnNoMoreActivitiesToShow();
        }else{
            $('#act_loader').show()
            $.ajax
            ({
                type: 'POST',
                url: url,
                data: ({
                    rnd: Math.random() * 100000,
                    type: 'dashboard',
                    allActivities: allActivities,
                    activities_index: activities_index,
                }),
                success: function (response) {
                    if (allActivities && (response.shouldAppend)) {
                        $('#ActivityContent').append(response.content);
                    } else {
                        $('#ActivityContent').html(response.content);
                        if(!response.isThereMoreActivities){
                            actionOnNoMoreActivitiesToShow();
                        }
                    }
                    $('#showAll').show();
                },
            });
        }
        $('#act_loader').hide();
    }

    function actionOnNoMoreActivitiesToShow(){
        $.growl.error({message: "No more activities"});
        return ;
    }
    </script>
@endsection