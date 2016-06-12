<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//Dados recebidos via POST
$valor_doado    = $_POST['valor_doado'];
$id_conta       = $_POST['id_conta'];

//Consulta dados nas tabelas bancos e contas
$consulta_conta = "SELECT * FROM Bancos, Contas WHERE Bancos_id_banco = id_banco AND id_conta = '$id_conta'";
$resultado_consulta_conta = mysql_query($consulta_conta);
$registros_resultado_consulta_conta = mysql_fetch_array($resultado_consulta_conta);

//Verifica se o usuario é administrador
if($_SESSION['usuarioAdministrador'] == '1'){
    //Inclui subcabeçalho administrador
    include './inc/cabecalho_sub_painel_admin.php';
}else{
    //Inclui cabeçalho para usuários
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
                        <h4>Etapa 3: Escolha o Estado</h4>
                        <form method="post" action="conferencia_doacao.php">
                            <table>
                                <tr>
                                    <td>
                                        <?php
                                        //Consulta dados nas tabelas conferencias e regioes e agrupe pela ID da regiao
                                        $consulta_regiao = "SELECT * FROM Conferencias, Regioes WHERE Regioes_id_regiao = id_regiao GROUP BY id_regiao";
                                        $resultado_consulta_regiao = mysql_query($consulta_regiao);
                                        ?>
                                        <select name="id_regiao">
                                            <?php
                                            //Enquanto houver registros mostrar dados abaixo
                                            while ($registros_resultado_consulta_regiao = mysql_fetch_array($resultado_consulta_regiao)){ ?>
                                            <option value="<?php echo $registros_resultado_consulta_regiao['id_regiao']?>">
                                                <?php echo $registros_resultado_consulta_regiao['id_regiao']." | ".$registros_resultado_consulta_regiao['nome_regiao']; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <!--Campos ocultos para passagem de parâmetro-->
                                    <td><input type="hidden" name="id_conta" value="<?php echo $id_conta ?>"></td>
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
                                <!--Validação para moeda Brasil-->
                                <td>Valor:</td><td><?php echo $valor_doado ?></td>
                            </tr>
                            <tr>
                                <td>Estado:</td><td>Aguardando escolha</td>
                            </tr>
                            <tr>
                                <td>Conferência:</td><td>Ainda não informado</td>
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
