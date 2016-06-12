<?php
//realiza consulta na tabela bancos
$consulta_bancos = "SELECT * FROM Bancos";
$resultado_consulta_bancos = mysql_query($consulta_bancos);
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Donativos</title>
        <link rel="stylesheet" href="./css/style.css">
        <script type="text/javascript" src="./js/jquery.js" ></script>
        <script type="text/javascript" src="./js/jquery.mask.js" ></script>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                    $("#data").mask("99/99/9999");    // Máscara para DATA
                    $('#agencia').mask('9.999-9');    // Máscara para AGÊNCIA BANCÁRIA
                    $('#conta').mask('99.999-9');    // Máscara para CONTA BANCÁRIA
            }); 
        </script>
    </head>
    <body>
        <div class="content_wrapper">
            <div class="container_12">
                <div class="grid_9">
                    <div class="content">
                        <h3><?php echo "Olá, " . $_SESSION['usuarioNome']; ?></h3>
                        <h3>Cadastrar conta</h3>
                        <form method="post" action="./processamento/cadastrar_conta_bancaria.php">
                            <table>
                                <tr>
                                    <td>Banco</td>
                                    <td>Agência</td>
                                    <td>Conta</td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="id_banco">
                                            <!--Passando dados do banco cadastrado para listbox enquanto houver registros-->
                                            <?php while ($registros_resultado_consulta_bancos = mysql_fetch_array($resultado_consulta_bancos)){ ?>
                                            <option value="<?php echo $registros_resultado_consulta_bancos['id_banco']; ?>">
                                                <?php echo $registros_resultado_consulta_bancos['id_banco']." | ".$registros_resultado_consulta_bancos['banco']; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td><input type="text" id="agencia" name="agencia" size="15" maxlength="15" required></td>
                                    <td><input type="text" id="conta" name="conta" size="20" maxlength="20" required></td>
                                    <td><input type="submit" value="Cadastrar"></td>
                                </tr>
                            </table>
                        </form>
                        <h3></h3>