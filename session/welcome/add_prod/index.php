

<!DOCTYPE html5>
<html>
<head>
	<title>Proferta - Venda um Produto ou Serviço </title>
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
   // $_SESSION['id'] = $_POST['user'];
    if(!isset($_SESSION['id'])){
     echo "  Bem Vindo Visitante.";
     echo "<a class='navbar-brand' href='#'></a>
  <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarTogglerDemo02' aria-controls='navbarTogglerDemo02' aria-expanded='false' aria-label='Toggle navigation'>
    <span class='navbar-toggler-icon'></span>
  </button>

  <div class='collapse navbar-collapse' id='navbarTogglerDemo02'>
    <ul class='navbar-nav mr-auto mt-2 mt-lg-0'>
      <li class='nav-item active'>
        <a class='nav-link' href='../../'>Login <span class='sr-only'>(current)</span></a>
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
  $stm_qtd->bindValue(1,$_SESSION['id']);


  $stm_qtd->execute();
  $row = $stm_qtd->fetchAll();
  foreach ($row as $key => $value) {
    echo " <img width='50px' height='50px' src='../".$value['profile_img']."'> <b>". $value['nome'] . "</b>  "    . " <div class='btn'><font color='green'> <b>R$ ". number_format((float)$value['saldo'], 2, ',', '.') . "</font></b></div>";
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
       <form class='nav' method='post' action='./'><input name='user' type='hidden' value='".$_SESSION['id']."'> <input class='btn btn-primary' disabled type='submit' value='Vender um produto.'></form>
      </li>
      <a class='navbar-brand' href='#'></a>
        <li class='nav-item'>
        <form class='nav' action='../my_prod/' method='POST'><input name='owner' type='hidden' value='".$_SESSION['id']."'><input class='btn btn-outline-warning' type='submit' value='Meus Produtos'></form>
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

<div class='container' style="width: 55vh">
  <!-- VISUALIZANDO PRODUTOS DE TODOS -->
  <?php
  if(!isset($_SESSION['id'])){
          echo "Área restrita. <br> faça login primeiro.";
          exit();
  }else{
    $get_id_fromDB = "SELECT * FROM prod";
    $stm_id = $con->prepare($get_id_fromDB);
    $stm_id->execute();
    $row = $stm_id->fetchAll();
    foreach ($row as $key => $value) {
      $id_prod = $value['id'];
    }
          
              echo "<form class='text-center border border-light p-5' method='post' action='add.php' enctype='multipart/form-data'>

            <p class='h4 mb-4'>Adicione um produto</p>

            <!-- Name -->
            <input required name='prod_name' type='text' id='defaultContactFormName' class='form-control mb-4' placeholder='Nome do Produto ou Serviço'>

            <!-- Email -->
              <input required name='valor' type='number'  class='form-control mb-4' placeholder='R$'>
              <input required name='qtd' type='number'  class='form-control mb-4' placeholder='Quantidade'>
              <input required name='owner' type='hidden' value='".$_SESSION['id']."'>
            <!-- Subject -->
            <label>Categoria</label>
            <select required name='category' class='browser-default custom-select mb-4'>
                <option value='' selected>Escolha</option>
                <option value='Animais'>Animais</option>
                <option value='Agricolas'>Agricolas</option>
                <option value='Automoveis'>Automoveis</option>
                <option value='Bebidas'>Bebidas</option>
                <option value='Beleza' >Beleza</option>
                <option value='Cosmeticos'>Cosméticos</option>
                <option value='Cursos'>Cursos</option>
                <option value='Fitness'>Fitness</option>
                <option value='Limpeza'>Limpeza</option>
                <option value='Saude'>Saúde</option>




            </select>

            <!-- Message -->
            <div class='form-group'>
                <textarea name='descript' class='form-control rounded-0' id='exampleFormControlTextarea2' rows='3' placeholder='Descrição do Produto ou Serviço'></textarea>
            </div>

            <!-- Copy -->
           Escolha uma imagem para o produto > <input class='form-control' required type='file' name='fileToUpload' id='fileToUpload'>
          
<br>
            <!-- Send button --><br>
            <button class='btn btn-info btn-block' type='submit'>OK</button> 

        </form>";



    }
  
    
  



  
        
    



  ?>
</div>
<?php 
	


	
?>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</body>
</html>


