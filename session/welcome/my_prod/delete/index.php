<?php
	session_start();
	include "../../../../connection/connection.class.php";
	
	if(!isset($_SESSION['id'])){
	echo "Impossivel deletar produto sem estar logado.". "<a href='../../../../'> Clique aqui para fazer login</a>";
	exit();
	}
	
	$conObj = new Connection();
	$conn = $conObj->getConnection();

	$query_qtd = "SELECT qtd FROM prod WHERE id = ? AND id_user = ?";

	$stm_qtd = $conn->prepare($query_qtd);
	$stm_qtd->bindValue(1,$_POST['prod']);
	$stm_qtd->bindValue(2,$_SESSION['id']);

	$stm_qtd->execute();

	$qtd_r = $stm_qtd->fetchAll();

	foreach ($qtd_r as $key => $value) {
		$qtd = $value['qtd'];

	}
	
	if($qtd > 1){
		$qtd = $qtd-1;
		$query_decr = "UPDATE prod SET qtd = ".$qtd." WHERE id = ? AND id_user = ?";
		$stm_decr = $conn->prepare($query_decr);
		$stm_decr->bindValue(1,$_POST['prod']);
		$stm_decr->bindValue(2,$_SESSION['id']);
		$stm_decr->execute();
		echo "Produto decrementado. -1 <a class='btn btn-primary' href='../'> Clique aqui para voltar aos seus produtos</a>";




	}else{
		$query_decr = "DELETE FROM prod WHERE id = ? and id_user = ?";
		$stm_decr = $conn->prepare($query_decr);
		$stm_decr->bindValue(1,$_POST['prod']);
		$stm_decr->bindValue(2,$_SESSION['id']);
		$stm_decr->execute();
		echo "Produto excluido. <a class='btn btn-primary' href='../'> Clique aqui para voltar aos seus produtos</a>";
	}


	
	
	



 ?>