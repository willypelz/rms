<?php

namespace App\Imports;

use App\Models\PrivateJob;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;

class PrivateJobEmail implements ToModel, WithHeadingRow, withValidation
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
            'emails' => 'required|email',

             // Above is alias for as it always validates in batches
             '*.emails' => 'required|email',
        ];
    }
}
