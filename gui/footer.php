


<script type="text/javascript" src="<?php asset('met/js/bootstrap.min.js') ?>"></script>
<script type="text/javascript" src="<?php asset('met/js/bootmetro-panorama.js') ?>"></script>
<script type="text/javascript" src="<?php asset('met/js/bootmetro-pivot.js') ?>"></script>
<script type="text/javascript" src="<?php asset('met/js/bootmetro-charms.js') ?>"></script>
<script type="text/javascript" src="<?php asset('met/js/bootstrap-datepicker.js') ?>"></script>

<script type="text/javascript" src="<?php asset('met/js/jquery.mousewheel.min.js') ?>"></script>
<script type="text/javascript" src="<?php asset('met/js/jquery.touchSwipe.min.js') ?>"></script>

<script type="text/javascript" src="<?php asset('met/js/holder.js') ?>"></script>
<!--<script type="text/javascript" src="<?php asset('met/js/perfect-scrollbar.with-mousewheel.min.js') ?>"></script>-->
<script type="text/javascript" src="<?php asset('met/js/demo.js') ?>"></script>


<script type="text/javascript">

   $(document).ready(function(){
       $('.panorama').panorama({
           //nicescroll: false,
           showscrollbuttons: true,
           keyboard: true,
           parallax: true
       });

       $('#cmdDel').click(function(){
           $('#frmTable').submit();
       });

       $('#search').click(function(){
           $('#frmSearch').toggle();
       });
       $('.table').dataTable();
   });
</script>
</body>
<!-- END BODY -->

</html>