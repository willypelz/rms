
<section class="no-pad">
                <div class="">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="contentArea" class="content rounded">
         
                        
                        <div class="col-sm-12">
                        <br>
                        <div class="">
                            <span class="title">Invoice #80186</span><br>
                            Invoice Date: <?php echo date('Y-m-d') ?><br>
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
                                    <td class="textcenter">&#8358;{{ $item->price }}</td>
                                </tr>
                                <?php $total += $item->price;
                                 ?>
                             @endforeach 
                             <?php 
                             $vat = (5 / 100) * intval( $total ); 

                             ?>  
                                <tr class="title">
                                    <td class="text-right">Sub Total:</td>
                                    <td class="textcenter">&#8358;{{ $total }}</td>
                                </tr>
                                    <tr class="title">
                                    <td class="text-right">5.00% VAT:</td>
                                    <td class="textcenter">&#8358;{{ $vat }}</td>
                                </tr>
                                      
                                <tr class="title">
                                    <td class="text-right">Total:</td>
                                    <td class="textcenter">&#8358;{{ $total + $vat }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix">
                        
                        </div>
                    <!-- <a class="btn btn-line">Cancel Order</a> -->
                    <div class="col-sm-12 text-center">
                        <a id="proceedCheckout" href="" class="btn btn-success pull-right">Proceed</a>
                        <div class="separator separator-small"></div>
                    </div>

                    </div>
                </div>
         </section>

           <script>
            $('#proceedCheckout').click(function(){

                                var url = "{{ route('ajax_checkout') }}";
                                      $.ajax
                                      ({
                                        type: "POST",
                                        url: url,
                                        data: ({ rnd : Math.random() * 100000, "_token":"{{ csrf_token() }}", type: Cart.config.type, total_amount:'{{ $total + $vat }}'}),
                                        success: function(response){
                                          // console.log(response);
                                          $('body #invoice-res').html(response)
                                          
                                        }
                                    });

                                  

                return false;
                
            })
         </script>
 
       