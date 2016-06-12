<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//Inclui menu
include './inc/menu_relatorios.php';

//Consulta dados nas tabelas igrejas, fundos, doacoes_para_fundos, doacoes, conferencias
$consulta_conferencias = "SELECT *, SUM(valor_recebido) AS total FROM Conferencias, Fundos, Igrejas WHERE id_conferencia = Conferencias_id_conferencia AND id_igreja = Igrejas_id_igreja AND valor_recebido > '0' GROUP BY id_conferencia ORDER BY total DESC";
$resultado_consulta_conferencias = mysql_query($consulta_conferencias);
//armazena a quantidade de registros
$qtde_registros_resultado_consulta_conferencias = mysql_num_rows($resultado_consulta_conferencias);
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
                        <h3>Conferências</h3>
                        <?php 
                        //Verfica se a quantidade de registros é maior que 0
                        if($qtde_registros_resultado_consulta_conferencias > 0){ ?>
                        <table>
                            <tr>
                                <td><input type="button" onclick="window.print()" value="Imprimir"  /></td>
                            </tr>
                            <tr>
                                <td>Nome da Conferência</td><td>Total arrecadado</td>
                            </tr>
                            <tr>
                                <td><hr /></td><td><hr /></td>
                            </tr>

                            <?php 
                            //Enquanto houver registros mostrar dados abaixo
                            while ($registros_resultado_consulta_conferencias = mysql_fetch_array($resultado_consulta_conferencias)){ ?>
                            <tr>
                                <td><?php echo $registros_resultado_consulta_conferencias['nome_conferencia'] ?></td><td><?php echo 'R$ ' . number_format($registros_resultado_consulta_conferencias['total'], 2, ',', '.') ?></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </table>
                        <?php
                        //se quantidade de registros for menor que zero
                        }else{
                            echo '<h3></h3<h4>Ainda não tivemos nenhuma doação.</h4>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>