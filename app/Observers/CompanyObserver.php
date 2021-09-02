<?php

namespace App\Observers;

use App\Models\Company;

class CompanyObserver
{
    /**
     * Handle the company "created" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */ 

    public function created(Company $company)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Create Company',
                'description' => 'Added company '.$company->name,
                'action_id' => $company->id,
                'action_type' => 'App\Models\Company',
                'causee_id' => auth()->user()->id,
                'causer_id' => auth()->user()->id,
                'causer_type' => 'admin',
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the company "updated" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function updated(Company $company)
    {
        //
        if(auth()->check()){
            $old = $company->getOriginal('name');
            if($company->isDirty('name')){
                $param = [
                    'log_name' => 'Updated Company',
                    'description' => 'Updated the company '.$old.' name to '.$company->name,
                    'action_id' => $company->id,
                    'action_type' => 'App\Models\Company',
                    'causee_id' => auth()->user()->id,
                    'causer_id' => auth()->user()->id,
                    'causer_type' => 'admin',
                    'properties' => '',
                ];
            }else{
                $param = [
                    'log_name' => 'Updated Company',
                    'description' => 'Updated the company '.$company->name.' info',
                    'action_id' => $company->id,
                    'action_type' => 'App\Models\Company',
                    'causee_id' => auth()->user()->id,
                    'causer_id' => auth()->user()->id,
                    'causer_type' => 'admin',
                    'properties' => '',
                ];
            }
            
            logAction($param);
            
        }
    }

    /**
     * Handle the company "deleted" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function deleted(Company $company)
    {
        //
    }

    /**
     * Handle the company "restored" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function restored(Company $company)
    {
        //
    }

    /**
     * Handle the company "force deleted" event.
     *
     * @param  \App\Models\Company  $company
     * @return void
     */
    public function forceDeleted(Company $company)
    {
        //
    }
}
