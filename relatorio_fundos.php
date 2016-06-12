<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//inclui menu
include './inc/menu_relatorios.php';

//consulta dados nas tabelas doacoes_para_fundos, doacoes, fundos
$consulta_fundos = "SELECT * FROM Doacoes_para_Fundos, Doacoes, Fundos WHERE valor_recebido > '0' GROUP BY id_fundo ORDER BY valor_recebido DESC";
$resultado_consulta_fundos = mysql_query($consulta_fundos);
$qtde_registros_resultado_consulta_fundos = mysql_num_rows($resultado_consulta_fundos);
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
                        <h3>Fundos</h3>
                        <?php
                        //se quantidade de registros for maior que zero
                        if($qtde_registros_resultado_consulta_fundos > 0){ ?>
                        <table>
                            <tr>
                                <td><a href="#"><img id="ico" src="images/ico_imprimir.png" onclick="window.print()" /></a></td><td><a href="processamento/gerar_relatorio_pdf.php?relatorio=fundos"><img id="ico" src="images/ico_pdf.png" /></a></td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td>Nome do Fundo</td><td>Total arrecadado</td>
                            </tr>
                            <tr>
                                <td><hr /></td><td><hr /></td>
                            </tr>
                            <?php 
                            //Enquanto houver registros mostrar os dados abaixo
                            while ($registros_resultado_consulta_fundos = mysql_fetch_array($resultado_consulta_fundos)){ ?>
                            <tr>
                                <td><?php echo $registros_resultado_consulta_fundos['nome_fundo'] ?></td><td><?php echo 'R$ ' . number_format($registros_resultado_consulta_fundos['valor_recebido'], 2, ',', '.') ?></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                        <?php
                        //se a quantidade de registros for menor que zero
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