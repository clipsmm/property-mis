<?php
session_start();
session_regenerate_id();
if (!isset($_SESSION['username'])){
    header('location: login.php');
}

require $_SERVER['DOCUMENT_ROOT']. "/remis/config.php";
$page = 'address';
require 'gui/head.php';

?>

    <div class="container">
        <?php require 'gui/toolbar.php' ?>
        <div class="row">
            <div class="span12">

                <p>Property Addresses</p>

                
                <div class="row">
                    <div class="span12">

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
                            $entities= $em->getRawEntity('property');
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
    <footer class="win-ui-dark win-commandlayout navbar-fixed-bottom">
        <div class="container">
            <div class="row">
                <div class="span6 align-left">
                    <button class="win-command">
                        <span class="win-commandicon win-commandring icon-search-2"></span>
                        <span class="win-label">Cerca</span>
                    </button>

                    <hr class="win-command" />

                    <button class="win-command">
                        <span class="win-commandicon win-commandring icon-reload"></span>
                        <span class="win-label">Reload</span>
                    </button>

                    <button class="win-command">
                        <span class="win-commandicon win-commandring icon-email"></span>
                        <span class="win-label">Send Email</span>
                    </button>
                </div>
                <div class="span6 align-right">
                    <button class="win-command">
                        <span class="win-commandicon win-commandring icon-remove"></span>
                        <span class="win-label">Delete</span>
                    </button>

                    <button class="win-command">
                        <span class="win-commandicon win-commandring icon-plus-2"></span>
                        <span class="win-label disabled">Add</span>
                    </button>
                </div>
            </div>
        </div>
    </footer>


<?php include 'gui/charms.php' ?>

<?php
include  'gui/footer.php';
