<?php

namespace App\Services;
use App\User;

interface UserContract {
   
    /**
     * TO GET THE DEFAULT COMPANY FOR A USER
     * @param User the user of interest
     * @return App\Model\Company
    */
    public function getDefaultCompany(User $user);

}

?>