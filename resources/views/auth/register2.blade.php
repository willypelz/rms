@extends('layout.template-default')


@section('navbar')
    
@show()
@section('content')
<style>
    
    body{
        background:url('img/intro-bg.jpg') no-repeat fixed ;
        background-size:cover;
    }

</style>
    <section>
        <div class="container">
            <div class="row">

                <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 text-center">
                    <h2>Company Details</h2>
                    <!-- <p class="text-muted">Africa's fastest growing network of professionals</p> -->
                </div>

                <div class="col-sm-10 col-sm-offset-1">

                    <div class="white padbox rounded">


                        <form role="form" class="form-signup" action="dashboard.php">

                            <div class="row"><br>

                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <label for=""><i class="fa fa-building"></i> Company name</label>
                                        <input type="text" class="form-control" id="" placeholder="">
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for=""><i class="fa fa-envelope"></i> Company email address</label>
                                                <input type="email" class="form-control" id="" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for=""><i class="fa fa-phone"></i> Company Phone Number</label>
                                                <input type="email" class="form-control" id="" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="col-sm-3">
                                <label for=""><i class="fa fa-circle"></i> company logo <span class="text-danger">*</span></label>
                                    <div class="well company-logo small text-center" role="company-logo">
                                        Attach your company logo here<br><br>
                                        <a href="" class="btn btn-block btn-line">Attach a file</a>
                                    </div>
                                </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for=""><i class="fa fa-bars"></i> Description</label>
                                    <textarea class="form-control" placeholder="Company Description" style="height: 150px" ></textarea>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for=""><i class="fa fa-map-marker"></i> Address / Location</label>
                                    <textarea class="form-control" placeholder="Company Address" style="height: 100px" ></textarea>
                                </div>
                            </div>

                            </div>

                            <div class="row">
                                <!-- <span class="hidden-xs"><br></span> -->
                                <!-- <div class="col-sm-6 text-muted">
                                    By clicking "Sign Up", you agree with our <a href="#">Terms & Conditions</a>
                                <span class="visible-xs"><br></span>
                                </div> -->

                                <div class="col-sm-4 col-sm-offset-8">
                                    <button type="submit" class="btn btn-success btn-block">
                                    <i class="fa fa-check"></i> &nbsp; FINISH</button>
                                </div>

                                <!-- <div class="col-sm-12">
                                    <hr>
                                </div>

                                <div class="col-xs-12 text-center">
                                    <p>Already registered? <a href="signin.php">Sign In Here</a></p>
                                </div> -->

                            </div>
                        </form>

                    </div>
                    <!--/tab-content--><div class="row"><br>
                        <p class="text-center text-brandon">&copy; {{ date('Y') }}. SeamlessHiring</p>
                    </div>

                </div>
                    
            </div>
        </div>
    </section>
@endsection

@section('footer')
        
@endsection