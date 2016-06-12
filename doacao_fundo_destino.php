<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//Recebe dados via GET
$id_doacao  = $_GET['id_doacao'];
$id_fundo   = $_GET['id_fundo'];

//Consulta
$consulta_fundo = "SELECT * FROM Doacoes_para_Fundos, Fundos, Igrejas, Conferencias, Regioes, Doacoes WHERE id_doacao = Doacoes_id_doacao AND id_regiao = Regioes_id_regiao AND id_conferencia = Conferencias_id_conferencia AND id_igreja = Igrejas_id_igreja AND valor_recebido > '0' AND id_fundo = '$id_fundo'";
$resultado_consulta_fundo = mysql_query($consulta_fundo);
$registros_resultado_consulta_fundo = mysql_fetch_array($resultado_consulta_fundo);

//recebe negativa do valor de transferência
$status = isset($_GET['status']);
if($status == 'error'){
    ?>
    <script type="text/javascript">
        var valor = "<?php echo 'R$ ' . number_format($registros_resultado_consulta_fundo['valor_recebido'], 2, ',', '.'); ?>";
        alert("Ops! Para realizar esta transação você deve transferir no mínimo R$ 0,01 ou no máximo "+valor+". Tente novamente!");        
    </script>
    <?php
}

//Inclui cabeçalho
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
        <script type="text/javascript" src="js/jquery.js" ></script>
        <script type="text/javascript" src="js/jquery.maskMoney.js" ></script>
        <script type="text/javascript">
            $(document).ready(function(){
                  $("input.dinheiro").maskMoney({showSymbol:true, symbol:"R$ ", decimal:",", thousands:"."});
            });
        </script>
    </head>
    <body>
        <div class="content_wrapper">
            <div class="container_12">
                <div class="grid_9">
                    <div class="content">
                        <h3><?php echo "Olá, " . $_SESSION['usuarioNome']; ?></h3>
                        <h3>Movimentar Fundos</h3>    
                        <h4>Fundo de origem</h4>
                        <form method="POST" action="processamento/transferir_fundo.php">
                            <table>
                                <tr>
                                    <td>ID</td><td><input type="text" name="id_fundo_origem" value="<?php echo $registros_resultado_consulta_fundo['id_fundo'] ?>" size="40" readonly></td>
                                </tr>
                                <tr>
                                    <td>Estado</td><td><input type="text" name="estado" value="<?php echo $registros_resultado_consulta_fundo['nome_regiao'] ?>" size="40" readonly></td>
                                </tr>
                                <tr>
                                    <td>Conferência</td><td><input type="text" name="conferencia" value="<?php echo $registros_resultado_consulta_fundo['nome_conferencia'] ?>" size="40" readonly></td>
                                </tr>
                                <tr>
                                    <td>Templo</td><td><input type="text" name="igreja" value="<?php echo $registros_resultado_consulta_fundo['nome_igreja'] ?>" size="40" readonly></td>
                                </tr>
                                <tr>
                                    <td>Fundo de origem</td><td><input type="text" name="fundo" value="<?php echo $registros_resultado_consulta_fundo['nome_fundo'] ?>" size="40" readonly></td>
                                </tr>
                                <tr>
                                    <td>Valor disponível no Fundo</td><td><input type="text" name="" value="<?php echo 'R$ ' . number_format($registros_resultado_consulta_fundo['valor_recebido'], 2, ',', '.'); ?>" size="40" readonly></td>
                                </tr>
                                <tr>
                                    <td><input type="hidden" name="id_doacao" value="<?php echo $id_doacao ?>"></td>
                                    <td><input type="hidden" name="valor_recebido" value="<?php echo $registros_resultado_consulta_fundo['valor_recebido']; ?>"></td>  
                                </tr>  
                                <tr>
                                    <td></td><td></td>
                                </tr>
                                <tr>
                                    <td></td><td></td>
                                </tr>
                                <tr>
                                    <td>Fundo de destino</td>
                                    <td>
                                        <select name="id_fundo_destino">
                                            <?php
                                            //Consulta para listar os fundos exceto o fundo transferidor
                                            $consulta_fundos = "SELECT * FROM Fundos WHERE id_fundo != '$id_fundo'";
                                            $resultado_consulta_fundos = mysql_query($consulta_fundos);

                                            //Enquanto houver registros mostrar dados abaixo
                                            while ($registros_resultado_consulta_fundos = mysql_fetch_array($resultado_consulta_fundos)){
                                            ?>
                                            <option value="<?php echo $registros_resultado_consulta_fundos['id_fundo'] ?>"><?php echo $registros_resultado_consulta_fundos['nome_fundo'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Valor a transferir</td>
                                    <!--Validação para não permitir inserção de valor meno que 0 e maior que o valor disponível para transferencia-->
                                    <td><input class="dinheiro" type="text" name="valor_transferir" maxlength="20" size="40" required></td>
                                    
                                </tr>
                                <tr>
                                    <td>
                                        <input type="submit" value="Transferir"> <input type="button" value="Voltar" onClick="history.go(-1)">
                                    </td>
                                </tr>
                            </table>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>