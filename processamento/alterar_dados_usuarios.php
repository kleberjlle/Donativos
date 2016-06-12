<?php
include("../seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

$id_usuario     = $_POST['id_usuario'];
$senha          = $_POST['senha'];
$administrador  = isset($_POST['administrador']);

//Realiza consulta, caso ID do usuário selecionado seja igual a de um registro do BD  
$consulta_usuario = "SELECT * FROM Usuarios WHERE id_usuario = '$id_usuario'";
$resultado_consulta_usuario = mysql_query($consulta_usuario);
$registros_resultado_consulta_usuario = mysql_fetch_array($resultado_consulta_usuario);

/*Verifica se a variável está em branco
 * Caso sim recebe 0
 * Caso não recebe 1
 */
if(empty($administrador)){
    $administrador = 0;
}else{
    $administrador = 1;
}

/* Verifica se o ID do usuário selecionado é diferente da recebida pelo parâmetro
 * se for então aplica segurança MD5
 * senão não aplica segurança, pois já estará criptografada
 */
if($senha != $registros_resultado_consulta_usuario['senha']){
    $atualiza_usuario = "UPDATE Usuarios SET senha = '".MD5($senha)."', administrador = '$administrador' WHERE id_usuario = '$id_usuario'";
    $resultado_atualiza_usuario = mysql_query($atualiza_usuario);
    
    //Redireciona página
    header("Location: ../cadastros_usuarios.php");
}else{
    $atualiza_usuario = "UPDATE Usuarios SET senha = '$senha', administrador = '$administrador' WHERE id_usuario = '$id_usuario'";
    $resultado_atualiza_usuario = mysql_query($atualiza_usuario);
    
    //Redireciona página
    header("Location: ../cadastros_usuarios.php");
}
?>