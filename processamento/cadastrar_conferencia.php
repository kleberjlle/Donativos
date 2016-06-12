<?php
include("../seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//Recebe nome da conferência e o ID da regiao selecionada
$nome_conferencia   = $_POST['nome_conferencia'];
$id_regiao          = $_POST['id_regiao'];

//Insere um novo registro na tabela conferencias
$cadastra_conferencia = "INSERT INTO Conferencias (Regioes_id_regiao, nome_conferencia) VALUES ('$id_regiao', '$nome_conferencia')";
$resultado_cadastra_conferencia = mysql_query($cadastra_conferencia);

//Redireciona página
header("Location: ../cadastros_conferencias.php?id_regiao=$id_regiao");
?>