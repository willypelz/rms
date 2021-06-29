<?php

namespace App\Observers;

use App\Models\TestRequest;

class TestRequestObserver
{
    /**
     * Handle the test request "created" event.
     *
     * @param  \App\Models\TestRequest  $testRequest
     * @return void
     */
    public function created(TestRequest $testRequest)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Created a TestbRequest',
                'description' => 'Create Test Request'.' '.$testRequest->name,
                'action_id' => $testRequest->id,
                'action_type' => 'App/Models/TestRequest',
                'causee_id' => auth()->user()->id,
                'causer_id' => auth()->user()->id,
                // 'causer_type' => isset($logAction['causer_type']) ? $logAction['causer_type'] : getCauserType(isset($logAction['causee_id']) ? $logAction['causee_id'] : Null),
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the test request "updated" event.
     *
     * @param  \App\Models\TestRequest  $testRequest
     * @return void
     */
    public function updated(TestRequest $testRequest)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Update a TestRequest ',
                'description' => 'Updated TestRequest'.' '.$testRequest->name,
                'action_id' => $testRequest->id,
                'action_type' => 'App/Models/TestRequest',
                'causee_id' => auth()->user()->id,
                'causer_id' => auth()->user()->id,
                // 'causer_type' => isset($logAction['causer_type']) ? $logAction['causer_type'] : getCauserType(isset($logAction['causee_id']) ? $logAction['causee_id'] : Null),
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the test request "deleted" event.
     *
     * @param  \App\Models\TestRequest  $testRequest
     * @return void
     */
    public function deleted(TestRequest $testRequest)
    {
        //
    }

    /**
     * Handle the test request "restored" event.
     *
     * @param  \App\Models\TestRequest  $testRequest
     * @return void
     */
    public function restored(TestRequest $testRequest)
    {
        //
    }

    /**
     * Handle the test request "force deleted" event.
     *
     * @param  \App\Models\TestRequest  $testRequest
     * @return void
     */
    public function forceDeleted(TestRequest $testRequest)
    {
        //
    }
}
