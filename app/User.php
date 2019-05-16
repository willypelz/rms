<?php

namespace App;

use App\Models\WorkflowStep;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;


class User extends Authenticatable
{
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'invite_code',
        'is_internal',
        'role_name',
        'is_super_admin'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',

    ];

    public function companies()
    {
        return $this->belongsToMany('App\Models\Company', 'company_users')->withPivot('role');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'role_user')->withPivot('job_id');
    }

    public function workflowSteps()
    {
        return $this->belongsToMany(
            WorkflowStep::class,
            'approval_workflow_step',
            'user_id',
            'workflow_step_id'
        );
    }
}
