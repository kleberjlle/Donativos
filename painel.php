<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//Inclui cabeçalho para não administradores
include './inc/cabecalho_painel.php';
?>
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
                        <?php
                        echo '<h3></h3><h4>Seja Bem vindo ao Sistema de Donativos!</h4>';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>