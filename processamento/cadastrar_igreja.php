<?php
include("../seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//Recebe dados da igreja/ templo
$nome_igreja    = $_POST['nome_igreja'];
$id_conferencia = $_POST['id_conferencia'];

//Insere um novo registro na tabela igrejas
$cadastra_igreja = "INSERT INTO Igrejas (Conferencias_id_conferencia, nome_igreja) VALUES ('$id_conferencia', '$nome_igreja')";
$resultado_cadastra_igreja = mysql_query($cadastra_igreja);

//Redireciona página com método GET, para passar o ID da conferência
header("Location: ../cadastros_igrejas.php?id_conferencia=$id_conferencia");
?>