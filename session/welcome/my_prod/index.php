

<!DOCTYPE html5>
<html>
<head>
	<title>Proferta - Seja Bem Vindo ! </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>

 
 
<nav class="navbar navbar-expand-lg navbar-light bg-light"><?php
session_start();
define("PATH_SESSION", dirname(__FILE__));
require_once(PATH_SESSION . "/../../../connection/connection.class.php");
    $conObj = new Connection();
    $con = $conObj->getConnection();
    if(!isset($_SESSION['id'])){
     echo "  Bem Vindo Visitante.";
     echo "<a class='navbar-brand' href='#'></a>
  <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarTogglerDemo02' aria-controls='navbarTogglerDemo02' aria-expanded='false' aria-label='Toggle navigation'>
    <span class='navbar-toggler-icon'></span>
  </button>

  <div class='collapse navbar-collapse' id='navbarTogglerDemo02'>
    <ul class='navbar-nav mr-auto mt-2 mt-lg-0'>
      <li class='nav-item active'>
        <a class='btn btn-primary' href='../../../session/welcome'>Login <span class='sr-only'>(current)</span></a> >
      </li>
      <li class='nav-item active'> <a class='btn btn-secondary' href='../../../reg/'> Registre-se! </a></li>
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
  $stm_qtd->bindValue(1,$_SESSION['id']);


  $stm_qtd->execute();
  $row = $stm_qtd->fetchAll();
  foreach ($row as $key => $value) {
    echo " <img width='50px' height='50px' src='../".$value['profile_img']."'><b>". $value['nome'] . "</b>"    . " <div class='btn'><font color='green'> <b>R$ ". number_format((float)$value['saldo'], 2, ',', '.') . "</font></b></div>";

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
       <form class='nav' method='post' action='../add_prod'><input name='user' type='hidden' value='".$_SESSION['id']."'> <input class='btn btn-outline-primary' type='submit' value='Vender um produto.'></form>
      </li>
      <a class='navbar-brand' href='#'></a>
        <li class='nav-item'>
        <form class='nav' action='./' method='POST'><input name='owner' type='hidden' value='".$_SESSION['id']."'><input class='btn btn-warning ' disabled type='submit' value='Meus Produtos'></form>
      </li>
        <a class='navbar-brand' href='#'></a>
      <li class='nav-item'>
        <form class='nav' action='../my_deals/' method='POST'><input name='owner' type='hidden' value='".$_SESSION['id']."'><input class='btn btn-outline-dark' type='submit' value='Minhas Vendas'></form>
      </li>
         <a class='navbar-brand' href='#'></a>
      <li class='nav-item'>
        <form class='nav' action='../my_deals2/' method='POST'><input name='owner' type='hidden' value='".$_SESSION['id']."'><input class='btn btn-outline-dark' type='submit' value='Minhas Compras'></form>
      </li>
        <a class='navbar-brand' href='#'></a>
      <li class='nav-item'><a style='background-color: grey' class='btn btn-outline-light' href='../'>Página Inicial</a></li>
    </ul>
    <form class='form-inline my-2 my-lg-0'>
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

  
 

if(!isset($_SESSION['id'])){
  echo "";
 
    # code...
    echo " necessario estar logado";
    exit();
    
}else{
   $sql_qtd = "SELECT * FROM prod WHERE id_user = ?";
  $stm_qtd = $con->prepare($sql_qtd);
  $stm_qtd->bindValue(1,$_SESSION['id']);
$stm_qtd->execute();
  $row = $stm_qtd->fetchAll();
  

 

 echo " <div class='row'>
 <div class='container'>
  <div class='row'>";
    foreach ($row as $key => $value) {
    
      // var_dump($value['url']);
echo "     
              <div class='col-md-3' >
                <div class='card'  style='width: 18rem; height: 40rem'>
                     <img width='200px' height='200px' class='card-img-top' src='../".$value['url']."'>
                      <div class='card-body mb'>
                        <div><h5 class='card-title'>".$value['nome']."</h5></div>
                        <div ><p class='card-text'>".$value['descript']."</p></div>
                        <div > <p class='card-text'> <b>Em estoque ".$value['qtd']."</b></p></div>
                        <div >De:<s>". number_format((float)$value['valor'], 2, ',', '.')."</s></div>
                        <div > Por:<p class='card-text'>".number_format((float)$value['valor'], 2, ',', '.')." </div>
                        </p>
                        <div class='shadow-lg p-3 mb-5 bg-white rounded'>
                        <form method='POST' action='./delete/' > 
                            <input name='prod' value='".$value['id']."' type='hidden'>
                            <input class='btn btn-danger sm'  value='Excluir' type='submit'>
                        </form>
                        <form method='POST' action='./alter/' > 
                            <input name='prod' value='".$value['id']."' type='hidden'>
                            <input class='btn btn-warning sm'  value='Alterar Detalhes' type='submit'>
                        </form>
                        </div>
                        </p>
                
                  </div>
              
                  </div>
                  </div>

         ";



 
}
echo "</div>

</div>
</div>
</div>
";



}


  
    
  



  
        
    



  ?>

</div>
<?php 
	 


	
?>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"> </script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"> </script>

</body>
</html>


