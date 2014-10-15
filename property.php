<?php
session_start();
session_regenerate_id();
if (!isset($_SESSION['username'])){
    header('location: login.php');
}

require $_SERVER['DOCUMENT_ROOT']. "/remis/config.php";
$page = 'property';
use Entity\Property;
require 'gui/head.php';
$em = $system->getDatabaseManager();
$addresses = $em->getRawEntity('address');
$owns = $em->getRawEntity('client');
$types = $em->getRawEntity('proptype');
$agents = $em->getRawEntity('agent');;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create']) && $_POST['create'] == "create"){
    $err = 0;
    if(!isset($_POST['name'])){
        $err += 1;
    }else{
        $name = stripslashes($_POST['name']);
    }
    if(!isset($_POST['type'])){
        $err += 1;
    }else{
        $typ = stripslashes($_POST['type']);
        echo $typ."<br>";
    }
    if(!isset($_POST['owner'])){
        $err += 1;
    }else{
        $owner = stripslashes($_POST['owner']);
    }
    if(!isset($_POST['address'])){
        $err += 1;
    }else{
        $address = stripslashes($_POST['address']);
    }
    if(!isset($_POST['units'])){
        $err += 1;
    }else{
        $units = stripslashes($_POST['units']);
    }
    if(!isset($_POST['date'])){
        $err += 1;
    }else{
        $date = stripslashes($_POST['date']);
    }
    if(!isset($_POST['sale'])){
        $err += 1;
    }else{
        $rent = stripslashes($_POST['rent']);
    }
    if(!isset($_POST['sale'])){
        $err += 1;
    }else{
        $sale = stripslashes($_POST['sale']);
    }
    if(!isset($_POST['sold'])){
        $err += 1;
    }else{
        $sold = stripslashes($_POST['sold']);
    }
    if(!isset($_POST['desc'])){
        $err += 1;
    }else{
        $desc = stripslashes($_POST['desc']);
    }
    if(!isset($_POST['area'])){
        $err += 1;
    }else{
        $area = stripslashes($_POST['area']);
    }
    if(!isset($_POST['agent'])){
        $err += 1;
    }else{
        $agent = stripslashes($_POST['agent']);
    }

    if($err == 0 && $_SESSION['nonce'] == $_POST['nonce']){
        $prop = new Property();
        $prop->setAddressId($address);
        $prop->setOwnerId($owner);
        $prop->setTypeId($typ);
        $prop->setPropSold($sold);
        $prop->setPropDateSubmitted($date);
        $prop->setPropName($name);
        $prop->setPropAgentId($agent);
        $prop->setPropRooms($units);
        $prop->setPropDesc($desc);
        $prop->setPropSalePrice($sale);
        $prop->setPropRentPrice($rent);
        $prop->setPropArea($area);

        $msgs = $prop->createProperty();
    }else{
        $msgs = $err.": Please fill all fields!";
    }
}elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete']) && $_POST['delete'] == "delete"){
    if(!isset($_POST['data'])){
        $err +=1;
    }else{
        $data = $_POST['data'];
        $data = join(',',$data);
        $prop = new Property();
        $prop->setId($data);
        $msgs = $prop->deleteProperty();
    }
}
$_SESSION['nonce'] = $nonce = md5('salt'.microtime());
?>

    <div class="container">
        <?php require 'gui/toolbar.php' ?>
        <div id="alerts-container">
            <?php if(!empty($msgs)){ ?>
                <div class="alert">
                    <button type="button" class="close" data-dismiss="alert"></button>
                    <strong>Alert!</strong> <?php echo $msgs ?>
                </div>
            <?php } ?>
        </div>
        <div class="row" id="box">
            <?php
            if(isset($_GET['new'])){
                include form('property_new_form');
            }else{
                include form('property_table');
            }

            ?>

        </div>
    </div>
    </div>
    <footer class="win-ui-dark win-commandlayout navbar-fixed-bottom">
        <div class="container">
            <div class="row">
                <div class="span6 align-left">
                    <button class="win-command" id="search">
                        <span class="win-commandicon win-commandring icon-search-2"></span>
                        <span class="win-label">Search</span>
                    </button>

                    <hr class="win-command" />

                    <a class="win-command" href="property">
                        <span class="win-commandicon win-commandring icon-reload"></span>
                        <span class="win-label">Reload</span>
                    </a>

                    <button class="win-command">
                        <span class="win-commandicon win-commandring icon-email"></span>
                        <span class="win-label">Send Email</span>
                    </button>

                    <?php require 'gui/search_form.php' ?>
                </div>
                <div class="span6 align-right">
                    <button class="win-command" id="cmdDel">
                        <span class="win-commandicon win-commandring icon-remove"></span>
                        <span class="win-label">Delete</span>
                    </button>

                    <a class="win-command" href="property.php?new">
                        <span class="win-commandicon win-commandring icon-plus-2"></span>
                        <span class="win-label disabled">Add</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>

<?php
include 'gui/charms.php'; ?>

<?php
include  'gui/footer.php';
