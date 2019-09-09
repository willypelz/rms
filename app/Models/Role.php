<?php
namespace App\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable = ['name', 'description', 'display_name'];

     public function permissions()
    {
      return $this->belongsToMany('App\Models\Permission', 'permission_role');
    }
}