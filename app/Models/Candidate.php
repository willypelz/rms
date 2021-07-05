<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Candidate extends Authenticatable
{

    protected $fillable = ['first_name', 'last_name', 'email', 'password', 'remember_token','token','is_from','company_id'];

    public function name()
    {
       return "{$this->first_name} {$this->last_name}";
    }

    public function cvs()
    {
        return $this->HasMany('App\Models\Cv');
    }

    public function applications()
    {
        return $this->HasMany('App\Models\JobApplication');
    }

}
