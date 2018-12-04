<?php 

class User {
	private $nome;
	private $cpf;
	private $login;
	private $senha;
	private $saldo;

	public function getNome(){
		return $this->nome;
	}
	public function getSenha(){
		return $this->senha;
	}
	public function setNome($nome){
			$this->nome = $nome;
	}
	public function setSenha($senha){
			$this->senha = $senha;
	}
	public function setCPF($cpf){
			$this->cpf = $cpf;
	}
	public function getCPF(){
		return $this->cpf;
	}
	public function setSaldo($saldo){
			$this->saldo = $saldo;
	}
	public function getSaldo(){
		return $this->saldo;
	}
		public function setLogin($login){

			$this->login = $login;
	}
	public function getLogin(){
		return $this->login;
	}

	public function getConnectionForUser(){
		include  PATH . "/../../connection/connection.class.php";
		$conObj = new Connection();
		$con = $conObj->getConnection();
		return $con;
	}
	public function agree_login($cpf,$senha){
		include  PATH . "/../connection/connection.class.php";
		$conObj = new Connection();
		$con = $conObj->getConnection();

		if(!(isset($cpf)) || !(isset($senha))){
			echo "Digite algo nos campos";
			exit();
		}else{
		
		$sql_login = "SELECT cpf,id,nome,senha FROM userr WHERE cpf = ? AND senha = ?";
		$stm_login = $con->prepare($sql_login);
			try{
				$stm_login->bindValue(1,$cpf);
				$stm_login->bindValue(2,$senha);
				$stm_login->execute();
			}catch(PDOException $e){
				echo "";
				exit("<h1><a href='javascript:window.history.go(-1)'>Digite algo nos campos.</a><br></h1>");
			}
		
		
		$row2 = $stm_login->rowCount();

		if($row2 > 0){
		$row = $stm_login->fetchAll();

			foreach ($row as $key => $value) {
			echo " <link href='http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css' rel='stylesheet' id='bootstrap-css'>
  <script src='http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script><div class='container'><h1>Olá, ".$value['nome']." é você?  </h1><br><form action='login.php' method='post'>
				<input name='username' type='hidden' value='".$value['cpf']."'>
				<input name='id' type='hidden' value='".$value['id']."'>
				<input name='nome' type='hidden' value='".$value['nome']."'>
				<input name='password' type='hidden' value='".$value['senha']."'>
				<input class='btn btn-success' type='submit' value='Sim, sou eu !'></form></div>";
			}
		}else{
			echo "dados incorretos";
			var_dump($cpf);
			var_dump($senha);
		}
		


	}
}
	public function logout(){
		session_start();
		session_destroy();
	}
	public function login($login,$senha){
		
		include  PATH . "/../../connection/connection.class.php";
		$conObj = new Connection();
		$con = $conObj->getConnection();

		if(!(isset($login)) || !(isset($senha))){
			echo "Voce precisa digitar algo nos campos.";
			exit();
		}else{
		
		$sql_login = "SELECT cpf,nome,login, senha FROM userr WHERE cpf = ? AND senha = ?";
		$stm_login = $con->prepare($sql_login);

		$stm_login->bindValue(1,$login);
		$stm_login->bindValue(2,$senha);

		$stm_login->execute();

		$row = $stm_login->rowCount();
			
		if($row > 0){

			session_start();
			$row2 = $stm_login->fetchAll();
			foreach ($row2 as $key => $value) {
				$_SESSION['nome'] = $value['nome'];
				$_SESSION['id'] = $login;
			}
			$_SESSION['nome'] = $value['nome'];
				$_SESSION['id'] = $login;
			$_SESSION['login'] = $login;
			header("location: ../session/welcome/");
		}else{
			echo "credenciais incorretas";
			exit();
		}



		}
	}


	public function comprar($produto, $sessao, $con){

		if(!isset($session)){
			echo "Necessario estar logado.";
			exit();
		}else{
			session_start();
			$_SESSION['login'] = $sessao;

			$sql_produto = "SELECT * FROM prod WHERE id = ? AND category = ?";
			$sql_req_pedido = "INSERT INTO pedido (id_produto,id_cliente, valor) VALUES (?,?,?)";
		}
		
	}
	
	public function vender($produto, $valor,$pnome,$session, $nome, $con){

	}
}

?>