

<!DOCTYPE html5>
<html>
<head>
	<title>Proferta - Seja Bem Vindo ! </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link href="../../css/style.css" rel="stylesheet" type="text/css">


</head>
<body style="
    background-color: #cccccc;
    position: all;">

 
 
<nav class="navbar navbar-expand-lg navbar-light bg-light" >
<?php
session_start();
define("PATH_SESSION", dirname(__FILE__));
require_once(PATH_SESSION . "/../connection/connection.class.php");
    $conObj = new Connection();
    $con = $conObj->getConnection();
    if(!isset($_SESSION['id'])){
     echo " ";
     echo "
  <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarTogglerDemo02' aria-controls='navbarTogglerDemo02' aria-expanded='false' aria-label='Toggle navigation'>
    <span class='navbar-toggler-icon'></span>
  </button>

  <div  class='collapse navbar-collapse' id='navbarTogglerDemo02'> 
  
    <ul class='navbar-nav mr-auto mt-2 mt-lg-0'>
    <li class='nav-item active'><a class='navbar-brand'   href='../session/welcome'><img width='50px' height='50px' src='../image/home.png'></a></li>
      <li class='nav-item active'>
       <form class='nav' action='../login/' method='POST'>
       <table>
           <tr>
            <td>
              <input class='form-control'  name='username' type='number'>
            </td>
            <td>
              <input class='form-control' type='password' name='password'>
            </td>
            <td>
             <input class='btn btn-primary' type='submit' value='Fazer login'>
            </td>
          </tr>
          </table>
        </form>
      </li>
     
      
    </ul>
  
  </div>
</nav>";
    }else{
       $sql_prof = "SELECT profile_img, nome, saldo FROM userr WHERE cpf = ?";
  $stm_prof = $con->prepare($sql_prof);
  $stm_prof->bindValue(1,$_SESSION['id']);


  $stm_prof->execute();
  $row = $stm_prof->fetchAll();
  foreach ($row as $key => $value) {
    echo " <img width='50px' height='50px' src='../session/welcome".$value['profile_img']."'> <b> ". $value['nome'] . " </b> "    . "<div class='btn'><font color='green'> <b>R$ ". number_format((float)$value['saldo'], 2, ',', '.') . "</font></b></div>";
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
       <form class='nav' method='post' action='./add_prod'><input name='user' type='hidden' value='".$_SESSION['id']."'> <input class='btn btn-outline-success' type='submit' value='Vender um produto.'></form>
      </li>
      <a class='navbar-brand' href='#'></a>
      <li class='nav-item'>
        <form class='nav' action='./my_prod/' method='POST'><input name='owner' type='hidden' value='".$_SESSION['id']."'><input class='btn btn-outline-warning' type='submit' value='Meus Produtos'></form>
      </li>
           <a class='navbar-brand' href='#'></a>
      <li class='nav-item'>
        <form class='nav' action='./my_deals/' method='POST'><input name='owner' type='hidden' value='".$_SESSION['id']."'><input class='btn btn-outline-dark' type='submit' value='Minhas Vendas'></form>
      </li>
         <a class='navbar-brand' href='#'></a>
      <li class='nav-item'>
        <form class='nav' action='./my_deals2/' method='POST'><input name='owner' type='hidden' value='".$_SESSION['id']."'><input class='btn btn-outline-dark' type='submit' value='Minhas Compras'></form>
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
<center>
<div class="container">
  <!-- VISUALIZANDO PRODUTOS DE TODOS -->
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container-fluid" >
  <form action="../reg.php" method="post" enctype='multipart/form-data'>

    <section class="container">
		<div class="container-page">				
			<div class="col-md-6">
				<h3 class="dark-grey">Cadastre-se!</h3>
				
				<div class="form-group col-lg-12">
					<label>Nome</label>
					<input type="text" name="nome" class="form-control" id="" placeholder="Entre com seu nome.">
				</div>
				
				<div class="form-group col-lg-6">
					<label>Senha</label>
					<input type="password" name="senha" class="form-control"  placeholder="Entre com sua senha.">
				</div>
				
				<div class="form-group col-lg-6">
					<label> CPF</label>
					<input type="number"  maxlenght="11" name="cpf" class="form-control"  placeholder="Entre com seu CPF">
				</div>
        <div class="form-group col-lg-6">
					<label> DDD</label>
					<input type="number"  maxlenght="3" name="code" class="form-control"  placeholder="088">
          <label> Telefone celular ou Fixo.</label>
					<input type="number"  maxlenght="9" name="phone" class="form-control"  placeholder="9 99887766">
				</div>
     
							
				<div class="form-group col-lg-6">
					<label>Email Address</label>
					<input type="text" name='email' id="email" class="form-control"  placeholder="meuemail@mail.com">
				</div>
        <div class="form-group col-lg-6">Sua foto<input class='form-control' required type="file" name="fileToUpload" id="fileToUpload"></div>
    
							
				
			

							
			
			</div>
      <div class="form-group col-lg-6">
      
  <label for="descricao">Sobre você:</label>
  <input type="text" class="form-control"  name="descricao" placeholder="EXEMPLO: Estudo Tecnologias da Informação, na Faculdade Paraíso do Ceará.">

</div>
	
			 <div class="form-group col-lg-12" align='left'>
      
				<h3 class="dark-grey">Termos e Condições</h3>
				<p>
					Clicando em "Registrar" você concorda com nossos Termos e Condições.
				</p>  
				<p>
				
				</p>
				<p>
				</p>
				<p>
					Acceptance of an order by us is dependent on our suppliers ability to provide the product. (Paragraph 13.5.6)
				</p>
				
        
				<button type="submit" class="btn btn-primary">Cadastre-se !</button>
		 </div>
		</div>
	 </section>
  </form>
</div>

</div>
</center>
<script>
var cpfMascara = function (val) {
   return val.replace(/\D/g, '').length > 11 ? '00.000.000/0000-00' : '000.000.000-009';
},
cpfOptions = {
   onKeyPress: function(val, e, field, options) {
      field.mask(cpfMascara.apply({}, arguments), options);
   }
};
$('.mascara-cpfcnpj').mask(cpfMascara, cpfOptions);
</script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>


