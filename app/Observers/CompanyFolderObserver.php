<?php

namespace App\Observers;

use App\Models\CompanyFolder;

class CompanyFolderObserver
{
    /**
     * Handle the company folder "created" event.
     *
     * @param  \App\Models\CompanyFolder  $companyFolder
     * @return void
     */
    public function created(CompanyFolder $companyFolder)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Created a CompanyFolder Model',
                'description' => 'Created a CompanyFolder',
                'action_id' => $companyFolder->id,
                'action_type' => 'Create',
                'causee_id' => $companyFolder->company_id,
                'causer_id' => auth()->user()->id,
                //'causer_type' => isset($logAction['causer_type']) ? $logAction['causer_type'] : getCauserType(isset($logAction['causee_id']) ? $logAction['causee_id'] : Null),
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the company folder "updated" event.
     *
     * @param  \App\Models\CompanyFolder  $companyFolder
     * @return void
     */
    public function updated(CompanyFolder $companyFolder)
    {
        //
    }

    /**
     * Handle the company folder "deleted" event.
     *
     * @param  \App\Models\CompanyFolder  $companyFolder
     * @return void
     */
    public function deleted(CompanyFolder $companyFolder)
    {
        //
    }

    /**
     * Handle the company folder "restored" event.
     *
     * @param  \App\Models\CompanyFolder  $companyFolder
     * @return void
     */
    public function restored(CompanyFolder $companyFolder)
    {
        //
    }

    /**
     * Handle the company folder "force deleted" event.
     *
     * @param  \App\Models\CompanyFolder  $companyFolder
     * @return void
     */
    public function forceDeleted(CompanyFolder $companyFolder)
    {
        //
    }
}
