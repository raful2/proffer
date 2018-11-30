

<!DOCTYPE html5>
<html>
<head>
	<title>Proferta - Detalhes do Produto </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>

 
 
<nav class="navbar navbar-expand-lg navbar-light bg-light"><?php
session_start();

require_once("../../connection/connection.class.php");
    $conObj = new Connection();
    $con = $conObj->getConnection();
    if(!isset($_POST['session'])){
     echo "  Bem Vindo Visitante. Esta pagina é RESTRITA.";
     echo "<a class='navbar-brand' href='#'></a>
  <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarTogglerDemo02' aria-controls='navbarTogglerDemo02' aria-expanded='false' aria-label='Toggle navigation'>
    <span class='navbar-toggler-icon'></span>
  </button>

  <div class='collapse navbar-collapse' id='navbarTogglerDemo02'>
    <ul class='navbar-nav mr-auto mt-2 mt-lg-0'>
      <li class='nav-item active'>
        <a class='nav-link' href='../../'>Login <span class='sr-only'>(current)</span></a>
      </li>
      <li class='nav-item'>
        <a class='nav-link disabled' href=''>Cadastre um Produto ou Serviço.</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link disabled' href='#'>Disabled</a>
      </li>
    </ul>
    <form class='form-inline my-2 my-lg-0'>
      <input class='form-control mr-sm-2' type='search' placeholder='Procurar produto'>
      <button class='btn btn-outline-success my-2 my-sm-0' type='submit'>Procurar</button>
    </form>
  </div>
</nav>";
    }else{
       $sql_qtd = "SELECT profile_img, nome, saldo FROM userr WHERE cpf = ?";
  $stm_qtd = $con->prepare($sql_qtd);
  $stm_qtd->bindValue(1,$_POST['session']);


  $stm_qtd->execute();
  $row = $stm_qtd->fetchAll();
  foreach ($row as $key => $value) {
    echo " <img width='50px' height='50px' src='../../session/welcome/".$value['profile_img']."'> Bem Vindo(a) <b>". $value['nome'] . "</b> aproveite seus creditos! "    . " <div class='btn btn-primary'> R$ ". number_format((float)$value['saldo'], 2, ',', '.') . "</div>";
    echo "<a class='navbar-brand' href='#'></a>
  <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarTogglerDemo02' aria-controls='navbarTogglerDemo02' aria-expanded='false' aria-label='Toggle navigation'>
    <span class='navbar-toggler-icon'></span>
  </button>

  <div class='collapse navbar-collapse' id='navbarTogglerDemo02'>
    <ul class='navbar-nav mr-auto mt-2 mt-lg-0'>
      <li class='nav-item active'>
        <a class='btn btn-danger' href='logout.php'>Sair <span class='sr-only'>(current)</span></a>
      </li>
     <a class='navbar-brand' href='#'></a>  
      <li class='nav-item'>
       <form class='nav' method='post' action='../../session/welcome/add_prod/'><input name='user' type='hidden' value='".$_SESSION['id']."'> <input class=' btn btn-outline-success' type='submit' value='Vender um produto.'></form>
      </li>
      <a class='navbar-brand' href='#'></a>
        <li class='nav-item'>
        <form class='nav' action='../../session/welcome/my_prod/' method='POST'><input name='owner' type='hidden' value='".$_SESSION['id']."'><input class='btn btn-outline-warning' type='submit' value='Meus Produtos'></form>
      </li>
      <a class='navbar-brand' href='#'></a>

      <li>
        <form class='nav' action='../session/welcome/my_deals/' method='POST'><input name='owner' type='hidden' value='".$_SESSION['id']."'><input class='btn btn-outline-dark' type='submit' value='Minhas Vendas'></form>
          </li>
            <a class='navbar-brand' href='#'></a>

      <li>
        <form class='nav' action='../../session/welcome/my_deals2/' method='POST'><input name='owner' type='hidden' value='".$_SESSION['id']."'><input class='btn btn-outline-dark' type='submit' value='Minhas Compras'></form>
          </li>
    </ul>
    <form class='form-inline my-2 my-lg-0' acto>
      <input class='form-control mr-sm-2' type='search' placeholder='Procurar produto'>
      <button class='btn btn-outline-success my-2 my-sm-0' type='submit'>Procurar</button>
    </form>
  </div>
</nav>";
  }
    }

  
 


?>
  

	<div class="jumbotron text-center">
  <h1>
   </h1>
  <p>Compre e Venda, Produtos e Serviços.</p> 
</div>

<div class="container">
  <!-- VISUALIZANDO PRODUTOS DE TODOS -->
  <?php

 

if(!isset($_POST['session']) || !isset($_POST['prod'])){
  echo "<h3>Faça login primeiro.</h3>";

   
    # code...
echo " 
 <link href='http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css' rel='stylesheet' id='bootstrap-css'>
  <script src='http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>";
   
}else{
   $sql_prod = "SELECT prod.nome as nome, userr.nome as uname, prod.id_user,prod.qtd, prod.id,prod.descript,prod.valor, prod.url FROM prod JOIN userr ON prod.id_user = userr.cpf  WHERE prod.id = ?";
  $stm_prod = $con->prepare($sql_prod);
  $stm_prod->bindValue(1,$_POST['prod']);
  
  $stm_prod->execute();
  $row = $stm_prod->fetchAll();

   echo "
 ";

    foreach ($row as $key => $value) {
    # code...
echo " <div class='container' align='center'>
  <img class='card-img-top' src='../../session/welcome/".$value['url']."' alt='Card image cap'>
  <div class='card-body'>
    <h4 class='card-title'>".$value['nome']."</h4>
    Anunciante: <h5 class='card-title'>".$value['uname']."</h5>
    <p class='card-text'> Em estoque: ".$value['qtd']."</p>
    <p class='card-text'>".$value['descript']."</p>
        <p class='card-text'> R$".number_format((float)$value['valor'], 2, ',', '.')."</p>

    <form action='../../details/prod/buy/' method='POST'>
    <input name='prod' type='hidden' value='".$value['id']."'>
    <input name='valor' type='hidden' value='".$value['valor']."'>
    <input name='owner' type='hidden' value='".$value['id_user']."'> 
    <input name='session' type='hidden' value='".$_SESSION['id']."'>
    <input type='submit' class='btn btn-success' value='Comprar'>
    <a href='/proferta/session/welcome' class='btn btn-danger sm'> Voltar </a>
    </form>
  
  </div>
</div>
 <link href='http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css' rel='stylesheet' id='bootstrap-css'>
  <script src='http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>";
}
}


  
    
  



  
        
    
 echo "</div>";


  ?>
</div>
<?php 
	


	
?>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</body>
</html>


