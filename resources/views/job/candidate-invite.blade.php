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
                <h4 class="text-brandon l-sp-5 text-uppercase">Candidate Invitaion</h4>
              </div>
              <div class="clearfix"></div>
            </div>
          </div>
          @include('layout.alerts')
        </section>
        <div class="white">
          <div class="col-sm-12">
            <div class="row pad-v-sm">
              <div class="col-sm-10 col-sm-offset-1">
                <p class="lh1-7 text-normal" style="font-size: 1.15em; color: #5d5d5d">
                  Welcome {{ ucwords( $candidate->last_name ) }},
                  <br>You have accepted the invitation as a Job applicant, Kindly create your Candidate Password<strong></strong>
                </p>
                <p class="lh1-7 text-normal text-center" style="font-size: 1.15em; color: #5d5d5d">
                </p>
              </div>
            </div>
            <div class="row">
              <hr>
              <!-- Click here to activate your account -->
              <a role="button" data-toggle="collapse" href="#loginForm" class="btn btn-primary btn-block"> Activate</a>
            </div>
            <div class="clearfix"></div>
            <hr style="margin-bottom: 0">
          </div>
          <div class="row">
            <form action="{{route ('candidate-invite', ['id'=> $candidate->id, 'token'=> $candidate->token] )}}" class="collapse pad-v-sm" method="post" id="loginForm" style="background: #F1F3F5;border-bottom: 1px solid #bbb">
              <div class="col-sm-6 col-sm-offset-3">
                <div class="form-group">
                  <label for="">Email</label>
                  <input type="email" value="{{ $candidate->email }}" disabled="disabled" class="form-control" placeholder="Enter Email">
                </div>
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
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="page page-sm foot no-bod-rad">
        <div class="col-sm-6 col-sm-offset-3 text-center">
          <!-- <hr> -->
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