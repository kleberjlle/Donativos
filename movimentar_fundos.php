<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//Inclui cabeçalho para usuario administradores
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
                        <?php
                        //Consulta dados das tabela doacoes_para_fundos, fundos, igrejas, conferencias, regioes e doacoes e agrupe pela ID do fundo
                        $consulta_fundo = "SELECT * FROM Doacoes_para_Fundos, Fundos, Igrejas, Conferencias, Regioes, Doacoes WHERE id_regiao = Regioes_id_regiao AND id_conferencia = Conferencias_id_conferencia AND id_igreja = Igrejas_id_igreja AND valor_recebido > '0' GROUP BY id_fundo";
                        $resultado_consulta_fundo = mysql_query($consulta_fundo);
                        $qtde_registros_resultado_fundo = mysql_num_rows($resultado_consulta_fundo);
                        ?>
                        <h3><?php echo "Olá, " . $_SESSION['usuarioNome']; ?></h3>
                        <h3>Movimentar Fundos</h3>
                        <?php 
                        //Verifica se quantidade de registros eh maior que 0
                        if($qtde_registros_resultado_fundo > 0){ 
                        ?>
                        <form method="GET">
                            <table>
                                <tr>
                                    <td>ID</td>
                                    <td>Estado</td>
                                    <td>Conferência</td>
                                    <td>Templo</td>
                                    <td>Fundo</td>
                                    <td>Total arrecadado</td>
                                </tr>
                                <?php 
                                //Enquanto houver registros mostrar dados abaixo
                                while ($registros_resultado_consulta_fundo = mysql_fetch_array($resultado_consulta_fundo)){ ?>
                                <tr>
                                    <td><input type="text" name="id_fundo" value="<?php echo $registros_resultado_consulta_fundo['id_fundo'] ?>" size="2" readonly></td>
                                    <td><input type="text" name="estado" value="<?php echo $registros_resultado_consulta_fundo['nome_regiao'] ?>" size="2" readonly></td>
                                    <td><input type="text" name="conferencia" value="<?php echo $registros_resultado_consulta_fundo['nome_conferencia'] ?>" size="30" readonly></td>
                                    <td><input type="text" name="igreja" value="<?php echo $registros_resultado_consulta_fundo['nome_igreja'] ?>" size="30" readonly></td>
                                    <td><input type="text" name="fundo" value="<?php echo $registros_resultado_consulta_fundo['nome_fundo'] ?>" size="40" readonly></td>
                                    <td><input type="text" name="" value="<?php echo 'R$ ' . number_format($registros_resultado_consulta_fundo['valor_recebido'], 2, ',', '.'); ?>" size="15" readonly></td>
                                    <td><a href="doacao_fundo_destino.php?id_fundo=<?php echo $registros_resultado_consulta_fundo['id_fundo'] ?>&id_doacao=<?php echo $registros_resultado_consulta_fundo['id_doacao'] ?>">Transferir</a></td>
                                </tr>
                                <?php } ?>
                            </table>
                        </form>
                        <?php
                        //Se quantidade de registros for menor ou igual a 0
                        }else{
                            echo '<h3></h3><h4>Os Fundos ainda não receberam doações</h4>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>