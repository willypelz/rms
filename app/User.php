<?php

namespace App;

use App\Enum\Configs;
use App\Models\Company;
use App\Models\Role;
use App\Models\WorkflowStep;
use App\Services\UserService;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Notifications\Notifiable;
use Trebol\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use EntrustUserTrait, Notifiable;

    protected $userService;

    public function __construct(){
        $this->userService = app()->make(UserService::class);
    }
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

    public function companies(bool $withPivot = false)
    {
        return $this->belongsToMany('App\Models\Company', 'company_users')->withPivot('role', 'is_default');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
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

    public function isAdmin()
    {
        $admin = $this->roles()->count();
        return $admin ? true:false;
    }

    public function isInterviewer()
    {
        $interviewer = $this->roles()->where("name", "interviewer")->first();
        return $interviewer ? true:false;
    }
    
    public function isCommenter()
    {
        $commenter = $this->roles()->where("name", "commenter")->first();
        return $commenter ? true:false;
    }

     /**
     * TO GET THE DEFAULT COMPANY FOR A USER
     * @return App\Model\Company
    */
    public function defaultCompany(){
        return $this->userService->getDefaultCompany($this);
    }

    public static function boot() {
        parent::boot();
        static::created(function (User $user) {
            $user->defaultCompany();
        });
    }

}