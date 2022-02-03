{{--        modal display for workflow creation --}}
<div class="modal fade" id="workflowModal" tabindex="-1" role="dialog"
     aria-labelledby="workflowModalLabel"
     data-backdrop="static" data-keyboard="false"
     aria-hidden="true"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="workflowModalLabel">Create Workflow</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="name" class="col-form-label">Name:</label><span class="text-danger">*</span>
                        <input type="text" class="form-control" name="workflow_name"
                               placeholder="A name for this workflow"
                               id="workflow_name">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label><span class="text-danger">*</span>
                        <textarea name="description"
                                  id="workflow_description"
                                  placeholder="A short note about this workflow"
                                  class="form-control"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="saveWorkflow" class="btn btn-primary">Create</button>
            </div>
        </div>
    </div>
</div>

<script  type="text/javascript">
    $('#saveWorkflow').click(function (e) {
        e.preventDefault();
        var workflow_name = $('#workflow_name').val();
        var workflow_description = $('#workflow_description').val();
        if (workflow_name == null || workflow_name == "") {
            $.growl.error({message: 'Please enter workflow name.'})
            return false;
        }
        if (workflow_description == null || workflow_description == "") {
            $.growl.error({message: 'Please enter workflow description.'})
            return false;
        }
        var token = $('#token').val();
        var url = "{{ route('workflow-store') }}";
        var workflow_url = "{{ route('workflow') }}";

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}', name: workflow_name, description: workflow_description, background_callback: true
            },
            success: function (res) {
                const data = res.data;
                $('#workflowModal').modal('hide');
                $.growl.notice({title: "Success", duration:9000,  message: `Workflow successfully created. If you want to Customise this workflow created click <a target="_blank" href="${workflow_url}"> here </a>`})
                let newOption = new Option(data.name, data.id, false, false);
                $('#workflowId').append(newOption).trigger('change');
                // $(".select2-container option").remove();
                $('#workflow_name').val('');
                $('#workflow_description').val('');
                workflow_name = '';
                workflow_description = '';
            },
            error:function (err) {
                if(err.status === 422) {
                    $.each(err.responseJSON.errors, function (key, val) {
                        $.growl.error({
                            title:"Error!",
                            message:val,
                            duration:9000
                        });
                    });
                }
            }
        });
    });
</script>
