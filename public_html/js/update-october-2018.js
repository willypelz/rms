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

});