@extends('layout.template-guest')
<link rel="stylesheet" type="text/css" href="{{ asset('font/flaticon.css') }}">
<link href="{{ asset('css/select2.css') }}" rel="stylesheet">
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
                                                <div class="pull-right">
                                                <label for="" class="text-white">Filter: </label>
                                                <select name="specializations[]" style="width:200px"
                                                        onchange="javascript:location.href = this.value;"
                                                        id="specialization"
                                                        class="select2 company-filter" >
                                                    <option value="">--choose sub company</option>
                                                    @foreach($subsidiaries as $s)
                                                        <option value="{{ route('job-listing', ['company_id' => $s->id])}}">{{ $s->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
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
                            @include('candidate.includes.footer')


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

<script src="{{ asset('js/select2.min.js') }}"></script>
<script type="text/javascript">
        $('.select2').select2({
            maximumInputLength: 1
        });
</script>

@endsection




