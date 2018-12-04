<?php 
include  PATH . "/../connection/connection.class.php";
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$senha = $_POST['senha'];
$email = $_POST['email'];
$ddd = $_POST['code'];
$phone = $_POST['phone'];
//$descript = $_POST['descricao'];

$conObj = new Connection();
$sql_ver = "SELECT * FROM userr WHERE cpf = ?";
$con = $conObj->getConnection();
$stm_ver = $con->prepare($sql_ver);

$stm_ver->bindValue(1,$cpf);
$stm_ver->execute();
$row = $stm_ver->rowCount();
if($row > 0){
    echo "Usuário já cadastrado. <br> <a href='javascript:window.history.go(-1)'> clique aqui para voltar </a>";
    exit();
}elseif(!isset($email) || !isset($cpf) || !isset($senha) || !isset($nome)){

}else{
            
$target_dir = "session/welcome/user_img/";

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
    $dir_to_db = "user_img/";
          $dir_to_db = $dir_to_db . basename($_FILES["fileToUpload"]['name']);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $sql_newuser = "INSERT INTO userr (nome, cpf, email, senha, profile_img, ddd, phone) VALUES (:nome, :cpf, :email, :senha, :img, :ddd, :phone)";
    $stm_newuser = $con->prepare($sql_newuser);
    $stm_newuser->bindParam(':nome', $nome);
    $stm_newuser->bindParam(':cpf',  $cpf);
    $stm_newuser->bindParam(':email',$email);
    $stm_newuser->bindParam(':senha',$senha);
    $stm_newuser->bindParam(':img',$dir_to_db);
    $stm_newuser->bindParam(':ddd',$ddd);
    $stm_newuser->bindParam(':phone',$phone);
    //$stm_newuser->bindParam(':descript',$descript);
    $stm_newuser->execute();
    echo "Cadastrado com Sucesso.";
    }
}
}
?>