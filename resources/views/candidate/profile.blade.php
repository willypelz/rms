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
                    
                    @include('layout.alerts')
                    <!-- Sidebar -->
                    
                    <div class="col-md-3">
                        @include('candidate.includes.sidebar')
                    </div>
                    
                    <!-- Main body -->
                    <div class="col-md-9">
                        
                        <div class="tab-content">
                            {{-- <div role="tabpanel" class="sec-body tab-pane fade" id="sec-job-list">
                                @include('candidate.job-list')
                            </div>

                            <div class="clearfix"></div> --}}

                            <div role="tabpanel" class="sec-body tab-pane active" id="">
                                <section class="job-head no-margin">
                                    <div class="">
                                        <div class="row">
                                            <div class="col-sm-8 col-sm-offset-2 text-center">

                                                <h3 class="text-white no-margin">
                                                    Profile

                                                </h3>
                                                <hr>
                                            </div>
                                            <div class="clearfix"></div>

                                        </div>
                                    </div>
                                </section>

                            </div>

                            <form role="form" class="form-signin" method="POST" action="{{ route('candidate-profile') }}">
                                {!! csrf_field() !!}

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                            <label for="">Firstname</label>
                                            <input type="text" class="form-control" id="" placeholder=""
                                                   name="first_name" value="{{ $candidate->first_name ? $candidate->first_name : old('first_name') }}" required>

                                            @if ($errors->has('first_name'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                            <label for="">Lastname</label>
                                            <input type="text" class="form-control" id="" placeholder=""
                                                   name="last_name" value="{{ $candidate->last_name ? $candidate->last_name : old('last_name') }}" required>

                                            @if ($errors->has('last_name'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="">Email</label>
                                            <input type="email" class="form-control" id="" placeholder="" name="email"
                                                   value="{{ $candidate->email ? $candidate->email :  old('email') }}" required disabled>

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                                <div class="row"><br>

                                    <div class="col-sm-10 col-sm-offset-1 col-md-12 col-sm-offset-0">
                                        <button type="submit" class="btn btn-success btn-block">Update &raquo;</button>
                                    </div>


                                </div>
                            </form>

                            <div class="clearfix"></div>


                        </div>
                        
                        
                        <!--/footer-->
                        <div class="page page-sm foot no-bod-rad">
                            <div class="col-sm-6 col-sm-offset-3 text-center"><!-- <hr> -->
                                <p><img src="{{ env('SEAMLESS_HIRING_LOGO') }}" alt=""
                                        width="200px"></p>
                                <p>
                                    <small class="text-muted"> &nbsp;
                                        &copy; {{ date('Y') }}. Powered by <a href="http://www.seamlesshiring.com">
                                            SeamlessHiring</a></small>
                                </p>
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