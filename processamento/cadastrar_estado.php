<?php
include("../seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//Recebe sigla do Estado
$nome_regiao      = $_POST['nome_regiao'];

//Insere registro na tabela Regioes
$cadastra_regiao = "INSERT INTO Regioes (nome_regiao) VALUES ('$nome_regiao')";
$resultado_cadastra_regiao = mysql_query($cadastra_regiao);

//Redireciona página
header("Location: ../cadastros_templos.php");
?>