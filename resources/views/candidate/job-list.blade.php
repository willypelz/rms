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

                            <div class="tab-content no-pad">
                                <div class="">
                                    <section class="job-head no-margin">
                                    <div class="">
                                        <div class="row">
                                        
                                            <div class="col-sm-12 text-center text-white">
                                                
                                        
                                                <h2 class="job-title">
                                                        Jobs
                                                </h2>
                                                <hr>
                                                <ul class="list-inline text-white">
                                                    <!--<li><strong>Company:</strong>&nbsp; JobAcess</li>-->
                                                    <li>
                                                        <strong>&nbsp;{{ count( $jobs ) }}</strong>&nbsp; Job Opening(s)</li>
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
                                                    <div class="tab-content">
                                    
                                                <div class="row">
                                                    
                                                    <div class="col-sm-12">

                                                        <br>

                                                        <div class="" id="">
                                                        
                                                                <ul class="search-results">
                                                                    @foreach($jobs as $job)
                                                                    <li>
                                                                        <h4><a role="presentation" href="{{ route('job-view', [$job->id, $job->slug]) }}" >{{ $job->title }}</a>
                                                                        </h4>
                                                                        <p>{{ $job->summary }}</p>
                                                                        <div class="dt"><strong>Company:</strong>&nbsp;{{ $job->company->name }}, <strong>Location:</strong>&nbsp;{{ $job->location }}. <strong>Posted:</strong>&nbsp;{{ date('D. j M, Y', strtotime( $job->created_at)) }}</div>
                                                                        <div class="description">
                                                                            {{-- <p>Able bodied security men and women needed in a hotel. Must be smart and able to work in a corporate environment ...</p> --}}

                                                                                <strong>Expiry:</strong>&nbsp;{{ date('D. j M, Y', strtotime( $job->expiry_date)) }}. &nbsp; 
                                                                               
                                                                        </div><hr>
                                                                    </li>
                                                                    @endforeach
                                                        
                                                        
                                                                    </ul>
                                                        
                                                        
                                                                    {{-- <a href="" class="btn btn-line load">
                                                                        <span class="glyphicon glyphicon-repeat"></span>&nbsp; Load more</a> --}}
                                                        
                                                        </div>                                            
                                                    </div>
                                                           
                                                    <div class="clearfix"></div>

                                                </div>
                                    
                                            </div>
                                                </div>
                                    
                                            </div>
                                    
                                        </div>
                                        <div class="clearfix"></div>
                                        
                                    </div>
                                </div>
                            </div>



                            <!--/footer-->
                            <div class="page page-sm foot no-bod-rad">
                                <div class="col-sm-6 col-sm-offset-3 text-center"><!-- <hr> -->
                                <p><img src="{{ env('SEAMLESS_HIRING_LOGO') }}" alt="" width="200px"> </p>
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
<div class="separator separator-small"><br></div>


@endsection




