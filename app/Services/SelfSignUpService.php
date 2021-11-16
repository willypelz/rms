<?php

namespace App\Services;
use App\User;
use Exception;
use App\Models\Role;
use App\Models\Client;
use App\Models\Company;
use App\Models\SystemSetting;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NotifyAdminOfNewRMSAccount;
use Seamlesshr\ShrCloudflareDomainGenerator\DomainGenerator;


class SelfSignUpService {

    /**
     * TO CREATE THE DOMAIN NAME and pass the values to other methods
     * @param User the user of interest
     * @return App\Model\Company
    */
    public function createDomain($request){
      //get the baseurl to be used e.g seamlesshiring.com
      $base_url = DomainGenerator::getBaseURL(); 
      if($base_url == 'seamlesshiring.com'){
            $sub_domain_available = DomainGenerator::isSubdomainAvailable($request->domain); //true/false
            if($sub_domain_available){
                //returns either true or an exception. You can pass either "add" or "delete" as second param
                $add_subdomain = DomainGenerator::mapURL($request->domain,'add'); 
                if(is_bool($add_subdomain) && $add_subdomain){
                    return $this->createClientAndCompany($request);
                }
            }  
      }else{
        throw new Exception('Chosen url is no longer available, please try another');
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
                        'license_type' => 'TRIAL',
                        'client_id' => $client->id,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        ],
                        ['slug' => str_slug($request->company_name.microtime()),
                        'date_added' => date('Y-m-d')]);
        //$solr = "http://solr-load-balancer-785410781.eu-west-1.elb.amazonaws.com:8983/solr/admin/cores?action=CREATE&name=".str_slug($client->slug);
       //$this->updateEnvValueInDb($client,$company);
        return $this->createUserAndRoles($request,$company);
    }
 
    /**
     * add env values that need to be unique from beginning
     * @param $request 
     * @param $company
     * @return App\User
    */
    private function updateEnvValueInDb($client, $company){
        $envKeys = ['APP_URL'=>$client->url, 'COMPANY_EMAIL'=>$company->email,'COMPANY_NAME'=>$company->name, 
                    'SOLR_URL'=>"http://solr-load-balancer-785410781.eu-west-1.elb.amazonaws.com:8983/solr/",'SOLR_CORE'=>str_slug($client->name),];
        
        foreach($envKeys as $key=>$value) {
                     SystemSetting::updateOrCreate([
                    'client_id' =>$company->client_id,
                    'key' => $key],
                     ['value' => $value]);
        }
    }

    /**
     * create user and attach user to admin role and  the created company
     * @param $request 
     * @param $company
     * @return App\User
    */
    private function createUserAndRoles($request, $company){
        //using this approach cos firstOrCreate strangely doesn't work on RMS with user table
            $user = User::where('email',$request->email)->where('client_id', $company->client_id)->first();
            if(!$user){
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->is_internal = 1;
                $user->activated = 1;
                $user->is_super_admin = 1;
                $user->client_id = $company->client_id;
                $user->save();
            }else{
                $user = $user;
            }

            $role = Role::whereName('admin')->first()->id;
            $company->users()->attach($user->id, ['role' => $role,'date_added'=>date('Y-m-d')]);
            $user->roles()->attach([$role]);
         
            Notification::send($user,new NotifyAdminOfNewRMSAccount($company,$user));
            
            return $user;
    }
   

}

?>