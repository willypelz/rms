<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Dtos\DownloadApplicantInterviewNoteDto;
use App\Dtos\DownloadApplicantSpreadsheetDtoType;
use App\User;
use App\Notifications\NotifyAdminOfApplicantsInterviewNotesCompleted;
use App\Notifications\NotifyAdminOfApplicantsInterviewNoteExportCompleted;
use App\Exports\InterviewNoteExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Dtos\DownloadApplicantSpreadsheetDto;
use \Maatwebsite\Excel\Excel as ConcreteExcel;
class SendApplicantsInterviewNotes implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filename;

    protected $admin,$company;

    protected $downloadApplicantInterviewNoteDto;

    public $timeout = 0;

    /**
     * Create a new job instance.
     * @param App\User $user
     * @param App\Dtos\DownloadApplicantInterviewNoteDto
     * @return void
     */
    public function __construct(User $admin,$company, DownloadApplicantInterviewNoteDto $downloadApplicantInterviewNoteDto)
    {
        $this->admin = $admin;
        $this->company = $company;
        $this->downloadApplicantInterviewNoteDto  = $downloadApplicantInterviewNoteDto;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $filename  = $this->downloadApplicantInterviewNoteDto->getFilename();
        $link = $this->downloadApplicantInterviewNoteDto->getDownloadLink();
        $disk = $this->downloadApplicantInterviewNoteDto->getStorageDisk();
        $company =  $this->company;
        $admin = $this->admin;
        switch($this->downloadApplicantInterviewNoteDto->getType()){
            case DownloadApplicantSpreadsheetDtoType::CSV :
                $filename = $filename .  "." . ConcreteExcel::CSV;
                $link = $link .  "." . ConcreteExcel::CSV;
                $csv_interview_notes_excel_file = $this->downloadApplicantInterviewNoteDto->getCsvInterviewNotes();
                Excel::store( new InterviewNoteExport($csv_interview_notes_excel_file,$company,$admin), $link , $disk);
                $csv_interview_notes_excel_file = \Storage::disk($disk)->get($link);
                $this->admin->notify( new NotifyAdminOfApplicantsInterviewNoteExportCompleted($csv_interview_notes_excel_file , $filename, $disk, $link));
                break;
            case DownloadApplicantSpreadsheetDtoType::ZIP :
                $this->downloadApplicantInterviewNoteDto->getZippedInterviewNotes();
                $this->admin->notify( new NotifyAdminOfApplicantsInterviewNotesCompleted( $filename, $disk, $link));
                break;
        }
    }
}
