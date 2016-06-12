<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//Recebe dados
$valor_doado    = $_POST['valor_doado'];
$id_conta       = $_POST['id_conta'];
$id_regiao      = $_POST['id_regiao'];
$id_conferencia = $_POST['id_conferencia'];
$id_igreja      = $_POST['id_igreja'];

//Consulta dados nas tabelas bancos econtas
$consulta_conta = "SELECT * FROM Bancos, Contas WHERE Bancos_id_banco = id_banco AND id_conta = '$id_conta'";
$resultado_consulta_conta = mysql_query($consulta_conta);
$registros_resultado_consulta_conta = mysql_fetch_array($resultado_consulta_conta);

//Consulta dados na tabela regioes
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

//Verifica se usuario é administrador
if($_SESSION['usuarioAdministrador'] == '1'){
    //Inclui subcabeçalho para administradores
    include './inc/cabecalho_sub_painel_admin.php';
}else{
    //Inclui cabeçalho para não administradores
    include './inc/cabecalho_painel.php';
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Donativos</title>
        <link rel="icon" href="images/favicon.ico">
        <link rel="shortcut icon" href="images/favicon.ico" />
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="content_wrapper">
            <div class="container_12">
                <div class="grid_9">
                    <div class="content">
                        <h3><?php echo "Olá, " . $_SESSION['usuarioNome']; ?></h3>
                        <h3>Minhas doações</h3>
                        <h4>Etapa 6: Escolha o Fundo</h4>
                        <form method="post" action="processamento/doar.php">
                            <table>
                                <tr>
                                    <td>
                                        <?php
                                        //Consulta dados nas tabelas fundos, igrejas e conferencias
                                        $consulta_fundo = "SELECT * FROM Fundos, Igrejas, Conferencias WHERE Igrejas_id_igreja = id_igreja AND Conferencias_id_conferencia = id_conferencia AND id_igreja = '$id_igreja'";
                                        $resultado_consulta_fundo = mysql_query($consulta_fundo);
                                        ?>
                                        <select name="id_fundo">
                                            <?php
                                            //Enquanto houver registros mostrar dados abaixo
                                            while ($registros_resultado_consulta_fundo = mysql_fetch_array($resultado_consulta_fundo)){
                                            ?>
                                            <option value="<?php echo $registros_resultado_consulta_fundo['id_fundo']?>">
                                                <?php echo $registros_resultado_consulta_fundo['id_fundo']." | ".$registros_resultado_consulta_fundo['nome_fundo']; ?>
                                            </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <!--Campos ocultos para passagem de parametros-->
                                    <td><input type="hidden" name="id_conta" value="<?php echo $id_conta ?>"></td>
                                    <td><input type="hidden" name="valor_doado" value="<?php echo $valor_doado ?>"></td>
                                    <td><input type="hidden" name="id_regiao" value="<?php echo $id_regiao ?>"></td>
                                    <td><input type="hidden" name="id_conferencia" value="<?php echo $id_conferencia ?>"></td>
                                    <td><input type="hidden" name="id_igreja" value="<?php echo $id_igreja ?>"></td>
                                    <td><input type="submit" value="Doar"></td>
                                    <td><input type="button" value="Voltar" onClick="history.go(-1)"></td>
                                </tr>
                            </table>
                        </form>
                        <h3></h3>
                        <h4>Andamento da doação:</h4>
                        <table>
                            <tr>
                                <td>Conta:</td><td><?php echo $registros_resultado_consulta_conta['banco'].' | '.$registros_resultado_consulta_conta['agencia'].' | '.$registros_resultado_consulta_conta['conta'] ?></td>
                            </tr>
                            <tr>
                                <!--Validação para moeda padrão Brasil-->
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
                                <td>Fundo:</td><td>Aguardando escolha</td>
                            </tr>
                        </table>    
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>