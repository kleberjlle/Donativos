<?php
include("../seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//Recebe dados do fundo e TD da igreja
$nome_fundo = $_POST['nome_fundo'];
$id_igreja  = $_POST['id_igreja'];

//Insere registro na tabela fundos e retorna o número da ID desta inserção
$cadastra_fundo = "INSERT INTO Fundos (Igrejas_id_igreja, nome_fundo) VALUES ('$id_igreja', '$nome_fundo')";
$resultado_cadastra_fundo = mysql_query($cadastra_fundo);
$retorno = mysql_insert_id();

//Redireciona página com método GET, para passar o ID da inserção anterior
header("Location: ../cadastro_fundo_finalizado.php?id_fundo=$retorno");
?>