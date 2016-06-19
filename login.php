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
        <?php
        //caso esteja na página login $pg_login recebe verdadeiro
        $pg_login = TRUE;
        include './inc/cabecalho_externo.php';
        ?>
        <div class="content_wrapper">
            <div class="container_12">
                <div class="grid_9">
                    <div class="content">
                        <div class="quadro">
                            <form method="post" action="valida.php">
                                <table>
                                    <tr>
                                        <td>Usuário</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" name="usuario" size="24" maxlength="50" required></td>
                                    </tr>
                                    <tr>
                                        <td>Senha</td>
                                    </tr>
                                    <tr>
                                        <td><input type="password" name="senha" size="24" maxlength="50" required></td>
                                    </tr>
                                    <tr>
                                        <td><input type="submit" value="Entrar"></td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
