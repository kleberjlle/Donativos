<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//Consulta tabela usuários
$consulta_usuario = "SELECT * FROM Usuarios WHERE '".$_SESSION['usuarioID']."' = id_usuario";
$resultado_consulta_usuario = mysql_query($consulta_usuario);
$registros_resultado_consulta_usuario = mysql_fetch_array($resultado_consulta_usuario);

//Inclui cabeçalho do usuário sem permissão administrador
include './inc/cabecalho_painel.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Donativos</title>
        <link rel="icon" href="images/favicon.ico">
        <link rel="shortcut icon" href="images/favicon.ico" />
        <link rel="stylesheet" href="css/style.css">
        <script src="js/jquery.js" />
        <script src="js/jquery-migrate-1.1.1.js" />
        <script src="js/superfish.js" />
        <script src="js/bgStretch.js" />
        <script src="js/jquery.equalheights.js" />
        <script src="js/jquery.easing.1.3.js" />
    </head>
    <body>
        <div class="content_wrapper">
            <div class="container_12">
                <div class="grid_9">
                    <div class="content">
                        <h3><?php echo "Olá, " . $_SESSION['usuarioNome']; ?></h3>
                        <h3>Alterar dados</h3>
                        <form method="post" action="processamento/alterar_dados_admin_n.php">
                            <table>
                                <tr>
                                    <td>Nome</td>
                                    <td>Sobrenome</td>
                                    <td>CPF</td>
                                    <td>Usuário</td>
                                    <td>Senha</td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="nome" value="<?php echo $registros_resultado_consulta_usuario['nome'] ?>" size="20" maxlength="60" required></td>
                                    <td><input type="text" name="sobrenome" value="<?php echo $registros_resultado_consulta_usuario['sobrenome'] ?>" size="25" maxlength="100"></td>
                                    <td><input type="number" name="cpf" value="<?php echo $registros_resultado_consulta_usuario['cpf'] ?>" size="5" maxlength="14" required></td>
                                    <td><input type="text" name="usuario" value="<?php echo $registros_resultado_consulta_usuario['usuario'] ?>" size="20" maxlength="60" readonly></td>
                                    <td><input type="password" name="senha" value="<?php echo $registros_resultado_consulta_usuario['senha'] ?>" size="20" maxlength="60" required></td>
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