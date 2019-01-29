<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobBoard extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'job_boards';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id', 'order_date', 'total_amount', 'discount'];

    public function jobs()
    {
        return $this->belongsToMany('App\Models\Job', 'jobs_job_boards');
    }
}
