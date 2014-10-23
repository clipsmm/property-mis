<?php
session_start();
session_regenerate_id();
if (!isset($_SESSION['username'])){
    header('location: login.php');
}

require $_SERVER['DOCUMENT_ROOT']. "/remis/config.php";
$page = 'Pay rent';
if(!isset($_GET['rent']))$system->redirect('rent');
$rentId = $_GET['rent'];
use Entity\RentPayment;

require 'gui/head.php';
$em = $system->getDatabaseManager();
$proId = $em->getEntityDetail('rent',$rentId,'prop_id');
$price = $em->getEntityDetail('property',$proId,'rent_price');
$tenId = $em->getEntityDetail('rent',$rentId,'tenant_id');
$tenants = $em->getRawEntity('tenant');
$query = "
SELECT *,MONTH(rent_date) as daet FROM rentpayment
WHERE rent_id='$rentId'
ORDER BY rent_date DESC
LIMIT 1
";
$em->query($query);
$entities = $em->persist();
$entity = $em->fetch($entities);
$bal = $entity['rent_balance'];
$month =  $entity['daet'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create']) && $_POST['create'] == "create"){
    $err = 0;
    if(!isset($_POST['paid'])){
        $err += 1;
    }else{
        $paid = stripslashes($_POST['paid']);
    }
    if(!isset($_POST['date'])){
        $err += 1;
    }else{
        $date= stripslashes($_POST['date']);
    }
    if($month ==  date('m',strtotime($date)) ){
        $amt = $bal;
    }else{
        $amt = $price+$bal;
    };
    if($err == 0 && $_SESSION['nonce'] == $_POST['nonce']){
        $rep = new RentPayment();
        $rep->setRentId($rentId);
        $rep->setRentAmount($amt);
        $rep->setRentPaid($paid);
        $rep->setRentBalance($amt - $paid);
        $rep->setRentDate($date);
        $msgs =$rep->createRentPayment();
    }else{
        $msgs = "Fill all fields!";
    }



}elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete']) && $_POST['delete'] == "delete"){
    if(!isset($_POST['data'])){
        $err +=1;
    }else{
        $data = $_POST['data'];
        $data = join(',',$data);
        $ren= new RentPayment();
        $ren->setId($data);
        $msgs = $ren->deleteRentPayment();
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
            <?php include 'gui/payment_new_form.php' ?>
            <div class="span12">
                    <div class="row">
                        <div class="span4 well">
                            <span class="text">Name: <b><?php echo $em->getEntityDetail('tenant',$tenId,'ten_name') ?></b></span><br><br>
                            <span class="text">Property: <b><?php echo $em->getEntityDetail('property',$proId,'prop_name') ?></b></span><br><br>
                            <span class="text">Date: <b><?php echo date('Y-m-d H:i') ?></b></span><br>

                        </div>
                    </div>
                <div class="row">
                    <div class="span12">
                        <form action=""  method="post" id="frmTable">
                            <input type="hidden" name="delete" value="delete">
                            <input type="hidden" name="nonce" value="<?php echo $_SESSION['nonce'] ?>">
                            <table class="table table-condensed table-hover pricing-table">
                                <thead>
                                <tr>
                                    <th class="span1"></th>
                                    <th class="span2">Date Paid</th>
                                    <th class="span2">Rent Fee</th>
                                    <th class="span2">Amount Paid</th>
                                    <th class="span2">Balance</th>
                                    <th class="span2"></th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $em = $system->getDatabaseManager();
                                $qry = "
                                SELECT count(r.id) as receipts, sum(r.rent_amount) as totalE, sum(r.rent_paid) as totalP,
                                 sum(r.rent_balance) as totalB
                                 FROM rentpayment r
                                 WHERE r.rent_id = '$rentId'
                                ";
                                $em->query($qry);
                                $vars = $em->persist();
                                $entities = $em->getRawEntityBy('rentpayment','rent_id',$rentId);
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
                                        <td class="span2"><?php echo $entity['rent_date']?></td>
                                        <td class="span2"><?php echo $entity['rent_amount']?></td>
                                        <td class="span2"><?php echo $entity['rent_paid']?></td>
                                        <td class="span2"><?php echo $entity['rent_balance']?></td>
                                        <td class="span2"><a class="btn btn-primary"
                                                             href="#edit.php?table=rentpayment&id=<?php echo $entity['id'] ?>">
                                                <i class="icon icon-pencil"></i></a>
                                        </td>
                                    </tr>
                                <?php }
                            }
                                   $var = $em->fetch($vars);
                                ?>
                                </tbody>
                                <tfoot>
                                <tr class="">
                                    <td colspan="2">Payments: <?php echo $var['receipts']?></td>
                                    <td><?php echo $var['totalE']?></td>
                                    <td><?php echo $var['totalP']?></td>
                                    <td><?php echo $var['totalB']?></td>
                                </tr>
                                </tfoot>
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

