<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'specializations';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'company_id'];

    public $timestamps = false;

    public function jobs(){
        return $this->belongsToMany('App\Models\Job', 'jobs_specializations');
    }

    

}
