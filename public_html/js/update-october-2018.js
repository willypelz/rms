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

    $( 'templateBtn' ).on('click', function(){
        var cursorPos = $('#text').prop('selectionStart');
        var v = $('#text').val();
        var textBefore = v.substring(0,  cursorPos );
        var textAfter  = v.substring( cursorPos, v.length );
        $('#text').val( textBefore+ $(this).val() +textAfter );
    });
});