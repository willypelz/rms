@extends('layout.template-user')

@section('content')
 <section class="s-div dark">
        <div class="container">

            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="">
                        <h1 class="text-white"> <i class="fa fa-check"></i> Payment Successful &nbsp;</h1>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section class="no-pad">
            <!-- Page Content -->
    <div class="container">
      <div class="row"><br>
        <div class="col-md-6 col-md-offset-3">
        
                            <div class="alert alert-info ">
                            <strong>Confirmation:</strong>
                                A confirmation email has been sent to your
                                email.<br>
                                Thank you for your registration.
                            </div>
            <div class="separator separator-sm hidden-xs"></div>

       <div class="well">
                     <div class="row"><br>
            <div class="col-md-12">
            <p class="lead">Explanation on payment</p>
              <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tes quaerat sapiente quibusdam.</p>
            <hr>
            <div class="col-xs-6">
              <a href="dashboard.php"><img src="pay1.png" alt="" width="100%"></a>
            </div>
            <div class="col-xs-6">
              <a href="dashboard.php"><img src="pay1.png" alt="" width="100%"></a>
            </div>
            <div class="col-xs-6">
              <a href="dashboard.php"><img src="pay1.png" alt="" width="100%"></a>
            </div>
            <div class="col-xs-6">
              <a href="dashboard.php"><img src="pay1.png" alt="" width="100%"></a>
            </div>
            <div class="clearfix">
              <br>
            </div>
            <hr>
            </div>
            
            <div class="col-md-6 col-md-offset-3">
              <div class="controls text-center">
                  <a href="{{ url('dashboard') }}" class="btn btn-success btn-block">Proceed to DashBoard &raquo;</a> 
              </div>
            </div>
       </div>
                 </div>
            <br>
                 
                 </div>
        
        </div>
      </div>
    </div>
    <!-- /.container -->
    </section>
<div class="separator separator-small"></div>
@endsection