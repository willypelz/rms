<style type="text/css">
  .bootstrap-datetimepicker-widget.dropdown-menu {
    width: auto !important;
}
</style>

<div class="row" id="cont">
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
                                                    <h5 class="media-heading"><strong>{{ $product->name }}</strong></h5>
                                                    {{ $product->summary }} 
                                                </div>
                                            </div>
                                            <div class="col-xs-3">
                                                <p style="display:none;">₦{{ $product->cost }} </p>
                                                <button class="btn btn-sm btn-success" id="request-btn"  data-amount="{{ $product->cost }}"  data-title="{{ $product->name  }}"  data-id="{{ $product->ats_service_id  }}" data-owner="{{ $product->ats_provider_id  }}">
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
                      <!-- <th>Cost (₦)</th> -->
                      <!-- <th></th> -->
                  </tr>
                  </thead>
                  <tbody id="cart-preview">
                  
                  </tbody><thead>
                  <tr>
                      <!-- <th>Total</th> -->
                      <th id="cart-total" style="display:none;" >0</th>
                      <!-- <th> &nbsp; </th> -->
                  </tr>
                  </thead>
                  
              </table>
              @if(!@$test_available)
                <a class="btn btn-danger pull-right" id="request-check" disabled="disabled">Proceed to Checkout &nbsp;<i class="fa fa-external-link"></i></a>
              @endif
              <!--<a class="btn btn-sm pull-left btn-line">Clear Selection &nbsp;<i class="fa fa-refresh"></i></a>-->
              <div class="clearfix"></div>
              <hr>
          </div>
        

          @if(@$test_available)
          <form>
              <h4 class="text-center"><strong>Test Details</strong></h4>
              <div class="form-group">
                  <label>Location</label>
                  <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                      <input type="text" required class="form-control" value="Online" id="test-location" aria-describedby="" placeholder="Location">
                  </div>
                  <!--<span class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>-->
                  <!--<span id="inputGroupSuccess1Status" class="sr-only">(success)</span>-->
              </div>
              <div class="form-group">
                  <label>Tests Available From</label>
                  <div class="input-group date" id='datetimepicker1'>
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <input type="text" required class="form-control" value="{{ date('D, d/m/Y', strtotime('+ 1 day')) }}" id="test-start" aria-describedby="" placeholder="Open Date">
                  </div>
              </div>
              <div class="form-group">
                  <label>Tests Available Till</label>
                  <div class="input-group date" id='datetimepicker2'>
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <input type="text" required class=" form-control" value="{{ date('D, d/m/Y', strtotime('+ 1 week')) }}" id="test-end" aria-describedby="" placeholder="Close Date">
                  </div>
              </div>
              <input type="submit" class="btn btn-success pull-right" id="request-test" disabled="disabled" value="Request Test">
              <div class="clearfix"></div>
          </form>
          <!--<hr>-->
          <!--<a class="btn btn-primary btn-block">Check for another Applicant</a>-->
          @endif
      </div>
  </div>

  <input type="button" class="btn btn-danger pull-right" id="pay"  value="PAY NOW" style="display:none;">
  <div class="clearfix"></div>


<script src="https://checkout.simplepay.ng/v2/simplepay.js"></script>
<script type="text/javascript" src=" {{ asset('js/moment.min.js') }} "></script>
<script type="text/javascript" src=" {{ asset('js/bootstrap-datetimepicker.min.js') }} "></script>
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datetimepicker.min.css') }} ">
<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker({ format: 'YYYY-MM-DD HH:mm:ss' });
        $('#datetimepicker2').datetimepicker({ format: 'YYYY-MM-DD HH:mm:ss' });
    });
