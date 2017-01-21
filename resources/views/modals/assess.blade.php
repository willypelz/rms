<div class="row">
      <div class="col-xs-7 scroll-450">
          <div class="">
              
              
                  <div class="panel panel-default">
                      
                            <div class="panel-heading">
                                <h3 class="panel-title">Options</h3>
                            </div>

                        
                          @if(count($products) > 0)
                              @foreach($products as $product)
                                @if( $product->service->type == $section )
                                  <div class="panel-body" data-id="{{ $product->id }}">

                                    <div class="row">
                                        <div class="media small">
                                            <div class="col-xs-9">
                                                <div class="media-left pull-left" style="padding-right: 20px;">
                                                    <a href="#">
                                                        <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="{{ $product->provider->logo }}" data-holder-rendered="true" style="width: 100px; ">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="media-heading">{{ $product->name }}</h5>
                                                    {{ $product->summary }} 
                                                </div>
                                            </div>
                                            <div class="col-xs-3">
                                                <p>₦{{ $product->cost }} </p>
                                                <button class="btn btn-sm btn-success" id="request-btn"  data-amount="{{ $product->cost }}"  data-title="{{ $product->name  }}"  data-id="{{ $product->id  }}" data-owner="{{ $product->ats_provider_id  }}">
                                                    Request
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                              @endif
                            @endforeach
                          @endif
                        </div>
                  
          </div>
      </div>
      <div class="col-xs-5">
          <h5>Selected Applicant</h5>
         <div class="scroll-150">
          
              {!! @$applicant_badge !!}  
          
          
          </div>

          <!--<a class="btn btn-xs pull-right">-->
              <!--<i class="fa fa-plus fa-lg"></i> Add Applicant-->
          <!--</a>-->
          <div class="clearfix"></div>
          <hr>
          <div>
              <h5>Your Cart</h5>
              <table class="table table-condensed" >
                  <thead>
                  <tr>
                      <th>Your Selection</th>
                      <th>Cost (₦)</th>
                      <th></th>
                  </tr>
                  </thead>
                  <tbody id="cart-preview">
                  
                  </tbody><thead>
                  <tr>
                      <th>Total</th>
                      <th id="cart-total">0</th>
                      <th> &nbsp; </th>
                  </tr>
                  </thead>
                  
              </table>
              @if(!@$test_available)
                <a class="btn btn-danger pull-right" id="request-check">Proceed to Checkout &nbsp;<i class="fa fa-external-link"></i></a>
              @endif
              <!--<a class="btn btn-sm pull-left btn-line">Clear Selection &nbsp;<i class="fa fa-refresh"></i></a>-->
              <div class="clearfix"></div>
              <hr>
          </div>
        

          @if(@$test_available)
          <form>
              <h5>Test Details</h5>
              <div class="form-group">
                  <!--<label>Location</label>-->
                  <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                      <input type="text" required class="form-control" id="test-location" aria-describedby="" placeholder="Location">
                  </div>
                  <!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
                  <!--<span id="inputGroupSuccess1Status" class="sr-only">(success)</span>-->
              </div>
              <div class="form-group">
                  <!--<label>Location</label>-->
                  <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <input type="date" required class="datepicker form-control" id="test-start" aria-describedby="" placeholder="Open Date">
                  </div>
              </div>
              <div class="form-group">
                  <!--<label>Location</label>-->
                  <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <input type="date" required class="datepicker form-control" id="test-end" aria-describedby="" placeholder="Close Date">
                  </div>
              </div>
              <input type="submit" class="btn btn-success pull-right" id="request-test" value="Request Test">
              <div class="clearfix"></div>
          </form>
          <!--<hr>-->
          <!--<a class="btn btn-primary btn-block">Check for another Applicant</a>-->
          @endif
      </div>
  </div>


