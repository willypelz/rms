<div class="pull-left">
    Download Applicants To Workflow Stage Bulk Upload Template? <a target="_blank" href="{{route('download-bulk-upload-applicant-to-workflow-stage-template')}}" id="downloadBulkUploadApplicantToWorkflowStageTemplateBtn" class="">Click Here</a>
</div>
<br><br>
<div>
    {!! Form::open(array('class'=>'', 'files'=>true)) !!}

    <div class="col-xs-4 col-xs-offset-4">
        <div class="form-group">

            <label for="">Upload File <span class="text-danger">*</span>
            
            </label>
    
            {{ Form::file('bulk_upload_applicants_to_workflow_stage_file', ["required", "id='bulk_upload_applicants_to_workflow_stage_file'", "accept='.xlsx'"] ) }}
            <span style="font-style: italic; font-size: 11px;" class="text-danger">format supported(.xlsx)</span>
        </div>
    </div>
</div>

<div class="col-xs-12">
    <div class="pull-right">
        <button onclick="uploadApplicantsToWorkflowStage()" id="uploadApplicantsToWorkflowStageBtn" class="btn btn-success pull-right">Upload</button>
        <div class="separator separator-small"></div>
    </div>
    
    <div class="pull-right" style="margin-right:10px;">
        <a href="javascript://" id="closeApprove" data-dismiss="modal" class="btn btn-danger pull-right">Cancel</a>
        <div class="separator separator-small"></div>
    </div>
</div>

<div class="clearfix"></div>

<script type="text/javascript">
    function uploadApplicantsToWorkflowStage(){ 
            let files = document.getElementById("bulk_upload_applicants_to_workflow_stage_file").files;
            if(files.length == 0)
                return $.growl.error({message : "You must select a file before you can proceed"});
            let formData = new FormData();
            formData.append("bulk_upload_applicants_to_workflow_stage_file" , files[0]) 
            formData.append("job_id" , "{{$appl->job->id}}") 
            $.ajax({
                type: 'POST',
                url: "{{ route('modal-bulk-upload-to-current-workflow-stage') }}",
                contentType: false, 
                processData: false,
                data: formData,
                success: function(response) {
                    if (response.status == true) {
                        $('#viewModal').modal('toggle');
                        $.growl.notice({message: response.msg});
                        sh.reloadStatus();
                        setTimeout(function() { location.reload() }, 3000);
                    }else{
                        $.growl.error({message: response.msg});
                    }
                }
            });
    }
</script>
