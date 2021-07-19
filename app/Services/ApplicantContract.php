<?php
namespace App\Services;

use App\Dtos\DownloadApplicantSpreadsheetDto;
use App\Dtos\DownloadApplicantInterviewNoteDto;
use App\Dtos\DownloadApplicantCvDto;
use Illuminate\Foundation\Bus\DispatchesJobs;

interface ApplicantContract {
    
    /**
     * The Download Applicants Spreedsheet Data to object instance
     * @param App\Dtos\DownloadApplicantSpreadsheetDto the downloadApplicantSpreadsheetDto
     */
    public function downloadSpreadsheet(DownloadApplicantSpreadsheetDto $downloadApplicantSpreadsheetDto);

     /**
     * The Download Applicants Spreedsheet Data to object instance
     * @param App\Dtos\DownloadApplicantSpreadsheetDto the downloadApplicantSpreadsheetDto
     */
    public function downloadCv($downloadApplicantCvDto);

    /**
     * The Download Applicants Spreedsheet Data to object instance
     * @param App\Dtos\DownloadApplicantSpreadsheetDto the downloadApplicantSpreadsheetDto
     */
    public function downloadInterviewNotes(DownloadApplicantInterviewNoteDto $downloadApplicantInterviewNoteDto);
    
}

?>