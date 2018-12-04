<?php 
define ("PATH", dirname(__FILE__));
include  PATH . '/../Cliente/Cliente.class.php';

if( !(isset($_POST['username'])) || !(isset($_POST['password'])) ){
	echo "Digite algo nos campos. <a class='btn btn-danger' href='../'> voltar</a>";
	exit();
}else{
	$user = new User();


$user->agree_login($_POST['username'],$_POST['password']);
}



?>