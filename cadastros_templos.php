<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

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
    </head>
    <body>
        <div class="content_wrapper">
            <div class="container_12">
                <div class="grid_9">
                    <div class="content">
                        <h3><?php echo "Olá, " . $_SESSION['usuarioNome']; ?></h3>
                        <h3>Cadastrar Templo</h3>
                        <h4>Etapa 1: Selecione/ Cadastre o Estado</h4>
                        <form method="post" action="processamento/cadastrar_estado.php">
                            <table>
                                <tr>
                                    <td>Cadastrar Estado (abrev.)</td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="nome_regiao" size="2" maxlength="2" required></td>
                                    <td><input type="submit" value="Cadastrar"></td>
                                </tr>
                            </table>
                        </form>
                        <h3></h3>
                        <h3>Selecione o Estado</h3>
                        <form>
                            <table>
                                <tr>
                                    <td>ID</td>
                                    <td>Estado</td>
                                    <td>Selecionar</td>
                                </tr>
                                <?php
                                //Consulta dados da tabela regioes e ordene pela ID
                                $consulta_regiao = "SELECT * FROM Regioes ORDER BY id_regiao";
                                $resultado_consulta_regiao = mysql_query($consulta_regiao);

                                //Enquanto houver registros mostrar dados abaixo
                                while ($registros_resultado_consulta_regiao = mysql_fetch_array($resultado_consulta_regiao)){
                                ?>
                                <tr>
                                    <td><input type="text" name="id_regiao" value="<?php echo $registros_resultado_consulta_regiao['id_regiao'] ?>" size="2" readonly></td>
                                    <td><input type="text" name="nome_regiao" value="<?php echo $registros_resultado_consulta_regiao['nome_regiao'] ?>" size="2" readonly></td>
                                    <td><a href="cadastros_conferencias.php?id_regiao=<?php echo $registros_resultado_consulta_regiao['id_regiao'] ?>">Selecionar</a></td>
                                </tr>
                                <?php } ?>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>