<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AllowBusinessEmail implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $exempted_email_servers = ['yahoo.com', 'gmail.com','ymail.com', 'yopmail.com','live.com','aol.com','outlook.com'];
        $get_server = substr($value, strpos($value, '@') + 1);
        return !in_array($get_server,$exempted_email_servers) ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Only an official email is allowed";
    }
}
