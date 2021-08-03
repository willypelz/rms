<?php
namespace App\Services;

use App\Dtos\DownloadApplicantSpreadsheetDto;
use App\Dtos\DownloadApplicantInterviewNoteDto;
use App\Dtos\DownloadApplicantCvDto;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\User;

interface ApplicantContract {
    
    /**
     * The Download Applicants Spreedsheet Data to object instance
     * @param App\Dtos\DownloadApplicantSpreadsheetDto the downloadApplicantSpreadsheetDto
     */
    public function downloadSpreadsheet(User $admin, $data);

     /**
     * The Download Applicants Spreedsheet Data to object instance
     * @param App\Dtos\DownloadApplicantSpreadsheetDto the downloadApplicantSpreadsheetDto
     */
<<<<<<< Updated upstream
    public function downloadCv($downloadApplicantCvDto);
=======
    public function downloadCv(User $admin,  $data);
>>>>>>> Stashed changes

    /**
     * The Download Applicants Spreedsheet Data to object instance
     * @param App\Dtos\DownloadApplicantSpreadsheetDto the downloadApplicantSpreadsheetDto
     */
    public function downloadInterviewNotes(User $admin, $data, $type);
    
}

?>