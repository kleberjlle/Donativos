<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//Inclui menu
include './inc/menu_relatorios.php';

//Consulta dados nas tabelas doacoes, contas e bancos
$consulta_bancos = "SELECT *, SUM(valor_doado) AS total FROM Doacoes, Contas, Bancos WHERE id_banco = Bancos_id_banco AND id_conta = Contas_id_conta GROUP BY id_banco ORDER BY total DESC";
$resultado_consulta_bancos = mysql_query($consulta_bancos);
//armazena a quantidade de registros
$qtde_registros_resultado_consulta_bancos = mysql_num_rows($resultado_consulta_bancos);
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
                        <h3>Bancos</h3>
                        <?php
                        //verifica se a quantidade de registros é maior que 0
                        if($qtde_registros_resultado_consulta_bancos > 0){ ?>
                        <table>
                            <tr>
                                <td><input type="button" onclick="window.print()" value="Imprimir"  /></td>
                            </tr>
                            <tr>
                                <td>Nome do banco</td><td>Total arrecadado</td>
                            </tr>
                            <tr>
                                <td><hr /></td><td><hr /></td>       
                            </tr>
                            <?php
                            //Enquanto houver registros mostrar dados abaixo
                            while ($registros_resultado_consulta_bancos = mysql_fetch_array($resultado_consulta_bancos)){
                            ?>
                            <tr>
                                <td><?php echo $registros_resultado_consulta_bancos['banco'] ?></td><td><?php echo 'R$ ' . number_format($registros_resultado_consulta_bancos['total'], 2, ',', '.') ?></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                        <?php
                        //se a quantidade de registros for menor que 0
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