</script>

  <script type="text/javascript">

    $(document).ready(function(){

        var app_ids = <?php echo json_encode($app_ids );?>  ;
        var cv_ids = <?php echo json_encode($cv_ids );?> ;
        var type = "{{ $type }}";
        var has_invoice = false;

        var tests = [];
        var checks = [];

        var total_amount, order_id,type_ids,invoice_no;

        $('body #request-btn').on('click', function(){
          $('#cart-preview').append('<tr data-id="' + $(this).attr('data-id') +'" data-owner="' + $(this).attr('data-owner') +'"><td id="name">' + $(this).attr('data-title') +'</td><td ><span id="amount">' + "</span> " + ' </td><td class="text-right"><a href="javascript://" id="delete-request"><i class="fa fa-times-circle text-danger"></i> </a></td></tr>');
          // $('#cart-preview').append('<tr data-id="' + $(this).attr('data-id') +'" data-owner="' + $(this).attr('data-owner') +'"><td id="name">' + $(this).attr('data-title') +'</td><td ><span id="amount">' + $(this).attr('data-amount') + "</span> x " + {{ $count }} + ' </td><td class="text-right"><a href="javascript://" id="delete-request"><i class="fa fa-times-circle text-danger"></i> </a></td></tr>');
          $(this).calculateCartTotal();
          // $(this).closest('.panel-body').fadeOut();
          $(this).prop('disabled','disabled').text('Requested');

          $('#request-test').removeAttr('disabled');
          $('#request-check').removeAttr('disabled');


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


            if( total == 0 )
            {
              $('#request-test').prop('disabled','disabled');
              $('#request-check').prop('disabled','disabled');
            }

            
        }
        
        $('#request-test').on('click', function(event){

          event.preventDefault(); 

            


           var tot = 0;

           if( $('#test-start').val() == "" || $('#test-end').val() == "" )
           {
              $.growl.error({ message: "Select Date" });
           }
           else
           {
              $(this).attr('disabled','disabled');

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
                total_amount: tot * parseInt( {{ $count }} ),
                type: type,
                tests : tests
                // test_id: 
                // test_name: 
                // test_owner:
            };

            $.post('{{ route("request-test") }}', data, function(res){
               
                // total_amount = ( parseInt( res.total_amount ) * 0.05 ) + parseInt( res.total_amount );
                // order_id = res.order_id;
                // type_ids = res.type_ids;
                // doPayment(total_amount, order_id, type_ids);
                // 
                
                  $( '#viewModal' ).modal('toggle');
                $.growl.notice({ message: " Test requested" });
                sh.reloadStatus();

            });

           }


            


        });

        $('#request-check').on('click', function(event){
            event.preventDefault(); 

            $(this).attr('disabled','disabled');
            
            
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
                total_amount: tot * parseInt( {{ $count }} ),
                type: type
                // test_id: 
                // test_name: 
                // test_owner:
            };

            $.post('{{ route("request-check") }}', data, function(res){

              //  $.post('{{ route("checkout") }}', data, function(){
                // $('.modal-body').html('{!! preloader() !!}');
                total_amount = ( parseInt( res.total_amount ) * 0.05 ) + parseInt( res.total_amount );
                order_id = res.order_id;
                type_ids = res.type_ids;
                doPayment(total_amount, order_id, type_ids);
              // });
                      // $("#viewModal").html('{!! preloader() !!}');
            });

           


        });

        function doPayment(total_amount, order_id,type_ids)
        {
          if(has_invoice)
          {
            loadSimplePay(total_amount, order_id);  
          }
          else
          {
            console.log('First total ' + total_amount);
            $.ajax
                    ({
                        type: "POST",
                        url: "{{ route('show-invoice-pop') }}",
                        data: ({ rnd : Math.random() * 100000 ,type_ids: type_ids, job_id: "{{ $appl->job->id }}", type : type, status : 'UNPAID' , count: {{ $count }} }),
                        success: function(response){

                          $( '#cont' ).html( response.html );
                          $('#pay').show();
                          has_invoice = true;
                          invoice_no = response.invoice_no; 
                          $("#viewModal .close").hide();
                          $("#viewModal .modal-title").text('Invoice');
                          // $this.find('.text').text( 'PAY NOW' );
                          // $('#dashboard').text( 'Go to Dashboard' );
                        }
                    });

          }
        }

        $('#pay').on('click', function(){
            doPayment(total_amount, order_id,type_ids);
        });


        // SimplePay Configuration

        function loadSimplePay(total_amount, order_id){
           var handler = SimplePay.configure({
                 token: processPayment, // callback function to be called after token is received
                 key: 'test_pu_6afdbcd91aa446ecb7f79a2f29c2b530', // place your api key. Demo: test_pu_*. Live: pu_*
                 // image: 'https://seamlesshiring.com/img/seamlesshiring-logo.png' // optional: an url to an image of your choice
              });

          handler.open(SimplePay.CHECKOUT, // type of payment
              {
                 email: 'me@ayolana.com', // optional: user's email
                 phone: '+2348038953794',
                 description: 'Payment for ' + type.replace("_", " "), // a description of your choosing
                 // address: '', // user's address
                 // postal_code: '110001', // user's postal code
                 // city: '', // user's city
                 country: 'NG', // user's country
                 amount: total_amount * 100, // value of the purchase, ₦ 1100
                 currency: 'NGN' // currency of the transaction
              });
            console.log( total_amount , total_amount * 100 );

              function processPayment (token, paid) {

                console.log(token, paid, type);

              

                var url ="{{ route('simplepay') }}"
                  $.ajax
                    ({
                        type: "POST",
                        url: url,
                        data: ({ rnd : Math.random() * 100000, token:token, status: paid, amount: SimplePay.amountToLower( total_amount ), currency : 'NGN', app_ids:app_ids, tests:tests, invoice_no:invoice_no, type:type  }),
                        success: function(response){
                            sh.reloadStatus();
                            $( '#viewModal' ).modal('toggle');
                            $("#viewModal .close").show();
                            if( response == "true" )
                            {
                              $.growl.notice({ message: "Payment Successful " });
                            }
                            else
                            {
                              $.growl.error({ message: "Payment Unsuccessful " });
                            }



                             /*if(response != null){
                                 var oldurl = "{{ route('transactions') }}";

                                 $.ajax
                                  ({
                                      type: "POST",
                                      url: oldurl,
                                      data: ({ jsonres:response, order_id:order_id, status:true, message:'Transaction Successful', "_token":"{{ csrf_token() }}"}),
                                      success: function(response){
                                        console.log(2,response);

                                          // $( '#viewModal' ).modal('toggle');
                                          // $( '#paymentSuccess' ).html('Payment Successful');
                                          sh.reloadStatus();
                                        setTimeout(function(){
                                          $.growl.notice({ message: "Payment Successful " });
                                        }, 1000);

                                      }
                                  });
                             }*/
                        }
                    });

              }


        } 



    });

  </script>

  <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>