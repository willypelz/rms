<?php

namespace App;

use App\Models\WorkflowStep;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Trebol\Entrust\Traits\EntrustUserTrait;
use Illuminate\Notifications\Notifiable;
use App\Models\Company;
use Ixudra\Curl\Facades\Curl;
use App\Enum\Configs;

class User extends Authenticatable
{
    use EntrustUserTrait, Notifiable;
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

    public function isAdmin()
    {
        $admin = $this->roles()->count();
        return $admin ? true:false;
    }

    public function company()
    {
        $this->getDefaultCompany();
    }

    public function getDefaultCompany(){
        if(isHrmsIntegrated())
            return $this->getDefaultCompanyFromHrms();
        else
            return $this->getDefaultCompanyFromRms();
    }

    private function getDefaultCompanyFromHrms(string $employeeEmail = null){
        $response = getResponseFromHrmsByGET(Configs::GET_USER_DEFAULT_COMPANY,  ["employeeEmail" => $employeeEmail ?: \Auth::user()->email] );
        if($response){
            $userHrmsDefaultCompany = $response->data;
            $rmsCompany = Company::where(["hrms_id" => $userHrmsDefaultCompany->id])->first();
            $company = $this->companies()->where(["company_users.company_id" => $rmsCompany->id])->wherePivot('is_default', 1)->first() ?: 
                       $this->companies()->updateExistingPivot( $rmsCompany->id, ["is_default" => 1]);
            return $company ? $rmsCompany  : null;
        }
        return null;
    }

    private function getDefaultCompanyFromRms(){
        return $this->companies()->first();
    }

}