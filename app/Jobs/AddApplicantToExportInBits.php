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
use App\Notifications\NotifyAdminOfApplicantsInterviewNotesCompleted;
use Madnest\Madzipper\Facades\Madzipper;


class AddApplicantToExportInBits implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $payload, $company, $admin, $disk, $link, $last_loop, $filename, $type, $sheetInstance;


    /**
     * Create a new job instance.
     *
     * @param $user
     * @param $filename
     * @param $link
     * @param $disk
     * @param $excelData
     */

    public function __construct($payload, $company, $admin, $link , $disk, $filename,  $last_loop, $type, $sheetInstance = null)
    {
        $this->payload = $payload;
        $this->company = $company;
        $this->admin = $admin;
        $this->link = $link;
        $this->disk = $disk;
        $this->last_loop = $last_loop;
        $this->filename = $filename;
        $this->type = $type;
		$this->sheetInstance = $sheetInstance;
     }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(){

		switch($this->type){
            case \App\Dtos\DownloadApplicantType::CSV :
        			Excel::store( new InterviewNoteExport($this->csv_interview_notes_excel_file, $this->company, $this->admin), $this->link , $this->disk);
					$payload = \Storage::disk($this->disk)->get($this->link);
            		if($this->last_loop){
			    		$this->admin->notify( new NotifyAdminOfApplicantsInterviewNoteExportCompleted($this->payload, $this->filename, $this->disk, $this->link));
					}
                break;
            case \App\Dtos\DownloadApplicantType::ZIP :
            		$interview_note_files = $this->sheetInstance->getInterviewNotesFiles($this->payload);
            		Madzipper::make($this->sheetInstance->getZipPath())->add($interview_note_files)->close();
            		if($this->last_loop){
			    		$this->admin->notify( new NotifyAdminOfApplicantsInterviewNotesCompleted($this->filename, $this->disk, $this->link));
					}
                break;
        }
    }
}
