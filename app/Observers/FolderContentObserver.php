<?php

namespace App\Observers;

use App\Models\FolderContent;

class FolderContentObserver
{
    /**
     * Handle the FolderContent "created" event.
     *
     * @param  \App\Models\FolderContent  $folderContent
     * @return void
     */
    public function created(FolderContent $folderContent)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Created a FolderContent Model',
                'description' => 'Created a folder content',
                'action_id' => $folderContent->id,
                'action_type' => 'Create',
                'causee_id' => auth()->user()->id,
                'causer_id' =>  auth()->user()->id,
                //'causer_type' => isset($logAction['causer_type']) ? $logAction['causer_type'] : getCauserType(isset($logAction['causee_id']) ? $logAction['causee_id'] : Null),
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the FolderContent "updated" event.
     *
     * @param  \App\Models\FolderContent  $FolderContent
     * @return void
     */
    public function updated(FolderContent $folderContent)
    {
        //
    }

    /**
     * Handle the FolderContent "deleted" event.
     *
     * @param  \App\Models\FolderContent  $FolderContent
     * @return void
     */
    public function deleted(FolderContent $folderContent)
    {
        //
    }

    /**
     * Handle the FolderContent "restored" event.
     *
     * @param  \App\Models\FolderContent  $FolderContent
     * @return void
     */
    public function restored(FolderContent $folderContent)
    {
        //
    }

    /**
     * Handle the FolderContent "force deleted" event.
     *
     * @param  \App\Models\FolderContent  $FolderContent
     * @return void
     */
    public function forceDeleted(FolderContent $folderContent)
    {
        //
    }
}
