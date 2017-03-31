<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Curl;
use App\Models\Company;
use App\Models\Job;
use App\Models\JobActivity;
use App\Libraries\Solr;
use Auth;
use App\Models\FolderContent;
use App\Models\Invoices;
use App\Models\InvoiceItems;
use App\Models\JobBoard;
use App\Models\AtsRequest;
use App\Models\TestRequest;
use Mail;


class PaymentController extends Controller
{
    private $search_params = [ 'q' => '*', 'row' => 20, 'start' => 0, 'default_op' => 'AND', 'search_field' => 'text', 'show_expired' => false ,'sort' => 'application_date+desc', 'grouped'=>FALSE ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

   public function createInvoice(Request $request)
   {

        $invoiceDB = Invoices::create([
                'type' => $request->type,
                'status' => $request->status,
                'company_id' => get_current_company()->id,
                'initiated_by' => Auth::user()->id
            ]);


        


        

        switch ($request->type) {
            case 'JOB_BOARD':

                foreach ($request->type_ids as $key => $type_id) {

                    $board = JobBoard::where('id',$type_id)->get()->first();

                    if( $board->avi == NULL )
                    {
                        InvoiceItems::create( [
                            'invoice_id' => $invoiceDB->id,
                            'type' => $request->type,
                            'type_id' => $type_id,
                            'image' => $board->img,
                            'title' => $board->name,
                            'amount' => $board->price
                        ]);
                    }
                    else
                    {
                        InvoiceItems::create( [
                            'invoice_id' => $invoiceDB->id,
                            'type' => $request->type,
                            'type_id' => $type_id,
                            'image' => $board->img,
                            'title' => $board->name,
                            'amount' => NULL
                        ]);
                    }

                    
                }

                $invoice_type = "JOB BOARDS";

                break;

            case 'BACKGROUND_CHECK':

                foreach ($request->type_ids as $key => $type_id) {

                    $check = AtsRequest::with('product.provider')->where('id',$type_id)->get()->first();

                    InvoiceItems::create( [
                        'invoice_id' => $invoiceDB->id,
                        'type' => $request->type,
                        'type_id' => $type_id,
                        'image' => $check->product->provider->logo,
                        'title' => $check->product->name,
                        'amount' => $check->product->cost
                    ]);
                    
                }

                $invoice_type = "BACKGROUND CHECKS";

                break;

            case 'MEDICAL_CHECK':

                foreach ($request->type_ids as $key => $type_id) {

                    $check = AtsRequest::with('product.provider')->where('id',$type_id)->get()->first();

                    InvoiceItems::create( [
                        'invoice_id' => $invoiceDB->id,
                        'type' => $request->type,
                        'type_id' => $type_id,
                        'image' => $check->product->provider->logo,
                        'title' => $check->product->name,
                        'amount' => $check->product->cost
                    ]);
                    
                }

                $invoice_type = "MEDICAL CHECKS";

                break;

            case 'TEST':

                foreach ($request->type_ids as $key => $type_id) {

                    $test = TestRequest::with('product.provider')->where('id',$type_id)->get()->first();
                    // dump( $type_id, $test->product->provider, $test->product->provider->logo );
                    InvoiceItems::create( [
                        'invoice_id' => $invoiceDB->id,
                        'type' => $request->type,
                        'type_id' => $type_id,
                        'image' => @$test->product->provider->logo,
                        'title' => @$test->product->name,
                        'amount' => @$test->product->cost
                    ]);
                    
                }

                $invoice_type = "TESTS";

                break;
            
            default:
                $items = new stdClass();
                $items->type = null;
                $items->date = null;
                break;
        }

        $invoice = Invoices::with('items')->where('id',$invoiceDB->id)->get()->first();
        if( @$request->count )
        {
            $total_multiplier = intval( @$request->count );
            $count = ' x ' .@$request->count;

        }
        else
        {
            $total_multiplier = 1;
            $count = '';
        }
        // $mail = Mail::queue('emails.new.invoice', ['job' => $job], function ($m) use($invoice,$invoice_type) {
        //             $m->from('no-reply@seamlesshiring.com', 'Seamlesshiring');

        //             $m->to('support@seamlesshiring.com')->subject('Customer Invoice: #'.$invoice->id);
        //     });

        



        return view('invoice.includes.inner',compact('invoice','invoice_type','count','total_multiplier'));
   }

   public function showInvoice(Request $request)
   {
    $invoice = Invoices::with('items')->where('id',$request->invoice_id)->get()->first();

        switch ($invoice->type) {
            case 'JOB_BOARD':

                foreach ($invoice->items as $key => $item) {

                    $board = JobBoard::where('id',$item->type_id)->get()->first();

                    if( $board->avi == NULL )
                    {
                        InvoiceItems::create( [
                            'invoice_id' => $invoice->id,
                            'type' => $invoice->type,
                            'type_id' => $item->type_id,
                            'image' => $board->img,
                            'title' => $board->name,
                            'amount' => $board->price
                        ]);
                    }
                    else
                    {
                        InvoiceItems::create( [
                            'invoice_id' => $invoice->id,
                            'type' => $invoice->type,
                            'type_id' => $item->type_id,
                            'image' => $board->img,
                            'title' => $board->name,
                            'amount' => NULL
                        ]);
                    }

                    
                }

                $invoice_type = "JOB BOARDS";

                break;
            
            default:
                $items = new stdClass();
                $items->type = null;
                $items->date = null;
                break;
        }

        return view('invoice.default',compact('invoice','invoice_type'));
   }

    
}
