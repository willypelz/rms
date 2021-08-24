<?php

namespace App\Exports;

use App\Models\Job;
use App\Models\InterviewNoteValues;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;


class InterviewNoteExportHeader implements WithHeadings
{
    use Exportable;

    private $application_ids;


	public function __construct($application_id)
	{
        $this->application_ids = [$application_id];
	}

	public function headings(): array
    {
        $heading = [
            'Name',
            'Gender',
            'Email',
            'Phone',
            'Age',
            'Address',
            'Highest Qualification',
            'Years of Experience',
            'Last Position',
            'Last Company Worked',
            'Willing to Relocate?',
        ];

        $interview_notes = InterviewNoteValues::whereIn('job_application_id', $this->application_ids)->groupBy('interviewed_by')->get();

        $interviewers = $interview_notes->unique('interviewed_by')->take(1);

        $interview_notes_count = 1;
        foreach($interviewers as $interviewer){
            array_push($heading, 'Interviewer Name', 'Interview Date');

            $interviewer_notes = InterviewNoteValues::with('interviewer',
                'interview_note_option')->where('interviewed_by', $interviewer->interviewed_by)->where('job_application_id', $this->application_ids)->get();

            foreach ($interviewer_notes as $option){
                array_push($heading, $option->interview_note_option->name);
            }

            array_push($heading, 'Average Score', 'Total Score');
            // $interview_notes_count++;
        }

        array_push($heading, 'Overall Average');

        return $heading;
    }


}
