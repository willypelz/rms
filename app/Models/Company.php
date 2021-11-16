<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;
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
    	'hrms_id',
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
        'api_key',
        'license_type',
	    'is_active',
        'is_default',
        'client_id',
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

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'company_users',  "company_id", "role_id");
    }

    public function companyAtsProductTests()
    {
        return $this->hasMany('App\Models\CompanyTest', "company_id");
    }

}
