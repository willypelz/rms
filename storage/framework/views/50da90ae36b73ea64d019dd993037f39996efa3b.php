<?php $__env->startSection('content'); ?>


<section class="s-div dark">
        <div class="container">

            <div class="row">
                <div class="col-md-4 col-md-offset-1 hidden-sm hidden-xs">
                    <div class=""><br>
                        <h2 class="text-white push-down no-margin"> <i class="fa fa-street-view"></i> Talent Pool</h2>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <form action="cv-search.php" class="form-group"><br>
                       <div class="form-lg">
                         <div class="col-xs-10">
                           <div class="row"><input placeholder="Find something you want" value="Frontend Developer" class="form-control input-lg input-talent" type="text"></div>
                         </div>
                         <div class="col-xs-2">
                           <div class="row">
                               <button type="submit" class="btn btn-lg btn-block btn-success btn-talent">
                               <!-- Find <span class="hidden-sm hidden-xs">Candidates</span>  -->
                               <i class="fa fa-search fa-lg"></i>
                               </button>
                           </div>
                         </div>
                       </div>
                    </form>
                </div>
            </div>

        </div>
    </section>



    <section class="no-pad">
                <div class="">
                    <div class="row">
                        <div class="col-sm-4">
                            <div id="paymemt-success" class="content rounded">

                              <?php if($type == 'bank'): ?>
                                    
                                    <h2>Bank Information</h2>
                                    <strong>Pay To</strong><br>
                                    Account Name: Insidify Limited<br>
                                    Account No: 0114023729<br>
                                    Bank: Guaranty Trust Bank (GTB)<br>
                                    OR<br>
                                    Account No: 1013173318<br>
                                    Bank: Zenith Bank<br>
                                    TIN: 12001705-0001
                              <?php else: ?>
                                    <h2>Payment via Paystack</h2>

                                      <img class="pp-img" src="<?php echo asset('img/paystack_logo.jpeg') ?>" alt="Image Alternative text" title="Image Title" />
                                      <!-- <p>Important: You will be redirected to PayPal's website to securely complete your payment.</p> -->
                                      <a onclick="pay()" id="sub_btn" class="btn btn-primary">Checkout via PayStack</a>   
                              <?php endif; ?>

                            </div>
                        </div>

    <script src="https://paystack.ng/js/inline.js"></script>

          <script>
              function pay(){
                // console.log('got here')
                <?php
                        $uuid = uniqid(true);
                ?>
                var ajax_image = "<img src='<?php echo asset('img/faceb.gif') ?>' alt='Loading...' />";
                // console.log(ajax_image);
                    // $('#sub_btn').html(ajax_image)

                    var url = "<?php echo e(route('transactions')); ?>";
                    $.ajax
                      ({
                          type: "POST",
                          url: url,
                          data: ({order_id: "<?php echo e($order_id); ?>", status:false, message:'Transaction Not Found', "_token":"<?php echo e(csrf_token()); ?>"}),
                          success: function(response){
                            // console.log(response) 
                            loadPaystack();
                          }
                      });

                    function loadPaystack(){
                        var handler = PaystackPop.setup({
                            key: 'pk_test_7d7271a9f0ca45ac76d8ca1569ea47948e1bb5f5',
                            email: 'info@bus.com.ng',
                            amount: "<?php echo e($total_amount); ?>",
                            ref: '<?php echo $uuid; ?>',
                            callback: paystackcallback
                        })
                        handler.openIframe()
                    }

                    function paystackcallback(response){

                 $("#paymemt-success").html('<img src="<?php echo e(asset("img/wheel.gif")); ?>" width="100px" /> please wait...');

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
                                 var oldurl = "<?php echo e(route('transactions')); ?>";

                                 $.ajax
                                  ({
                                      type: "POST",
                                      url: oldurl,
                                      data: ({order_id:"<?php echo e($order_id); ?>", status:true, message:'Transaction Successful', "_token":"<?php echo e(csrf_token()); ?>"}),
                                      success: function(response){
                                          // conosle.log(response);
                                    $("#paymemt-success").html('Payment Successful');

                                      }
                                  });
                            }
                          }
                      });
                  }



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
                            
                            <?php foreach($items as $item): ?>
                                <tr>
                                    <td><?php echo e($item->name); ?> (25/09/2015 - 24/09/2016) *</td>
                                    <td class="textcenter">N500.00</td>
                                </tr>
                             <?php endforeach; ?>   
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
                        <div class="clearfix">
                        <div class="separator separator-small"></div>

                        
                        </div>
                   

                    </div>
                </div>
         </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.template-user', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>