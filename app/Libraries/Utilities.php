<?php 

namespace App\Libraries;

use Carbon\Carbon;
use Cart;

class Utilities {



	static function getAge($dob){
		return Carbon::parse( $dob )->diff(Carbon::now())->format('%y years');
		// return Carbon::createFromDate(1991, 7, 19)->diff(Carbon::now())->format('%y years, %m months and %d days');
	}

	static function getCartCount(){
		return Cart::count(false);
	}
	
}
