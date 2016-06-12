<?php
include("../seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//Recebe dados da conta bancária e do banco selecionado
$id_banco = $_POST['id_banco'];
$agencia  = $_POST['agencia'];
$conta    = $_POST['conta'];

//Insere registro na tabea contas
$cadastra_conta = "INSERT INTO Contas (Usuarios_id_usuario, Bancos_id_banco, agencia, conta) VALUES ('".$_SESSION['usuarioID']."','$id_banco','$agencia', '$conta')";
$resultado_cadastra_conta = mysql_query($cadastra_conta);

//Redireciona página
header("Location: ../minhas_contas.php");
?>