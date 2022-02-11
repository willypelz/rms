<?php
namespace App\Models;

use App\User;
use Trebol\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable = ['name', 'description', 'display_name'];

    public function permissions()
    {
      return $this->belongsToMany('App\Models\Permission', 'permission_role');
    }


    public function getRolePermission($roleId){
    	return PermissionRole::whereRoleId($roleId)->pluck('permission_id')->toArray();
    }

  public function users()
  {
    return $this->belongsToMany(User::class, 'role_user', 'user_id', 'role_id');
  }
}
