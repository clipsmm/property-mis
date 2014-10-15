<?php
session_start();
session_regenerate_id();
require $_SERVER['DOCUMENT_ROOT']. "/remis/config.php";

$system->logout();