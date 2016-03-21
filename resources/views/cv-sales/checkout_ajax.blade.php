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
                                    bunmifamiloni<br>familoni oluwatayo<br>
                                    mayfair, ile ife, Osun, 234, Nigeria

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
                        <div class="clearfix">
                        
                        </div>
                    <!-- <a class="btn btn-line">Cancel Order</a> -->
                        <div class="col-sm-12">
                            <form action="{{ route('payment') }}" method="post">
                                Bank Transfer/Deposit: <input type="radio" name="payment_option" value="bank" required><br>
                                Pay Online via Paystack: <input type="radio" name="payment_option" value="paystack"><br>
                                    <input type="hidden" name="order_id" value="{{ $order_id }}">
                                    <input type="hidden" name="amount" value="{{ $total_amount }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
</section>

