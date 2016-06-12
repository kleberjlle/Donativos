<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//Recebe dados do usuário via GET
$id_usuario = $_GET['id_usuario'];

//Consulta na tabela usuarios se o ID recebido existe
$consulta_usuario = "SELECT * FROM Usuarios WHERE id_usuario = '$id_usuario'";
$resultado_consulta_usuario = mysql_query($consulta_usuario);
$registros_resultado_consulta_usuario = mysql_fetch_array($resultado_consulta_usuario);
        
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
                        <h3>Escolha a conta que deseja alterar</h3>
                        <form method="POST" action="processamento/alterar_dados_usuarios.php">
                            <table>
                                <tr>
                                    <td>ID</td>
                                    <td>Nome</td>
                                    <td>Sobrenome</td>
                                    <td>CPF</td>
                                    <td>Usuário</td>
                                    <td>Senha</td>
                                    <td>Administrador</td>
                                    <td>Remover usuário</td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="id_usuario" value="<?php echo $registros_resultado_consulta_usuario['id_usuario'] ?>" size="2" readonly></td>
                                    <td><input type="text" name="nome" value="<?php echo $registros_resultado_consulta_usuario['nome'] ?>" size="15" readonly=""></td>
                                    <td><input type="text" name="sobrenome" value="<?php echo $registros_resultado_consulta_usuario['sobrenome'] ?>" readonly=""></td>
                                    <td><input type="number" name="cpf" value="<?php echo $registros_resultado_consulta_usuario['cpf'] ?>" size="5" readonly=""></td>
                                    <td><input type="text" name="usuario" value="<?php echo $registros_resultado_consulta_usuario['usuario'] ?>" size="15" readonly></td>
                                    <td><input type="password" name="senha" value="<?php echo $registros_resultado_consulta_usuario['senha'] ?>" size="15" maxlength="50" required></td>
                                    <td><input type="checkbox" name="administrador" value="<?php echo $registros_resultado_consulta_usuario['administrador'] ?>" <?php if($registros_resultado_consulta_usuario['administrador'] == '1'){ echo "checked"; } ?>></td>
                                    <td><input type="submit" value="Alterar dados"</td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>