<?php
session_start();
session_regenerate_id();
if (!isset($_SESSION['username'])){
    header('location: login.php');
}

require $_SERVER['DOCUMENT_ROOT']. "/remis/config.php";
$page = 'client';
use Entity\Client;
require 'gui/head.php';
$em = $system->getDatabaseManager();
$departments = $em->getRawEntity('department');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create']) && $_POST['create'] == "create"){
    $err = 0;
    if(!isset($_POST['firstName'])){
        $err += 1;
        echo "fname";
    }else{
        $firstName = stripslashes($_POST['firstName']);
    }
    if(!isset($_POST['lastName'])){
        $err += 1;
        echo "lname";
    }else{
        $lastName = stripslashes($_POST['lastName']);
    }
    if(!isset($_POST['gender'])){
        $err += 1;
        echo "gender";
    }else{
        $gender = stripslashes($_POST['gender']);
    }
    if(!isset($_POST['phone'])){
        $err += 1;
        echo "phone";
    }else{
        $phone = stripslashes($_POST['phone']);
    }
    if(!isset($_POST['idNo'])){
        $err += 1;
        echo "idno";
    }else{
        $idNo = stripslashes($_POST['idNo']);
    }
    if(!isset($_POST['email'])){
        $err += 1;
        echo "dept";
    }else{
        $email = stripslashes($_POST['email']);
    }
    if(!isset($_POST['address'])){
        $err += 1;
        echo "dob";
    }else{
        $address = stripslashes($_POST['address']);
    }
    if(!isset($_POST['town'])){
        $err += 1;
        echo "doh";
    }else{
        $town = stripslashes($_POST['town']);
    }
    if($err == 0 && $_SESSION['nonce'] == $_POST['nonce']){
        $client = new Client();
        $client->setClientAddress($address);
        $client->setClientFirstName($firstName);
        $client->setClientLastName($lastName);
        $client->setClientGender($gender);
        $client->setClientIdNo($idNo);
        $client->setClientEmail($email);
        $client->setClientTown($town);
        $client->setClientPhone($phone);
        $msgs = $client->createClient();
    }else{
        $msgs = $err.": Please fill all fields!";
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
            <?php include 'gui/client_new_form.php' ?>
            <div class="span12">

                
                <div class="row">
                    <div class="span12">

                        <table class="table table-condensed table-hover">
                            <thead>
                            <tr>
                                <th class="span1"></th>
                                <th class="span2">First Name</th>
                                <th class="span2">Last Name</th>
                                <th class="span2">Gender</th>
                                <th class="span2">ID No</th>
                                <th class="span2">Address</th>
                                <th class="span2">Town</th>
                                <th class="span2">Phone</th>
                                <th class="span2">Email</th>
                                <th class="span2"></th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $em = $system->getDatabaseManager();
                            $entities = $em->getRawEntity('client');
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
                                            <input type="checkbox"><span class="metro-checkbox"></span>
                                        </label>
                                    </td>
                                    <td class="span2"><?php echo $entity['client_first_name']?></td>
                                    <td class="span2"><?php echo $entity['client_last_name']?></td>
                                    <td class="span2"><?php echo $entity['client_gender']?></td>
                                    <td class="span2"><?php echo $entity['client_id_no']?></td>
                                    <td class="span2"><?php echo $entity['client_address']?></td>
                                    <td class="span2"><?php echo $entity['client_town']?></td>
                                    <td class="span2"><?php echo $entity['client_phone']?></td>
                                    <td class="span2"><?php echo $entity['client_email'] ?></td>
                                    <td class="span2"><a class="btn btn-primary"
                                                         href="edit.php?table=client&id=<?php echo $entity['id'] ?>">
                                            <i class="icon icon-pencil"></i></a> </td>
                                </tr>
                            <?php }
                        }
                            ?>


                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require 'gui/taskbar.php' ?>


<?php include 'gui/charms.php' ?>

<?php
include  'gui/footer.php';
