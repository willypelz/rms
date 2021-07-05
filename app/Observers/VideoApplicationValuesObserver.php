<?php

namespace App\Observers;

use App\Models\VideoApplicationValues;

class VideoApplicationValuesObserver
{
    /**
     * Handle the video application values "created" event.
     *
     * @param  \App\Models\VideoApplicationValues  $videoApplicationValues
     * @return void
     */
    public function created(VideoApplicationValues $videoApplicationValues)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Create a Video Application Values',
                'description' => 'Video Application',
                'action_id' => $videoApplicationValues->id,
                'action_type' => 'App\Models\VideoApplicationValues',
                'causee_id' => auth()->guard('candidate')->user()->id,
                'causer_id' => auth()->guard('candidate')->user()->id,
                'causer_type' => 'applicant',
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the video application values "updated" event.
     *
     * @param  \App\Models\VideoApplicationValues  $videoApplicationValues
     * @return void
     */
    public function updated(VideoApplicationValues $videoApplicationValues)
    {
        //
    }

    /**
     * Handle the video application values "deleted" event.
     *
     * @param  \App\Models\VideoApplicationValues  $videoApplicationValues
     * @return void
     */
    public function deleted(VideoApplicationValues $videoApplicationValues)
    {
        //
    }

    /**
     * Handle the video application values "restored" event.
     *
     * @param  \App\Models\VideoApplicationValues  $videoApplicationValues
     * @return void
     */
    public function restored(VideoApplicationValues $videoApplicationValues)
    {
        //
    }

    /**
     * Handle the video application values "force deleted" event.
     *
     * @param  \App\Models\VideoApplicationValues  $videoApplicationValues
     * @return void
     */
    public function forceDeleted(VideoApplicationValues $videoApplicationValues)
    {
        //
    }
}
