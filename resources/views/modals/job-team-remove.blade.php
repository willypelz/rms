<div class="text-center">
    <p>
    <h5>Do you want to remove <strong>{{ucwords($team_member->name)}}</strong> from your job team?</h5>
    </p>

    <div class="pull-right">
        <a href="javascript://" id="jobTeamRemovalBtn" class="btn btn-success pull-right">Yes</a>
        <div class="separator separator-small"></div>
    </div>

    <div class="pull-right" style="margin-right:10px;">
        <a href="javascript://" id="closeJobTeamRemovalModal" class="btn btn-danger pull-right">No</a>
        <div class="separator separator-small"></div>
    </div>

    <div class="clearfix"></div>
</div>



<script type="text/javascript">
    $(document).ready(function () {


        $('body #closeJobTeamRemovalModal').on('click', function () {
            $('#viewModal').modal('toggle');
        });

        $('body #jobTeamRemovalBtn').on('click', function () {
            $field = $(this);
            $field.attr('disabled','disabled');
            $.post("{{ route('remove-job-team-member') }}", {
                job: '{{$job}}',
                comp: '{{$comp}}',
                ref: '{{$ref}}'
            }, function (data) {
                $('#viewModal').modal('toggle');
                $.growl.notice({message: "You have removed " + "{{ucwords($team_member->name)}}" +" from your job team"});
                $('[data-id="'+'{{$ref}}'+'"]').closest('.list-group-item').remove();
                console.log('[data-id="'+'{{$ref}}'+'"]');
            });

        });
    });
</script>
