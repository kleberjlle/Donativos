<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//Consulta dados dos usuarios administradores
$consulta_usuario_admin = "SELECT * FROM Usuarios WHERE '".$_SESSION['usuarioID']."' = id_usuario";
$resultado_consulta_usuario_admin = mysql_query($consulta_usuario_admin);
$registros_resultado_consulta_usuario_admin = mysql_fetch_array($resultado_consulta_usuario_admin);

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
                        <h3>Alterar dados do administrador</h3>
                        <form method="post" action="processamento/alterar_dados_admin_s.php">
                            <table>
                                <tr>
                                    <td>Nome</td>
                                    <td>Sobrenome</td>
                                    <td>CPF</td>
                                    <td>Usuário</td>
                                    <td>Senha</td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="nome" value="<?php echo $registros_resultado_consulta_usuario_admin['nome'] ?>" size="20" maxlength="60" required></td>
                                    <td><input type="text" name="sobrenome" value="<?php echo $registros_resultado_consulta_usuario_admin['sobrenome'] ?>" size="20" maxlength="100"></td>
                                    <td><input type="number" name="cpf" value="<?php echo $registros_resultado_consulta_usuario_admin['cpf'] ?>" size="5" maxlength="10" required></td>
                                    <td><input type="text" name="usuario" value="<?php echo $registros_resultado_consulta_usuario_admin['usuario'] ?>" size="20" maxlength="60" readonly></td>
                                    <td><input type="password" name="senha" value="<?php echo $registros_resultado_consulta_usuario_admin['senha'] ?>" size="20" maxlength="50" required></td>
                                    <td><input type="submit" value="Alterar"></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>