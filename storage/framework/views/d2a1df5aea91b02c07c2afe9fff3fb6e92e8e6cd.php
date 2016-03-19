 <section class="no-pad">
                <div class="">
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="contentArea" class="content rounded">
         
                        
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
                            <?php foreach($items as $item): ?>
                                <tr>
                                    <td><?php echo e($item->name); ?> (25/09/2015 - 24/09/2016) *</td>
                                    <td class="textcenter">N500.00</td>
                                </tr>
                                <?php $total += 500 ?>
                             <?php endforeach; ?>   
                                <tr class="title">
                                    <td class="text-right">Sub Total:</td>
                                    <td class="textcenter">N<?php echo e($total); ?></td>
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
                                    <td class="textcenter">N<?php echo e($total); ?></td>
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
                // console.log('<?php echo e(asset("img/ajaxloader.gif")); ?>')
                 $("#contentArea").html('<img src="<?php echo e(asset("img/wheel.gif")); ?>" width="100px" /> please wait...');

                                var url = "<?php echo e(route('ajax_checkout')); ?>";

                                      $.ajax
                                      ({
                                        type: "POST",
                                        url: url,
                                        data: ({ rnd : Math.random() * 100000, "_token":"<?php echo e(csrf_token()); ?>"}),
                                        success: function(response){
                                          // console.log(response);
                                          $('#invoice-res').html(response)
                                          
                                        }
                                    });

                                  

                return false;
                
            })
         </script>