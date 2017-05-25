@extends('layout.template-default')

@section('content')
  <section class="email-v">
    <div class="container">
      <div class="row">
        <div class="pad pad-md col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 white">
          <div class="text-center text-muted">
            <br><br><br>
            <h1>Lorem ipsum dolor sit amet, consectetur adipisicing.</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aperiam eaque eligendi facilis illo ipsam
              itaque, labore laboriosam minima mollitia, nam, nisi ratione soluta voluptatibus.</p>
            <img src="//placehold.it/500x500" alt="" height="300" width="300">
            <br><br>
            <a href="#" class="btn btn-primary btn-lg">Action 1</a>
            <button type="button" class="btn btn-primary btn-lg" data-toggle="collapse" data-target="#someForm">Action 2</button>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
              <div id="someForm" class="well collapse" data-toggle="collapse">
                <form action="">
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
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endsection