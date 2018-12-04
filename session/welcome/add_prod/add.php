

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
     echo "  Bem Vindo Visitante. <a class='btn btn-secondary' href='../../../> Registre-se! </a>";
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
  $stm_qtd->bindValue(1,$_SESSION['id']);


  $stm_qtd->execute();
  $row = $stm_qtd->fetchAll();
  foreach ($row as $key => $value) {
    echo " <img width='50px' height='50px' src='".$value['profile_img']."'> <b> ". $value['nome'] . " </b>  "    . " <div class='btn'><font color='green'> <b>R$ ". number_format((float)$value['saldo'], 2, ',', '.') . "</font></b></div>";
    echo "<a class='navbar-brand' href='#'></a>
  <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarTogglerDemo02' aria-controls='navbarTogglerDemo02' aria-expanded='false' aria-label='Toggle navigation'>
    <span class='navbar-toggler-icon'></span>
  </button>

  <div class='collapse navbar-collapse' id='navbarTogglerDemo02'>
    <ul class='navbar-nav mr-auto mt-2 mt-lg-0'>
      <li class='nav-item active'>
        <a class='btn btn-danger' href='../logout.php'>Sair <span class='sr-only'>(current)</span></a>
      </li>
    <a class='navbar-brand' href='#'></a>
      <li class='nav-item'>
       <form class='nav' method='post' action='../add_prod'><input name='user' type='hidden' value='".$_SESSION['id']."'> <input class='btn btn-outline-primary' type='submit' value='Vender um produto.'></form>
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

<div class="container" >
  <!-- VISUALIZANDO PRODUTOS DE TODOS -->
  <?php
  if(!isset($_SESSION['id'])){
          echo "Área restrita. <br> faça login primeiro.";
          exit();
  }else{
          
$target_dir = "../img_prod/";

$target_file = $target_dir . basename($_FILES["fileToUpload"]['name']);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "Arquivo é uma imagem - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "O arquivo escolhido deve ser uma imagem.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "<br>Desculpe, renomeie o arquivo pois já existe um com este nome.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "<br>Desculpe, arquivo muito grande.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "<br>Desculpe, apenas arquivos de IMAGEM (JPG, JPEG, PNG, GIF etc.)";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<br>Desculpe, seu arquivo não foi carregado.";
// if everything is ok, try to upload file
} else {

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          $dir_to_db = "/img_prod/";
          $dir_to_db = $dir_to_db . basename($_FILES["fileToUpload"]['name']);
          var_dump($dir_to_db);
          $sql_insert = "INSERT INTO prod (nome,qtd,valor,id_user,descript,url) VALUES (:nome,:qtd,:valor,:owner,:descript,:url)";
          
          $stm_insert = $con->prepare($sql_insert);
        $stm_insert->bindParam(':nome', $_POST['prod_name']);
          $stm_insert->bindParam(':qtd',$_POST['qtd']);
          $stm_insert->bindParam(':valor',$_POST['valor']);
          $stm_insert->bindParam(':owner',$_POST['owner']);
          $stm_insert->bindParam(':descript', $_POST['descript']);
          $stm_insert->bindParam(':url',$dir_to_db);
          try{
            $stm_insert->execute();
            echo "Cadastrado com sucesso,";
            echo " a imagem ". basename( $_FILES["fileToUpload"]["name"]). " foi carregada com sucesso.";
          }catch(PDOException $e){
              echo $e->getMessage();
          }
        
    } else {
        echo "Desculpe, houve um erro inesperado.";
    }
}

          



          //arquivo 
          
}
              



    
  
    
  



  
        
    



  ?>
</div>
<?php 
	


	
?>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</body>
</html>


