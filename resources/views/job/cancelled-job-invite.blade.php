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
                  <h4 class="text-brandon l-sp-5 text-uppercase">Job Team Invite Cancelled</h4>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </section>
          <div class="white">
            <div class="col-sm-12">
              <div class="row pad-v-sm">
                <div class="col-sm-10 col-sm-offset-1">
                    <p class="lh1-7 text-normal" style="font-size: 1.15em; color: #5d5d5d">
                      Hello {{ ucwords( $job_team_invite->name ) }}, 
                      <br>This invitation to join the job team for the recruitment of <strong>{{ $job ? $job->title : 'all jobs' }}</strong> in <strong>{{ $company->name }}</strong> has been cancelled.
                    </p>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="page page-sm foot no-bod-rad">
            <div class="col-sm-6 col-sm-offset-3 text-center"><!-- <hr> -->
              <p><img src="{{ getEnvData('SEAMLESS_HIRING_LOGO',null, request()->clientId) }}" alt="" width="250px"> </p>
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
