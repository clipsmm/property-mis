<?php
session_start();
session_regenerate_id();
if (!isset($_SESSION['username'])){
    header('location: login.php');
}

require $_SERVER['DOCUMENT_ROOT']. "/remis/config.php";
$page = 'comlaint';
use Entity\Complaint;
require 'gui/head.php';
$em = $system->getDatabaseManager();
$cats = $em->getRawEntity('complain_category');
$clients = $em->getRawEntity('client');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create']) && $_POST['create'] == "create"){
    $err = 0;
    if(!isset($_POST['client'])){
        $err += 1;
        echo "Fill client";
    }else{
        $client = stripslashes($_POST['client']);
    }
    if(!isset($_POST['category'])){
        $err += 1;
        echo "Category ";
    }else{
        $category = stripslashes($_POST['category']);
    }
    if(!isset($_POST['title'])){
        $err += 1;
        echo "title";
    }else{
        $title = stripslashes($_POST['title']);
    }
    if(!isset($_POST['issue'])){
        $err += 1;
        echo "issue";
    }else{
        $issue = stripslashes($_POST['issue']);
    }

    if($err == 0 && $_SESSION['nonce'] == $_POST['nonce']){
        $com = new Complaint();
        $com->setClientId($client);
        $com->setCmpCat($category);
        $com->setCmpDate(date('Y-m-d'));
        $com->setCmpView(0);
        $com->setCmpTitle($title);
        $com->setCmpDesc($issue);
        $msgs = $com->createComplaint();
    }else{
        $msgs = $err.": Please fill all fields!";
    }
}elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete']) && $_POST['delete'] == "delete"){
    if(!isset($_POST['data'])){
        $err +=1;
    }else{
        $data = $_POST['data'];
        $data = join(',',$data);
        $dep = new Complaint();
        $dep->setId($data);
        $msgs = $dep->deleteComplaint();
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
            <?php include 'gui/complaint_new_form.php' ?>
            <div class="span12">

                
                <div class="row">
                    <div class="span12">
                        <form action=""  method="post" id="frmTable">
                            <input type="hidden" name="delete" value="delete">
                        <table class="table table-condensed table-hover">
                            <thead>
                            <tr>
                                <th class="span1"></th>
                                <th class="span2">Title</th>
                                <th class="span2">Category</th>
                                <th class="span2">Date</th>
                                <th class="span2">By</th>
                                <th class="span2">Viewed?</th>
                                <th class="span2"></th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $em = $system->getDatabaseManager();
                            $entities = $em->getRawEntity('complaint');
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
                                    <td class="span2"><?php echo $entity['cmp_title']?></td>
                                    <td class="span2"><?php echo $entity['cmp_cat']?></td>
                                    <td class="span2"><?php echo $entity['cmp_date']?></td>
                                    <td class="span2"><?php echo $entity['client_id']?></td>
                                    <td class="span2"><?php echo $entity['cmp_view']?></td>
                                    <td class="span2"><a class="btn btn-primary"
                                                         href="edit.php?table=complaint&id=<?php echo $entity['id'] ?>">
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
