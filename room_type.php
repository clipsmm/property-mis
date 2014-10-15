<?php
session_start();
session_regenerate_id();
if (!isset($_SESSION['username'])){
    header('location: login.php');
}

require $_SERVER['DOCUMENT_ROOT']. "/remis/config.php";

$html ="Mta";
$dompdf = new DOMPDF();
$file = file_get_contents('index.php');
$dompdf->load_html($file);
$dompdf->render();
$dompdf->stream("sample.pdf");


