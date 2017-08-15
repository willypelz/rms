@extends('layout.template-default')

@section('content')


  <section class="s-div homepage" style="background: #10588a fixed bottom url(img/office-interior.jpg);">
         <div class="container">

            <div class="row text-center text-light text-white">

                <div class="col-sm-10 col-sm-offset-1">
                <div class="separator separator-small"></div>
               <img src="{{ url('/') }}/img/talent.png" width="250px" class="" alt=""><hr>
                    <h1 class=" text-brandon "> 
                    
                    Seamless Talent Sourcing</h1><hr>
<!--                    <hr>-->
                    <p class="lead">We sit on one of the largest talent databases in the country, with the combination of SeamlessHiring.com and Insidify.com.</p>
                    <br><br>
                </div>
            </div>

        </div> 
    </section>


  <section class="white" style="">
        <div class="container">
            <div class="row">

                <div class="col-sm-5 col-sm-offset-1 text-right">
                <h2 class="text-capitalize"> cutting-edge technologies</h2><hr>
                   <p class="lead text-muted">Drawing from these databases, and several layers of cutting-edge technologies for finding and testing candidates, we are able to help you fill any role within your organization with the best fit, in record time.</p>
                    
                </div>
                <div class="col-sm-5 text-center"><br>
                    <img src="{{ url('/') }}/img/server.png" width="55%" class="" alt="">
                </div>
            </div>
        </div>
    </section>

  <section class="grey" style="">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text-center">
                 <i class="fa fa-rocket fa-4x"></i><br> 
                <h2>Our Approach</h2><hr>
                   <p class="lead text-muted">We understand the importance of getting it right with talent. Your people

are arguably the most important resource your organization owns. Because

of this, we take talent sourcing very seriously.

This is how we see it. When you entrust your talent search on us, it is a

“sacred” responsibility. We do not rest until we find the most perfect fit for

you.</p>
                </div>
            </div>
        </div>
    </section>


  <section class="white" style="">
        <div class="container">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                <h2 class=" text-center"> Our Processes</h2><hr>
                   <div class="col-sm-3">
                       <div class="list-group">
                          <a class="list-group-item active">
                            Brief Definition <i class="pull-right fa fa-arrow-right"></i>
                          </a>
                          <a class="list-group-item">Need assessment</a>
                          <a class="list-group-item">Job description crafting</a>
                          <a class="list-group-item">Company culture profiling</a>
<!--                          <a href="#" class="list-group-item">...</a>-->
                        </div>
                   </div>
                   <div class="col-sm-3">
                       <div class="list-group">
                          <a class="list-group-item active">
                            Candidate Search <i class="pull-right fa fa-arrow-right"></i>
                          </a>
                          <a class="list-group-item">Database mining</a>
                          <a class="list-group-item">Extensive networking</a>
                          <a class="list-group-item">Longlisting</a>
<!--                          <a href="#" class="list-group-item">...</a>-->
                        </div>
                   </div>
                   <div class="col-sm-3">
                       <div class="list-group">
                          <a class="list-group-item active">
                            Candidate Evaluation <i class="pull-right fa fa-arrow-right"></i>
                          </a>
                          <a class="list-group-item">IQ/Personality testing</a>
                          <a class="list-group-item">Role based testing</a>
                          <a class="list-group-item">2 step interview</a>
                          <a class="list-group-item">Shortlisting</a>
<!--                          <a href="#" class="list-group-item">Search Closure.</a>-->
                        </div>
                   </div>
                   <div class="col-sm-3">
                       <div class="list-group">
                          <a href="#" class="list-group-item active">
                            Client Review &amp; Closure 
                          </a>
                          <a class="list-group-item">Client Interview</a>
                          <a class="list-group-item">Background checks</a>
                          <a class="list-group-item">Offer and Negotiation</a>
                          <a class="list-group-item">Placement</a>
                          <a class="list-group-item">Search Closure</a>
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="s-div text-white" id="talentForm">
        <div class="container">
            <div class="row">
                
                   <div class="col-sm-8 col-sm-offset-2 text-center">

                      <div class="well transparent">
                        <div class="">
                          <h2 class="text-center text-brandon">
                            Start Sourcing
                          </h2>
                          <p>Kindly provide all details below. We shall reach you within 24hrs</p><br>
                          
                          <form action="" method="post" name="talent-source-form" id="talent-source-form">
                            @include('layout.alerts')
                            <div class="form-group col-md-6">
                              <label for="name" class="fa-inverse">Name</label>
                              <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="name" class="fa-inverse">Company Name</label>
                              <input type="text" class="form-control" name="company_name" id="company_name" required>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="name" class="fa-inverse">Role</label>
                              <input type="text" class="form-control" name="role" id="role" required>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="name" class="fa-inverse">Phone Number</label>
                              <input type="number" class="form-control" name="phone_number" id="phone_number" required>
                            </div>
                            <div class="form-group col-md-12">
                              <label for="name" class="fa-inverse">Email</label>
                              <input type="email" class="form-control" name="email" id="email" required>
                            </div>
                            <div class="form-group col-md-12">
                              <label for="name" class="fa-inverse">Vacant Position</label>
                              <textarea placeholder="separate each vacany with a comma ( , )" name="vacant_position" id="vacant_position" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="form-group col-md-12">
                             @include('layout.alerts')
                            </div>
                            
                            <div class="form-group col-md-12">
                              <input type="button" id="talent-sourcing-btn" class="btn btn-lg btn-success" value="Submit">
                            </div>
                          </form>
                        </div>
                        <div class="clearfix"></div>
                      </div>
                       <h3><i class="fa fa-star-o"></i>
                       <i class="fa fa-star-o"></i>
                       <i class="fa fa-star-o"></i><br>
                       <br>The 3 month Pledge.</h3>
                   <p class="lead">

If you have any reason to decline a candidate we sourced for you within 3

months of resumption, we will replace the candidate at no cost to you.
                   </p>
                   <br>
                   </div>
            </div>
        </div>
    </section>


    <script type="text/javascript">
      $(document).ready( function(){

          $('#talent-sourcing-btn').on('click', function(){
              $this = $(this);
              var data = {
                'name' : $('#name').val(),
                'company_name' : $('#company_name').val(),
                'role' : $('#role').val(),
                'phone_number' : $('#phone_number').val(),
                'email' : $('#email').val(),
                'vacant_position' : $('#vacant_position').val(),
              }

              $this.attr('disabled','disabled');
              $.post('{{ route("talent-source") }}', data, function(response){
                  response = JSON.parse( response );
                  $this.removeAttr('disabled');
                  if( response.status )
                  {
                    $('body #success').html('Request Sent Sucessfully').fadeIn();
                    setTimeout( "$('body #success').html('').fadeOut()"  ,5000);
                  }
                  else
                  {
                    $('body #error').html('Request could not be sent, Please try again later').fadeIn();
                    setTimeout( "$('body #error').html('').fadeOut()"  ,5000);
                  }

              }); 

          });

          
      });
    </script>


@endsection