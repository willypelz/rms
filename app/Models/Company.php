<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'companies';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'logo', 'phone', 'address', 'website', 'slug', 'about', 'location_id'];

    public $timestamps = false;

    public function jobs(){
        return $this->hasMany('App\Models\Job', 'company_id');
    }

}
