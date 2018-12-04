

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
define("PATH_SESSION", dirname(__FILE__));
require_once(PATH_SESSION . "/../../../connection/connection.class.php");
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
    echo " <img width='50px' height='50px' src='../../../session/welcome/".$value['profile_img']."'> <b>". $value['nome'] . "</b>  "    . " <div class='btn'><font color='green'> <b>R$ ". number_format((float)$value['saldo'], 2, ',', '.') . "</font></b></div>";
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
       <form class='nav' method='post' action='../../../session/welcome/add_prod'><input name='user' type='hidden' value='".$_SESSION['id']."'> <input class='btn btn-outline-primary' type='submit' value='Vender um produto.'></form>
      </li>
      <a class='navbar-brand' href='#'></a>
        <li class='nav-item'>
        <form class='nav' action='../../../session/welcome/my_prod/' method='POST'><input name='owner' type='hidden' value='".$_SESSION['id']."'><input class='btn btn-outline-warning ' type='submit' value='Meus Produtos'></form>
      </li>
        <a class='navbar-brand' href='#'></a>
      <li class='nav-item'>
        <form class='nav' action='../../../session/welcome/my_deals/' method='POST'><input name='owner' type='hidden' value='".$_SESSION['id']."'><input class='btn btn-outline-dark' type='submit' value='Minhas Vendas'></form>
      </li>
      <a class='navbar-brand' href='#'></a>

      <li class='nav-item'>
        <form class='nav' action='../../../session/welcome/my_deals2/' method='POST'><input name='owner' type='hidden' value='".$_SESSION['id']."'><input class='btn btn-outline-dark' type='submit' value='Minhas Compras'></form>
      </li>
        <a class='navbar-brand' href='#'></a>
      <li class='nav-item'><a style='background-color: grey' class='btn btn-outline-light' href='../../../session/welcome/'>Página Inicial</a></li>
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
  echo "<h2>Faça login primeiro.</h2>";

   
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
       $id_usuario = $value['id_user'];
       $uname = $value['uname'];
       $prod_name = $value['nome'];
       $valor_prod = $value['valor'];
        $qtd_prod = $value['qtd'];
   
if($value['id_user'] == $_POST['session']){
          echo "Você não pode comprar seu proprio produto.";
          exit();
      }
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

      $sql_vendor_saldo = "SELECT saldo,cpf  FROM userr WHERE cpf = ?";
      $stm_vendor_saldo = $con->prepare($sql_vendor_saldo);
      $stm_vendor_saldo->bindValue(1,$_POST['owner']);
      $stm_vendor_saldo->execute();
      $row2 = $stm_vendor_saldo->fetchAll();
      foreach ($row2 as $key => $value) {
        $saldo_vendor = $value['saldo'];
        $vendor = $value['cpf'];
    
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
      
      $hoje = getdate();
     
     $dia       = $hoje['mday'];
     $mes       = $hoje['mon'];
     $ano       = $hoje['year'];
     $hora      = $hoje['hours'];
     $minuto    = $hoje['minutes'];
     $segundos  =$hoje['seconds'];
     $data = array('dia' => $dia,
                   'mes' => $mes,
                   'ano' => $ano,
                   'sec' => $segundos,
                   'min' => $minuto,
                   'hora' => $hora,
                         );  
     
     // $data_conv = $ano."/".$mes."/".$dia." ".$hora.":".$minuto.":".$segundos;
    $data_conv = "now()";
      
      $sql_nome1 = "SELECT nome from userr WHERE cpf = ?";
      $stm_nome1 = $con->prepare($sql_nome1);
      $stm_nome1->bindValue(1,$_POST['owner']);
      $stm_nome1->execute();
      $row_nome1 = $stm_nome1->fetchAll();
      foreach ($row_nome1 as $key => $value) {
        $vendedor = $value['nome'];
      }

        $descript_converted = "Você comprou um(a) ".$prod_name."  de ".$vendedor."  por R$ ".number_format((float)$valor_prod, 2, ',', '.')." ";
      $sql_blog = "INSERT INTO buy_log (id_user,dat,descript) VALUES (:buyer,:data,:descr)";
      $stm_blog = $con->prepare($sql_blog);
      $stm_blog->bindParam(':buyer',$_POST['session']);
      $stm_blog->bindParam(':data',$data_conv);
      $stm_blog->bindParam(':descr',$descript_converted);
      $stm_blog->execute();
 $sql_nome = "SELECT nome from userr WHERE cpf = ?";
      $stm_nome = $con->prepare($sql_nome);
      $stm_nome->bindValue(1,$_SESSION['id']);
      $stm_nome->execute();
      $row_nome = $stm_nome->fetchAll();
      foreach ($row_nome as $key => $value) {
        $comprador = $value['nome'];
      }
      $descript_converted2 = "Você vendeu um(a) ".$prod_name."  à ".$comprador." por R$ ".number_format((float)$valor_prod, 2, ',', '.')."";
      $sql_slog = "INSERT INTO sell_log (id_user,dat,descript) VALUES (:seller,:data,:descr)";
      $stm_slog = $con->prepare($sql_slog);
      $stm_slog->bindParam(':seller',$vendor);
      $stm_slog->bindParam(':data',$data_conv);
      $stm_slog->bindParam(':descr',$descript_converted2);
      $stm_slog->execute();


 echo "<h2> Combine a entrega </h2><br> ";
      
    sleep(3);
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


