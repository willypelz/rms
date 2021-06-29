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
                'log_name' => 'Created CompanyFolder',
                'description' => 'Created CompanyFolder',
                'action_id' => $companyFolder->id,
                'action_type' => 'App\Models\CompanyFolder',
                'causee_id' => '',
                'causer_id' => auth()->user()->id,
                'causer_type' => 'admin',
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
