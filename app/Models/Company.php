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
    protected $fillable = [
        'name',
        'logo',
        'email',
        'phone',
        'address',
        'website',
        'slug',
        'about',
        'location_id',
        'date_added',
        'has_expired',
        'valid_till',
        'api_key'
    ];

    public $timestamps = false;

    public function jobs()
    {
        return $this->hasMany('App\Models\Job', 'company_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'company_users')->withPivot('role', 'role_id');
    }

    public function tests()
    {
        return $this->belongsToMany('App\\Models\AtsProduct', 'company_tests');
    }

}
