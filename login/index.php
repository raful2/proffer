<?php 
include '../Cliente/Cliente.class.php';

$user = new User();
$user->setCPF($_POST['username']);
$user->setSenha($_POST['password']);

$user->agree_login($user->getCPF(),$user->getSenha());


?>