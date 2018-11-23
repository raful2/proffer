<?php 
include '../Cliente/Cliente.class.php';

$user = new User();

$user->login($_POST['username'],$_POST['password']);


?>