<?php

namespace App\Http\Controllers;
use App\Imports\BulkImportOfApplicantsToWorkflowStage;
use Maatwebsite\Excel\HeadingRowImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use \Maatwebsite\Excel\Validators\ValidationException as ExcelValidationException;
use Illuminate\Validation\ValidationException as RequestValidationException;
use Illuminate\Http\Request;
use App\Exceptions\ApplicantsWorkflowStepsUpdateException;;
use App\Models\JobApplication;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

class BulkUploadApplicantsToWorkflowStepContoller extends Controller
{

    private const TEMPLATE_FILE_PATH = "downloads/bulk-upload-applicants-to-workflow-stage-template.xlsx";
    private const DOWNLOAD_FILE_NAME = "Bulk Upload Applicants To Workflow Stage.xlsx";

    /**
     * Show bulk upload applicants to workflow stage modal view
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\View\View
     */
    public function getBulkUploadToCurrentWorkflowStage(Request $request){
        $stepId = $request->stepId;
        $app_id = (int)explode(",", $request->app_id)[0];
        $appl = JobApplication::with('job', 'cv')->find($app_id);
        return view('modals.bulk_upload_to_current_workflow_stage', compact('appl', 'stepId'));
    }

    /**
     * Handle request related to bulk uploading of applicants to workflow stage [post, get]
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\View\View | Illuminate\Http\Response
     */
    public function postBulkUploadToCurrentWorkflowStage(Request $request)
    {
        if ($request->has("bulk_upload_applicants_to_workflow_stage_file")) {
            try{
                $this->validate(request(), [
                    "bulk_upload_applicants_to_workflow_stage_file" => "required|file|mimes:xlsx"
                ]);
                try{
                    $bulk_upload_applicants_to_workflow_stage_file = $request->file('bulk_upload_applicants_to_workflow_stage_file');
                    if(!$this->validateExcelHeaders($bulk_upload_applicants_to_workflow_stage_file)){
                        return response()->json(["status"=>false, "msg"=>"Excel file must contain 'EMAIL' and 'WORKFLOW STEP' headers. NB: headers are case insensitive "]);
                    }
                    (new BulkImportOfApplicantsToWorkflowStage($request->job_id))->import($bulk_upload_applicants_to_workflow_stage_file);
                    return response()->json(["status"=>true, "msg"=>"Operation Bulk Upload Successful"]);
                }catch(ExcelValidationException  $e){
                    return response()->json(["status"=>false, "msg"=> $this->formatExcelValidationMessageExceptionMessage($e)]); 
                }catch(ApplicantsWorkflowStepsUpdateException  $e){
                    return response()->json(["status"=>false, "msg"=> $e->getMessage()]); 
                }
            }catch(RequestValidationException $e){
                return response()->json(["status"=>false, "msg"=> "File type must be of type xlsx"]); 
            }
        }
        return response()->json(["status"=>false, "msg"=> "No bulk upload applicants to workflow stage file uploaded"]); 
    }

    /**
     * Handle request related to downloading  of applicants to workflow stage template
     * @param  Illuminate\Http\Request $request
     * @return Illuminate\View\View | Illuminate\Http\Response
     */
    public function downloadBulkApplicantsToWorkflowStagesTemplate(Request $request)
    {
        $file_path = is_file(public_path(BulkUploadApplicantsToWorkflowStepContoller::TEMPLATE_FILE_PATH)) ? public_path(BulkUploadApplicantsToWorkflowStepContoller::TEMPLATE_FILE_PATH) : false;
        if($file_path){
            $filename = BulkUploadApplicantsToWorkflowStepContoller::DOWNLOAD_FILE_NAME;
            return response()->download( $file_path, $filename, ['Content-Type:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']);
        }
        return redirect()->with(["status"=>"error", "msg"=>"There exists no bulk upload applicants to workflow template current. contact admin for support"]);
    }

    /**
     * Format Error Exceptions of type ExcelValidationException
     * @param ExcelValidationException $exception
     * @return string
     */
    protected function formatExcelValidationMessageExceptionMessage(ExcelValidationException $exception) : string
    {
        $error_msg = "";
        foreach ($exception->failures()  as $failure) {
            $error_msg .= "On Row, " . $failure->row() . " Heading [" . $failure->attribute() . "], " .
                        implode(", " , $failure->errors());
        }
        return $error_msg;
    }

    /**
     * Validate Excel Headers
     * Helps to verify that the excel file has the required headers
     * @param Illuminate\Http\UploadedFile $bulk_upload_applicants_to_workflow_stage_file the uploaded excel file
     * return bool
     */
    protected function validateExcelHeaders($bulk_upload_applicants_to_workflow_stage_file)
    {
        $heading_rows = (new HeadingRowImport)->toArray($bulk_upload_applicants_to_workflow_stage_file)[0][0];
        $heading_rows_lower_case = array_map(function($value){return strtoupper(\Str::slug($value));}, $heading_rows);
        if(!(  in_array(BulkImportOfApplicantsToWorkflowStage::EMAIL_FIELD, $heading_rows_lower_case) && in_array(BulkImportOfApplicantsToWorkflowStage::WORKFLOW_STEP_FIELD, $heading_rows_lower_case)) )
            return false;
        return true;
    }

}
