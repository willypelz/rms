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
                  <h4 class="text-brandon l-sp-5 text-uppercase">Job Team Accept Page </h4>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </section>
          <div class="white">
            <div class="col-sm-12">
              <div class="row pad-v-sm">
                <div class="col-sm-10 col-sm-offset-1">
                  <p class="lh1-7 text-normal" style="font-size: 1.15em; color: #5d5d5d">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Animi deserunt, enim et explicabo maiores molestias nisi quisquam saepe sequi totam. Aut beatae
                    corporis ducimus enim, ipsa ipsum laudantium magnam quos recusandae reprehenderit saepe tempore</p>
                </div>
              </div>
                <div class="row">
                  <hr>
                  <div class="col-sm-3 col-sm-offset-3">
                    <a href="" class="btn btn-success btn-block">Action 1</a>
                  </div>
                  <div class="col-sm-3">
                    <a role="button" data-toggle="collapse" href="#loginForm" class="btn btn-primary btn-block"> Action 2</a>
                  </div>
                  <div class="clearfix"></div>
                  <hr style="margin-bottom: 0">
                </div>
                <div class="row">
                    <form action="" class="collapse pad-v-sm" id="loginForm" style="background: #F1F3F5;border-bottom: 1px solid #bbb">
                      <div class="col-sm-6 col-sm-offset-3">
                      <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" class="form-control" placeholder="Enter Email">
                      </div>
                      <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" placeholder="Enter password">
                      </div>
                      <div class="form-group">
                        <label for="">Retype Password</label>
                        <input type="password" class="form-control" placeholder="Re-Enter password">
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
