<?php
session_start();
session_regenerate_id();
if (!isset($_SESSION['username'])){
    header('location: login.php');
}

require $_SERVER['DOCUMENT_ROOT']. "/remis/config.php";
$page = 'address';
use Entity\Address;
require 'gui/head.php';
$em = $system->getDatabaseManager();
$counties = $em->getRawEntity('county');
$towns = $em->getRawEntity('towns');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create']) && $_POST['create'] == "create"){
    $err = 0;
    if(!isset($_POST['building'])){
        $err += 1;
        echo "Fill client";
    }else{
        $building = stripslashes($_POST['building']);
    }
    if(!isset($_POST['street'])){
        $err += 1;
        echo "Category ";
    }else{
        $street = stripslashes($_POST['street']);
    }
    if(!isset($_POST['area'])){
        $err += 1;
        echo "title";
    }else{
        $area = stripslashes($_POST['area']);
    }
    if(!isset($_POST['town'])){
        $err += 1;
        echo "issue";
    }else{
        $twn = stripslashes($_POST['town']);
    }
    if(!isset($_POST['county'])){
        $err += 1;
        echo "issue";
    }else{
        $cty = stripslashes($_POST['county']);
    }

    if($err == 0 && $_SESSION['nonce'] == $_POST['nonce']){
        $add = new Address();
        $add->setAddBuilding($building);
        $add->setAddStreet($street);
        $add->setAddArea($area);
        $add->setAddTown($twn);
        $add->setAddCounty($cty);
        $msgs = $add->createAddress();
    }else{
        $msgs = $err.": Please fill all fields!";
    }
}elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete']) && $_POST['delete'] == "delete"){
    $err = 0;
    if(!isset($_POST['data'])){
        $msgs = "Select row(s) to delete";
    }else{
        $data = $_POST['data'];
        $data = join(',',$data);
        $add = new Address();
        $add->setId($data);
        $msgs = $add->deleteAddress();
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
            <?php include 'gui/address_new_form.php' ?>
            <div class="span12">

                
                <div class="row">
                    <div class="span12">
                        <form action=""  method="post" id="frmTable">
                            <input type="hidden" name="delete" value="delete">
                            <table class="table table-condensed table-hover">
                                <thead>
                                <tr>
                                    <th class="span1"></th>
                                    <th class="span2">Building</th>
                                    <th class="span2">Street</th>
                                    <th class="span2">Area</th>
                                    <th class="span2">Town</th>
                                    <th class="span2">County</th>
                                    <th class="span2"></th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $em = $system->getDatabaseManager();
                                $entities = $em->getRawEntity('address');
                                if (isset($_GET['term']) && !empty($_GET['term'])){
                                    $term = $_GET['term'];
                                    $entities = $em->searchEntity($page,$term);
                                }

                                if (!$entities || $entities == false){
                                    echo '
                                        <tr>
                                        <td colspan="4"><b>No records found</b></td>
                                        </tr>
                                    ';
                                }else{
                                while($entity = $em->fetch($entities)){ ?>
                                    <tr>
                                        <td class="align-center">
                                            <label class="checkbox">
                                                <input name="data[]" value="<?php echo $entity['id'] ?>" type="checkbox"><span class="metro-checkbox"></span>
                                            </label>
                                        </td>
                                        <td class="span2"><?php echo $entity['building']?></td>
                                        <td class="span2"><?php echo $entity['street']?></td>
                                        <td class="span2"><?php echo $entity['area']?></td>
                                        <td class="span2"><?php echo $entity['town']?></td>
                                        <td class="span2"><?php echo $entity['county']?></td>
                                        <td class="span2"><a class="btn btn-primary"
                                                             href="edit.php?table=address&id=<?php echo $entity['id'] ?>">
                                                <i class="icon icon-pencil"></i></a> </td>
                                    </tr>
                                <?php }
                                }
                                ?>


                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php require 'gui/taskbar.php' ?>


<?php include 'gui/charms.php' ?>

<?php
include  'gui/footer.php';
