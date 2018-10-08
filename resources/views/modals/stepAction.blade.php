{!! @$applicant_badge !!}


<div class="pull-right">
    <a href="javascript://" id="actionBtn" class="btn btn-success pull-right">Yes</a>
    <div class="separator separator-small"></div>
</div>

<div class="pull-right" style="margin-right:10px;">
    <a href="javascript://" class="btn btn-danger pull-right" data-dismiss="modal">No</a>
    <div class="separator separator-small"></div>
</div>

<div class="clearfix"></div>


<script type="text/javascript">
    $(document).ready(function () {

        var app_ids = <?php echo json_encode($app_ids);?>  ;
        var cv_ids = <?php echo json_encode($cv_ids);?> ;

        // $('body #closeActionModal').on('click', function () {
        //     $('#viewModal').modal('toggle');
        // });

        $('#actionBtn').on('click', function () {
            $field = $(this);
            $.post("{{ route('mass-action') }}", {
                job_id: '{{ $appl->job->id }}',
                cv_ids: cv_ids,
                app_ids: app_ids,
                status: '{{ $stepSlug }}'
            }, function (data) {

                $('#viewModal').modal('toggle');

                $.growl.notice({
                    message: "You have moved"
                        + $field.closest('.modal-body').find('.media-heading a').text()
                });

                // Just guessing what this method does 😀
                sh.reloadStatus();
            });

        });
    });
</script>