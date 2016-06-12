<?php
include("../seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//Recebe dados da doação
$valor_doado    = $_POST['valor_doado'];
$id_regiao      = $_POST['id_regiao'];
$id_conferencia = $_POST['id_conferencia'];
$id_igreja      = $_POST['id_igreja'];
$id_fundo       = $_POST['id_fundo'];
$id_conta       = $_POST['id_conta'];

$valor_doado = str_replace("." , "" , $valor_doado); // Primeiro tira os pontos
$valor_doado = str_replace("," , "." , $valor_doado); // Depois tira a vírgula

//Consulta fundo quando o ID do fundo escolhido for igual ao do BD
$consulta_fundo = "SELECT * FROM Fundos WHERE id_fundo = '$id_fundo'";
$resultado_consulta_fundo = mysql_query($consulta_fundo);
$registros_resultado_consulta_fundo = mysql_fetch_array($resultado_consulta_fundo);

//Variável temporária recebe o valor do fundo selecionado para somar com o valor daodo
$temp = $registros_resultado_consulta_fundo['valor_recebido'];
$valor_recebido = $valor_doado + $temp;

//Insere um registro com a doação e retorna o ID deste registro
$cadastra_doacao_doacoes = "INSERT INTO Doacoes (valor_doado, data_doacao, Contas_id_conta) VALUES ('$valor_doado', NOW(), '$id_conta')";
$resultado_cadastra_doacao_doacoes = mysql_query($cadastra_doacao_doacoes);
$retorno = mysql_insert_id();

//Insere um novo registro na tabela doacoes_para_fundos com o regsitro anterior
$cadastra_doacao = "INSERT INTO Doacoes_para_Fundos (Doacoes_id_doacao, Fundos_id_fundo) VALUES ('$retorno', '$id_fundo')";
$resultado_cadastra_doacao = mysql_query($cadastra_doacao);

//Atualiza o valor do fundo
$atualiza_doacao_fundos = "UPDATE Fundos SET valor_recebido = '$valor_recebido' WHERE id_fundo = '$id_fundo'";
$resultado_atualiza_doacao_fundos = mysql_query($atualiza_doacao_fundos);

//Redireciona página com método GET, passando os dados anteriores
header("Location: ../doacao_finalizada.php?valor_doado=$valor_doado&id_regiao=$id_regiao&id_conferencia=$id_conferencia&id_igreja=$id_igreja&id_fundo=$id_fundo&id_conta=$id_conta");
?>