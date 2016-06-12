<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//inclui cabeçalho
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
                    <h3><?php echo "Olá, " . $_SESSION['usuarioNome']; ?></h3>
                    <div class="content"><h4>Transferência realizada com sucesso!</h4>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>