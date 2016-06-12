<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

/*Verifica se a variável está em branco
 * Caso sim recebe isset, para não mostrar erro
 * Caso não recebe a ID passada via GET do retorno do cadastro
 */
if($id_conferencia = empty($_GET['id_conferencia'])){
    $id_conferencia = isset($_GET['id_conferencia']);
}else{
    $id_conferencia = $_GET['id_conferencia'];
}

//consulta das tabelas conferencias e regioes
$consulta_conferencia = "SELECT * FROM Conferencias, Regioes WHERE id_conferencia = '$id_conferencia' AND id_regiao = Regioes_id_regiao";
$resultado_consulta_conferencia = mysql_query($consulta_conferencia);
$registros_resultado_consulta_conferencia = mysql_fetch_array($resultado_consulta_conferencia);

//Inclui cabeçalho para usuarios administradores
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
                        <h4>Etapa 3: Selecione/ Cadastre um Templo</h4>
                        <form method="post" action="processamento/cadastrar_igreja.php">
                            <table>
                                <tr>
                                    <td>Estado</td>
                                    <td>Conferência</td>
                                    <td>Cadastrar Templo</td>
                                </tr>
                                <tr>
                                    <input type="hidden" name="id_conferencia" value="<?php echo $registros_resultado_consulta_conferencia['id_conferencia']?>" size="2" readonly>
                                    <td><input type="text" name="nome_regiao" value="<?php echo $registros_resultado_consulta_conferencia['nome_regiao']?>" size="2" readonly></td>
                                    <td><input type="text" name="nome_conferencia" value="<?php echo $registros_resultado_consulta_conferencia['nome_conferencia']?>" size="40" readonly></td>
                                    <td><input type="text" name="nome_igreja" size="40" maxlength="80" required></td>
                                    <td><input type="submit" value="Cadastrar"></td>
                                    <td><input type="button" value="Voltar" onClick="history.go(-1)"></td>
                                </tr>
                            </table>
                        </form>
                        <?php
                        //Consulta nas tabelas conferencias, regioes e igrejas
                        $consulta_igreja = "SELECT * FROM Conferencias, Regioes, Igrejas WHERE Conferencias_id_conferencia = id_conferencia AND Regioes_id_regiao = id_regiao AND id_conferencia = '$id_conferencia'";
                        $resultado_consulta_igreja = mysql_query($consulta_igreja);
                        //Armazena quantidade de registros da consulta_igreja
                        $qtde_resultado_consulta_igreja = mysql_num_rows($resultado_consulta_igreja);

                        //Se tiver mais de 0 registros
                        if($qtde_resultado_consulta_igreja > 0){
                        ?>
                        <h3></h3>
                        <h3>Selecione o Templo</h3>
                        <form method="get">
                            <table>
                                <tr>
                                    <td>ID</td>
                                    <td>Estado</td>
                                    <td>Conferência</td>
                                    <td>Templo</td>
                                    <td>Selecionar</td>
                                </tr>
                                <?php 
                                //Enquanto houver registros mostrar os dados abaixo
                                while ($registros_resultado_consulta_igreja = mysql_fetch_array($resultado_consulta_igreja)){ 
                                ?>
                                <tr>
                                    <input type="hidden" name="id_igreja" value="<?php echo $registros_resultado_consulta_igreja['id_igreja']?>" size="2" readonly>
                                    <td><input type="text" name="id_igreja" value="<?php echo $registros_resultado_consulta_igreja['id_igreja']?>" size="2" readonly></td>
                                    <td><input type="text" name="nome_regiao" value="<?php echo $registros_resultado_consulta_igreja['nome_regiao']?>" size="2" readonly></td>
                                    <td><input type="text" name="nome_conferencia" value="<?php echo $registros_resultado_consulta_igreja['nome_conferencia'] ?>" size="30" readonly></td>
                                    <td><input type="text" name="nome_igreja" value="<?php echo $registros_resultado_consulta_igreja['nome_igreja'] ?>" maxlength="80" size="30" readonly></td>
                                    <td><a href="cadastros_fundos.php?id_igreja=<?php echo $registros_resultado_consulta_igreja['id_igreja'] ?>">Selecionar</a></td>
                                </tr>
                                <?php } ?>
                            </table>
                        </form>
                        <?php
                        //Seo não tiver registros
                        }else{
                            echo '<h3></h3><h4>Esta Conferência não possui nenhum templo cadastrado.</h4>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>