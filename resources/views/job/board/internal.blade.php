<form action="{{ route('job-team-add') }}" method="post" id="JobTeamAdd">
    {!! csrf_field() !!}

    <div class="form-group">
        <div class="form-group">
            <label for="">Role Name</label>
            <input name="role_name" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="role">Permissions</label>
            <select class="select2 form-control" multiple name="role[]" id="role">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ ucwords($role->display_name) }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group" style="display:none" id="stepDiv">
            <label for="role">Steps on this service</label>
            <select class="select2 form-control" multiple name="steps[]" id="step" class="form-control">
                @foreach($job->workflow->workflowSteps as $step)
                    @if($step->type == 'interview')
                        <option value="{{ $step->id }}">{{ ucwords($step->name) }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <label for="">Access: </label>
        <select name="access" id="access" class="form-control" required>
            <option value="job" hidden>"{{ $job->title }}"</option>
        </select>
    </div>

    <label for="editor1">Invite Mail</label>
    <textarea rows="10" cols="30" id="editor1" name="body_mail"
              style="visibility: hidden; display: none;">
                                       &lt;p&gt;Hello,&lt;br&gt;


                                        Regarding the ongoing recruitment process at {{ ucwords( get_current_company()->name ) }} company for the job of {{ ucwords( $job->title ) }}, this is to inform you that you have been invited to join the recruitment team.
                                        You would be required to collaborate with your team in selecting the candidate(s) who best suit(s) the job.


                                       </textarea>
    <script>

        CKEDITOR.replace('editor1');
    </script>

    <br>
    <p>
        <!-- <a class="btn btn-line btn-sm" aria-controls="collapseWYSIWYG" aria-expanded="false" href="#collapseWYSIWYG" data-toggle="collapse" role="button"><i class="fa fa-times"></i> &nbsp; Cancel</a> -->

        <a aria-controls="AddTeamMember" aria-expanded="false" class="btn btn-line btn-sm" data-toggle="collapse"
           data-target="#AddTeamMember" href="#AddTeamMember"> Cancel</a>

        <a aria-controls="AddTeamMember" aria-expanded="false"
           class="btn btn-line btn-sm" data-toggle="collapse"
           data-target="#AddTeamMember" href="#AddTeamMember"> Cancel</a>

        <!-- <a class="btn btn-success btn-sm pull-right" aria-controls="collapseWYSIWYG" aria-expanded="false" href="#collapseWYSIWYG" data-toggle="collapse" role="button">Send Mail &nbsp; <i class="fa fa-send"></i></a> -->
        <input class="btn btn-success btn-sm pull-right" id="sendMail"
               type="submit" value="Send mail">
        <!-- <button class="btn btn-success btn-sm pull-right" aria-controls="collapseWYSIWYG" aria-expanded="false" href="#collapseWYSIWYG" data-toggle="collapse" role="button" type="submit">Send Mail &nbsp;  <i class="fa fa-send"></i></button> -->
    </p>

</form>