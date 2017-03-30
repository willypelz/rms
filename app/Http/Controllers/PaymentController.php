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


        


        $invoice = Invoices::with('items')->where('id',$invoiceDB->id)->get()->first();

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
            
            default:
                $items = new stdClass();
                $items->type = null;
                $items->date = null;
                break;
        }

        $invoice = Invoices::with('items')->where('id',$invoiceDB->id)->get()->first();
        // $mail = Mail::queue('emails.new.invoice', ['job' => $job], function ($m) use($invoice,$invoice_type) {
        //             $m->from('no-reply@seamlesshiring.com', 'Seamlesshiring');

        //             $m->to('support@seamlesshiring.com')->subject('Customer Invoice: #'.$invoice->id);
        //     });

        



        return view('invoice.includes.inner',compact('invoice','invoice_type'));
   }

   public function showInvoce(Request $request)
   {
    $invoice = Invoices::with('items')->where('id',$invoiceDB->id)->get()->first();

        switch ($invoice->type) {
            case 'JOB_BOARD':
                $items = new \stdClass;
                $items->type = 'JOB BOARDS';

                $board_ids = array_pluck( $invoice->items, 'type_id' );

                $boards = JobBoard::whereIn('id',$board_ids)->where('avi', NULL)->get();
                

                foreach ($boards as $key => $board) {
                    $items->data[] = (object) [
                        'image' => $board->img,
                        'title' => $board->name,
                        'amount' => $board->price
                    ];
                }

                break;
            
            default:
                $items = new stdClass();
                $items->type = null;
                $items->date = null;
                break;
        }
   }

    
}
