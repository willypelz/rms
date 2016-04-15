<script src="https://checkout.simplepay.ng/simplepay.js"></script>

 @if(!empty($jobBoards))

    <script src="https://paystack.ng/js/inline.js"></script>

 <section class="no-pad">
                <div class="">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="content rounded">

                            
         
                            <div class="alert alert-info text-center">If you choose to make payment directly to our bank account by visiting a bank physically or via online transfer, do ensure to
                            send a mail to billing@insidify.com stating the details of your payment.
                            </div>

                            <div class="well">

                                <div class="col-xs-6">

                                    <strong>Invoiced To</strong><br>
                                    {{ $company->name }},<br>{{$company->phone}}<br>
                                    {{ $company->address }}

                                </div>
                                <div class="col-xs-6">

                                    <strong>Pay To</strong><br>
                                    Account Name: Insidify Limited<br>
                                    Account No: 0114023729<br>
                                    Bank: Guaranty Trust Bank (GTB)<br>
                                    OR<br>
                                    Account No: 1013173318<br>
                                    Bank: Zenith Bank<br>
                                    TIN: 12001705-0001
                                </div>
                                <div class="clearfix">
                                
                                </div>

                            </div>

                        
                        <div class="col-sm-12">
                        <br>
                        <div class="">
                            <span class="title">Invoice #80186</span><br>
                            Invoice Date: 11/09/2015<br>
                            Due Date: 25/09/2015
                        </div>

                            <br>
                            <table class="table table-striped table-bordered">
                                <tbody>
                                <thead class="title textcenter">
                                    <tr>
                                        <td>Description</td>
                                        <td>Amount</td>
                                    </tr>
                                </thead>
                            
                              
                                <?php $total=0; ?>
                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $item->name }} *</td>
                                    <td class="textcenter">{{ $item->price }}</td>
                                </tr>
                                <?php $total += $item->price;
                                 ?>
                             @endforeach 
                             <?php 
                             $vat = (5 / 100) * $total; 

                             ?>  <tr class="title">
                                    <td class="text-right">Sub Total:</td>
                                    <td class="textcenter">&#8358;{{ $total }}</td>
                                </tr>
                                    <tr class="title">
                                    <td class="text-right">5.00% VAT:</td>
                                    <td class="textcenter">&#8358;{{ $vat }}</td>
                                </tr>
                                      
                                <tr class="title">
                                    <td class="text-right">Total:</td>
                                    <td class="textcenter">N{{ $total }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix">
                        
                        </div>
                    <!-- <a class="btn btn-line">Cancel Order</a> -->
                        <div class="col-sm-12">
                            <form method="post" action="{{ route('payment') }}" id="BoardPaymentForm">
                                Bank Transfer/Deposit: <input type="radio" name="payment_option" value="bank" required><br>
                                Pay Online via Paystack: <input type="radio" name="payment_option" value="paystack"><br>
                                    <input type="hidden" name="order_id" value="{{ $order_id }}">
                                    <input type="hidden" name="amount" value="{{ $total }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="cart_type" value="jobBoards">
                                <input type="submit" class="btn btn-success pull-right" value="Pay">
                        <div class="separator separator-small"></div>

                            </form>
                        </div>
                   <!--  <div class="col-sm-12 text-center">
                        <a href="payment-success.php" class="btn btn-success pull-right">Pay Now</a>
                        <div class="separator separator-small"></div>
                    </div> -->

                    </div>
                </div>

                <script>
                $("#BoardPaymentForm").submit(function(event){

                            event.preventDefault();

                    // var total_amount = "{{ $total }}"
                    var radioo = $('input[name=payment_option]:checked', '#BoardPaymentForm').val()

                    if(radioo == 'bank'){
                        window.location = "{{ route('payment', [$order_id] ) }}";
                    }

                    var total_amount = "{{ $total }}"

                        $("#invoice-response").html('<img src="{{ asset("img/wheel.gif") }}" width="100px" /> please wait... Connecting to payment gateway');
                        setTimeout(pay, 3000);
                });
                
                function pay(){
                // console.log('got here')
                    <?php
                            $uuid = uniqid(true);
                    ?>
                    var ajax_image = "<img src='<?php echo asset('img/faceb.gif') ?>' alt='Loading...' />";

                    var url = "{{ route('transactions') }}";
                    $.ajax
                      ({
                          type: "POST",
                          url: url,
                          data: ({order_id: "{{ $order_id }}", status:false, message:'Transaction Not Found', "_token":"{{ csrf_token() }}"}),
                          success: function(response){
                            // console.log(response) 
                            $('#myInvoice').modal('hide')
                            loadPaystack();
                          }
                      });                    
                }


                    function loadPaystack(){
                        var handler = PaystackPop.setup({
                            key: 'pk_test_7d7271a9f0ca45ac76d8ca1569ea47948e1bb5f5',
                            email: 'info@bus.com.ng',
                            amount: "{{ $total_amount }}",
                            ref: '<?php echo $uuid; ?>',
                            callback: paystackcallback
                        })
                        handler.openIframe()
                    }

                    function paystackcallback(response){

                      $("#paymemt-success").html('<img src="{{ asset("img/wheel.gif") }}" width="100px" /> please wait...');

                      var url = "https://paystack.ng/charge/verification";
                      $.ajax
                        ({
                          type: "POST",
                          url: url,
                          data: ({trxref:response.trxref, merchantid:'pk_test_7d7271a9f0ca45ac76d8ca1569ea47948e1bb5f5'}),
                          success: function(response){
                            var pars = (JSON.parse(response))
                            var resp =(pars.status)

                            if(resp == 'success'){
                                 var oldurl = "{{ route('transactions') }}";

                                 $.ajax
                                  ({
                                      type: "POST",
                                      url: oldurl,
                                      data: ({order_id:"{{ $order_id }}", status:true, message:'Transaction Successful', "_token":"{{ csrf_token() }}"}),
                                      success: function(response){
                                          // conosle.log(response);
                                    $("#paymemt-success").html('Payment Successful');

                                      }
                                  });
                            }
                          }
                      });
                  }


                </script>
</section>




 @else







 <section class="no-pad">
                <div class="">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="content rounded" id="testContent">

                            
         
                            <div class="alert alert-info text-center">If you choose to make payment directly to our bank account by visiting a bank physically or via online transfer, do ensure to
                            send a mail to billing@insidify.com stating the details of your payment.
                            </div>

                            <div class="well">

                                <div class="col-xs-6">

                                     <strong>Invoiced To</strong><br>
                                    {{ $company->name }},<br>{{$company->phone}},<br>
                                    {{ $company->address }}
                                </div>
                                <div class="col-xs-6">

                                    <strong>Pay To</strong><br>
                                    Account Name: Insidify Limited<br>
                                    Account No: 0114023729<br>
                                    Bank: Guaranty Trust Bank (GTB)<br>
                                    OR<br>
                                    Account No: 1013173318<br>
                                    Bank: Zenith Bank<br>
                                    TIN: 12001705-0001
                                </div>
                                <div class="clearfix">
                                
                                </div>

                            </div>

                        
                        <div class="col-sm-12">
                        <br>
                        <div class="">
                            <span class="title">Invoice #80186</span><br>
                            Invoice Date: <?php echo date('Y-m-d') ?><br>
                        </div>

                            <br>
                            <table class="table table-striped table-bordered">
                                <tbody>
                                <thead class="title textcenter">
                                    <tr>
                                        <td>Description</td>
                                        <td>Amount</td>
                                    </tr>
                                </thead>
                            
                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $item->name }}  *</td>
                                    <td class="textcenter">N500.00</td>
                                </tr>
                             @endforeach   
                                <tr class="title">
                                    <td class="text-right">Sub Total:</td>
                                    <td class="textcenter">N{{ $total_amount }}</td>
                                </tr>
                                    <tr class="title">
                                    <td class="text-right">5.00% VAT:</td>
                                    <td class="textcenter"><?php echo ((5/100) * 100) ?></td>
                                </tr>
                                        <tr class="title">
                                    <td class="text-right">Credit:</td>
                                    <td class="textcenter">N0.00</td>
                                </tr>
                                <tr class="title">
                                    <td class="text-right">Total:</td>
                                    <td class="textcenter">N{{ $total_amount }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix">
                        
                        </div>
                    <!-- <a class="btn btn-line">Cancel Order</a> -->
                        <div class="col-sm-12">
                            <form action="{{ route('payment') }}" method="post" id="CvsPaymentForm">
                                Bank Transfer/Deposit: <input type="radio" name="payment_option" value="bank" required><br>
                                Pay Online via SimplePay: <input type="radio" name="payment_option" value="paystack"><br>
                                    <input type="hidden" name="order_id" value="{{ $order_id }}">
                                    <input type="hidden" name="amount" value="{{ $total_amount }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" id="PayBtnn" class="btn btn-success pull-right" value="Pay">
                        <div class="separator separator-small"></div>

                            </form>
                        </div>
                   <!--  <div class="col-sm-12 text-center">
                        <a href="payment-success.php" class="btn btn-success pull-right">Pay Now</a>
                        <div class="separator separator-small"></div>
                    </div> -->

                    </div>
                </div>
</section>

<script>
    
    $("#CvsPaymentForm").submit(function(event){

             event.preventDefault();

                    var radioo = $('input[name=payment_option]:checked', '#CvsPaymentForm').val()

                    if(radioo == 'bank'){
                        window.location = "{{ route('payment', [$order_id] ) }}";
                    }

                    var total_amount = "{{ $total_amount }}"

                        $("#testContent").html('<img src="{{ asset("img/wheel.gif") }}" width="100px" /> please wait... Connecting to payment gateway');
                        setTimeout(pay, 3000);
                });

        function pay(){

            $('#PayBtnn').html('please wait...')
            console.log('SimplePay working fine');

            var url = "{{ route('transactions') }}";
            $.ajax
              ({
                  type: "POST",
                  url: url,
                  data: ({order_id: "{{ $order_id }}", status:false, message:'Transaction Not Found', "_token":"{{ csrf_token() }}"}),
                  success: function(response){
                    console.log(response) 
                    $('#myInvoice').modal('hide')
                    loadSimplePay();
                  }
              });
        }

         function processPayment (token) {
                  // implement your code here - we call this after a token is generated
                  // example:
                 // alert(token)
                 // console.log(token)
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
                                      data: ({order_id:"{{ $order_id }}", status:true, message:'Transaction Successful', "_token":"{{ csrf_token() }}"}),
                                      success: function(response){
                                         console.log(response);
                                        $("#paymemt-success").html('Payment Successful');

                                      }
                                  });
                             }
                        }
                    });



              }



        function loadSimplePay(){
             var handler = SimplePay.configure({
                   token: processPayment, // callback function to be called after token is received
                   key: 'test_pu_6afdbcd91aa446ecb7f79a2f29c2b530', // place your api key. Demo: test_pu_*. Live: pu_*
                   image: 'http://' // optional: an url to an image of your choice
                });

            handler.open(SimplePay.CHECKOUT, // type of payment
                {
                   email: '{{ $company->email }}', // optional: user's email
                   // phone: '+234*', // optional: user's phone number
                   description: 'Payment for Job boards', // a description of your choosing
                   address: '{{ $company->address }}', // user's address
                   postal_code: '110001', // user's postal code
                   // city: '{{ $company->location }}', // user's city
                   country: 'NG', // user's country
                   amount: '{{ $total_amount }}', // value of the purchase, ₦ 1100
                   currency: 'NGN' // currency of the transaction
                });
        }

       

</script>

@endif

