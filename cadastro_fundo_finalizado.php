<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//Recebe dados do fundo
$id_fundo = $_GET['id_fundo'];

//Consulta nas tabelas fundos, conferencias, regioes e igrejas
$consulta_fundo = "SELECT * FROM Fundos, Conferencias, Regioes, Igrejas WHERE Conferencias_id_conferencia = id_conferencia AND Regioes_id_regiao = id_regiao AND Igrejas_id_igreja = id_igreja AND id_fundo = '$id_fundo'";
$resultado_consulta_fundo = mysql_query($consulta_fundo);
$registros_resultado_consulta_fundo = mysql_fetch_array($resultado_consulta_fundo);

//Inclui cabeçalho para usuários administradores
include './inc/cabecalho_painel_admin.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Donativos</title>
        <link rel="icon" href="images/favicon.ico">
        <link rel="shortcut icon" href="images/favicon.ico" />
        <link rel="stylesheet" href="css/style.css">
        <script src="js/jquery.js"></script>
        <script src="js/jquery-migrate-1.1.1.js"></script>
        <script src="js/superfish.js"></script>
        <script src="js/bgStretch.js"></script>
        <script src="js/jquery.equalheights.js"></script>
        <script src="js/jquery.easing.1.3.js"></script>
    </head>
    <body>
        <div class="content_wrapper">
            <div class="container_12">
                <div class="grid_9">
                    <div class="content">
                        <h3><?php echo "Olá, " . $_SESSION['usuarioNome']; ?></h3>
                        <h3>Fundo Cadastrado com sucesso!</h3>
                        <form>
                            <table>
                                <tr>
                                    <td>ID</td>
                                    <td>Estado</td>
                                    <td>Conferência</td>
                                    <td>Templo</td>
                                    <td>Fundo</td>        
                                </tr>
                                <tr>
                                    <td><input type="text" name="id_fundo" value="<?php echo $registros_resultado_consulta_fundo['id_fundo']?>" size="2" readonly></td>
                                    <td><input type="text" name="nome_regiao" value="<?php echo $registros_resultado_consulta_fundo['nome_regiao']?>" size="2" readonly></td>
                                    <td><input type="text" name="nome_conferencia" value="<?php echo $registros_resultado_consulta_fundo['nome_conferencia'] ?>" size="40" readonly></td>
                                    <td><input type="text" name="nome_igreja" value="<?php echo $registros_resultado_consulta_fundo['nome_igreja'] ?>" size="30" readonly></td>
                                    <td><input type="text" name="nome_fundo" value="<?php echo $registros_resultado_consulta_fundo['nome_fundo']?>" size="40" readonly></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>