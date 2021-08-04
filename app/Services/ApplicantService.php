<?php

namespace App\Services;

use App\Dtos\DownloadApplicantSpreadsheetDto;
use App\Dtos\DownloadApplicantCvDto;
use App\Jobs\AddApplicantToExportInBits;
use App\Notifications\NotifyAdminOfApplicantsSpreedsheetExportCompleted;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Jobs\SendApplicantsSpreedsheet;
use App\Jobs\SendApplicantsCv;
use App\Jobs\SendApplicantsInterviewNotes;
use App\Dtos\DownloadApplicantInterviewNoteDto;
use App\Dtos\DownloadApplicantSpreadsheetDtoType;
use Illuminate\Support\Facades\Storage;
use App\User;

class ApplicantService implements ApplicantContract
{

    use DispatchesJobs;

    /**
     * The Download Applicants Spreedsheet Data to object instance
     * @param App\Dtos\DownloadApplicantSpreadsheetDto the downloadApplicantSpreadsheetDto
     */
    public function downloadSpreadsheet(User $admin,  $data)
    {
		SendApplicantsSpreedsheet::dispatch($admin, $data);
    }

    /**
     * The Download Applicants Spreedsheet Data to object instance
     * @param App\Dtos\DownloadApplicantSpreadsheetDto the downloadApplicantSpreadsheetDto
     */
    public function downloadCv(User $admin,  $data)
    {
        SendApplicantsCv::dispatch($admin, $data);
    }

    /**
     * The Download Applicants Spreedsheet Data to object instance
     * @param App\Dtos\DownloadApplicantSpreadsheetDto the downloadApplicantSpreadsheetDto
     */
    public function downloadInterviewNotes($admin, $data, $type)
    {
	    SendApplicantsInterviewNotes::dispatch($admin, get_current_company(), $data, $type);
    }


}

?>