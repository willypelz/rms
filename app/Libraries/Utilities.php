<?php 

namespace App\Libraries;

use Carbon\Carbon;
use Cart;

class Utilities {



	static function getAge($dob){
		return Carbon::parse( $dob )->diff(Carbon::now())->format('%y years');
		// return Carbon::createFromDate(1991, 7, 19)->diff(Carbon::now())->format('%y years, %m months and %d days');
	}

	static function getBoardCartCount(){
		// return Cart::count(false);
		return Cart::instance('JobBoard')->count(false);

	}

	static function getBoardCartCost(){
		$cons = Cart::instance('JobBoard')->content();
         $total_amount = 0;
         foreach ($cons as $c) {
            $total_amount += $c->price;
         }
         return $total_amount;
	}
	

	

}
