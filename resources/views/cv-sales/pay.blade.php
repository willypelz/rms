@extends('layout.template-user')

@section('content')
<script src="https://checkout.simplepay.ng/v2/simplepay.js"></script>


    <section class="no-pad">
                <div class="">
                    <div class="row">
                        <div class="col-sm-4">
                            <div id="paymemt-success" class="content rounded">

                              @if($type == 'bank')
                                    
                                    <h2>Bank Information</h2>
                                    <strong>Pay To</strong><br>
                                    Account Name: Insidify Limited<br>
                                    Account No: 0114023729<br>
                                    Bank: Guaranty Trust Bank (GTB)<br>
                                    OR<br>
                                    Account No: 1013173318<br>
                                    Bank: Zenith Bank<br>
                                    TIN: 12001705-0001
                              @else
                                    <h2>Payment via Paystack</h2>

                                      <img class="pp-img" src="<?php echo asset('img/simplepay.png') ?>" alt="Image Alternative text" title="Image Title" />
                                      <br>
                                      <!-- <p>Important: You will be redirected to PayPal's website to securely complete your payment.</p> -->
                                      <a onclick="pay()" id="sub_btn" class="btn btn-primary">Checkout via SimplePay</a>   
                              @endif

                            </div>
                        </div>

              <script>

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

                var handler = SimplePay.configure({
                   token: processPayment, // callback function to be called after token is received
                   key: 'test_pu_6afdbcd91aa446ecb7f79a2f29c2b530', // place your api key. Demo: test_pu_*. Live: pu_*
                   image: 'http://' // optional: an url to an image of your choice
                });


              function pay(){

                var url = "{{ route('transactions') }}";
                $.ajax
                  ({
                      type: "POST",
                      url: url,
                      data: ({order_id: "{{ $order_id }}", status:false, message:'Transaction Not Found', "_token":"{{ csrf_token() }}"}),
                      success: function(response){
                        console.log(response) 
                        // loadPaystack();
                      }
                  });

                handler.open(SimplePay.CHECKOUT, // type of payment
                {
                   email: '{{ $company->email }}', // optional: user's email
                   phone: '{{ $company->phone }}', // optional: user's phone number
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


                        <div class="col-sm-8">
                            <div class="content rounded">

                            
         
                            <div class="alert alert-info text-center">If you choose to make payment directly to our bank account by visiting a bank physically or via online transfer, do ensure to
                            send a mail to billing@insidify.com stating the details of your payment.
                            </div>

                            <div class="well">

                                <div class="col-xs-6">

                                    <strong>Invoiced To</strong><br>
                                    bunmifamiloni<br>familoni oluwatayo<br>
                                    mayfair, ile ife, Osun, 234, Nigeria

                                </div>
                                
                                <div class="clearfix">
                                
                                </div>

                            </div>

                  @if(!empty($jobBoards))
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

                  @else
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
                            
                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $item->name }} (25/09/2015 - 24/09/2016) *</td>
                                    <td class="textcenter">N500.00</td>
                                </tr>
                             @endforeach   
                                <tr class="title">
                                    <td class="text-right">Sub Total:</td>
                                    <td class="textcenter">N5,338.88</td>
                                </tr>
                                    <tr class="title">
                                    <td class="text-right">5.00% VAT:</td>
                                    <td class="textcenter">N257.14</td>
                                </tr>
                                        <tr class="title">
                                    <td class="text-right">Credit:</td>
                                    <td class="textcenter">N0.00</td>
                                </tr>
                                <tr class="title">
                                    <td class="text-right">Total:</td>
                                    <td class="textcenter">N5,596.02</td>
                                </tr>
                                </tbody>
                            </table>
                      </div>
                  @endif


                        <div class="clearfix">
                        <div class="separator separator-small"></div>

                        
                        </div>
                   

                    </div>
                </div>
         </section>


@endsection
