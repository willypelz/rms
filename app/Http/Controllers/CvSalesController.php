<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Libraries\Solr;
use Cart;


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
            $response = Solr::search_resume($this->search_params);

            $cart = Cart::content();
            $count = Cart::count(false); 
            // dd(!empty($cart));
            //to get ids of all items in cart so as to check the button to display in view
            foreach ($cart as $k) {
                $ids[] = ($k->id);
            }

            if(empty($ids))
                $ids = null;
        // $in_cart = in_array('26618', $ids);

            return view('cv-sales.search-results',['result' => $response, 'items'=> $cart, 'many'=>$count, 'ids'=>$ids]);
    }

    public function Cart(Request $request){
        // echo 'yes';
        if($request->type == 'remove'){
            $search = Cart::search(array('id' => $request->cv_id)); // Returns an array of rowid(s) of found item(s) or false on failure
            Cart::remove($search[0]);

            echo 'Deleted';
            // echo 'Deleted'. $request->cv_id;
        }elseif ($request->type == 'clear') {
            # code...
            Cart::destroy();

        }
        else{
            //Adding to Cart
            Cart::add(array('rowid'=>111111, 'id' => $request->cv_id, 'name' => $request->name, 'qty' => 1, 'price' => 500));
            echo 'Successfully Added';
        }
    }

    public function CartDetails(Request $request){
        Cart::destroy();
    }

    public function Output(){
        $cart = Cart::content();
        dd($cart);
    }

    public function Ajax_cart(){
        $items = Cart::content();
        $view = view('cv-sales.ajax_cart', compact('items'));
        return $view;
    }

    public function Ajax_checkout(){
        $items = Cart::content();
        
        $total_amount = 0;
        foreach ($items as $k) {
          $total_amount += ($k->price);
          // dd(date('Y-m-d H:i:s'));
        }
       // dd($total_amount);
        $order = Order::firstOrCreate([
                    'company_id' => '1',
                    'order_date'=> date('Y-m-d H:i:s'),
                    'total_amount'=>$total_amount,
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

        $view = view('cv-sales.ajax_checkout', compact('items', 'order_id', 'total_amount'));
        return $view;
    }

    public function Payment(Request $request){

        $items = Cart::content();
        $type = ($request->payment_option);
        $order_id = $request->order_id;
        $total_amount = $request->amount.'00';
        return view('cv-sales.payment', compact('type', 'items', 'order_id', 'total_amount'));
    }
    

    public function Transactions(Request $request){

        $transaction = Transaction::firstOrCreate([
            'order_id' => $request->order_id,
            'status'=> $request->status,
            'message'=>$request->message
        ]);

        return $transaction;
    }
}
