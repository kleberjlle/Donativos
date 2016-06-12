<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//Recebe dados via GET
$valor_doado    = $_GET['valor_doado'];
$id_regiao      = $_GET['id_regiao'];
$id_conferencia = $_GET['id_conferencia'];
$id_igreja      = $_GET['id_igreja'];
$id_fundo       = $_GET['id_fundo'];
$id_conta       = $_GET['id_conta'];

//Consulta dados nas tabelas bancos e contas
$consulta_conta = "SELECT * FROM Bancos, Contas WHERE Bancos_id_banco = id_banco";
$resultado_consulta_conta = mysql_query($consulta_conta);
$registros_resultado_consulta_conta = mysql_fetch_array($resultado_consulta_conta);

//Consulta dados na tablea regioes
$consulta_regiao = "SELECT * FROM Regioes WHERE id_regiao = '$id_regiao'";
$resultado_consulta_regiao = mysql_query($consulta_regiao);
$registros_resultado_consulta_regiao = mysql_fetch_array($resultado_consulta_regiao);

//Consulta dados na tabela conferencias
$consulta_conferencia = "SELECT * FROM Conferencias WHERE id_conferencia = '$id_conferencia'";
$resultado_consulta_conferencia = mysql_query($consulta_conferencia);
$registros_resultado_consulta_conferencia = mysql_fetch_array($resultado_consulta_conferencia);

//Consulta dados nas tabelas conferencias e igrejas
$consulta_igreja = "SELECT * FROM Conferencias, Igrejas WHERE id_conferencia = '$id_conferencia'";
$resultado_consulta_igreja = mysql_query($consulta_igreja);
$registros_resultado_consulta_igreja = mysql_fetch_array($resultado_consulta_igreja);

//Consulta dados na tabela fundos
$consulta_fundo = "SELECT * FROM Fundos WHERE id_fundo = '$id_fundo'";
$resultado_consulta_fundo = mysql_query($consulta_fundo);
$registros_resultado_consulta_fundo = mysql_fetch_array($resultado_consulta_fundo);

/*Verifica se usuário atual é administrador
 * Caso sim recebe inclusão do subcabeçalho para administradores
 * Caso não recebe inclusão do cabeçalho para não administradores
 */
if($_SESSION['usuarioAdministrador'] == '1'){
    include './inc/cabecalho_sub_painel_admin.php';
}else{
    include './inc/cabecalho_painel.php';
}
?>    
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Donativos</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="content_wrapper">
            <div class="container_12">
                <div class="grid_9">
                    <div class="content">
                        <h3><?php echo "Olá, " . $_SESSION['usuarioNome']; ?></h3>
                        <table>
                            <tr>
                                <td colspan="2"><h4>Andamento da doação:</h4></td><td></td>
                            </tr>
                            <tr>
                                <td>Conta:</td><td><?php echo $registros_resultado_consulta_conta['banco'].' | '.$registros_resultado_consulta_conta['agencia'].' | '.$registros_resultado_consulta_conta['conta'] ?></td>
                            </tr>
                            <tr>
                                <!--Máscara para moeda do Brasil-->
                                <td>Valor:</td><td><?php echo $valor_doado ?></td>
                            </tr>
                            <tr>
                                <td>Estado:</td><td><?php echo $registros_resultado_consulta_regiao['nome_regiao'] ?></td>
                            </tr>
                            <tr>
                                <td>Conferência:</td><td><?php echo $registros_resultado_consulta_conferencia['nome_conferencia']?></td>
                            </tr>
                            <tr>
                                <td>Templo:</td><td><?php echo $registros_resultado_consulta_igreja['nome_igreja']?></td>
                            </tr>
                            <tr>
                                <td>Fundo:</td><td><?php echo $registros_resultado_consulta_fundo['nome_fundo']?></td>
                            </tr>
                        </table>
                        <h3></h3><h4>Doação realizada com sucesso!</h4>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>