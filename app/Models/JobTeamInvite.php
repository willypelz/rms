<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobTeamInvite extends Model
{
    //
    public $guarded = [];

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'job_id',
        'role_ids',
        'company_id',
        'is_internal',
        'role_name',
        'created_at',
        'updated_at'
    ];

    protected $table = 'job_team_invites';

public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
