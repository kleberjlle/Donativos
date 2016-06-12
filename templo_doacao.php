<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//Recebe dados via POST
$valor_doado    = $_POST['valor_doado'];
$id_conta       = $_POST['id_conta'];
$id_regiao      = $_POST['id_regiao'];
$id_conferencia = $_POST['id_conferencia'];

//consulta dados das tabelas bancos e contas
$consulta_conta = "SELECT * FROM Bancos, Contas WHERE Bancos_id_banco = id_banco AND id_conta = '$id_conta'";
$resultado_consulta_conta = mysql_query($consulta_conta);
$registros_resultado_consulta_conta = mysql_fetch_array($resultado_consulta_conta);

//consulta dados da tabela regioes
$consulta_regiao = "SELECT * FROM Regioes WHERE id_regiao = '$id_regiao'";
$resultado_consulta_regiao = mysql_query($consulta_regiao);
$registros_resultado_consulta_regiao = mysql_fetch_array($resultado_consulta_regiao);

//consulta dados da tabela conferencias
$consulta_conferencia = "SELECT * FROM Conferencias WHERE id_conferencia = '$id_conferencia'";
$resultado_consulta_conferencia = mysql_query($consulta_conferencia);
$registros_resultado_consulta_conferencia = mysql_fetch_array($resultado_consulta_conferencia);

//verifica se o usuário é administrador
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
                        <h3>Minhas doações</h3>
                        <h4>Etapa 5: Escolha o Templo</h4>
                        <form method="post" action="fundo_doacao.php">
                            <table>
                                <tr>
                                    <td>
                                        <?php
                                        //consulta dados das tabelas regioes, conferencias, igrejas
                                        $consulta_igreja = "SELECT * FROM Regioes, Conferencias, Igrejas WHERE Conferencias_id_conferencia = id_conferencia AND Regioes_id_regiao = id_regiao AND id_conferencia = '$id_conferencia'";
                                        $resultado_consulta_igreja = mysql_query($consulta_igreja);
                                        ?>
                                        <select name="id_igreja">
                                            <?php 
                                            //Enquanto houver registros mostrar dados abaixo
                                            while ($registros_resultado_consulta_igreja = mysql_fetch_array($resultado_consulta_igreja)){ ?>
                                            <option value="<?php echo $registros_resultado_consulta_igreja['id_igreja']?>">
                                                <?php echo $registros_resultado_consulta_igreja['id_igreja']." | ".$registros_resultado_consulta_igreja['nome_igreja']; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <!--Campos ocultos apenas para passagem de paramentros-->
                                    <td><input type="hidden" name="id_conta" value="<?php echo $id_conta ?>"></td>
                                    <td><input type="hidden" name="id_conferencia" value="<?php echo $id_conferencia ?>"></td>
                                    <td><input type="hidden" name="id_regiao" value="<?php echo $id_regiao ?>"></td>
                                    <td><input type="hidden" name="valor_doado" value="<?php echo $valor_doado ?>"></td>
                                    <td><input type="submit" value="Próxima"></td>
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
                                <!--Máscara para moeda padrão Brasil-->
                                <td>Valor:</td><td><?php echo $valor_doado ?></td>
                            </tr>
                            <tr>
                                <td>Estado:</td><td><?php echo $registros_resultado_consulta_regiao['nome_regiao'] ?></td>
                            </tr>
                            <tr>
                                <td>Conferência:</td><td><?php echo $registros_resultado_consulta_conferencia['nome_conferencia']?></td>
                            </tr>
                            <tr>
                                <td>Templo:</td><td>Aguardando escolha</td>
                            </tr>
                            <tr>
                                <td>Fundo:</td><td>Ainda não informado</td>
                            </tr>
                        </table>    
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>