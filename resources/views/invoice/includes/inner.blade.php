<html><body style="
    margin: 15px;
    padding: 0;
    background-color: #cad5dc;
    font-family: sans-serif;
    font-size: 14px;
    color: #000000;
">
@if( $invoice->status == 'UNPAID' )
<div style="
    margin: 0 auto;
    padding: 10px 20px 70px 20px;
    width: 600px;
    background-color: #fff;
    box-shadow: 0 5px 5px rgba(0, 0, 0, 0.1);
    border-radius: 3px;
    border-top: 3px solid #ea4747;
    ">
    @elseif( $invoice->status == 'PAID' )
	<div style="
    margin: 0 auto;
    padding: 10px 20px 70px 20px;
    width: 600px;
    background-color: #fff;
    box-shadow: 0 5px 5px rgba(0, 0, 0, 0.1);
    border-radius: 3px;
    border-top: 3px solid #4bb779;
    ">

    @endif



<table style="margin: 0 0 15px 0;
    width: 100%;"><tbody><tr><td width="25%" nowrap="">

<p><img src="{{ env('SEAMLESS_HIRING_LOGO') }}" title="seamlesshiring"></p>
</td><td width="50%" align="center">

<!-- <font style="font-size: 16px;
    color: #FFFFFF;
    background-color: #A2B23D;
    font-weight: bold;
    padding: 5px 10px;
    margin-bottom: 10px;">Paid</font><br><br> -->
    @if( $invoice->status == 'UNPAID' )
<font style="
    font-size: 16px;
    color: #FFFFFF;
    background-color: #EA4747;
    font-weight: bold;
    padding: 10px;
    margin-bottom: 10px;
    top: -28px;
    text-transform: uppercase;
    position: relative;
    border-radius: 0 0 3px 3px;
    right: -160px;
    ">
    @elseif( $invoice->status == 'PAID' )
	<font style="
    font-size: 16px;
    color: #FFFFFF;
    background-color: #4bb779;
    font-weight: bold;
    padding: 10px;
    margin-bottom: 10px;
    top: -28px;
    text-transform: uppercase;
    position: relative;
    border-radius: 0 0 3px 3px;
    right: -160px;
    ">
    @endif
    {{ $invoice->status }}</font></td></tr></tbody></table>


@if( $invoice->status == 'UNPAID' )
<div>
<p style="font-weight: bold;padding: 20px;background: #FBEEEB;text-align: center;">If you choose to make payment directly to our bank account by visiting a bank physically or via online transfer, do ensure to
send a mail to support@seamlesshiring.com stating the details of your payment.
</p>
</div>
@endif

<table style="width: 100%;
    background-color: #ccc;
    border-spacing: 0;
    border-collapse: separate;
    border-left: 1px solid #ccc;">

    <tbody><tr><td style="
    margin: 0;
    padding: 2px;
    line-height: 15px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-left: 0;
    " width="50%">

<div style="
    height: 160px;
    padding: 10px;
    background-color: #fff;
    color: #000;
    overflow: hidden;
    ">

<strong>Invoiced To</strong><br>
{{ $invoice->company->name }}<br>
{{ $invoice->company->address }}<br>

</div>

</td><td style="
    margin: 0;
    padding: 2px;
    line-height: 15px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-left: 0;
    " width="50%">

<div style="
    height: 160px;
    padding: 10px;
    background-color: #fff;
    /* border: 1px solid #ccc; */
    color: #000;
    overflow: hidden;
    ">

<strong>Pay To</strong><br>
Account Name: Insidify Limited<br>
Account No: 0114023729<br>
Bank: Guaranty Trust Bank (GTB)<br>
OR<br>
Account No: 1013173318<br>
Bank: Zenith Bank<br>
TIN: 12001705-0001

</div>

</td></tr></tbody></table>

<div style="margin: 15px 0;">
<span style="
font-size: 16px;
    font-weight: bold;">
		{{ $invoice_type }}
    </span>
    <br>
<span style="
font-size: 16px;
    font-weight: bold;">
    Invoice #{{ $invoice->id }}
    </span>
    <br>
Invoice Date: {{ date('D. j M, Y', strtotime( $invoice->created_at ) ) }}<br>
<!-- Due Date: 25/09/2015 -->
</div>

