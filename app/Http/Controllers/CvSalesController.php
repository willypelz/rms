<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\OrderItem;
use App\Models\CompanyFolder;
use App\Models\FolderContent;
use Illuminate\Http\Request;
use App\Libraries\Solr;
use Cart;
use Auth;
use Mail;
use Carbon\Carbon;


class CvSalesController extends Controller
{
    private $search_params = [ 'q' => '*', 'row' => 20, 'start' => 0, 'default_op' => 'AND', 'search_field' => 'text', 'show_expired' => false ,'sort' => 'post_date+desc', 'grouped'=>FALSE ];
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
            $this->search_params['q'] = $request->search_query;
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
        //http://127.0.0.1:5000/extract
        // $text = file_get_contents("http://127.0.0.1:5000/extract?file_name=".urlencode( $filepath ) );
        $filepath = public_path("adeigbe_musibau_2015.doc");
        $cv = file_get_contents("http://127.0.0.1:5000/extract?file_name=".urlencode( $filepath ) );

        return view('cv-sales.includes.cv-preview',['cv' => $cv ]);
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
         $search = Cart::instance('JobBoard')->search(array('id' =>'4'));
         // echo $search;
         dd($search);
    }

    public function Output(){
        $cart = Cart::instance('JobBoard')->content();
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

        if(isset($request->cart_type)){

            if($request->cart_type == 'jobBoards'){
                $items = Cart::instance('JobBoard')->content();

                $total_amount = $request->total_amount;
                
                $order = Order::firstOrCreate([
                        'company_id' => '1',
                        'order_date'=> date('Y-m-d H:i:s'),
                        'total_amount'=>$total_amount,
                        'type'=> 'Job Board'
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
                $view = view('cv-sales.checkout_ajax', compact('items', 'order_id', 'total_amount', 'jobBoards'));
                return $view;
            }

        }else{
           
            $items = Cart::content();
            
            $total_amount = 0;
            foreach ($items as $k) {
              $total_amount += ($k->price);
            }
            $order = Order::firstOrCreate([
                        'company_id' => '1',
                        'order_date'=> date('Y-m-d H:i:s'),
                        'total_amount'=>$total_amount,
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

           Mail::send('emails.cv-sales.invoice', ['user' => $user], function ($m) use ($user) {
                $m->from('alerts@insidify.com', 'Your Application');

                $m->to('lanaayodele@gmail.com', 'Ayo')->subject('Your Reminder!');
            });
           
            $view = view('cv-sales.checkout_ajax', compact('items', 'order_id', 'total_amount'));
            return $view;
        }
    }

    public function Payment(Request $request, $type = null){

        if($type != null){

            $order = Order::where('id', $type)->with('orderItems')->first();
            $items = $order->orderItems;
            $order_id = $order->id;
            $total_amount = $order->total_amount;
            $jobBoards = 'JOB Boards';
            $type= 'bank';

            return view('cv-sales.pay', compact('type', 'items', 'order_id', 'total_amount', 'jobBoards'));

        }else{
            $items = Cart::content();
            $type = ($request->payment_option);
            $order_id = $request->order_id;
            $total_amount = $request->amount.'00';
            return view('cv-sales.pay', compact('type', 'items', 'order_id', 'total_amount'));
        }        
    }
    

    public function Transactions(Request $request){

        $transaction = Transaction::firstOrCreate([
            'order_id' => $request->order_id,
            'status'=> $request->status,
            'message'=>$request->message
        ]);

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
            $folders = $company_folder_obj->getMyFolders( Auth::user()->id );
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
            $company_folder_obj::create( ['name' => $request->name, 'date_added' => Carbon::now(), 'user_id' => Auth::user()->id ] );

            
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
            $folder_content_obj::create( ['item_id' => $request->item_id, 'item_type' => $request->item_type, 'folder_id' => $request->folder_id, 'date_added' => Carbon::now() ] );

            return response()->json( true );

        }
        else
        {
            return "You need to be logged in to add folders";
        }
    }
    
}
