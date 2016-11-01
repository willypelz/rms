<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Order;
use App\User;
use App\Models\Cv;
use App\Models\Job;
use App\Models\Transaction;
use App\Models\OrderItem;
use App\Models\CompanyFolder;
use App\Models\FolderContent;
use App\Models\JobApplication;
use App\Models\FormFieldValues;
use Illuminate\Http\Request;
use App\Libraries\Solr;
use App\Libraries\Utilities;
use Cart;
use Auth;
use Mail;
use Carbon\Carbon;

use App\Jobs\ExtractCvContent;


class CvSalesController extends Controller
{
    private $search_params = [ 'q' => '*', 'row' => 20, 'start' => 0, 'default_op' => 'AND', 'search_field' => 'text', 'show_expired' => false ,'sort' => 'score+asc', 'grouped'=>FALSE ];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'search',
            'getCvPreview',
            'saveCvPreview',
            'Cart',
            'CartDetails',
            'Output',
            'Ajax_cart',
            'Ajax_checkout',
            'Payment',
            'Transactions',
            'TestEmail'
        ]]);
    }

    public function search(Request $request)
    {
            

            if( $request->search_query && $request->search_query != '' )
            {
                $this->search_params['q'] = $request->search_query;
            }

            $this->search_params['start'] = $start = ( $request->start ) ? ( $request->start * $this->search_params['row'] ) : 0;
            
            $additional = "";

            if( @$request->age ){
                $date = Carbon::now();
                //2015-09-16T00:00:00Z
                // $start_dob = str_replace('+', '', $date->subYears( @$request->age[0] )->toIso8601String() ). "Z" ; 
                // $end_dob = str_replace('+', '', $date->subYears( @$request->age[1] )->toIso8601String() ). "Z";  
                
                $start_dob = explode(' ', $date->subYears( @$request->age[0] ) )[0] .'T23:59:59Z'; 
                $end_dob = explode(' ', $date->subYears( @$request->age[1] ) )[0] .'T00:00:00Z';

                $solr_age = [ $start_dob, $end_dob ];

                $additional .= "&fq=dob:[".$solr_age[1]."+TO+".$solr_age[0]."]"; //$startdate.'T01:00:59Z' $enddate.'T23:59:59Z'

            }
            else
            {
                $request->age = [ 5, 85 ];
                $solr_age = null;
            }


            //If years of experience is available
            if( @$request->exp_years ){
                //2015-09-16T00:00:00Z

                $solr_exp_years = [ @$request->exp_years[0], @$request->exp_years[1] ];
                $additional .= "&fq=years_of_experience:[".$solr_exp_years[0]."+TO+".$solr_exp_years[1]."]";
            }
            else
            {
                $request->exp_years = [ 0, 60 ];
                $solr_exp_years = null;
            }


            if( $request->filter_query ){
                $this->search_params['filter_query'] = @$request->filter_query;
            }
            
            // $response = Solr::search_resume($this->search_params);

            $result = Solr::search_resume($this->search_params, @$additional);

            $cart = Utilities::getCartContent('cv-sales'); 
            $count = Utilities::getBoardCartCount('cv-sales'); 

            //to get ids of all items in cart so as to check the button to display in view
            foreach ($cart as $k) {
                $ids[] = ($k->id);
            }

            if(empty($ids))
                $ids = null;


            
            $end = (($start + $this->search_params['row']) > intval($result['response']['numFound']))?$result['response']['numFound']:($start + $this->search_params['row']);
            $showing = view('cv-sales.includes.top-summary',['start' => ( $start + 1 ),'end' => $end, 'total'=> $result['response']['numFound'], 'type'=> '', 'page' => floor($request->start + 1), 'filters' => $request->filter_query ])->render();    

            if($request->ajax())
            {
                $search_results = view('cv-sales.includes.search-results-item',['result' => $result,'search_query' => $request->search_query, 'items'=> $cart, 'many'=>$count, 'ids'=>$ids, 'start' => $start, 'page' => 'search'])->render();    
                $search_filters = view('cv-sales.includes.search-filters',['result' => $result,'search_query' => $request->search_query, 'age' => @$request->age,'exp_years' => @$request->exp_years])->render();
                return response()->json( [ 'search_results' => $search_results, 'search_filters' => $search_filters, 'showing' => $showing, 'count' => $result['response']['numFound'] ] );
                
            }
            else{
                return view('cv-sales.search-results',['result' => $result,'search_query' => $request->search_query, 'items'=> $cart, 'many'=>$count, 'ids'=>$ids, 'start' => $start, 'page' => 'search', 'showing' => $showing, 'age' => @$request->age,'exp_years' => @$request->exp_years ]);
            }
            
    }




    public function filter_search(Request $request)
    {

            /*$this->search_params['q'] = $request->search_query;
            $this->search_params['filter_query'] = @$request->filter_query;//dd($this->search_params);

            $cart = Cart::content();
            $count = Cart::count(false); 

             foreach ($cart as $k) {
                $ids[] = ($k->id);
            }

            if(empty($ids))
                $ids = null;
            
            $response = Solr::search_resume($this->search_params);

            return view('cv-sales.includes.search-results-item',['result' => $response,'search_query' => $request->search_query, 'items'=> $cart, 'many'=>$count, 'ids'=>$ids ]);*/
    }

    public function getCvPreview(Request $request)
    {
        $cv = Cv::find($request->cv_id)->toArray();
        $cv['dob'] = $cv['date_of_birth'];
        $is_applicant = $request->is_applicant;
        $is_embedded = $request->is_embedded;
        if(isset($request->appl_id)){
            $appl = JobApplication::find($request->appl_id);   
             // dd( $appl->custom_fields );

             
        }
        
        // dd( FormFieldValues::where('job_application_id') )
        return view('cv-sales.includes.cv-preview',compact("cv", "is_applicant", "appl", 'is_embedded'));
    }

    public function saveCvPreview($cv, Request $request){ // to solr


        Cv::where('id', '>', 5673)->chunk(100, function ($cvs) {
            foreach ($cvs as $cv) {

                //adding to jobs queue...
                $this->dispatch(new ExtractCvContent($cv));

                echo 'Queued: '.$cv->cv_file.'<br/>';
            }
        });
        

    }

    public function ExtractCv($cv, Request $request){ // to solr
        
        $this->dispatch(new ExtractCvContent($cv));
    }

    public function Cart(Request $request){
        
        // dd($request->all());

                   if($request->action == 'add'){
                     // Cart::instance('JobBoard')->add('sdjk922', 'Product 2', 1, 19.95, array('size' => 'medium'));
                    Cart::instance( $request->type )->add(array('rowid'=>111111, 'id' => $request->id, 'name' => $request->name, 'qty' => $request->qty, 'price' => $request->price));
                    // echo 'Added Successfully';
                   }
                   elseif ($request->action == 'remove') {
                        $search = Cart::instance( $request->type )->search(array('id'=>$request->id));
                        Cart::instance( $request->type )->remove($search[0]);
                        // echo 'Deleted';    
                   }
                   elseif ($request->action == 'clear') {
                        Cart::instance( $request->type )->destroy();
                    }
                    else{
                        
                        Cart::instance($request->type)->destroy();

                   } 

                return json_encode( [ 'count' =>  Utilities::getBoardCartCount( $request->type ), 'total' => Utilities::getBoardCartCost( $request->type ) ] );


        
    }

    /* CART TESTING */
    public function CartDetails(Request $request){
        // Cart::destroy();
         $cons = Cart::instance('JobBoard')->content();
         $total_amount = 0;
         foreach ($cons as $c) {
            $total_amount += $c->price;
         }
         // echo $search;
         dd($total_amount);
    }

    public function Output(){
        $cart = Cart::content();
        dd($cart);
    }

    // END OF CART TESTING

    public function Ajax_cart(Request $request){

            $items = Cart::instance( $request->type )->content();
            $view = view('cv-sales.ajax_cart', compact('items'));
            return $view;
        
    }

    public function Ajax_checkout(Request $request){

        $user = Auth::user();

        if(!Auth::check()){
            $view = view('auth.ajax_login');
            return $view;
        }

        $invoice_no = '#'.mt_rand();

        $d = User::with('companies')->where('id', $user->id)->first();
        $company = get_current_company();
        $total_amount = $request->total_amount;

        $items = Cart::instance( $request->type )->content();

        
        $order = Order::firstOrCreate([
                'company_id' => $company->id,
                'order_date'=> date('Y-m-d H:i:s'),
                'total_amount'=> $request->total_amount,
                'invoice_no'=> $invoice_no,
                'type'=> $request->type,
        ]);

        foreach ($items as $k) {

            $orderItems = OrderItem::firstOrCreate([
                        'order_id' => $order->id,
                        'itemId' => $k->id,
                        'type' => $request->type,
                        'name' => $k->name,
                        'price' => $k->price
             ]);

        }

        $order_id = $order->id;
        $jobBoards = $request->type;
        $view = view('cv-sales.checkout_ajax', compact('items', 'order_id', 'total_amount', 'jobBoards', 'company', 'invoice_no'));
        return $view;


    }

    public function Payment(Request $request, $type = null){

        $company = get_current_company();


        if($type != null){

            $order = Order::where('id', $type)->with('orderItems')->first();
            $items = $order->orderItems;
            $order_id = $order->id;
            $total_amount = $order->total_amount;
            $jobBoards = 'JOB Boards';
            $type= 'bank';

            return view('cv-sales.pay', compact('type', 'items', 'order_id', 'total_amount', 'jobBoards', 'company', 'total_amount'));

        }else{
            $items = Cart::content();
            $type = ($request->payment_option);
            $order_id = $request->order_id;
            $total_amount = $request->amount.'00';
            return view('cv-sales.pay', compact('type', 'items', 'order_id', 'total_amount', 'company', 'total_amount'));
        }        
    }
    

    public function Transactions(Request $request){

        if(isset($request->jsonres)){
            $r = ($request->jsonres);
            $trans_id = $r['id'];
            $card = $r['source']['id'];
            $cus_id = $r['customer']['id'];

            Order::where('id', $request->order_id)
              ->update(['trans_id' => $trans_id, 'customer_id'=>$cus_id, 'customer_card'=>$card]);
        }

        $transaction = Transaction::firstOrCreate([
            'order_id' => $request->order_id,
            'status'=> $request->status,
            'message'=>$request->message
        ]);

        if ($request->message == 'Transaction Successful') {
            Cart::destroy();
            Cart::instance('JobBoard')->destroy();

        }
        return $transaction;
    }

    public function TestEmail(){

        $user = Auth::user();
        // dd($user);
       $emailer =  Mail::send('emails.cv-sales.invoice', ['user' => $user], function ($m) use ($user) {
            $m->from('alerts@insidify.com', 'Your Application');

            $m->to('deleoshunlana@gmail.com', 'Ayo')->subject('Your Reminder!');
        });

       if($emailer)
        echo 'Sent';

    }

    public function getMyFolders(){
        if( Auth::check() )
        {
            $company_folder_obj = new CompanyFolder(); 
            $folders = $company_folder_obj->getMyFolders( get_current_company()->id );
            return response()->json( ['folders' => $folders] );

        }
        else
        {
            return "You need to be logged in to get folders";
        }
    }

    public function addFolders(Request $request)
    {
        if( Auth::check() )
        {
            $company_folder_obj = new CompanyFolder(); 
            $company_folder_obj::create( ['name' => $request->name, 'type' => $request->type, 'date_added' => Carbon::now(), 'company_id' => get_current_company()->id ] );

            
            return response()->json( true );

        }
        else
        {
            return "You need to be logged in to add folders";
        }
    }

    public function saveToFolder(Request $request)
    {
        if( Auth::check() )
        {
            $folder_content_obj = new FolderContent(); 
            $folder_content_obj::create( ['cv_id' => $request->cv_id, 'company_folder_id' => $request->folder_id ] );

            return response()->json( true );

        }
        else
        {
            return "You need to be logged in to add folders";
        }
    }

    public function viewSaved(Request $request)
    {
        $this->search_params['q'] = ( $request->search_query && trim( $request->search_query ) != '' ) ? $request->search_query : '*' ;

        $this->search_params['start'] = $start = ( $request->start ) ? ( $request->start * $this->search_params['row'] ) : 0;

        
        
        $this->search_params['filter_query'] = @$request->filter_query;
        // $response = Solr::search_resume($this->search_params);
        $response = Solr::get_saved_cvs($this->search_params);


        $cart = Utilities::getCartContent('saved-cvs'); 
        $count = Utilities::getBoardCartCount('saved-cvs'); 

        //to get ids of all items in cart so as to check the button to display in view
        foreach ($cart as $k) {
            $ids[] = ($k->id);
        }

        if(empty($ids))
            $ids = null;
    // $in_cart = in_array('26618', $ids);
        if($request->ajax())
        {
            
            $search_results = view('cv-sales.includes.search-results-item',['result' => $response,'search_query' => $request->search_query, 'items'=> $cart, 'many'=>$count, 'ids'=>$ids, 'start' => $start, 'page' => 'saved',  'is_saved' => true])->render();    
            $search_filters = view('cv-sales.includes.search-filters',['result' => $response,'search_query' => $request->search_query])->render();
            return response()->json( [ 'search_results' => $search_results, 'search_filters' => $search_filters ] );
            
        }
        else{
            return view('cv-sales.cv_saved',['result' => $response,'search_query' => $request->search_query, 'items'=> $cart, 'many'=>$count, 'ids'=>$ids, 'start' => $start, 'page' => 'saved',  'is_saved' => true ]);
        }
        // return view('cv-sales.cv_saved');
    }

    public function viewPurchased(Request $request)
    {
        $this->search_params['q'] = ( $request->search_query && trim( $request->search_query ) != '' ) ? $request->search_query : '*' ;

        $this->search_params['start'] = $start = ( $request->start ) ? ( $request->start * $this->search_params['row'] ) : 0;
        
        
        $this->search_params['filter_query'] = @$request->filter_query;
        // $response = Solr::search_resume($this->search_params);
        $response = Solr::get_purchased_cvs($this->search_params);


        $cart = Cart::content();
        $count = Cart::count(false); 

        //to get ids of all items in cart so as to check the button to display in view
        foreach ($cart as $k) {
            $ids[] = ($k->id);
        }

        if(empty($ids))
            $ids = null;
    // $in_cart = in_array('26618', $ids);
        if($request->ajax())
        {
            
            $search_results = view('cv-sales.includes.search-results-item',['result' => $response,'search_query' => $request->search_query, 'items'=> $cart, 'many'=>$count, 'ids'=>$ids, 'start' => $start, 'page' => 'purchased',  'is_saved' => true])->render();    
            $search_filters = view('cv-sales.includes.search-filters',['result' => $response,'search_query' => $request->search_query])->render();
            return response()->json( [ 'search_results' => $search_results, 'search_filters' => $search_filters ] );
            
        }
        else{
            return view('cv-sales.cv_purchased',['result' => $response,'search_query' => $request->search_query, 'items'=> $cart, 'many'=>$count, 'ids'=>$ids, 'start' => $start, 'page' => 'purchased',  'is_saved' => true ]);
        }
        // return view('cv-sales.cv_saved');
    }
    
    public function viewTalentPool(Request $request)
    {
        $this->search_params['q'] = ( $request->search_query && trim( $request->search_query ) != '' ) ? $request->search_query : '*' ;

        $this->search_params['start'] = $start = ( $request->start ) ? ( $request->start * $this->search_params['row'] ) : 0;
        
        

        
        if( @$request->age ){
            $date = Carbon::now();
            //2015-09-16T00:00:00Z
            $start_dob = explode(' ', $date->subYears( @$request->age[0] ) )[0] .'T23:59:59Z'; 
            $end_dob = explode(' ', $date->subYears( @$request->age[1] ) )[0] .'T00:00:00Z';

            $solr_age = [ $start_dob, $end_dob ];
            // dd($request->age, $start_dob, $end_dob);
        }
        else
        {
            $request->age = [ 5, 85 ];
            $solr_age = null;
        }


        //If years of experience is available
        if( @$request->exp_years ){
            //2015-09-16T00:00:00Z

            $solr_exp_years = [ @$request->exp_years[0], @$request->exp_years[1] ];
        }
        else
        {
            $request->exp_years = [ 0, 60 ];
            $solr_exp_years = null;
        }


        if( $request->filter_query ){
            $this->search_params['filter_query'] = @$request->filter_query;
        }
        
        // $response = Solr::search_resume($this->search_params);
        $response = $result = Solr::get_all_my_cvs($this->search_params, @$solr_age, @$solr_exp_years);

        $end = (($start + $this->search_params['row']) > intval($result['response']['numFound']))?$result['response']['numFound']:($start + $this->search_params['row']);
        // $showing = "Showing ".($start+1)." - ".$end." of ".$result['response']['numFound']." Cvs [Page ".floor($request->start + 1)."]";



        // $filter_text = '';
        // if(isset($request->filter_query)){

        //     $filter_text .= "<br/>Filtering by: ";
        //     foreach ($request->filter_query as $fq) {
                
        //         $filter_text .= ucwords(str_ireplace("_", " ", $fq)).', ';
        //     }

        //     $filter_text .= ".";

        // }

        // if( !empty($request->filter_query ) )
        // {
        //     $showing .= $filter_text . '<a id="clearAllFilters" href="javacript://" >Clear Filter</a>';
        // }
        
        $showing = view('cv-sales.includes.top-summary',['start' => ( $start + 1 ),'end' => $end, 'total'=> $result['response']['numFound'], 'type'=>'Cvs', 'page' => floor($request->start + 1), 'filters' => $request->filter_query ])->render();    

        $cart = Cart::content();
        $count = Cart::count(false); 

        //to get ids of all items in cart so as to check the button to display in view
        foreach ($cart as $k) {
            $ids[] = ($k->id);
        }

        if(empty($ids))
            $ids = null;
    // $in_cart = in_array('26618', $ids);

        $jobs = Job::where('company_id',get_current_company()->id)->get();
        if($request->ajax())
        {
            
            $search_results = view('cv-sales.includes.search-results-item',['result' => $response,'search_query' => $request->search_query, 'items'=> $cart, 'many'=>$count, 'ids'=>$ids, 'start' => $start, 'page' => 'pool',  'is_saved' => true, 'myJobs' => Job::getMyJobs() ])->render();    
            $search_filters = view('cv-sales.includes.search-filters',['result' => $response,'search_query' => $request->search_query, 'age' => @$request->age,'exp_years' => @$request->exp_years])->render();
            return response()->json( [ 'search_results' => $search_results, 'search_filters' => $search_filters, 'showing'=>$showing, 'count' => $result['response']['numFound'] ] );
            
        }
        else{
            return view('cv-sales.cv_pool',['result' => $response,'search_query' => $request->search_query,'showing'=>$showing, 'items'=> $cart, 'many'=>$count, 'ids'=>$ids, 'start' => $start, 'page' => 'pool',  'is_saved' => true, 'age' => [ 5, 85 ], 'exp_years' => [ 0, 60 ], 'myJobs' => Job::getMyJobs() ]);
        }
        // return view('cv-sales.cv_saved');
    }

    public function getBoardCartCount(Request $request)
    {
        return Utilities::getBoardCartCount( @$request->type );
    }
    
}
