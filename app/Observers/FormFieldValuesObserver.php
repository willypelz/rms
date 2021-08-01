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
     /**TODO: Figur out why it breaks when running create in a loop inside app/Http/Controllers/API/JobController.php line 445 */
       
    /* public function created(FormFieldsValues $formFieldValues)
    {
        if(auth()->check()){
            $param = [
                'log_name' => 'Created a FormFieldValues',
                'description' => 'Created a formfield value',
                'action_id' => $formFieldValues->id,
                'action_type' => 'App\Models\FormFieldValues',
                'causee_id' => auth()->user()->id ?? null,
                'causer_id' =>  auth()->user()->id ?? null,
                'causer_type' => '',
                'properties' => '',
            ];
            logAction($param);
           
        }
    }
    */
}
