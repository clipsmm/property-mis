<?php
session_start();
session_regenerate_id();
if (!isset($_SESSION['username'])){
    header('location: login.php');
}

require $_SERVER['DOCUMENT_ROOT']. "/remis/config.php";
$page = 'department';
use Entity\Department as Department;
require 'gui/head.php';
$err = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create']) && $_POST['create'] == "create"){

    if (isset($_POST['deptCode'])){
        $code = strtoupper(stripslashes($_POST['deptCode']));
    }else{
        $err += 1;
    }
    if (isset($_POST['deptName'])){
        $name = stripslashes($_POST['deptName']);
    }else{
        $err += 1;
    }
    if ($err == 0 && $_SESSION['nonce'] == $_POST['nonce']){
        $dep = new Department();
        $dep->setDeptCode($code);
        $dep->setDeptName($name);
        $msgs = $dep->createDepartment();

    }


}elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete']) && $_POST['delete'] == "delete"){
    if(!isset($_POST['data'])){
        $err +=1;
    }else{
        $data = $_POST['data'];
        $data = join(',',$data);
       $dep = new Department();
        $dep->setId($data);
        $msgs = $dep->deleteDepartment();
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
        <div class="row">
            <?php include 'gui/department_new_form.php' ?>
            <div class="span12">

                
                <div class="row">
                    <div class="span12">
                        <form method="post" action="" id="frmTable">
                            <input type="hidden" name="delete" value="delete">
                        <table class="table table-condensed table-hover">
                            <thead>
                            <tr>
                                <th class="span1"></th>
                                <th class="span2">Code</th>
                                <th class="span3">Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $em = $system->getDatabaseManager();
                            $entities = $em->getRawEntity('department');
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
                                    <td class="span2"><?php echo $entity['dept_code']?></td>
                                    <td class="span3"><?php echo $entity['dept_name']?></td>
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