<script src="https://checkout.simplepay.ng/v2/simplepay.js"></script>


  <script type="text/javascript">

    $(document).ready(function(){

        var app_ids = <?php echo json_encode($app_ids );?>  ;
        var cv_ids = <?php echo json_encode($cv_ids );?> ;

        $('body #request-btn').on('click', function(){
          $('#cart-preview').append('<tr data-id="' + $(this).attr('data-id') +'" data-owner="' + $(this).attr('data-owner') +'"><td id="name">' + $(this).attr('data-title') +'</td><td id="amount">' + $(this).attr('data-amount') + " x " + {{ $count }} + ' </td><td class="text-right"><a href="javascript://" id="delete-request"><i class="fa fa-times-circle text-danger"></i> </a></td></tr>');
          $(this).calculateCartTotal();
          // $(this).closest('.panel-body').fadeOut();
          $(this).prop('disabled','disabled').text('Requested');
        });
        
        $('body').on('click','#delete-request',function(){
            console.log( $('.panel-body[data-id="' + $(this).closest('tr').data('id') + '"]') );
            $('.panel-body[data-id="' + $(this).closest('tr').data('id') + '"] #request-btn').prop('disabled','').text('Request');
            $(this).closest('tr').remove();
            $(this).calculateCartTotal();
        });

        $.fn.calculateCartTotal = function(){
          var total = 0;
          $('#cart-preview #amount').each(function( index ) {
              total += parseInt( $( this ).text() ) * parseInt( {{ $count }} );
          });

            $('#cart-total').text(  total  );



            
        }
        
        $('#request-test').on('click', function(event){

          event.preventDefault(); 

            var tests = [];

           var tot = 0;

            $('#cart-preview tr').each(function( index ) {
                // $.extend(tests,{
                //     id: $(this).attr('data-id'),
                //     name: $(this).find('#name').text()
                // });
                tot +=  Number($(this).find('#amount').text());
                tests.push({
                    id: $(this).attr('data-id'),
                    name: $(this).find('#name').text(),
                    owner: $(this).attr('data-owner'),
                    cost: $(this).find('#amount').text(),
                });
            });

            var data = {
                location : $('#test-location').val(),
                start_time : $('#test-start').val(),
                end_time : $('#test-end').val(),
                app_ids: app_ids,
                cv_ids: cv_ids,
                job_id: "{{ $appl->job->id }}",
                total_amount: tot,
                type: 'Test',
                tests : tests
                // test_id: 
                // test_name: 
                // test_owner:
            };

            $.post('{{ route("request-test") }}', data, function(res){
                // $( '#viewModal' ).modal('toggle');
                 // console.log(res);
                loadSimplePay(res.total_amount, res.order_id)
            });

            console.log(data);
        });

        $('#request-check').on('click', function(){

            var checks = [];
            
           var tot = 0;
           // console.log(tot);

            $('#cart-preview tr').each(function( index ) {
                // $.extend(tests,{
                //     id: $(this).attr('data-id'),
                //     name: $(this).find('#name').text()
                // });
                tot +=  Number($(this).find('#amount').text());
                checks.push({
                    id: $(this).attr('data-id'),
                    name: $(this).find('#name').text(),
                    owner: $(this).attr('data-owner'),
                    cost: $(this).find('#amount').text(),
                });
            });

            var data = {                
                app_ids: app_ids,
                cv_ids: cv_ids,
                job_id: "{{ $appl->job->id }}",
                checks : checks,
                service_type: "{{ $section }}",
                total_amount: tot,
                type: 'Background Check'
                // test_id: 
                // test_name: 
                // test_owner:
            };

            $.post('{{ route("request-check") }}', data, function(res){
              //  $.post('{{ route("checkout") }}', data, function(){
                  console.log(res);
                  loadSimplePay(res.total_amount, res.order_id)
              // });
                      $("#viewModal").html('{!! preloader() !!}');
            });

           

            console.log(data);
        });


        // SimplePay Configuration

        function loadSimplePay(total_amount, order_id){
           var handler = SimplePay.configure({
                 token: processPayment, // callback function to be called after token is received
                 key: 'test_pu_6afdbcd91aa446ecb7f79a2f29c2b530', // place your api key. Demo: test_pu_*. Live: pu_*
                 image: 'http://' // optional: an url to an image of your choice
              });

          handler.open(SimplePay.CHECKOUT, // type of payment
              {
                 email: 'me@ayolana.com', // optional: user's email
                 phone: '+2348038953794',
                 description: 'Payment for Background Checks', // a description of your choosing
                 // address: '', // user's address
                 // postal_code: '110001', // user's postal code
                 // city: '', // user's city
                 country: 'NG', // user's country
                 amount: total_amount+'00', // value of the purchase, ₦ 1100
                 currency: 'NGN' // currency of the transaction
              });


              function processPayment (token) {

                console.log('Token is '+token+' and order_id is '+order_id);
                var url ="{{ route('simplepay') }}"
                  $.ajax
                    ({
                        type: "POST",
                        url: url,
                        data: ({ rnd : Math.random() * 100000, token:token }),
                        success: function(response){
                             console.log(response)

                             if(response != null){
                                 var oldurl = "{{ route('transactions') }}";

                                 $.ajax
                                  ({
                                      type: "POST",
                                      url: oldurl,
                                      data: ({ jsonres:response, order_id:order_id, status:true, message:'Transaction Successful', "_token":"{{ csrf_token() }}"}),
                                      success: function(response){
                                        console.log(response);
                                        // $("#paymemt-success").html('Payment Successful');
                                        // window.location = "{{ url('payment_successful') }}";
                                          $( '#viewModal' ).modal('toggle');
                                          $( '#paymentSuccess' ).html('Payment Successful');
                                          sh.reloadStatus();
                                        setTimeout(function(){
                                          $( '#paymentSuccess' ).html('');
                                        }, 3000);

                                      }
                                  });
                             }
                        }
                    });

              }


        } 


         













    });

  </script>

  <!-- <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script> -->