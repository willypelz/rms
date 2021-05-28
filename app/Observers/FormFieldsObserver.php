<?php

namespace App\Observers;

use App\Models\FormFields;

class FormFieldsObserver
{
    /**
     * Handle the form fields "created" event.
     *
     * @param  \App\Models\FormFields  $formFields
     * @return void
     */
    public function created(FormFields $formFields)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Create a FormFields',
                'description' => 'Created a formfield',
                'action_id' => $formFields->id,
                'action_type' => 'App\Models\FormFields',
                'causee_id' => auth()->user()->id,
                'causer_id' =>  auth()->user()->id,
                'causer_type' => 'admin',
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the form fields "updated" event.
     *
     * @param  \App\Models\FormFields  $formFields
     * @return void
     */
    public function updated(FormFields $formFields)
    {
        //
    }

    /**
     * Handle the form fields "deleted" event.
     *
     * @param  \App\Models\FormFields  $formFields
     * @return void
     */
    public function deleted(FormFields $formFields)
    {
        //
        if(auth()->check()){
            $param = [
                'log_name' => 'Delete a FormFields Model',
                'description' => 'Delete a formfield',
                'action_id' => $formFields->id,
                'action_type' => 'Delete',
                'causee_id' => auth()->user()->id,
                'causer_id' =>  auth()->user()->id,
                'causer_type' => 'admin',
                'properties' => '',
            ];
            logAction($param);
           
        }
    }

    /**
     * Handle the form fields "restored" event.
     *
     * @param  \App\Models\FormFields  $formFields
     * @return void
     */
    public function restored(FormFields $formFields)
    {
        //
    }

    /**
     * Handle the form fields "force deleted" event.
     *
     * @param  \App\Models\FormFields  $formFields
     * @return void
     */
    public function forceDeleted(FormFields $formFields)
    {
        //
    }
}
