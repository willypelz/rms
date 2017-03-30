<br>
			Company logo<br>
			Invoice #{{ $invoice->id }}<br>
			Status: {{ $invoice->status }}<br>
			*********<br>
			Invoice Date:{{ date('D. j M, Y', strtotime( $invoice->created_at ) ) }}<br>
			**************<br>
			Invoiced To:<br>company
			{{ $invoice->company->name }}<br>
			{{ $invoice->company->address }}<br>
			<br>
			<br>
			<br>
			Pay To:<br>
			Account Name: Seamlesshiring a/c name<br>
			Account No: 101045048454<br>
			Account Bank: Diamond Bank<br>
			TIN: 12001705-0001<br>
			<br>
			<br>
			Invoice Items<br>
			Description<br>
			<br>
			<strong>{{ $invoice_type }}</strong><br>
			<?php $total = 0; ?>
			@foreach($invoice->items as $data)
				@if( $invoice->type = 'JOB_BOARDS' )
					<?php $total += intval($data->amount); ?>
					@if( !is_null( $data->amount ) )
						{{ $data->title }} ---- ₦{{ $data->amount }}<br>
					@else
						{{ $data->title }} ---- Your request is being processed, you will be contacted.<br>
					@endif

				@endif
			@endforeach
			


			Payment Gateway Charge, if any( QuickTeller (Naira MasterCard/Verve) + *** )	<br>
			<br>
			<br>
			Sub Total: ₦{{ $total }}<br>
			VAT (if any)<br>
			Credit<br>
			Total Amount: ₦{{ $total }}<br>

			
			* Indicates a taxed item.<br>
			CTA: Pay now<br>
			Print     Download<br>
			CTA: « Back to Dashboard<br>
			<br>