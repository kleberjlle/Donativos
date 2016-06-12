<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//Incui subcabeçalho para usuário administrador
include './inc/cabecalho_sub_painel_admin.php';
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
                        <H4>Legal saber que nosso administrador também quer doar!</h4>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

