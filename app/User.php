<?php

namespace App;

use App\Models\WorkflowStep;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Trebol\Entrust\Traits\EntrustUserTrait;


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
        'is_super_admin',
        'user_token'
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

    public function workflow_steps()
    {
      return $this->belongsToMany('App\Models\WorkflowStep');
    }

    public function interviews()
    {
      return $this->belongsToMany('App\Models\Interview');
    }
}
