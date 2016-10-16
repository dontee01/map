<?php
ob_start();
$sess_name = session_name('map');
session_start();
include_once 'res/include/template.mangruf.class.php';
include_once 'res/include/mangrufcon.php';
$mangruf = new template(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
$mangruf->connect();
$main = $mangruf->time();
$conv = $mangruf->timeOnly();

// $ins = "UPDATE users SET uid = '', online = '0' WHERE id = '".$_SESSION['id']."'";
// $rins = $mangruf->query($ins);

// setcookie("sess", "", strtotime( '+5 days'));
// setcookie("em", "", strtotime( '+5 days'));
//session_unset($_SESSION['user']);
session_destroy();
header('location: index.php');

?>