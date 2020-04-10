<?php


namespace App\Models;


use Trebol\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{

		public function roles()
	  {
	    return $this->belongsToMany('App\Models\Role');
	  }
}