<?php
@session_start();
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <title><?php echo TITLE ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="MobileOptimized" content="320">
    <!-- stles -->
    <link rel="stylesheet" type="text/css" href="<?php asset('met/css/bootmetro.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php asset('met/css/bootmetro-responsive.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php asset('met/css/bootmetro-icons.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php asset('met/css/bootmetro-ui-light.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php asset('met/css/datepicker.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php asset('met/css/jquery.dataTables.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php asset('met/css/jquery.dataTables_themeroller.css') ?>">

    <?php if ($page == 'home'){ ?>
    <link rel="stylesheet" type="text/css" href="<?php asset('met/css/demo.css') ?>">
    <?php } ?>

    <script src="<?php asset('fnd/js/vendor/jquery.js') ?>"></script>
    <script src="<?php asset('met/js/jquery-ui.min.js') ?>"></script>
    <script src="<?php asset('met/js/modernizr-2.6.2.min.js') ?>"></script>
    <script src="<?php asset('met/js/jquery.dataTables.js') ?>"></script>
    <script src="<?php asset('met/js/Chart.js') ?>"></script>



</head>
<body>



