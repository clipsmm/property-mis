<?php
session_start();
session_regenerate_id();
if (!isset($_SESSION['username'])){
    header('location: login.php');
}

require $_SERVER['DOCUMENT_ROOT']. "/remis/config.php";
$page = 'rent';
use Entity\Rent;
require 'gui/head.php';
$em = $system->getDatabaseManager();
$props = $em->getRawEntity('property');
$tenants = $em->getRawEntity('tenant');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create']) && $_POST['create'] == "create"){
    $err = 0;
    if(!isset($_POST['property'])){
        $err += 1;
    }else{
        $property = stripslashes($_POST['property']);
    }
    if(!isset($_POST['tenant'])){
        $err += 1;
    }else{
        $tenant = stripslashes($_POST['tenant']);
    }
    if(!isset($_POST['dateI'])){
        $err += 1;
    }else{
        $dateI= stripslashes($_POST['dateI']);
    }
    if(!isset($_POST['dateO'])){
        $err += 1;;
    }else{
        $dateO = stripslashes($_POST['dateO']);
    }

    if($err == 0 && $_SESSION['nonce'] == $_POST['nonce']){
        $ren = new Rent();
        $ren->setPropId($property);
        $ren->setTenantId($tenant);
        $ren->setDateIn($dateI);
        $ren->setDateOut($dateO);
        $msgs = $ren->createRent();
    }else{
        $msgs = $err.": Please fill all fields!";
    }
}elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete']) && $_POST['delete'] == "delete"){
    if(!isset($_POST['data'])){
        $err +=1;
    }else{
        $data = $_POST['data'];
        $data = join(',',$data);
        $ren= new Rent();
        $ren->setId($data);
        $msgs = $ren->deleteRent();
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
            <?php include 'gui/rent_new_form.php' ?>
            <div class="span12">

                
                <div class="row">
                    <div class="span12">
                        <form action=""  method="post" id="frmTable">
                            <input type="hidden" name="delete" value="delete">
                            <table class="table table-condensed table-hover">
                                <thead>
                                <tr>
                                    <th class="span1"></th>
                                    <th class="span2">Tenant</th>
                                    <th class="span2">Property</th>
                                    <th class="span2">Date In</th>
                                    <th class="span2">Date Out</th>
                                    <th class="span2"></th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $em = $system->getDatabaseManager();
                                $entities = $em->getRawEntity('rent');
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
                                        <td class="span2"><?php echo $entity['tenant_id']?></td>
                                        <td class="span2"><?php echo $entity['prop_id']?></td>
                                        <td class="span2"><?php echo $entity['date_in']?></td>
                                        <td class="span2"><?php echo $entity['date_out']?></td>
                                        <td class="span2"><a class="btn btn-primary"
                                                             href="edit.php?table=rent&id=<?php echo $entity['id'] ?>">
                                                <i class="icon icon-pencil"></i></a>
                                            <a class="btn btn-primary" title="Pay Rent"
                                               href="rentpayment.php?rent=<?php echo $entity['id'] ?>">
                                                <i class="icon icon-plus"></i></a>
                                        </td>
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
