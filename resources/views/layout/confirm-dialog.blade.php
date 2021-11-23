<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
{{-- 
<div  style="display:none" title="Confirm Action">
    <p id="customMessage"><span class="ui-icon ui-icon-alert"  style="float:left; margin:12px 12px 20px 0;"></span>These items will be permanently deleted and cannot be recovered. Are you sure?</p>
    <input type="button" id ="btn1" value="">
    <input type="button" id ="btn2" value="">
</div> --}}
<div id="dialog-confirm" style="display:none" title="Confirm Action" class="card" style="width:400px">
        <div class="card-body text-center">
          <h4 class="card-title text-warning"><i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i></h4>
          <p id="customMessage" class="card-title card-text">Some example text.</p>
          <div class="row pull-right">
            <a  id ="btn1" class="btn btn-sm btn-primary text-white">Yes</a>
            <a id ="btn2" class="btn btn-sm btn-danger text-white">No</a>
         </div>
        </div>
</div>

<script>
    
    function customConfirmation(msg,btnone,btntwo){
                 $('#btn1').attr('value','');
                 $('#dialog-confirm').show();
                let btn1 = btnone ? btnone : 'Yes';
                let btn2 = btntwo ? btntwo : 'No';
                let message = msg ? msg : 'Are you sure you want to proceed?';

                $('#customMessage').text(message);
                $('#btn1').text(btn1).click(function(e){
                    $(this).attr('value','true');
                    $('#dialog-confirm').dialog( "close");
                });
                $('#btn2').text(btn2).click(function(){
                    $('#dialog-confirm').dialog( "close");
                });

                
                $( "#dialog-confirm" ).dialog({
                    resizable: false,
                    height: "auto",
                    width: 400,
                    modal: true,
                     // buttons: btns
                });       
    }

    function remove(strg, idName) {
        let output = "Are you sure you want to delete this " + strg + "?"
        customConfirmation(output)
        setTimeout(() => {
            $('#btn1').click(function(e){
                document.getElementById(idName).submit()
            })
        }, 1000);
    }

    function duplicate(strg, address) {
        let output = "Are you sure you want to duplicate " + strg + "?"
        customConfirmation(output)
        setTimeout(() => {
            $('#btn1').click(function(e){
                window.location.href = address
            })
            $('#btn2').click(function (e) {
                e.preventDefault();
            })
        }, 1000);
    }
    function cancelInvite(strg, address) {
        let output = "Are you sure you want to cancel " + strg +"'s invite?"
        customConfirmation(output)
        setTimeout(() => {
            $('#btn1').click(function(e){
                window.location.href = address
            })
            $('#btn2').click(function (e) {
                e.preventDefault();
            })
        }, 1000);
    }
</script>