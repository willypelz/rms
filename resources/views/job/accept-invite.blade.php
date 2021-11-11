@extends('layout.template-guest')

@section('navbar')
@show()

@section('footer')
@show()

@section('content')




  <section class="">
    <div class="container">

      <div class="row">
        <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-sm-12">
          <section class="job-head blue no-margin">
            <div class="">
              <div class="row">
                <div class="col-sm-12 text-center">
                  <h4 class="text-brandon l-sp-5 text-uppercase">Job Team Accept</h4>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </section>
          <div class="white">
            <div class="col-sm-12">
              <div class="row pad-v-sm">
                <div class="col-sm-10 col-sm-offset-1">
                  
                    @if(is_null( @$status ))
                      <p class="lh1-7 text-normal" style="font-size: 1.15em; color: #5d5d5d">
                        Welcome {{ ucwords( $job_team_invite->name ) }}, 
                        <br>You have accepted the invitation to join the job team for the recruitment of <strong>{{ $job ? $job->title : 'all jobs' }}</strong> in <strong>{{ $company->name }}</strong>

                      </p>
                    @else
                      <p class="lh1-7 text-normal text-center" style="font-size: 1.15em; color: #5d5d5d">

                        @if( $status )

                            You have accepted the invitation to join the job team for the recruitment of <strong>{{ $job ? $job->title : 'all jobs' }}</strong> in <strong>{{ $company->name }}</strong>
                            <hr>
                        @if($is_internal == 1)
                        @php
                            $user_email = base64_encode($user->email);
                            $redirect_url = getEnvData('HIRS_REDIRECT_LOGIN').'?referrer='.url('dashboard').'&host=seamlesshiring&user='.$user_email;
                        @endphp
                        <div class="col-sm-4 col-sm-offset-4">
                            <!-- Click here if you already have an account -->
                          <a href="{{ $redirect_url }}" class="btn btn-success btn-block">Login</a>
                        </div>
                        @else
                            <div class="col-sm-4 col-sm-offset-4">
                              <a href="{{ route('select-company',['id'=>$company->id]) }}" class="btn btn-success btn-block">Login</a>
                            </div>
                        @endif
                        @else
                            You have declined the invitation to join the job team for the recruitment of <strong>{{ $job ? $job->title : 'all jobs' }}</strong> in <strong>{{ $company->name }}</strong>
                            <div class="clearfix"></div>
                            <hr>
                            <p class="text-muted text-center">If you did not wish to decline this job team invitation, kindly contact the admin to re-invite you to the job team</p>

                        @endif

                      </p>
                    @endif
                  
                </div>
              </div>

                @if(is_null( @$status ))
                <div class="row">
                  <hr>

                  @if( !$is_new_user && Auth::check() )
                  <div class="col-sm-4 col-sm-offset-4">
                    <!-- Click here if you already have an account -->
                    <a href="{{ route('select-company',['id'=> $company->id]) }}" class="btn btn-success btn-block">Login</a>
                  </div>
                  @elseif($is_internal == 1)
                    @php
                      $user_email = base64_encode($user->email);
                      $redirect_url = getEnvData('HIRS_REDIRECT_LOGIN').'?referrer='.url('dashboard').'&host=seamlesshiring&user='.$user_email;
                    @endphp
                    <div class="col-sm-4 col-sm-offset-4">
                      <!-- Click here if you already have an account -->
                      <a href="{{ $redirect_url }}" class="btn btn-success btn-block">Login</a>
                    </div>
                  @else
                  
                  <div class="col-sm-4 col-sm-offset-4">
                    @if ($errors->any())
                      <div class="alert alert-danger">
                        <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                      </div>
                  @endif
                    <!-- Click here to activate your account -->
                    <a role="button" data-toggle="collapse" href="#loginForm" class="btn btn-primary btn-block"> Activate</a>
                  </div>
                  @endif
                  <div class="clearfix"></div>
                  <hr style="margin-bottom: 0">
                </div>
                <div class="row">
                    <form action="{{route ('accept-invite', $job_team_invite->id )}}" class="collapse pad-v-sm" method="post" id="loginForm" style="background: #F1F3F5;border-bottom: 1px solid #bbb">
                      <div class="col-sm-6 col-sm-offset-3">
                      <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" value="{{ $job_team_invite->email }}" disabled="disabled" class="form-control" placeholder="Enter Email">
                      </div>
                      <input type="hidden" name="ref" value="{{ $user->id }}" />
                      <div class="form-group">
                        <label for="">Create Password</label>
                        <input type="password" class="form-control" placeholder="Enter password" name="password" id="password" required>
                      </div>
                       <div class="form-group">
                        <label for="">Retype Password</label>
                        <input type="password" class="form-control" name="password_confirmation" id="confirm_password" placeholder="Re-Enter password" required>
                      </div>
                      <div class="form-group">
                        <button class="btn btn-success pull-right">Submit</button>
                        <div class="clearfix"></div>
                      </div>
                      </div>
                      <div class="clearfix"></div>
                    </form>
                  <div class="clearfix"></div>
                </div>
                @endif






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
          <div class="page page-sm foot no-bod-rad">
            <div class="col-sm-6 col-sm-offset-3 text-center"><!-- <hr> -->
              <p><img src="{{ getEnvData('SEAMLESS_HIRING_LOGO') }}" alt="" width="250px"> </p>
              <p class="text-muted small">@ <?php echo date('Y') ?></p>
            </div>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="separator separator-small"><br></div>

  <script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
@endsection
