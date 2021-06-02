<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $fillable = ['user_id', 'role_id', 'job_id'];

    protected $table = "role_user";

	public function role()
	{
		return $this->belongsTo('App\Models\Role', 'role_id');
	}
}
