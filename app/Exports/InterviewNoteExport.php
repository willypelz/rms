<?php

namespace App\Exports;


use App\Models\InterviewNoteValues;
use App\Models\JobApplication;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Files\LocalTemporaryFile;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\Exportable;

class InterviewNoteExport implements FromArray, WithEvents
{
    use Exportable, RegistersEventListeners;

	private $application_ids,$file_name,$company,$admin;
    protected static $static_file_name, $next_sn;

	public function __construct($application_ids,$file_name,$company,$admin)
	{
        $this->application_ids = $application_ids;
        $this->company = $company;
        $this->admin = $admin;
        $this->file_name = $file_name;
        self::$static_file_name = $this->file_name;
        
	}


	

    /**
    * @return \Illuminate\Support\Array
    */
    public function array():array
    {
        $data = [];
        $application_count = 1;


        foreach ($this->application_ids as $key => $app_id) {
            $appl = JobApplication::with('job', 'cv')->find($app_id);
            check_if_job_owner_on_queue($appl->job->id,$this->company,$this->admin);

            $interview_notes = InterviewNoteValues::with('interviewer',
                'interview_note_option')->where('job_application_id', $appl->id)->get();


            $data[$application_count]['Name'] = $appl->cv->first_name . " " . $appl->cv->last_name;
            $data[$application_count]['Gender'] = $appl->cv->gender;
            $data[$application_count]['Email'] = $appl->cv->email;
            $data[$application_count]['Phone'] = $appl->cv->phone;
            $data[$application_count]['Age'] = str_replace('ago', 'old', human_time($appl->cv->date_of_birth, 1));
            $data[$application_count]['Address'] = $appl->cv->state;
            $data[$application_count]['Highest Qualification'] = $appl->cv->highest_qualification;
            $data[$application_count]['Years of Experience'] = $appl->cv->years_of_experience;
            $data[$application_count]['Last Position'] = $appl->cv->last_position;
            $data[$application_count]['Last Company Worked'] = $appl->cv->last_company_worked;
            $data[$application_count]['Willing to Relocate?'] = $appl->cv->willing_to_relocate ? 'Yes' : 'No';

            $interview_notes_count = 1;
            $interviewers = $interview_notes->unique('interviewed_by');

            foreach ($interviewers as $noteKey => $note) {


                if($interview_notes_count == 1){
                    $data[$application_count]['Interviewer Name'] = $note->interviewer->name;
                    $data[$application_count]['Interview Date'] = date('D, j-n-Y, h:i A', strtotime($note->created_at));
                }else{

                    $application_count++;

                    $data[$application_count]['Name'] = '';
                    $data[$application_count]['Gender'] = '';
                    $data[$application_count]['Email'] = '';
                    $data[$application_count]['Phone'] = '';
                    $data[$application_count]['Age'] = '';
                    $data[$application_count]['Address'] = '';
                    $data[$application_count]['Highest Qualification'] = '';
                    $data[$application_count]['Years of Experience'] = '';
                    $data[$application_count]['Last Position'] = '';
                    $data[$application_count]['Last Company Worked'] = '';
                    $data[$application_count]['Willing to Relocate?'] = '';
                    $data[$application_count]['Interviewer Name'] = $note->interviewer->name;
                    $data[$application_count]['Interview Date'] = date('D, j-n-Y, h:i A', strtotime($note->created_at));
                }
               
                $total = $ratingCount = 0;
                foreach ($interview_notes->where('interviewed_by', $note->interviewed_by) as $option) {

                    if ($option->interview_note_option->type == 'rating') {

                        $data[$application_count][$option->interview_note_option->name] = ($option->value);
                        

                        $total += intval($option->value);
                        $ratingCount++;
                    }

                    if ($option->interview_note_option->type == 'text')
                        $data[$application_count][$option->interview_note_option->name] = $option->value;

                }

                $avg_score = $total / count($interviewers);;
                // $avg_score = $total / ($ratingCount);;
                $data[$application_count]['Total Score'] = $total;
                $data[$application_count]['Average Score'] = number_format($avg_score, 2);

                $interview_notes_count++;
            }

            if(count($interviewers))
                $data[$application_count]['Overall Average'] = $avg_score / count($interviewers);
            else
                $data[$application_count]['Overall Average'] = '';
            

            $application_count++;

        }

        return collect($data);
    }
    /**
    * Before exporting, open the sheet you want to 
    * add additional data to.
    * 
    * @param Maatwebsite\Excel\Events\BeforeExport $event 
    * @param Maatwebsite\Excel\Files\LocalTemporaryFile $file
    * 
    * @return mixed
    */ 
    public static function beforeWriting(BeforeWriting $event)
     {
        $file = new LocalTemporaryFile(public_path('exports/' . self::$static_file_name));
        $event->writer->reopen($file, \Maatwebsite\Excel\Excel::CSV);
        $sheet = $event->writer->getSheetByIndex(0);
        static::$next_sn = $sheet->getHighestRow();
        $sheet->export($event->getConcernable());
        return $sheet;
     
     }
}
