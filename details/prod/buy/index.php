

<!DOCTYPE html5>
<html>
<head>
    <title>Proferta - Compra concluida. </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>

 
 
<nav class="navbar navbar-expand-lg navbar-light bg-light"><?php
session_start();

require_once("../../../connection/connection.class.php");
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
        <a class='nav-link' href='#'>Link</a>
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
    echo " <img width='50px' height='50px' src='../../../session/welcome/".$value['profile_img']."'> Bem Vindo <b>". $value['nome'] . "</b> aproveite seus creditos! "    . " <div class='btn btn-primary'> R$ ". number_format((float)$value['saldo'], 2, ',', '.') . "</div>";
    echo "<a class='navbar-brand' href='#'></a>
  <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarTogglerDemo02' aria-controls='navbarTogglerDemo02' aria-expanded='false' aria-label='Toggle navigation'>
    <span class='navbar-toggler-icon'></span>
  </button>

  <div class='collapse navbar-collapse' id='navbarTogglerDemo02'>
    <ul class='navbar-nav mr-auto mt-2 mt-lg-0'>
      <li class='nav-item active'>
        <a class='nav-link' href='logout.php'>Sair <span class='sr-only'>(current)</span></a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='#'>Link</a>
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
 
    $sql_prod = "SELECT prod.nome as nome,userr.cpf, userr.nome as uname, prod.id_user, prod.id,prod.descript,prod.valor, prod.url, prod.qtd FROM prod JOIN userr ON prod.id_user = userr.cpf  WHERE prod.id = ?";
    $stm_prod = $con->prepare($sql_prod);
    $stm_prod->bindValue(1,$_POST['prod']);
    $stm_prod->execute();
    $row = $stm_prod->fetchAll();

    foreach ($row as $key => $value) {
      $prod_name = $value['nome'];
    $valor_prod = $value['valor'];
    $qtd_prod = $value['qtd'];
   

    $sql_buy_saldo = "SELECT saldo FROM userr WHERE cpf = ?";
    $stm_buy_saldo = $con->prepare($sql_buy_saldo);
    $stm_buy_saldo->bindValue(1,$_POST['session']);
    $stm_buy_saldo->execute();
    $row_buy = $stm_buy_saldo->fetchAll();
    foreach ($row_buy as $key => $value) {
      if($value['saldo'] < $valor_prod ){
        echo "Você nao tem Saldo suficiente para comprar este produto.";
        exit();
      }
      else{
        $saldo_buyer = $value['saldo'];
        $qtd_prod -=1;
        $saldo_buyer-= $valor_prod;
       
        $sql_decrement_saldo = "UPDATE userr SET saldo = ".$saldo_buyer." WHERE cpf = ?";
        $stm_decrement_saldo = $con->prepare($sql_decrement_saldo);
        $stm_decrement_saldo->bindValue(1,$_POST['session']);
        $stm_decrement_saldo->execute();

      $sql_vendor_saldo = "SELECT saldo  FROM userr WHERE cpf = ?";
      $stm_vendor_saldo = $con->prepare($sql_vendor_saldo);
      $stm_vendor_saldo->bindValue(1,$_POST['owner']);
      $stm_vendor_saldo->execute();
      $row2 = $stm_vendor_saldo->fetchAll();
      foreach ($row2 as $key => $value) {
        $saldo_vendor = $value['saldo'];
      
      }
      $saldo_vendor+=$valor_prod;
      $new_saldo = "UPDATE userr set saldo = ".$saldo_vendor." WHERE cpf = ?";

      $stm_new_saldo = $con->prepare($new_saldo);
      
      $stm_new_saldo->bindValue(1,$_POST['owner']);
      $stm_new_saldo->execute();

       $sql_qtd = "UPDATE prod SET qtd = ".$qtd_prod." WHERE id = ?";
       $stm_qtd = $con->prepare($sql_qtd);
       $stm_qtd->bindValue(1,$_POST['prod']);
      $stm_qtd->execute();
      $data_locale = new DateTimeZone("Brazil/East");
      $hoje = getdate();
      $sql_blog = "INSERT INTO buy_log (id_user,dat,descript) VALUES (:buyer,:data,:descr)";
      $stm_blog = $con->prepare($sql_blog);
      $stm_blog->bindParam(':buyer',$_POST['session']);
      $stm_blog->bindParam(':data',$hoje);
      $stm_blog->bindParam(':descr',"".$prod_name." comprado {".$hoje."} por ".$prod_valor."");
      $stm_blog->execute();
      echo "<h2>Comprado com sucesso.</h2><br> ";
    sleep(8);
    header("location: /proferta/session/welcome/");
     }
  }
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


