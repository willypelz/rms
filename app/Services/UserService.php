<?php

namespace App\Services;
use App\Services\UserContract;
use App\User;
use App\Enum\Configs;
use App\Models\Company;

class UserService implements UserContract {

    /**
     * TO GET THE DEFAULT COMPANY FOR A USER
     * @param User the user of interest
     * @return App\Model\Company
    */
    public function getDefaultCompany(User $user){
        $defaultCompany = $user->companies()->wherePivot('is_default', 1)->first();
        if($defaultCompany){
            return $defaultCompany;
        }else if(isHrmsIntegrated()){
            return $this->getDefaultCompanyFromHrms($user);
        }else{
            return $this->getDefaultCompanyFromRms($user);
        }
    }

    /**
     * TO GET THE DEFAULT COMPANY FOR A USER FROM HRMS
     * @param User the user of interest
     * @return App\Model\Company | null
    */
    private function getDefaultCompanyFromHrms(User $user){
        $response = getResponseFromHrmsByGET(Configs::GET_USER_DEFAULT_COMPANY,  ["employeeEmail" =>  $user->email] );
        if($response){
            $userHrmsDefaultCompany = $response->data;
            $rmsCompany = Company::where(["hrms_id" => $userHrmsDefaultCompany->id])->first();
            $company = $user->companies()->where(["company_users.company_id" => $rmsCompany->id])->wherePivot('is_default', 1)->first() ?: 
                       $user->companies()->updateExistingPivot( $rmsCompany->id, ["is_default" => 1]);
            return $company ? $rmsCompany  : null;
        }
        return null;
    }
    /**
     * TO GET THE DEFAULT COMPANY FOR A USER FROM RMS
     * @param User the user of interest
     * @return App\Model\Company | null
    */
    private function getDefaultCompanyFromRms($user){
        return $user->companies()->first();
    }

}

?>