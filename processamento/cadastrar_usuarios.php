<?php
include("../seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//Recebe dados do cadastro de usuário
$nome           = $_POST['nome'];
$sobrenome      = $_POST['sobrenome'];
$cpf            = $_POST['cpf'];
$usuario        = $_POST['usuario'];
$senha          = $_POST['senha'];
$administrador  = isset($_POST['administrador']);

/*Verifica se a variável está em branco
 * Caso sim recebe 0
 * Caso não recebe 1
 */
if(empty($administrador)){
    $administrador = 0;
}else{
    $administrador = 1;
}

//Insere um novo registro na tabela usuarios
$inserir_usuario = "INSERT INTO Usuarios (nome, sobrenome, cpf, usuario, senha, administrador) VALUES ('$nome','$sobrenome','$cpf', '$usuario', '".MD5($senha)."', '$administrador')";
$resultado_inserir_usuario = mysql_query($inserir_usuario);

//Redireciona página
header("Location: ../cadastros_usuarios.php");
?>