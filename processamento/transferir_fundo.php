<?php
include("../seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//Recebe dados da transferência
$id_doacao              = $_POST['id_doacao'];
$id_fundo_origem        = $_POST['id_fundo_origem'];
$id_fundo_destino       = $_POST['id_fundo_destino'];
$valor_destino          = $_POST['valor_transferir'];
$valor_origem           = $_POST['valor_recebido'];

// Remove o R$
$valor_destino = str_replace("R$ " , "" , $valor_destino);
//Substituir ponto por (vazio)
$valor_destino = str_replace("." , "" , $valor_destino);

/* Depois Substitui a vírgula por ponto, para realizar o cálculo em float ex.: de 3547,81 para 3547.81
e armazenar no BD caso caia na condição falsa da estrutura de decisão a seguir */
$valor_destino = str_replace("," , "." , $valor_destino); 

//verifica se o valor de transferência é maior que o disponível no fundo de origem ou  se é <= 0
if($valor_destino > $valor_origem OR $valor_destino <= 0){
    // formata valor para moeda. ex.: R$ 3.547,81
    $valor_origem           = number_format($valor_origem, 2, ',', '.');
    //Redireciona página com passagem de parâmetro
    header("Location:../doacao_fundo_destino.php?status=error&id_fundo=$id_fundo_origem&id_doacao=$id_doacao");
}else{

//Consulta registros da tabela fundos
$consulta_fundo = "SELECT * FROM Fundos WHERE id_fundo = '$id_fundo_destino'";
$resultado_consulta_fundo = mysql_query($consulta_fundo);
$registros_resultado_consulta_fundo = mysql_fetch_array($resultado_consulta_fundo);

//Subtrai do valor que o fundo transferente tinha
$valor_recebido_origem = $valor_origem - $valor_destino;

//Adiciona o valor da transferência ao valor que o fundo recebidor tinha
$valor_recebido_destino = $registros_resultado_consulta_fundo['valor_recebido'] + $valor_destino;

//Atualiza os valores do fundo transferidor na tabela fundos
$atualiza_fundo_origem = "UPDATE Fundos SET valor_recebido = '$valor_recebido_origem' WHERE id_fundo = '$id_fundo_origem'";
$resultado_atualiza_fundo_origem = mysql_query($atualiza_fundo_origem);

//Atualiza os valores do fundo recebidor na tabela fundos
$atualiza_fundo_destino = "UPDATE Fundos SET valor_recebido = '$valor_recebido_destino' WHERE id_fundo = '$id_fundo_destino'";
$resultado_atualiza_fundo_destino = mysql_query($atualiza_fundo_destino);

//Redireciona página
header("Location:../transferencia_finalizada.php");
}
?>