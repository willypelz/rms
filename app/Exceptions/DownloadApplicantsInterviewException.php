<?php

namespace App\Exceptions;

use Exception;

/**
 * Handle Exceptions related to dowmloading applicants interview
 */
class DownloadApplicantsInterviewException extends Exception
{

    protected $message;

    public function __construct($message){
        parent::__construct($message);
    }

}
