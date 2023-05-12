<?php
ob_start();
include 'lib/session.php';
include_once ("lib/database.php");
  include_once ("helpers/format.php");
  Spl_autoload_register(function ($className){ 
      include_once ("Model/admin/".$className.".php");
  });
$brand = new brand();
$db=new database();
$fm=new format();
$ct=new cart();
$cat=new category();
$brand = new brand();
$pro=new product();
$city=new city();
$user=new User();
$bill=new bill();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idCart'])){
    $idPro1 = $_POST['idDelete'];
    $idCus1 = $_POST['idCus1'];
    $delPro = $ct->deleteProfromCart($idPro1,$idCus1); 
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['updateCart'])){
    echo '<h1>hello</h1>';
  }
  
  ob_end_flush
?>