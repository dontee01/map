<?php
$sess_name = session_name('map');
session_start();

include_once 'res/include/template.mangruf.class.php';
include_once 'res/include/mangrufcon.php';
$mangruf = new template(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
// $mangruf->connect();
// $main = $mangruf->time();
// $conv = $mangruf->timeOnly();
$title_page = "Home";

if (!isset($_GET['token']))
{
  $mangruf->redirect('index.php');
}
if (empty($_GET['token']))
{
  $mangruf->redirect('index.php');
}
$token = $_GET['token'];

$qr = "SELECT * FROM users WHERE hashh = '$token' ";
    $run = $mangruf->query($qr);
    $row = $mangruf->rows($run);
    if ($row > 0){
    	echo "Account Verified <br /><a href='index.php'>Login</a>";
    }
    else{
    	echo "Incorrect token";
    }

?>