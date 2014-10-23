<?php
session_start();
session_regenerate_id();
if (!isset($_SESSION['username']) ){
    header('location: login.php');
}

require $_SERVER['DOCUMENT_ROOT']. "/remis/config.php";
if (!$system->hasRole('ADMIN')) {$system->redirect('index');}
$page = 'DASHBOARD';
require 'gui/head.php';
$em = $system->getDatabaseManager();
$types = $em->getRawEntity('proptype');

?>

    <div class="container">
        <?php require 'gui/toolbar.php' ?>
        <div class="row" id="box">
            <div id="alerts-container">
                <?php if(!empty($msgs)){ ?>
                    <div class="alert">
                        <button type="button" class="close" data-dismiss="alert"></button>
                        <strong>Alert!</strong> <?php echo $msgs ?>
                    </div>
                <?php } ?>
            </div>
            <?php include 'gui/user_registration_form.php' ?>
            <div class="span12">

                <div class="row">
                    <div class="span12">
                        <div id="canvas-holder">
                            <canvas id="chart-area" width="500" height="500"/>
                        </div>
                        <script>

                            var doughnutData = [

                                <?php
                                    while ($type = $em->fetch($types)){
                                        $count = $em->rows($em->getRawEntityBy('property','type_id',$type['id']));
                                        ?>
                                        {
                                            value: <?php echo $count ?>,
                                            label: "<?php echo $type['type_name'] ?>"
                                        },

                                        <?php
                                    }
                                  ?>

                            ];

                            window.onload = function(){
                                var ctx = document.getElementById("chart-area").getContext("2d");
                                window.myDoughnut = new Chart(ctx).Doughnut(doughnutData, {responsive : true});
                            };



                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php include 'gui/charms.php' ?>

<?php
include  'gui/footer.php';
