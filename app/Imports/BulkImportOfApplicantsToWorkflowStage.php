<?php

namespace App\Imports;

use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Illuminate\Support\Facades\DB;
use App\Exceptions\ApplicantsWorkflowStepsUpdateException;
use App\Models\JobApplication;

class BulkImportOfApplicantsToWorkflowStage implements ToCollection, SkipsEmptyRows, WithHeadingRow, withValidation
{
    use Importable;

    /**
     * The field name to be used internally mapping the email field from excel
     * @var string
     */
    public const EMAIL_FIELD = "EMAIL";

    /**
     * The field name to be used internally mapping the worflow step field from excel
     * @var string
     */
    public const WORKFLOW_STEP_FIELD = "WORKFLOW-STEP";

    /**
     * The job id on which applicants belongs to
     * @var int
     */
    private $job_id;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected $jobID;

    /**
     * One Args Constructor for BulkImportOfApplicantsToWorkflowStage
     * @param int $job_id
     */
    public function __construct(int $job_id){
        $this->job_id = $job_id;
        HeadingRowFormatter::default('uppercase_sluged');
    }

    public function collection(Collection $rows)
    {   
        $applicants_to_worflow_stage_mappings = $this->formatExcelRecordsToApplicantsWorkflowStageMappings($rows);
        $this->updateApplicantsWorkflowSteps($applicants_to_worflow_stage_mappings, $this->job_id);
    }

    public function rules(): array
    {
        return [
            "EMAIL" => ["required", "email", "exists:candidates,email" ],
            "WORKFLOW-STEP" => ["required", "string", Rule::exists('workflow_steps', 'slug') ]
        ];
    }

    /**
     * Overide default validation messages for excel rules exceptions
     * @return array
     */
    public function customValidationMessages()
    {
        return [
            'EMAIL.exists' => 'There are no applicants with the specified email.',
            'WORKFLOW-STEP.exists' => 'There are no workflow steps with the specified name.',
        ];
    }

    /**
     * Updates  applicants workflow step
     * @param Collection $applicants_to_worflow_stage_mappings the records from excel representing applciants and desired workflow step
     * @param int $job_id the id of the job to which applicants belong to
     * @throws ApplicantsWorkflowStepsUpdateException
     */
    protected function updateApplicantsWorkflowSteps(Collection $applicants_to_worflow_stage_mappings, int $job_id){
        DB::beginTransaction();
        try{
            $applicants_to_worflow_stage_mappings
            ->each(function($applicants_to_worflow_stage_mappings, $workflow_step) use ($job_id){
                JobApplication::where("job_id", $job_id)
                                ->whereHas("candidate", function($query) use ($applicants_to_worflow_stage_mappings){
                                    return $query->whereIn("email", $applicants_to_worflow_stage_mappings->pluck(BulkImportOfApplicantsToWorkflowStage::EMAIL_FIELD)->toArray() );
                                })
                                ->update(["status" => $workflow_step]);
            });
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            throw new ApplicantsWorkflowStepsUpdateException("An Error Occured While Updating Applicants Workflow stage");
        }
    }

    /**
     * Helps format excel data to applicant_workflow stages collection
     * @param Collection $rows the records from excel
     * @return Collection
     */
    public function formatExcelRecordsToApplicantsWorkflowStageMappings(Collection $rows) : Collection
    {
        return $rows->map(function($row){
                        return[  
                                BulkImportOfApplicantsToWorkflowStage::EMAIL_FIELD => $row["EMAIL"],
                                BulkImportOfApplicantsToWorkflowStage::WORKFLOW_STEP_FIELD => $row["WORKFLOW-STEP"]
                        ];
                    })
                    ->groupBy(function ($applicants_to_worflow_stage_mapping) {
                        return $applicants_to_worflow_stage_mapping[BulkImportOfApplicantsToWorkflowStage::WORKFLOW_STEP_FIELD];
                    });
    }
}
