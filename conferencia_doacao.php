<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//Recebe os dados da doação
$valor_doado    = $_POST['valor_doado'];
$id_conta       = $_POST['id_conta'];
$id_regiao      = $_POST['id_regiao'];

//Consulta dados das tabelas bancos e contas
$consulta_conta = "SELECT * FROM Bancos, Contas WHERE Bancos_id_banco = id_banco AND id_conta = '$id_conta'";
$resultado_consulta_conta = mysql_query($consulta_conta);
$registros_resultado_consulta_conta = mysql_fetch_array($resultado_consulta_conta);

//Consulta dados da tabela regioes
$consulta_regiao = "SELECT * FROM Regioes WHERE id_regiao = '$id_regiao'";
$resultado_consulta_regiao = mysql_query($consulta_regiao);
$registros_resultado_consulta_regiao = mysql_fetch_array($resultado_consulta_regiao);

/*Verifica se o usuario atual é administrador
 * Caso sim recebe a inclusão do subcabeçalho para administradores
 * caso não recebe a inclusão do cabeçalho para usuários não administradores
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
                        <h3>Minhas doações</h3>
                        <h4>Etapa 4: Escolha a Conferência</h4>
                        <form method="post" action="templo_doacao.php">
                            <table>
                                <tr>
                                    <td>
                                        <?php
                                        //Consulta tabelas conferencias e regioes
                                        $consulta_conferencia = "SELECT * FROM Conferencias, Regioes WHERE Regioes_id_regiao = id_regiao AND id_regiao = '$id_regiao'";
                                        $resultado_consulta_conferencia = mysql_query($consulta_conferencia);
                                        ?>
                                        <select name="id_conferencia">
                                            <?php
                                            //Enquanto houver registros mostrar dados abaixo
                                            while ($registros_resultado_consulta_conferencia = mysql_fetch_array($resultado_consulta_conferencia)){
                                            ?>
                                            <option value="<?php echo $registros_resultado_consulta_conferencia['id_conferencia']?>">
                                                <?php echo $registros_resultado_consulta_conferencia['id_conferencia']." | ".$registros_resultado_consulta_conferencia['nome_conferencia']; ?>
                                            </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <!--Campos ocultos somente para passagem de parâmetros-->
                                    <td><input type="hidden" name="id_conta" value="<?php echo $id_conta ?>"></td>
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
                                <td>Conferência:</td><td>Aguardando escolha</td>
                            </tr>
                            <tr>
                                <td>Templo:</td><td>Ainda não informado</td>
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
