<?php 

namespace App\Libraries;

use Carbon\Carbon;
use Cart;

class Utilities {



	static function getAge($dob){
		return Carbon::parse( $dob )->diff(Carbon::now())->format('%y years');
		// return Carbon::createFromDate(1991, 7, 19)->diff(Carbon::now())->format('%y years, %m months and %d days');
	}

	static function getBoardCartCount($type='JobBoard'){
		// return Cart::count(false);
		return Cart::instance($type)->count(false);

	}

	static function getCartContent($type='JobBoard'){
		return Cart::instance($type)->content();
	}

	static function getBoardCartCost($type='JobBoard'){
		$cons = Cart::instance($type)->content();
         $total_amount = 0;
         foreach ($cons as $c) {
            $total_amount += $c->price;
         }
         return $total_amount;
	}
	

	

}
