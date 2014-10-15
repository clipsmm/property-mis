<?php
$url= $_SERVER['HTTP_REFERER'];
$path = explode('/',$url);
echo end($path);
?>