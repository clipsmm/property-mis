<?php
session_start();
session_regenerate_id();
if (!isset($_SESSION['username'])){
    header('location: login.php');
}

require $_SERVER['DOCUMENT_ROOT']. "/remis/config.php";
$page = 'inspection';
use Entity\Inspection;
require 'gui/head.php';
$em = $system->getDatabaseManager();
$cats = $em->getRawEntity('complain_category');
$staffs = $em->getRawEntity('staff');
$props = $em->getRawEntity('property');
$clients = $em->getRawEntity('client');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create']) && $_POST['create'] == "create"){
    $err = 0;
    if(!isset($_POST['property'])){
        $err += 1;
        echo "Empyt property";
    }else{
        $property= stripslashes($_POST['property']);
    }
    if(!isset($_POST['staff'])){
        $err += 1;
        echo "Category ";
    }else{
        $staff = stripslashes($_POST['staff']);
    }
    if(!isset($_POST['issue'])){
        $err += 1;
        echo "issue";
    }else{
        $report = stripslashes($_POST['issue']);
    }

    if($err == 0 && $_SESSION['nonce'] == $_POST['nonce']){
        $ins = new Inspection();
        $ins->setPropId($property);
        $ins->setStaffId($staff);
        $ins->setInsDate(date('Y-m-d'));
        $ins->setInsDescription($report);
        $ins->setInsStatus('New');

        $msgs = $ins->createInspection();
    }else{
        $msgs = $err.": Please fill all fields!";
    }
}elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete']) && $_POST['delete'] == "delete"){
    if(!isset($_POST['data'])){
        $err +=1;
    }else{
        $data = $_POST['data'];
        $data = join(',',$data);
        $ins = new Inspection();
        $ins->setId($data);
        $msgs = $ins->deleteInspection();
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
            <?php include 'gui/inspection_new_form.php' ?>
            <div class="span12">

                
                <div class="row">
                    <div class="span12">
                        <form action=""  method="post" id="frmTable">
                            <input type="hidden" name="delete" value="delete">
                            <table class="table table-condensed table-hover">
                                <thead>
                                <tr>
                                    <th class="span1"></th>
                                    <th class="span2">Property</th>
                                    <th class="span2">Inspection By</th>
                                    <th class="span2">Date</th>
                                    <th class="span2">Status</th>
                                    <th class="span2">Actions</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $em = $system->getDatabaseManager();
                                $entities = $em->getRawEntity('inspection');
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
                                        <td class="span2"><?php echo $em->getEntityDetail('property',$entity['prop_id'],'prop_name')?></td>
                                        <td class="span2"><?php echo $em->getEntityDetail('staff',$entity['staff_id'],'staff_first_name')?></td>
                                        <td class="span2"><?php echo $entity['ins_date']?></td>
                                        <td class="span2"><?php echo $entity['ins_status']?></td>
                                        <td class="span2"><a class="btn btn-primary"
                                                             href="edit.php?table=inspection&id=<?php echo $entity['id'] ?>">
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
