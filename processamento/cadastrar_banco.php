<?php
include("../seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

// Recebe o nome do banco
$banco  = $_POST['banco'];

//Insere um novo registro na tabela bancos
$cadastra_banco = "INSERT INTO Bancos (banco) VALUES ('$banco')";
$resultado_cadastra_banco = mysql_query($cadastra_banco);

//Redireciona página
header("Location: ../cadastros_bancos.php");
?>