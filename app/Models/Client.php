<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url'];

    /**

	 * Client has many company relation
	 * 
	 * @return mixed
	 */

	public function companies()
	{
		return $this->hasMany('App\Models\Company', 'client_id');
	}
}
