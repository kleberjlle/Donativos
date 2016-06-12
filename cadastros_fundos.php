<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

/*Verifica se a variável está em branco
 * Caso sim recebe isset, para não mostrar erro
 * Caso não recebe a ID passada via GET do retorno do cadastro
 */
if($id_igreja = empty($_GET['id_igreja'])){
    $id_igreja = isset($_GET['id_igreja']);
}else{
    $id_igreja = $_GET['id_igreja'];
}

//Consulta nas tabelas conferencias, regioes e igrejas
$consulta_igreja = "SELECT * FROM Conferencias, Regioes, Igrejas WHERE Conferencias_id_conferencia = id_conferencia AND Regioes_id_regiao = id_regiao AND id_igreja = '$id_igreja'";
$resultado_consulta_igreja = mysql_query($consulta_igreja);
//Armazena quantidade de registros encontrados na consulta
$registros_resultado_consulta_igreja = mysql_fetch_array($resultado_consulta_igreja);

//Inclui cabeçalho para usuários administradores
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
                        <h3><?php echo "Olá, " . $_SESSION['usuarioNome']; ?></h3>
                        <h3>Cadastrar Templo</h3>
                        <h4>Etapa 4: Selecione/ Cadastre um Fundo</h4>
                        <form method="post" action="processamento/cadastrar_fundo.php">
                            <table>
                                <tr>
                                    <td>Estado</td>
                                    <td>Conferência</td>
                                    <td>Templo</td>
                                    <td>Cadastrar Fundo</td>
                                </tr>
                                <tr>
                                    <input type="hidden" name="id_igreja" value="<?php echo $registros_resultado_consulta_igreja['id_igreja']?>" size="2" readonly>
                                    <td><input type="text" name="nome_regiao" value="<?php echo $registros_resultado_consulta_igreja['nome_regiao']?>" size="2" readonly></td>
                                    <td><input type="text" name="nome_conferencia" value="<?php echo $registros_resultado_consulta_igreja['nome_conferencia']?>" size="30" readonly></td>
                                    <td><input type="text" name="nome_igreja" value="<?php echo $registros_resultado_consulta_igreja['nome_igreja']?>" size="30" maxlength="80" readonly></td>
                                    <td><input type="text" name="nome_fundo" size="30" required></td>
                                    <td><input type="submit" value="Cadastrar"></td>
                                    <td><input type="button" value="Voltar" onClick="history.go(-1)"></td>
                                </tr>
                            </table>
                        </form>
                        <?php
                        //Consulta dados nas tabelas regioes, conferencias, igrejas e fundos
                        $consulta_fundo = "SELECT * FROM Regioes, Conferencias, Igrejas, Fundos WHERE Regioes_id_regiao = id_regiao AND Conferencias_id_conferencia = id_conferencia AND Igrejas_id_igreja = id_igreja AND id_igreja = '$id_igreja'";
                        $resultado_consulta_fundo = mysql_query($consulta_fundo);
                        //Armazena quantidade de registros encontrados na consulta
                        $qtde_resultado_consulta_fundo = mysql_num_rows($resultado_consulta_fundo);

                        //Verifica se possui mais de 0 registros
                        if($qtde_resultado_consulta_fundo > 0){
                        ?>
                        <h3></h3>
                        <h3>Fundos Cadastrados</h3>
                        <form method="get">
                            <table>
                                <tr>
                                    <td>ID</td>
                                    <td>Estado</td>
                                    <td>Conferência</td>
                                    <td>Templo</td>
                                    <td>Fundo</td>        
                                </tr>
                                <?php
                                //Consulta dados nas tabelas regioes, conferencias, igrejas e fundos
                                $consulta_fundo = "SELECT * FROM Regioes, Conferencias, Igrejas, Fundos WHERE Regioes_id_regiao = id_regiao AND Conferencias_id_conferencia = id_conferencia AND Igrejas_id_igreja = id_igreja AND id_igreja = '$id_igreja'";
                                $resultado_consulta_fundo = mysql_query($consulta_fundo);

                                //Enquanto houver registros na consulta_fundo mostrar os dados abaixo
                                while ($registros_resultado_consulta_fundo = mysql_fetch_array($resultado_consulta_fundo)){ 
                                ?>
                                <tr>
                                    <td><input type="text" name="id_fundo" value="<?php echo $registros_resultado_consulta_fundo['id_fundo']?>" size="2" readonly></td>
                                    <td><input type="text" name="nome_regiao" value="<?php echo $registros_resultado_consulta_fundo['nome_regiao']?>" size="2" readonly></td>
                                    <td><input type="text" name="nome_conferencia" value="<?php echo $registros_resultado_consulta_fundo['nome_conferencia'] ?>" size="40" readonly></td>
                                    <td><input type="text" name="nome_igreja" value="<?php echo $registros_resultado_consulta_fundo['nome_igreja'] ?>" size="30" readonly></td>
                                    <td><input type="text" name="nome_fundo" value="<?php echo $registros_resultado_consulta_fundo['nome_fundo']?>" size="40" readonly></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </form>
                        <?php
                        //Caso a tabela não tenha nenhum registro
                        }else{
                            echo '<h3></h3><h4>Este Templo não possui nenhum Fundo cadastrado.</h4>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>