<?php
/**
 * Created by PhpStorm.
 * User: Meshaq
 * Date: 3/3/14
 * Time: 3:33 PM
 * This file contains common environment settings for the application
 */

$root = dirname(__FILE__);
$page = '';
define('DB_HOST','localhost');
define('DB_NAME','remis');
define('DB_USER','root');
define('DB_PASSWORD','');
define('APP_NAME','REMIS: Vital Properties');
define('HOME','remis/');
define('CLASS_PATH','system/class/');
define('TITLE','REMIS: Vital');
define("ACTIVE", "1");
define("DEFAULT_ROLE", "USER");
define("SECURE", FALSE);

/*
 * Include core functions
 */
include '/system/modules/init.php';
require "/system/modules/myFunctions.php";

require 'vendor/autoload.php';

$system = new \Entity\System();