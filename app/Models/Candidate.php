<?php

namespace App\Models;

use App\Models\Company;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Candidate extends Authenticatable
{

    protected $fillable = [
        'first_name', 'last_name', 'email', 
        'password', 'remember_token','token','
        is_from','company_id', 'client_id'
    ];

    public function getNameAttribute()
    {
        $first = ucfirst($this->first_name);
        $last = ucfirst($this->last_name);
        
        return "{$first} {$last}";
    }

    public function cvs()
    {
        return $this->HasMany('App\Models\Cv');
    }

    public function applications()
    {
        return $this->HasMany('App\Models\JobApplication');
    }

    public function defaultCompany()
    {
        return Company::first();
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

}
