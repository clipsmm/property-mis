<?php
if(isset($_GET['step']) && (!isset($_GET['Travel_ID']))){
$step = $_GET['step'] or $step = $_REQUEST['step'];
    ?>

<script>
$(document).ready(function(){
    var step = <?php echo $step; ?>;
    var mystep = "#travel"+step;
    var iform = 'bio';
    if (step!=null){
        if (step==1){
            iform = 'bio';
        }else if(step == 2){
            iform = 'detail';
        }else if(step == 3){
            iform = 'budget';
        }else if(step == 4){
            iform = 'review';
        }
        $(mystep).addClass('active');
        $(mystep).removeClass('disabled');
        $('.myForm').load('system/forms/travel_'+iform+ '_form_step'+step+'.php',function(){
                alert(step);
        });

        }

    });
</script>
<?php
}
if (isset($_GET['Travel_ID'],$_GET['step'])){
    $edit = $_GET['Travel_ID'];
    $step = $_GET['step'];
    ?>
<script>
    $(document).ready(function(){
        var edit = (<?php echo $edit ?>);

        var step = <?php echo $step; ?>;
        var mystep = "#travel"+step;
        var iform = 'bio';
        if (step!=null && edit != null){
            if (step==1){
                iform = 'bio';
            }else if(step == 2){
                iform = 'detail';
            }else if(step == 3){
                iform = 'budget';
            }else if(step == 4){
                iform = 'review';
            }
            $(mystep).addClass('active');
            $(mystep).removeClass('disabled');

            $('.myForm').load('system/forms/travel_'+iform+ '_edit_form_step'+step+'.php',{Travel_ID:edit,step:step},function(){
                //alert('system/forms/travel_'+iform+ '_edit_form_step'+step+'.php');
            });

        }

    })
</script>
<?php
}
