<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class PrivateEmailRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public function __construct()
    {
        
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        
        $arr = explode(',',$value);
        
        foreach($arr as $email){
            $email_validate['attach_email'][] = $email;
            $rules = array('attach_email.*'=>'email');

            $validator = Validator::make($email_validate,$rules);

            if ($validator->fails()){
                return false;
            }
            return true;
        }
        

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        //return 'The :attribute must contain valid email addresses.';
        return 'Invalid email address attached to job';
    }
}
