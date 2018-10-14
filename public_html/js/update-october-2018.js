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
        var sorted = sortableSteps.sortable("serialize");
        // var sorted = sortableSteps.sortable("toArray");

        console.log(sorted);
    });


});