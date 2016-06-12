<?php
include("../seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

$nome       = $_POST['nome'];
$sobrenome  = $_POST['sobrenome'];
$cpf        = $_POST['cpf'];
$senha      = $_POST['senha'];

/*verifica se o ID do usuário atual é diferente da recebida pelo parâmetro
 * se for então aplica segurança MD5
 * senão não aplica segurança, pois já estará criptografada
 */
if($senha != $_SESSION['usuarioSenha']){
    $atualiza_usuario_admin = "UPDATE Usuarios SET nome = '$nome', sobrenome = '$sobrenome', cpf = '$cpf', senha = '".MD5($senha)."' WHERE '".$_SESSION['usuarioID']."' = id_usuario";
    $resultado_atualiza_usuarios = mysql_query($atualiza_usuario_admin);

    //Redireciona página
    header("Location: ../alterar_dados_admin.php");
}else{
    $atualiza_usuario_admin = "UPDATE Usuarios SET nome = '$nome', sobrenome = '$sobrenome', cpf = '$cpf', senha = '$senha' WHERE '".$_SESSION['usuarioID']."' = id_usuario";
    $resultado_atualiza_usuarios = mysql_query($atualiza_usuario_admin);

    //Redireciona página
    header("Location: ../alterar_dados_admin.php");
}
?>