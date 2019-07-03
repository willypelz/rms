<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="form-group" id="stepDiv">
                <label for="role">Interview Steps on this service</label>
                <select multiple class="select2 form-control stepSelect" name="steps[]" id="step">
                    <option disabled value="{{null}}">--Select one--</option>
                    @foreach($steps as $step)
                        @if($step->type == 'interview')
                        <option value="{{$step->id}}">{{$step->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="btn btn-primary" onclick="submitRoles('{{$user->id}}', '{{$role_id}}')">Submit</div>
        </div>
    </div>
</div>
<script>

    $('.select2').select2();
    function submitRoles(user_id, role_id) {
        var checked = 1,
            job_id = {!! $job->id !!},
            steps = $('.stepSelect').val();
        $.ajax({
            url: "{{ route('persis-role') }}",
            type: "post",
            data: {user_id, role_id, job_id, checked, steps},
            success: function (response) {
                $.growl.notice({message: 'updated successfully'});
                window.location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $.growl.error({message: 'something went wrong.. please try again'});
            }
        });
    }
</script>