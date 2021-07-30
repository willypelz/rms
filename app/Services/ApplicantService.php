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

class ApplicantService implements ApplicantContract
{

    use DispatchesJobs;

    /**
     * The Download Applicants Spreedsheet Data to object instance
     * @param App\Dtos\DownloadApplicantSpreadsheetDto the downloadApplicantSpreadsheetDto
     */
    public function downloadSpreadsheet(DownloadApplicantSpreadsheetDto $downloadApplicantSpreadsheetDto)
    {
        $this->dispatch(new SendApplicantsSpreedsheet(\Auth::user(), $downloadApplicantSpreadsheetDto));
    }

    /**
     * The Download Applicants Spreedsheet Data to object instance
     * @param App\Dtos\DownloadApplicantSpreadsheetDto the downloadApplicantSpreadsheetDto
     */
    public function downloadCv($downloadApplicantCvDto)
    {
        $this->dispatch(new SendApplicantsCv(\Auth::user(), $downloadApplicantCvDto) );
    }

    /**
     * The Download Applicants Spreedsheet Data to object instance
     * @param App\Dtos\DownloadApplicantSpreadsheetDto the downloadApplicantSpreadsheetDto
     */
    public function downloadInterviewNotes(DownloadApplicantInterviewNoteDto $downloadApplicantInterviewNoteDto)
    {
	    try{
	        if ($downloadApplicantInterviewNoteDto->isType(DownloadApplicantSpreadsheetDtoType::ZIP))
	            $this->dispatch(new SendApplicantsInterviewNotes(\Auth::user(),get_current_company(), $downloadApplicantInterviewNoteDto));
	        else if ($downloadApplicantInterviewNoteDto->isType(DownloadApplicantSpreadsheetDtoType::CSV))
	            $this->dispatch(new SendApplicantsInterviewNotes(\Auth::user(),get_current_company(), $downloadApplicantInterviewNoteDto));
	        else {
	            throw new \Exception("Interview note operation not implemented yet");
	        }
        }catch(\Exception $e){
	         throw new \Exception("Something went wrong");

        }
    }


}

?>