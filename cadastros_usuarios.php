<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//Consulta dados da tabela usuarios e retorna todos exceto o do usuario atual
$consulta_usuario = "SELECT * FROM Usuarios WHERE '".$_SESSION['usuarioID']."' != id_usuario";
$resultado_consulta_usuario = mysql_query($consulta_usuario);

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
                        <h3>Cadastrar usuário</h3>
                        <form method="POST" action="processamento/cadastrar_usuarios.php">
                            <table>
                                <tr>
                                    <td>Nome</td>
                                    <td>Sobrenome</td>
                                    <td>CPF</td>
                                    <td>Usuário</td>
                                    <td>Senha</td>
                                    <td>Administrador</td>
                                </tr>
                                <tr>
                                    <td><input type="text" name="nome" size="15" maxlength="60" required></td>
                                    <td><input type="text" name="sobrenome" size="20" maxlength="100"></td>
                                    <td><input type="number" name="cpf" size="5" maxlength="10" required></td>
                                    <td><input type="text" name="usuario" size="15" maxlength="50" required></td>
                                    <td><input type="password" name="senha" size="15" maxlength="50" required></td>
                                    <td><input type="checkbox" name="administrador"></td>
                                    <td><input type="submit" value="Cadastrar"></td>
                                </tr>
                            </table>
                        </form>
                        <h3></h3>
                        <h3>Escolha a conta que deseja alterar</h3>
                        <form method="POST" action="processamento/alterar_usuario.php">
                            <table>
                                <tr>
                                    <td>ID</td>
                                    <td>Nome</td>
                                    <td>Sobrenome</td>
                                    <td>CPF</td>
                                    <td>Usuário</td>
                                    <td>Senha</td>
                                    <td>Administrador</td>
                                    <td>Alterar</td>
                                </tr>
                                <?php
                                //Enquanto houver registros mostrar dados abaixo
                                while ($registros_resultado_consulta_usuario = mysql_fetch_array($resultado_consulta_usuario)){
                                ?>
                                <tr>
                                    <td><input type="text" name="id_usuario" value="<?php echo $registros_resultado_consulta_usuario['id_usuario'] ?>" size="2" readonly></td>
                                    <td><input type="text" name="nome" value="<?php echo $registros_resultado_consulta_usuario['nome'] ?>" size="15" readonly=""></td>
                                    <td><input type="text" name="sobrenome" value="<?php echo $registros_resultado_consulta_usuario['sobrenome'] ?>" readonly=""></td>
                                    <td><input type="number" name="cpf" value="<?php echo $registros_resultado_consulta_usuario['cpf'] ?>" size="5" readonly=""></td>
                                    <td><input type="text" name="usuario" value="<?php echo $registros_resultado_consulta_usuario['usuario'] ?>" size="15" readonly></td>
                                    <td><input type="password" name="senha" value="<?php echo $registros_resultado_consulta_usuario['senha'] ?>" size="15" readonly></td>
                                    <td><input type="checkbox" name="administrador" value="<?php echo $registros_resultado_consulta_usuario['administrador'] ?>" <?php if($registros_resultado_consulta_usuario['administrador'] == '1'){ echo "checked"; } ?> disabled></td>
                                    <td><a href="alterar_usuario.php?id_usuario=<?php echo $registros_resultado_consulta_usuario['id_usuario'] ?>">Alterar</a></td>
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