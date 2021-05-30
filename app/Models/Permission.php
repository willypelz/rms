<?php


namespace App\Models;


use Trebol\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{

	public function roles()
	{
		return $this->belongsToMany('App\Models\Role');
	}

	public function getRolePermissions($roleId)
	{
		return PermissionRole::whereRoleId($roleId)->pluck('permission_id')->toArray();
	}
}
