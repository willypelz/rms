<?php

namespace App\Services;
use App\User;
use App\Models\Role;
use App\Models\Client;
use App\Models\Company;


class SelfSignUpService {

    /**
     * TO CREATE THE DOMAIN NAME and pass the values to other methods
     * @param User the user of interest
     * @return App\Model\Company
    */
    public function createDomain($request){
      // create $request->domain
     
      if(true){
        return $this->createClientAndCompany($request);
      }
    }

    /**
     * create the client and attach the client to a company
     * @param $request
     * @return App\User
    */
    public function createClientAndCompany($request){
        $client =  Client::firstOrCreate(['url' => $request->domain], ['name' => $request->company_name]); 
      
        $company = Company::firstOrCreate([
                        'name' => $request->company_name,
                        'license_type' => 'PREMIUM',
                        'client_id' => $client->id,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        ],
                        ['slug' => str_slug($request->company_name.microtime()),
                        'date_added' => date('Y-m-d')]);
                        
       return $this->createUserAndRoles($request,$company);
    }
 
    /**
     * create user and attach user to admin role and  the created company
     * @param $request 
     * @param $company
     * @return App\User
    */
    private function createUserAndRoles($request, $company){
      
           $user =  User::firstOrCreate([
                        "name" => $request->name,
                        "email" => $request->email,
                        "is_internal" => 1,
                        "activated" => 1,
                        "is_super_admin" => 1,
                        "client_id" => $company->client_id,
                    ]);
            dd(["name" => $request->name,
            "email" => $request->email,
            "is_internal" => 1,
            "activated" => 1,
            "is_super_admin" => 1,
            "client_id" => $company->client_id]);
            $role = Role::whereName('admin')->first()->id;
            $company->users()->attach($user->id, ['role' => $role]);
            $user->roles()->attach([$role]);
            return $user;
    }
   

}

?>