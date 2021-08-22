<?php

namespace App\Jobs;

use App\Models\JobApplication;
use App;
use App\Models\JobActivity;
use App\Models\InterviewNotes;
use App\Models\InterviewNoteValues;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Dtos\DownloadApplicantCvDto;
use App\User;
use App\Jobs\NotifyAdminOfCompletedExportJob;
use App\Jobs\SaveApplicantNotesInBitsJob;



class SaveApplicantNotesZip implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $notes,$filename,$jobId,$company,$admin;

    public $timeout = 2500;

    /**
     * Create a new job instance.
     * @param  $notes
     * @param $filename
     * @param $jobId
     * @param $company
     * @param $admin
     */
    public function __construct($notes,$filename,$jobId,$company,$admin)
    {
        $this->notes = $notes;
        $this->filename = $filename;
        $this->jobId = $jobId;
        $this->company = $company;
        $this->admin = $admin;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->notes as $key => $app_id) {
            $appl = JobApplication::with('job', 'cv')->find($app_id);
                if(is_null($appl)){
                  continue;
                }
          
                $jobID = $appl->job->id ?? null;

                if (isset($jobID) && !is_null($jobID)) {
                    check_if_job_owner_on_queue($jobID,$this->company, $this->admin); 
                }else{
                    continue;
                }
    
                $comments = JobActivity::with('user', 'application.cv', 'job')->where('activity_type','REVIEW')->where('job_application_id', $appl->id)->get();
                $notes = InterviewNotes::with('user')->where('job_application_id', $appl->id)->get();
                $interview_notes = InterviewNoteValues::with('interviewer','interview_note_option')->where('job_application_id', $appl->id)->get()->groupBy('interviewed_by');
    
                $path = public_path('uploads/tmp/');
                $show_other_sections = false;
    
                $pdf = App::make('dompdf.wrapper');
                $pdf->loadHTML(view('modals.inc.dossier-content',compact( 'jobID', 'appl', 'comments', 'interview_notes', 'show_other_sections'))->render());
    
                $pdf->save($path . $appl->cv->first_name . ' ' . $appl->cv->last_name . ' interview.pdf', true);
    
                $interview_local_file = $path . $appl->cv->first_name . ' ' . $appl->cv->last_name . ' interview.pdf';
                $cv_local_file = @$path . $appl->cv->first_name . ' ' . $appl->cv->last_name . ' cv - ' . $appl->cv->cv_file;
                $files_to_archive[] = $interview_local_file;
                $timestamp = " " . time() . " ";  
        }

        $zipPath = public_path('exports/') . $timestamp . $this->filename;
        $chunked_files = collect($files_to_archive)->chunk(200)->toArray();
        foreach($chunked_files as $files){
            SaveApplicantNotesInBitsJob::dispatch($zipPath,$files);
        }
       
        
    }

}