<table style="width: 100%;
    background-color: #ccc;
    border-spacing: 0;
    border-collapse: separate;
    border: 1px solid #ccc;">
    <tbody><tr style="
    font-size: 16px;
    font-weight: bold;">
        <td style="
            margin: 0;
            padding: 10px;
            line-height: 16px;
            background-color: #efefef;
            border: 1px solid #ccc;
            border-bottom: 0;
            border-left: 0;
            font-size: 12px;
            font-weight: bold;
            " width="50%">Description</td>
        <td style="
    margin: 0;
    padding: 10px;
    line-height: 16px;
    background-color: #efefef;
    border: 1px solid #ccc;
    border-bottom: 0;
    border-left: 0;
    font-size: 12px;
    font-weight: bold;
    " width="50%">Amount</td>
    </tr>
    
    <?php $total = 0; ?>
    @foreach($invoice->items as $data)
    	<?php $total += intval($data->amount); ?>
    	<tr>
    		<td style="
		    margin: 0;
		    padding: 10px;
		    line-height: 15px;
		    background-color: #fff;
		    border: 1px solid #ccc;
		    border-bottom: 0;
		    border-left: 0;
		    " width="50%">{{ $data->title }} *</td>

		    <td style="
		    margin: 0;
		    padding: 10px;
		    line-height: 15px;
		    background-color: #fff;
		    border: 1px solid #ccc;
		    border-bottom: 0;
		    border-left: 0;
		    " width="50%" class="textcenter">
		    @if( $invoice->type = 'JOB_BOARDS' )
				
				@if( !is_null( $data->amount ) )
					₦{{ number_format( $data->amount, 2 ) }}
				@else
					Your request is being processed, you will be contacted.
				@endif
			@else
				₦{{ number_format( $data->amount, 2) }}
			@endif</td>
			
		</tr>
	@endforeach
   <!--  <tr>
        <td style="
    margin: 0;
    padding: 10px;
    line-height: 15px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-bottom: 0;
    border-left: 0;
    " width="50%">Gateway Charge ( QuickTeller (Naira MasterCard/Verve)  + 3.63% )</td>
        <td style="
    margin: 0;
    padding: 10px;
    line-height: 15px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-bottom: 0;
    border-left: 0;
    " width="50%" class="textcenter">N196.02</td>
    </tr> -->
    <tr style="
    font-size: 16px;
    font-weight: bold;">
        <td style="
    margin: 0;
    padding: 10px;
    line-height: 15px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-bottom: 0;
    border-left: 0;
    text-align: right;
    font-size:15px;
    " width="50%">Sub Total:</td>
        <td style="
    margin: 0;
    padding: 10px;
    line-height: 15px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-bottom: 0;
    border-left: 0;
    text-align:;
    font-size:15px;
    ">₦{{ number_format( $total, 2 ) }}</td>
    </tr>
        <tr style="
    font-size: 16px;
    font-weight: bold;">
        <td style="
    margin: 0;
    padding: 10px;
    line-height: 15px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-bottom: 0;
    border-left: 0;
    text-align: right;
    font-size:15px;
    " width="50%">5.00% VAT:</td>
        <td style="
    margin: 0;
    padding: 10px;
    line-height: 15px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-bottom: 0;
    border-left: 0;
    text-align:;
    font-size:15px;
    " width ="50%" class="textcenter">₦{{ number_format( $total * 0.05, 2 ) }}</td>
    </tr>
            <!-- <tr style="
    font-size: 16px;
    font-weight: bold;">
        <td style="
    margin: 0;
    padding: 10px;
    line-height: 15px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-bottom: 0;
    border-left: 0;
    text-align: right;
    font-size:15px;
    " width="50%">Credit:</td>
        <td style="
    margin: 0;
    padding: 10px;
    line-height: 15px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-bottom: 0;
    border-left: 0;
    text-align:;
    font-size:15px;
    " width="50%" class="textcenter">N0.00</td>
    </tr> -->
    <tr style="
    font-size: 16px;
    font-weight: bold;">
        <td style="
    margin: 0;
    padding: 10px;
    line-height: 15px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-bottom: 0;
    border-left: 0;
    text-align: right;
    font-size:15px;
    " width="50%">Total:</td>
        <td style="
    margin: 0;
    padding: 10px;
    line-height: 15px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-bottom: 0;
    border-left: 0;
    text-align:;
    font-size:15px;
    " width="50%" class="textcenter">₦{{ number_format( ( $total * 0.05 ) + $total, 2 ) }}</td>
    </tr>
</tbody></table>

</div>


<!-- <p align="center"><a href=""> Back </a> | <a href="">Download</a> | <a href="">Close Window</a></p> -->


</body>
<!-- End -->


</html>