<?php

namespace App\Dtos;

use App\Models\Job;
use App\Models\JobApplication;
use Madnest\Madzipper\Facades\Madzipper;
use App\Models\JobActivity;
use App\Models\InterviewNotes;
use App\Models\InterviewNoteValues;
use App\Exceptions\DownloadApplicantsInterviewException;


interface DownloadApplicantSpreadsheetDtoType{
    const CSV = "CSV";
    const ZIP = "ZIP";
}
class DownloadApplicantInterviewNoteDto extends DownloadApplicantDto {

    /**
    * @var App\User the admin user
    */
    protected $user;

    /**
    * @var App\Models\Company the current company the admin is on
    */
    protected $current_company;

    /**
    * @var string the type of download  i.e zipped or cvs
    */
    protected $type;

    /**
     * Initialize dto with the needed datas
    * @param array $data the data gotten from the request
    * @param string $type the type of download operation
    */
    public function initialize($data, $type = DownloadApplicantSpreadsheetDtoType::ZIP) : object
    {
        parent::initialize($data);
        $this->user = \Auth::user();
        $this->current_company = get_current_company();
        $this->setType($type);
        $this->setFilename();
        $this->setPath( time() . $this->getFilename());
        $this->setApplicationIds();
        return $this;
    }

    /**
     * Set the type of operation being carries out
    * @param string $type the type of operation being carried out see interface <App\Dtos\DownloadApplicantSpreadsheetDtoType> above for constants
    */
    public function setType(string $type)
    {
        $this->type = $type;
    }
    /**
     * Set the type of operation being carries out
    * @return string $type the type of operation being carried out see interface <App\Dtos\DownloadApplicantSpreadsheetDtoType> above for constants
    */
    public function getType()
    {
        return $this->type;
    }
    /**
     * Check if current dto instance is of specified type
     * @param string $type the type to compare with
    * @return bool 
    */
    public function isType(string $type)
    {
        return $this->type == $type;
    }

    /**
     * Set the applicants ids
    * @return void 
    */
    public function setApplicationIds()
    {
        switch($this->getType()){
            case DownloadApplicantSpreadsheetDtoType::ZIP:
                if(!isset($this->getData()['app_ids'])){
                    $this->application_ids = JobApplication::where('job_id', $this->getData()["jobId"])->pluck('id');
                }else {
                    $this->application_ids = $this->getData()['app_ids'];
                }
                if(count($this->application_ids) < 1)
                    throw new DownloadApplicantsInterviewException ("There are no Applicant Interviews");
                break;
            case DownloadApplicantSpreadsheetDtoType::CSV:
                $requestData = $this->getData();
<<<<<<< Updated upstream
                $job = Job::with(['applicantsViaJAT' => function($query) use($requestData) { 
                                                            empty($requestData["status"]) ?? $query->whereStatus($requestData["status"]); 
                                                        } ])->find($requestData["jobId"]);
=======
                $job = Job::whereHas("applicantsViaJAT")->with('applicantsViaJAT')->find($requestData["jobId"]);
>>>>>>> Stashed changes
                $this->application_ids = !isset( $requestData['app_ids'] ) ? $job->applicantsViaJAT->pluck('id') : $requestData['app_ids'];
                if(count($this->application_ids) < 1) throw new DownloadApplicantsInterviewException ("There are no Applicant Interview Cvs");
                break;
        }
    }

    /**
     * Get interview note files
    * @return array 
    */
    public function getInterviewNotesFiles($application_ids) : array
    {
        $files_to_archive = [];
        
        foreach ($application_ids as $key => $app_id) {
            $appl = JobApplication::whereHas("cv")->with('job', 'cv')->find($app_id);
    
            if(!is_null($appl)){
                $jobID = $appl->job->id;
    
                if (isset($jobID)) {
                    if(!check_if_job_owner_on_queue($jobID, $this->current_company , $this->user )){
                        continue ;
                    };
                }
    
                $comments = JobActivity::with('user', 'application.cv', 'job')->where('activity_type',
                    'REVIEW')->where('job_application_id', $appl->id)->get();
                $notes = InterviewNotes::with('user')->where('job_application_id', $appl->id)->get();
                $interview_notes = InterviewNoteValues::with('interviewer','interview_note_option')
                                                        ->where('job_application_id', $appl->id)
                                                        ->get()
                                                        ->groupBy('interviewed_by');
    
                $path = public_path('uploads/tmp/');
                $show_other_sections = false;
    
                $pdf = \App::make('dompdf.wrapper');
                $pdf->loadHTML(view('modals.inc.dossier-content',
                    compact( 'jobID', 'appl', 'comments', 'interview_notes', 'show_other_sections'))->render());
    
                $pdf->save($path . $appl->cv->first_name . ' ' . $appl->cv->last_name . ' interview.pdf', true);
    
    
                $filename = "Bulk Interview Notes.zip";
                $interview_local_file = $path . $appl->cv->first_name . ' ' . $appl->cv->last_name . ' interview.pdf';
                // $cv_local_file = @$path . $appl->cv->first_name . ' ' . $appl->cv->last_name . ' cv - ' . $appl->cv->cv_file;
                $files_to_archive[] = $interview_local_file;
               
            }
        }
        
        return $files_to_archive;
    }

    /**
     * Set file name
    * @return string
    */
    public function setFilename(string $filename=null)
    {
        switch($this->getType()){
            case DownloadApplicantSpreadsheetDtoType::CSV:
                $this->filename =  $filename ?: "interview-note_" . date('Y_m_d_H_i_s');
                break;
            case DownloadApplicantSpreadsheetDtoType::ZIP:
                $this->filename = $filename ?: "Bulk Interview Notes.zip";
                break;
        }
        return "default_file_name.txt";
    }

    /**
     * Get  ZippedInterviewNotes of applicants
    * @return \Illuminate\Http\File 
    */
    public function getZippedInterviewNotes()
    {
        $chunked_interview_notes = collect($this->getCsvInterviewNotes())->chunk(100)->toArray();
        foreach($chunked_interview_notes as $index => $interview_notes){
            $interview_note_files = $this->getInterviewNotesFiles($interview_notes);
            Madzipper::make($this->getZipPath())->add($interview_note_files)->close();
        }
        $file = new \Illuminate\Http\File( $this->getStorageRealPath() );
        return $file;
    }
    /**
     * Get  CsvInterviewNotes of applicants
    * @return void 
    */
    public function getCsvInterviewNotes()
    {
	    return $this->application_ids;
	}
	
	public function processCsvInterviewNotes(\Closure $next){
		$chunkedApplicationIds = collect($this->getCsvInterviewNotes())->chunk(100)->toArray();
		foreach($chunkedApplicationIds as $index => $applicationIds){
			if($index == array_key_last($chunkedApplicationIds)){
				$next($applicationIds, true);
				return;
			}
			$next($applicationIds, false);
		}
	}

}


?>