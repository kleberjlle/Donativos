<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//inclui menu
include './inc/menu_relatorios.php';

//consulta as tabelas igrejas, fundos, doacoes_para_fundos
$consulta_templos = "SELECT *, SUM(valor_recebido) AS total FROM Conferencias, Igrejas, Fundos WHERE id_conferencia = Conferencias_id_conferencia AND id_igreja = Igrejas_id_igreja AND valor_recebido > '0' GROUP BY id_igreja ORDER BY total DESC";
$resultado_consulta_templos = mysql_query($consulta_templos);
//armazena quantidade de registros
$qtde_registros_resultado_consulta_templos = mysql_num_rows($resultado_consulta_templos);
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
                        <h3>Templos</h3>
                        <?php
                        //se quantidade de registros for maior que 0
                        if($qtde_registros_resultado_consulta_templos > 0){ ?>
                        <table>
                            <tr>
                                <td><a href="#"><img id="ico" src="images/ico_imprimir.png" onclick="window.print()" /></a></td><td><a href="processamento/gerar_relatorio_pdf.php?relatorio=templos"><img id="ico" src="images/ico_pdf.png" /></a></td>
                            </tr>
                        </table>
                        <table>
                            <tr>
                                <td>Nome do Templo</td><td>Total arrecadado</td>
                            </tr>
                            <tr>
                                <td><hr /></td><td><hr /></td>
                            </tr>
                            <?php 
                            //Enquanto houver registros mostrar dados abaixo
                            while ($registros_resultado_consulta_templos = mysql_fetch_array($resultado_consulta_templos)){ ?>
                            <tr>
                                <td><?php echo $registros_resultado_consulta_templos['nome_igreja'] ?></td><td><?php echo 'R$ ' . number_format($registros_resultado_consulta_templos['total'], 2, ',', '.') ?></td>
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