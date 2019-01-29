/**
 * Description
 *
 * @package     seamlesshiring.vcom
 * @category    Source
 * @author      Michael Akanji <matscode@gmail.com>
 * @date        2018-10-06
 */

$(function () {
    var approvalUsers = $('#approvalUsersBlock');
    approvalUsers.hide();
    $('#requireApproval').change(function () {
        if ($(this).prop('checked')) {
            approvalUsers.show();
        } else {
            approvalUsers.hide();
        }
    });

    if ($('#messageTemplate').length) {
        CKEDITOR.replace('messageTemplate');

        $(".templateBtn").on('click', function () {
            CKEDITOR.instances.messageTemplate.insertText($(this).val());
        });
    }

    var sortableSteps = $("#sortableSteps");
    sortableSteps
        .sortable({
            opacity: 0.8
        })
        .disableSelection();

    sortableSteps.on('sortstop', function (e, ui) {

        $.post("/settings/workflow/steps/reorder", {
            workflow_id: sortableSteps.data('workflow-id'),
            steps: sortableSteps.sortable("toArray")
        })
            .done(function (data) {
                // sorting became successful
                $.growl.notice({message: data.message});
                /*
                $.growl.info({message: 'reloadiing...'});
                $(this).delay(2000).queue(function(){
                    location.reload(true);
                });
                */
            })
            .fail(function (jqXHR) {
                // what happens when sort fails
                $.growl.warning({message: jqXHR.responseJSON.message});
            });

    });


});