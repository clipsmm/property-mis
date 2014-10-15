<?php
session_start();
session_regenerate_id();
if (!isset($_SESSION['username'])){
    header('location: login.php');
}

require $_SERVER['DOCUMENT_ROOT']. "/remis/config.php";
$page = 'Users';
require 'gui/head.php';

?>

    <div class="container">
<?php require 'gui/toolbar.php' ?>
        <div class="row">
            <div class="span12">

                <p>Acounts</p>

                <div class="row">
                    <div class="span12">

                        <table class="table table-condensed table-hover">
                            <thead>
                            <tr>
                                <th class="span1"></th>
                                <th class="span2">First Name</th>
                                <th class="span2">Last Name</th>
                                <th class="span2">Email</th>
                                <th class="span2">Username</th>
                                <th class="span2">Role</th>
                                <th class="span2">Active</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $em = $system->getDatabaseManager();
                            $entities= $em->getRawEntity('member');
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
                            while($user = $em->fetch($entities)){ ?>
                                <tr>
                                    <td class="align-center">
                                        <label class="checkbox">
                                            <input type="checkbox"><span class="metro-checkbox"></span>
                                        </label>
                                    </td>
                                    <td class="span2"><?php echo $user['user_first_name']?></td>
                                    <td class="span2"><?php echo $user['user_last_name']?></td>
                                    <td class="span2 align-left"><?php echo $user['user_email']?></td>
                                    <td class="span2 align-left"><?php echo $user['user_username']?></td>
                                    <td class="span2 align-left"><?php echo $user['user_role']?></td>
                                    <td><?php echo $user['user_active']?></td>
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
