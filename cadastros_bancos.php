<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//Consulta dados da tabela bancos
$consulta_banco = "SELECT * FROM Bancos ORDER BY id_banco";
$resultado_consulta_banco = mysql_query($consulta_banco);

//Inclui cabeçalho para usuarios administradores
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
    </head>
    <body>
        <div class="content_wrapper">
            <div class="container_12">
                <div class="grid_9">
                    <div class="content">
                        <h3><?php echo "Olá, " . $_SESSION['usuarioNome']; ?></h3>
                        <h3>Cadastrar banco</h3>
                        <form method="post" action="processamento/cadastrar_banco.php">
                            <table>
                                <tr>
                                    <td>Banco</td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="banco" size="28" required></td>
                                </tr>
                                <tr>
                                    <td><input type="submit" value="Cadastrar banco"></td>
                                </tr>
                            </table>
                        </form>
                        <h3></h3>
                        <h3>Bancos cadastrados</h3>
                        <form>
                            <table>
                                <tr>
                                    <td>ID</td>
                                    <td>Banco</td>
                                </tr>
                                <!--Enquanto houver registros no BD mostrar os campos id_banco e banco-->
                                <?php while ($registros_resultado_consulta_banco = mysql_fetch_array($resultado_consulta_banco)){ ?>
                                <tr>
                                    <td><input type="text" name="id_banco" value="<?php echo $registros_resultado_consulta_banco['id_banco'] ?>" size="2" readonly></td>
                                    <td><input type="text" name="banco" value="<?php echo $registros_resultado_consulta_banco['banco'] ?>" size="20" readonly></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>