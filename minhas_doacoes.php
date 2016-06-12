<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//Consulta dados das tabelas bancos, contas e usuarios 
$consulta_conta = "SELECT * FROM Bancos, Contas, Usuarios WHERE '".$_SESSION['usuarioID']."' = id_usuario AND Bancos_id_banco = id_banco AND Usuarios_id_usuario = id_usuario";
$resultado_consulta_conta = mysql_query($consulta_conta);
//armazena a quantidade de registros
$qtde_registros_resultado_consulta_conta = mysql_num_rows($resultado_consulta_conta);

//consulta dados das tabelas doacoes, contas e bancos e agrupe pela ID da conta
$consulta_doacao = "SELECT * FROM Doacoes, Contas, Bancos WHERE '".$_SESSION['usuarioID']."' = Usuarios_id_usuario AND Bancos_id_banco = id_banco AND Contas_id_conta = id_conta ORDER BY data_doacao DESC";
$resultado_consulta_doacao = mysql_query($consulta_doacao);
//armazena a quantidade de registros
$qtde_registros_resultado_consulta_doacao = mysql_num_rows($resultado_consulta_doacao);

//verifica se é usuário administrador
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
        <div class="content_wrapper"><div class="ic">More Website Templates @ Itapoá Info - September 23, 2013!</div>
            <div class="container_12">
                <div class="grid_9">
                    <div class="content">
                        <?php
                        //Verifica de a quantidade de registros é maior que 0
                        if($qtde_registros_resultado_consulta_conta > 0){
                        ?>
                        <h3><?php echo "Olá, " . $_SESSION['usuarioNome']; ?></h3>
                        <h3>Minhas doações</h3>
                        <h4>Etapa 1: Escolha de qual conta deseja doar.</h4>
                        <form method="post" action="valor_doacao.php">
                            <table>
                                <tr>
                                    <td>
                                        <select name="id_conta">
                                            <?php
                                            //Enquanto houver registros mostrar os dados abaixo
                                            while ($registros_resultado_consulta_conta = mysql_fetch_array($resultado_consulta_conta)){
                                            ?>
                                            <option value="<?php echo $registros_resultado_consulta_conta['id_conta']?>">
                                                <?php
                                                echo $registros_resultado_consulta_conta['id_conta'].
                                                " | ".$registros_resultado_consulta_conta['banco'].
                                                " | ".$registros_resultado_consulta_conta['agencia'].
                                                " | ".$registros_resultado_consulta_conta['conta'];
                                                ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td><input type="submit" value="Próxima"></td>
                                </tr> 
                            </table>
                        </form>
                        <?php 
                        }
                        else{
                            echo '<h3></h3><h4>Você não possui conta bancária cadastrada!</h4>';
                        }
                        //Verfica se a quantidade de registros eh maior que 0
                        if($qtde_registros_resultado_consulta_doacao > 0){
                        ?>
                        <h3></h3>
                        <h3>Total doado</h3>
                        <form>
                            <table>
                                <tr>
                                    <td>Data da Doação</td>
                                    <td>Banco</td>
                                    <td>Agência</td>
                                    <td>Conta</td>
                                    <td>Total doado</td>
                                </tr>
                                <?php
                                //Enquanto houver registros mostrar dado abaixo
                                while ($registros_resultado_consulta_doacao = mysql_fetch_array($resultado_consulta_doacao)){
                                ?>
                                <tr>
                                    <td><input type="text" name="data_doacao" value="<?php echo date('d/m/Y H:i:s', strtotime($registros_resultado_consulta_doacao['data_doacao'])); ?>" size="15" readonly></td>
                                    <td><input type="text" name="banco" value="<?php echo $registros_resultado_consulta_doacao['banco'] ?>" size="20" readonly></td>
                                    <td><input type="text" name="agencia" value="<?php echo $registros_resultado_consulta_doacao['agencia'] ?>" size="20" maxlength="7" readonly></td>
                                    <td><input type="text" name="conta" value="<?php echo $registros_resultado_consulta_doacao['conta'] ?>" size="20" readonly></td>
                                    <td><input type="text" name="valor_doado" value="<?php echo 'R$ ' . number_format($registros_resultado_consulta_doacao['valor_doado'], 2, ',', '.') ?>" size="15" readonly></td>
                                    
                                </tr>
                                <?php
                                } 
                                ?>
                            </table>
                        </form>
                        <?php
                        //Se quantidade de registros for menor ou igual a 0
                        }else if($qtde_registros_resultado_consulta_conta > 0 AND $qtde_registros_resultado_consulta_doacao <= 0){
                            echo '<h3></h3><h4>Você ainda não realizou doações!</h4>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
