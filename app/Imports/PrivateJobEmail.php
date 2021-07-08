<?php

namespace App\Imports;

use App\Models\PrivateJob;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;

class PrivateJobEmail implements ToModel, WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $jobID;

    public function __construct($job_id){
        $this->jobID = $job_id;
    }
    public function model(array $row)
    {
        return new PrivateJob([
            //
            'job_id' => $this->jobID,
            'attached_email' => $row['emails']

        ]);
    }
    public function rules(): array
    {
        return [
            'attached_email' => Rule::in(['patrick@maatwebsite.nl']),

             // Above is alias for as it always validates in batches
             '*.email' => Rule::in(['patrick@maatwebsite.nl']),
        ];
    }
}
