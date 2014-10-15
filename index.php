<?php
session_start();
session_regenerate_id();
if (!isset($_SESSION['username'])){
    header('location: login.php');
}

require $_SERVER['DOCUMENT_ROOT']. "/remis/config.php";
$page = 'home';
require 'gui/head.php';

?>

    <div id="wrap">

    <!-- Header
    ================================================== -->
    <?php require 'gui/toolbar.php' ?>

    <div id="alerts-container">

    </div>

    <!--<div id="metro-container" class="-container">-->
    <!--<div class="row">-->
    <!--<div id="hub" class="metro">-->
    <div class="metro panorama">
        <div class="panorama-sections">
            <div class="panorama-section tile-span-4">

                <h2>User Module</h2>

                <a class="tile app bg-color-blue" href="accounts">
                    <div class="image-wrapper">
                        <span class="icon icon-user"></span>
                    </div>
                    <div class="app-label">Accounts</div>
                    <?php $me = $system->getDatabaseManager() ?>
                    <div class="app-count"><?php echo $me->rows($me->getRawEntity('member')) ?></div>
                </a>

                <a class="tile app bg-color-blueDark" href="department">
                    <div class="image-wrapper">
                        <span class="icon icon-flow-tree"></span>
                    </div>
                    <div class="app-label">Departments</div>
                </a>

                <a class="tile wide imagetext bg-color-greenDark" href="staff">
                    <div class="image-wrapper">
                        <span class="icon icon-users"></span>
                    </div>
                    <div class="column-text">
                        <div class="text4">Staffs</div>
                    </div>
                    <div class="app-label"><?php echo $me->rows($me->getRawEntity('staff')) ?></div>
                </a>

                <a class="tile app bg-color-purple" href="clients">
                    <div class="image-wrapper">
                        <span class="icon icon-share"></span>
                    </div>
                    <div class="app-label">Clients</div>
                </a>

                <a class="tile app bg-color-green" href="complaint">
                    <div class="image-wrapper">
                        <span class="icon icon-envelop"></span>
                    </div>
                    <div class="app-label">Complaints</div>
                </a>

                <a class="tile app bg-color-orange" href="agent">
                    <div class="image-wrapper">
                        <span class="icon icon-users"></span>
                    </div>
                    <div class="app-label">Agents</div>
                </a>

            </div>

            <div class="panorama-section tile-span-4">

                <h2>Property Module</h2>

                <a class="tile wide app bg-color-red" href="property">
                    <div class="image-wrapper">
                        <span class="icon icon-grid"></span>
                    </div>
                    <div class="app-label">Property</div>
                </a>
                <a class="tile app bg-color-blue" href="address">
                    <div class="image-wrapper">
                        <span class="icon icon-paperclip"></span>
                    </div>
                    <div class="app-label">Addresses</div>
                </a>

                <a class="tile app bg-color-darken" href="inspection">
                    <div class="image-wrapper">
                        <span class="icon icon-tag"></span>
                    </div>
                    <div class="app-label">Inspection</div>
                </a>
                <a class="tile app bg-color-orange" href="rent">
                    <div class="image-wrapper">
                        <span class="icon icon-clipboard"></span>
                    </div>
                    <div class="app-label">Rent</div>
                </a>

            </div>



        </div>
    </div>
    <a id="panorama-scroll-prev" href="#"></a>
    <a id="panorama-scroll-next" href="#"></a>
    <div id="panorama-scroll-prev-bkg"></div>
    <div id="panorama-scroll-next-bkg"></div>
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->

    </div>
    <?php include 'gui/charms.php' ?>

</div>

<?php
include  'gui/footer.php';
