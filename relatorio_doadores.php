<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//Inclui menu
include './inc/menu_relatorios.php';

//Consulta dados nas tabelas doacoes, contas, usuarios
$consulta_usuarios = "SELECT *, SUM(valor_doado) AS total FROM Doacoes, Contas, Usuarios WHERE id_usuario = Usuarios_id_usuario AND id_conta = Contas_id_conta GROUP BY nome ORDER BY total DESC";
$resultado_consulta_usuarios = mysql_query($consulta_usuarios);
//Armazena a quantidade de registros
$qtde_registros_resultado_consulta_usuarios = mysql_num_rows($resultado_consulta_usuarios);
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Donativos</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="content_wrapper">
            <div class="container_12">
                <div class="grid_9">
                    <div class="content">
                        <h3><?php echo "Olá, " . $_SESSION['usuarioNome']; ?></h3>
                        <h3>Doadores</h3>
                        <?php
                        //se a quantidade de registros for maior que zero
                        if($qtde_registros_resultado_consulta_usuarios > 0){ ?>
                        <table>
                            <tr>
                                <td><input type="button" onclick="window.print()" value="Imprimir"  /></td>
                            </tr>
                            <tr>
                                <td>Nome do doador</td><td>Total arrecado</td>
                            </tr>
                            <tr>
                                <td><hr /></td><td><hr /></td>
                            </tr>
                            <?php
                            //Enquanto houver registros mostrar dados abaixo
                            while ($registros_resultado_consulta_usuarios = mysql_fetch_array($resultado_consulta_usuarios)){ ?>
                            <tr>
                                <td><?php echo $registros_resultado_consulta_usuarios['nome'] ?> <?php echo $registros_resultado_consulta_usuarios['sobrenome'] ?></td>
                                <td><?php echo 'R$ ' . number_format($registros_resultado_consulta_usuarios['total'], 2, ',', '.') ?></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                        <?php
                        //se quantidade de registros for menor que zero
                        }else{
                            echo '<h3></h3><h4>Ainda não tivemos nenhuma doação.</h4>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>