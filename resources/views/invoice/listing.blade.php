@extends('layout.template-default')
@section('content')
<div class="container">
        <div class="row">

            <div class="col-xs-12">
            <br>
                <h3 class="pull-left">Invoices</h3>
                                <nav class="navbar-right">
                                  {!! $invoices->links() !!}
                               </nav>
                <div class="clearfix">
                
                </div>
            </div>

        </div>
    </div>


    <section class="no-pad">
        <div class="container">
            <div class="row">

                <div class="col-xs-12">

                    <div class="content rounded">

                        <table class="table table-hover cv-basket">
                            <thead>
                                <tr>
                                    <th>Invoice Number</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $invoices as $invoice )

                                    <?php

                                    switch ($invoice->type) {
                                        case 'JOB_BOARD':
                                            $invoice_type = "JOB BOARDS";
                                            break;

                                        case 'BACKGROUND_CHECK':
                                            $invoice_type = "BACKGROUND CHECKS";
                                            break;

                                        case 'MEDICAL_CHECK':
                                            $invoice_type = "MEDICAL CHECKS";
                                            break;

                                        case 'TEST':
                                            $invoice_type = "TESTS";
                                            break;
                                        
                                        default:
                                            break;
                                    }
                                    ?>
                                    <tr>
                                        <td>#{{ $invoice->id }}</td>
                                        <td>
                                            <div class="comment media">
                                                
                                                <div class="media-body">
                                                    <p>
                                                    <h4>{{ $invoice_type }}</h4>
                                                    <?php $total = 0; ?>
                                                    @foreach($invoice->items as $data)
                                                        <?php $total += intval($data->amount); ?>
                                                        
                                                        {{ $data->title }} <br>
                                                    @endforeach

                                                    </p>
                                                    <!-- <span class="text-muted result-details">
                                                        <a href="" target="_blank">View Details</a> 
                                                        <a href="">Transfer to Saved CV</a> - 
                                                        <a href="" class="text-danger"><span class="glyphicon glyphicon-remove"></span></a>
                                                    </span> -->
                                                </div>
                                            </div>
                                        </td>
                                        <td>₦{{ number_format( $total, 2) }}</td>
                                        <td>{{ $invoice->status }}</td>
                                        <td>{{ date('D. j M, Y', strtotime( $invoice->created_at ) ) }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('show-invoice',['invoice_id' => $invoice->id ]) }}" class="text-danger">
                                                <span class="glyphicon glyphicon-eye"></span> View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                
                            </tbody>
                        </table>

                         <div class="row">
                            <!--<div class="col-xs-12">
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-info">Add more CVs</button>
                                    <button type="submit" class="btn btn-default">Proceed to payment &raquo;</button>
                                </div>
                            </div> -->
                            <div class="col-xs-12">
                                <nav class="navbar-right">
                                  {!! $invoices->links() !!}
                               </nav>
                           </div>
                        </div>

                    </div>

                </div>

                

            </div>
        </div>
    </section>
@endsection