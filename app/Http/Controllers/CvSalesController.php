<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Order;
use App\User;
use App\Models\Cv;
use App\Models\Transaction;
use App\Models\OrderItem;
use App\Models\CompanyFolder;
use App\Models\FolderContent;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use App\Libraries\Solr;
use Cart;
use Auth;
use Mail;
use Carbon\Carbon;


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
        // $this->middleware('auth');
    }

    public function search(Request $request)
    {
            

            if( $request->search_query && $request->search_query != '' )
            {
                $this->search_params['q'] = $request->search_query;
            }

            if( $request->start )
            {
                $this->search_params['start'] = $request->start;
            }
            
            
            $this->search_params['filter_query'] = @$request->filter_query;
            $response = Solr::search_resume($this->search_params);

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
                $search_results = view('cv-sales.includes.search-results-item',['result' => $response,'search_query' => $request->search_query, 'items'=> $cart, 'many'=>$count, 'ids'=>$ids])->render();    
                $search_filters = view('cv-sales.includes.search-filters',['result' => $response,'search_query' => $request->search_query])->render();
                return response()->json( [ 'search_results' => $search_results, 'search_filters' => $search_filters ] );
                
            }
            else{
                return view('cv-sales.search-results',['result' => $response,'search_query' => $request->search_query, 'items'=> $cart, 'many'=>$count, 'ids'=>$ids ]);
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
        }
        
        
        return view('cv-sales.includes.cv-preview',compact("cv", "is_applicant", "appl", 'is_embedded'));
    }

    static function saveCvPreview(Request $request){ // to solr
        $cv = $request->cv;
        $cv_file = $cv['cv_file'];
        $filepath = public_path($cv['cv_file']);
        $cv['raw_content'] = file_get_contents("http://127.0.0.1:5000/extract?file_name=".urlencode( $filepath ) );
        return $cv;
        // return Carbon::createFromDate(1991, 7, 19)->diff(Carbon::now())->format('%y years, %m months and %d days');
    }

    public function Cart(Request $request){
        
        // dd($request);
        if(isset($request->cart_type)){

            if($request->cart_type == 'jobBoards'){
                   if($request->type == 'add'){
                     // Cart::instance('JobBoard')->add('sdjk922', 'Product 2', 1, 19.95, array('size' => 'medium'));
                    Cart::instance('JobBoard')->add(array('rowid'=>111111, 'id' => $request->board_id, 'name' => $request->name, 'qty' => 1, 'price' => $request->price));
                    echo 'Added Successfully';
                   }elseif ($request->type == 'remove') {
                        $search = Cart::instance('JobBoard')->search(array('id'=>$request->board_id));
                        Cart::instance('JobBoard')->remove($search[0]);
                        echo 'Deleted';    
                   }else{
                        
                        Cart::instance('JobBoard')->destroy();

                   } 

            }

        }else{

            if($request->type == 'remove'){
                $search = Cart::search(array('id' => $request->cv_id)); // Returns an array of rowid(s) of found item(s) or false on failure
                Cart::remove($search[0]);

                echo 'Deleted';
            }elseif ($request->type == 'clear') {
                Cart::destroy();
            }
            else{
                Cart::add(array('rowid'=>111111, 'id' => $request->cv_id, 'name' => $request->name, 'qty' => 1, 'price' => 500));
                echo 'Successfully Added';
            }
        }
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

        if(isset($request->cart_type)){

            if($request->cart_type == 'jobBoards'){
                $items = Cart::instance('JobBoard')->content();
                $jobBoards = 'JOB Boards';

                 $view = view('cv-sales.ajax_cart', compact('items', 'jobBoards'));
                return $view;
            }

        }else{
            $items = Cart::content();
            $view = view('cv-sales.ajax_cart', compact('items'));
            return $view;
        }
    }

    public function Ajax_checkout(Request $request){

        $user = Auth::user();

        if(empty($user)){
            $view = view('auth.ajax_login');
            return $view;
        }

        $invoice_no = '#'.mt_rand();

        $d = User::with('companies')->where('id', $user->id)->first();
        $company = ($d->companies[0]);

        if(isset($request->cart_type)){

            if($request->cart_type == 'jobBoards'){
                $items = Cart::instance('JobBoard')->content();

                $total_amount = $request->total_amount;
                
                $order = Order::firstOrCreate([
                        'company_id' => $company->id,
                        'order_date'=> date('Y-m-d H:i:s'),
                        'total_amount'=>$total_amount,
                        'invoice_no'=> $invoice_no,
                        'type'=> 'Job Board',
                ]);

                foreach ($items as $k) {

                    $orderItems = OrderItem::firstOrCreate([
                                'order_id' => $order->id,
                                'itemId' => $k->id,
                                'type' => 'Job Board',
                                'name' => $k->name,
                                'price' => $k->price
                     ]);

                }

                $order_id = $order->id;
                $jobBoards = 'JOB Boards';
                $view = view('cv-sales.checkout_ajax', compact('items', 'order_id', 'total_amount', 'jobBoards', 'company', 'invoice_no'));
                return $view;
            }

        }else{
           
            $items = Cart::content();
            
            $total_amount = 0;
            foreach ($items as $k) {
              $total_amount += ($k->price);
            }
            $order = Order::firstOrCreate([
                        'company_id' => $company->id,
                        'order_date'=> date('Y-m-d H:i:s'),
                        'total_amount'=>$total_amount,
                        'invoice_no'=> $invoice_no,
                        'type'=>'cvs',
            ]);

            foreach ($items as $k) {
              $orderItems = OrderItem::firstOrCreate([
                                'order_id' => $order->id,
                                'itemId' => $k->id,
                                'type' => 'Cv-sales',
                                'name' => $k->name,
                                'price' => $k->price
                ]);
            }
            $order_id = $order->id;



           // Mail::send('emails.cv-sales.invoice', ['user' => $user], function ($m) use ($user) {
           //      $m->from('alerts@insidify.com', 'Your Application');

           //      $m->to('lanaayodele@gmail.com', 'Ayo')->subject('Your Reminder!');
           //  });
           
            $view = view('cv-sales.checkout_ajax', compact('items', 'order_id', 'total_amount', 'company'));
            return $view;
        }
    }

    public function Payment(Request $request, $type = null){

        $company = Auth::user()->companies[0];


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
            $folders = $company_folder_obj->getMyFolders( Auth::user()->companies[0]->id );
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
            $company_folder_obj::create( ['name' => $request->name, 'type' => $request->type, 'date_added' => Carbon::now(), 'company_id' => Auth::user()->companies[0]->id ] );

            
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

        if( $request->start )
        {
            $this->search_params['start'] = $request->start;
        }
        
        
        $this->search_params['filter_query'] = @$request->filter_query;
        // $response = Solr::search_resume($this->search_params);
        $response = Solr::get_saved_cvs($this->search_params);


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
            
            $search_results = view('cv-sales.includes.search-results-item',['result' => $response,'search_query' => $request->search_query, 'items'=> $cart, 'many'=>$count, 'ids'=>$ids, 'is_saved' => true])->render();    
            $search_filters = view('cv-sales.includes.search-filters',['result' => $response,'search_query' => $request->search_query])->render();
            return response()->json( [ 'search_results' => $search_results, 'search_filters' => $search_filters ] );
            
        }
        else{
            return view('cv-sales.cv_saved',['result' => $response,'search_query' => $request->search_query, 'items'=> $cart, 'many'=>$count, 'ids'=>$ids, 'is_saved' => true ]);
        }
        // return view('cv-sales.cv_saved');
    }

    public function viewPurchased(Request $request)
    {
        $this->search_params['q'] = ( $request->search_query && trim( $request->search_query ) != '' ) ? $request->search_query : '*' ;

        if( $request->start )
        {
            $this->search_params['start'] = $request->start;
        }
        
        
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
            
            $search_results = view('cv-sales.includes.search-results-item',['result' => $response,'search_query' => $request->search_query, 'items'=> $cart, 'many'=>$count, 'ids'=>$ids, 'is_saved' => true])->render();    
            $search_filters = view('cv-sales.includes.search-filters',['result' => $response,'search_query' => $request->search_query])->render();
            return response()->json( [ 'search_results' => $search_results, 'search_filters' => $search_filters ] );
            
        }
        else{
            return view('cv-sales.cv_purchased',['result' => $response,'search_query' => $request->search_query, 'items'=> $cart, 'many'=>$count, 'ids'=>$ids, 'is_saved' => true ]);
        }
        // return view('cv-sales.cv_saved');
    }
    
    public function viewTalentPool(Request $request)
    {
        $this->search_params['q'] = ( $request->search_query && trim( $request->search_query ) != '' ) ? $request->search_query : '*' ;

        if( $request->start )
        {
            $this->search_params['start'] = $request->start;
        }
        
        
        $this->search_params['filter_query'] = @$request->filter_query;
        // $response = Solr::search_resume($this->search_params);
        $response = Solr::get_all_my_cvs($this->search_params);


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
            
            $search_results = view('cv-sales.includes.search-results-item',['result' => $response,'search_query' => $request->search_query, 'items'=> $cart, 'many'=>$count, 'ids'=>$ids, 'is_saved' => true])->render();    
            $search_filters = view('cv-sales.includes.search-filters',['result' => $response,'search_query' => $request->search_query])->render();
            return response()->json( [ 'search_results' => $search_results, 'search_filters' => $search_filters ] );
            
        }
        else{
            return view('cv-sales.cv_pool',['result' => $response,'search_query' => $request->search_query, 'items'=> $cart, 'many'=>$count, 'ids'=>$ids, 'is_saved' => true ]);
        }
        // return view('cv-sales.cv_saved');
    }

    
}
