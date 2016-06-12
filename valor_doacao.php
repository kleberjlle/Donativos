<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//recebe dados via POST
$id_conta = $_POST['id_conta'];

//consulta dados das tabelas bancos, contas
$consulta_conta = "SELECT * FROM Bancos, Contas WHERE Bancos_id_banco = id_banco AND id_conta = '$id_conta'";
$resultado_consulta_conta = mysql_query($consulta_conta);
$registros_resultado_consulta_conta = mysql_fetch_array($resultado_consulta_conta);

//verifica se o usuário eh administrador
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
        <script type="text/javascript" src="js/jquery.js" ></script>
        <script type="text/javascript" src="js/jquery.maskMoney.js" ></script>
        <script type="text/javascript">
            $(document).ready(function(){
                  $("input.dinheiro").maskMoney({showSymbol:true, symbol:"R$ ", decimal:",", thousands:"."});
            });
        </script>
    </head>
    <body>
        <div class="content_wrapper">
            <div class="container_12">
                <div class="grid_9">
                    <div class="content">
                        <h3><?php echo "Olá, " . $_SESSION['usuarioNome']; ?></h3>
                        <h3>Minhas doações</h3>
                        <h4>Etapa 2: Insira o valor a ser doado</h4>
                        <form method="post" action="estado_doacao.php">
                            <table>
                                <tr>
                                    <!--campo oculto somente para passagem de parametro-->
                                    <td><input type="hidden" name="id_conta" value="<?php echo $id_conta ?>"></td>
                                    <td><input class="dinheiro" type="text" name="valor_doado" size="20" maxlength="20" required></td>
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
                                <td>Valor:</td><td>Aguardando inserção</td>
                            </tr>
                            <tr>
                                <td>Estado:</td><td>Ainda não informado</td>
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
