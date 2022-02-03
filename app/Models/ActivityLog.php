<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityLog extends Model
{
    use SoftDeletes;

    public $table = 'activity_logs';

    protected $fillable = [
        'log_name', 'description', 'action_id', 'action_type', 'causee_id', 'causer_id', 'causer_type', 'properties', 'is_active', 'company_id', 'ip', 'is_external_supervisor', 'is_applicant'
    ];

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    public function subject()
    {
        return $this->belongsTo('App\User','causee_id');
    }

    public function candidateSubject()
    {
        return $this->belongsTo('App\Models\Candidate', 'causee_id');
    }

    public function causer()
    {
        return $this->belongsTo('App\User','causer_id');
    }
    public function company(){
        
        return $this->belongsTo('App\Models\Company','company_id');
    }
    public function candidate()
    {
        return $this->belongsTo('App\Models\Candidate','causer_id');
    }

    public function employee()
    {
        return $this->hasOne('App\User', 'id', 'causer_id');
    }
}
