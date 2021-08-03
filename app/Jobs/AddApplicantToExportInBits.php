<?php

namespace App\Jobs;

use App\Dtos\DownloadApplicantSpreadsheetDto;
use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InterviewNoteExport;
use App\Notifications\NotifyAdminOfApplicantsInterviewNoteExportCompleted;

class AddApplicantToExportInBits implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $csv_interview_notes_excel_file, $company, $admin, $disk, $link, $last_loop, $filename;

    /**
     * Create a new job instance.
     *
     * @param $user
     * @param $filename
     * @param $link
     * @param $disk
     * @param $excelData
     */
    public function __construct($csv_interview_notes_excel_file, $company, $admin, $link , $disk, $filename,  $last_loop)
    {
        $this->csv_interview_notes_excel_file = $csv_interview_notes_excel_file;
        $this->company = $company;
        $this->admin = $admin;
        $this->link = $link;
        $this->disk = $disk;
        $this->last_loop = $last_loop;
        $this->filename = $filename;

     }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(){
		\Log::info("AddApplicantToExportInBits handle");
		Excel::store( new InterviewNoteExport($this->csv_interview_notes_excel_file, $this->company, $this->admin), $this->link , $this->disk);
		$csv_interview_notes_excel_file = \Storage::disk($this->disk)->get($this->link);
		if($this->last_loop){
			\Log::info("lastloop");
    		$this->admin->notify( new NotifyAdminOfApplicantsInterviewNoteExportCompleted($this->csv_interview_notes_excel_file, $this->filename, $this->disk, $this->link));
		}
    }
}
