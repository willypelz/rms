<?php

namespace App\Observers;

use App\Models\FormFieldValues;

class FormFieldValuesObserver
{
    /**
     * Handle the form fields values "created" event.
     *
     * @param  \App\Models\FormFieldsValues  $formFieldValues
     * @return void
     */
    public function created(FormFieldsValues $formFieldValues)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Create a FormFieldValues Model',
                'description' => 'Created a formfield value',
                'action_id' => $formFieldValues->id,
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
     * Handle the form fields values "updated" event.
     *
     * @param  \App\Models\FormFieldValues  $formFieldValues
     * @return void
     */
    public function updated(FormFieldValues $formFieldValues)
    {
        //
    }

    /**
     * Handle the form fields values "deleted" event.
     *
     * @param  \App\Models\FormFieldValues  $formFieldValues
     * @return void
     */
    public function deleted(FormFieldValues $formFieldValues)
    {
        //
    }

    /**
     * Handle the form fields values "restored" event.
     *
     * @param  \App\Models\FormFieldValues  $formFieldValues
     * @return void
     */
    public function restored(FormFieldValues $formFieldValues)
    {
        //
    }

    /**
     * Handle the form fields values "force deleted" event.
     *
     * @param  \App\Models\FormFieldsValues  $formFieldValues
     * @return void
     */
    public function forceDeleted(FormFieldValues $formFieldValues)
    {
        //
    }
}
