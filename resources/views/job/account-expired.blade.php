@extends('layout.template-guest')

@section('navbar')
@show()

@section('footer')
@show()

@section('content')




  <section class="">
    <div class="container">

      <div class="row">
        <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
          <section class="job-head blue no-margin">
            <div class="">
              <div class="row">
                <div class="col-sm-12 text-center">
                  <h4 class="text-brandon l-sp-5 text-uppercase">Account Expired</h4>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </section>
          <div class="white">
            <div class="col-sm-12">
              <div class="row pad-v-sm">
                <div class="col-sm-10 col-sm-offset-1">
                  <p class="lh1-7 text-normal" style="font-size: 1.15em; color: #5d5d5d">Your {type of plan} Account initiated on {add initiation date} has expired on {add expiration date}.
                    To continue enjoying your end-to-end recruitment experience on SeamlessHiring, go to the payment page.
                  </p>
                  <h1 class="text-center hidden">
                    <span class="fa fa-5x fa-stack">
                      <i class="fa fa-ban fa-stack-2x"></i>
                      <i class="fa fa-users fa-stack-1x"></i>
                    </span>
                  </h1>
                </div>
              </div>
                <div class="row">
                  <hr class="no-top-margin">
                  <div class="col-sm-4 col-sm-offset-4">
                    <a href="#" class="btn btn-success btn-block">Go to Payment Page &nbsp; <i class="fa fa-arrow-right"></i></a>
                  </div>
                  <div class="clearfix"></div>
                  <hr style="margin-bottom: 0">
                </div>


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
              <p><img src="https://cdn.insidify.com/dist/img/logos/seamlesshiring.svg" alt="" width="250px"> </p>
              <p>&copy; <?php echo date('Y') ?>. SeamlessHiring</small></p>
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
