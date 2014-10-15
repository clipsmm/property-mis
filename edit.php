<?php
session_start();
session_regenerate_id();
if (!isset($_SESSION['username'])){
    header('location: login.php');
}

require $_SERVER['DOCUMENT_ROOT']. "/remis/config.php";
if(!isset($_GET['table'],$_GET['id'])){
    $system->redirect('index');
}
$table = $_GET['table'];
$id = $_GET['id'];
$page = 'Edit '.$table;
require 'gui/head.php';
$em = $system->getDatabaseManager();
$departments = $em->getRawEntity('department');
$cats = $em->getRawEntity('complain_category');
$clients = $em->getRawEntity('client');
$counties = $em->getRawEntity('county');
$towns = $em->getRawEntity('towns');
$entity = $em->getEntityById($table,$id);
$addresses = $em->getRawEntity('address');
$owns = $em->getRawEntity('client');
$types = $em->getRawEntity('proptype');
$staffs = $em->getRawEntity('staff');
$props = $em->getRawEntity('property');
$tenants = $em->getRawEntity('tenant');
$agents = $em->getRawEntity('agent');
?>

    <div class="container">
        <?php require 'gui/toolbar.php' ?>

        <div class="row" id="box">
            <div class="span12">


                <div class="row">
                    <div class="span12">

                        <!-- Edit form here -->
                            <?php
                            $_SESSION['nonce'] = $nonce = md5('salt'.microtime());
                            include form($table.'_edit_form') ?>
                        <!-- End of edit form -->

                    </div>
                </div>
            </div>
        </div>
    </div>



<?php include 'gui/charms.php';

?>

<?php
include  'gui/footer.php';
