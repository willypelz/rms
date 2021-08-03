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

    protected $admin,$company;

    protected $data;
    
    protected $type;

    public $timeout = 0;

    /**
     * Create a new job instance.
     * @param App\User $user
     * @param App\Dtos\DownloadApplicantInterviewNoteDto
     * @return void
     */
    public function __construct(User $admin,$company, $data, $type)
    {
        $this->admin = $admin;
        $this->company = $company;
        $this->data  = $data;
        $this->type  = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
	    $sheetInstance = app()->make(DownloadApplicantInterviewNoteDto::class)->initialize($this->data, $this->type);
        $filename  = $sheetInstance ->getFilename();
        $link = $sheetInstance ->getDownloadLink();
        $disk = $sheetInstance ->getStorageDisk();
        $company =  $this->company;
        $admin = $this->admin;
        switch($sheetInstance->getType()){
            case DownloadApplicantSpreadsheetDtoType::CSV :
				$sheetInstance->processCsvInterviewNotes(function($csv_interview_notes_excel_file, $last_loop) use ($filename, $disk, $link, $company, $admin){
					 \Log::info('interview note CSV running');
					$filename = $filename .  "." . ConcreteExcel::CSV;
					$link = $link .  "." . ConcreteExcel::CSV;
					Excel::store( new InterviewNoteExport($csv_interview_notes_excel_file,$company,$admin), $link , $disk);
					$csv_interview_notes_excel_file = \Storage::disk($disk)->get($link);
					if($last_loop)
                		$this->admin->notify( new NotifyAdminOfApplicantsInterviewNoteExportCompleted($csv_interview_notes_excel_file , $filename, $disk, $link));
				});
                break;
            case DownloadApplicantSpreadsheetDtoType::ZIP :
                $interview_notes = $sheetInstance->getZippedInterviewNotes()->getRealPath();
                \Log::info('interview note ZIP running');
                $this->admin->notify( new NotifyAdminOfApplicantsInterviewNotesCompleted($interview_notes , $filename, $disk, $link));
                break;
        }

        
    }
}
