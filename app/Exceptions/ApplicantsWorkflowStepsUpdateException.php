<?php

namespace App\Exceptions;

use Exception;

/**
 * Handle Exceptions related to updating applicants workflow steps bulk update update
 */
class ApplicantsWorkflowStepsUpdateException extends Exception
{

    protected $message;

    public function __construct($message){
        parent::__construct($message);
    }

}
