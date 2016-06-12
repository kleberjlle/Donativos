<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

/*Verifica se a variável está em branco
 * Caso sim recebe isset, para não mostrar erro
 * Caso não recebe a ID passada via GET do retorno do cadastro
 */
if($id_regiao = empty($_GET['id_regiao'])){
    $id_regiao = isset($_GET['id_regiao']);
}else{
    $id_regiao = $_GET['id_regiao'];
}

//Consulta dados na tabela regioes caso a ID seja a mesma recebida
$consulta_regiao = "SELECT id_regiao, nome_regiao FROM Regioes WHERE id_regiao = '$id_regiao'";
$resultado_consulta_regiao = mysql_query($consulta_regiao);
$registros_resultado_consulta_regiao = mysql_fetch_array($resultado_consulta_regiao);

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
                        <h4>Etapa 2: Selecione/ Cadastre a Conferência</h4>
                        <form method="post" action="processamento/cadastrar_conferencia.php">
                            <table>
                                <tr>
                                    <td>Estado</td>
                                    <td>Cadastrar Conferência</td>
                                </tr>
                                <tr>
                                    <input type="hidden" name="id_regiao" value="<?php echo $registros_resultado_consulta_regiao['id_regiao'] ?>" size="2" readonly>
                                    <td><input type="text" name="nome_regiao" value="<?php echo $registros_resultado_consulta_regiao['nome_regiao'] ?>" size="2" readonly></td>
                                    <td><input type="text" name="nome_conferencia" size="40" maxlength="80" required></td>
                                    <td><input type="submit" value="Cadastrar"></td>
                                    <td><input type="button" value="Voltar" onClick="history.go(-1)"></td>
                                </tr>
                            </table>
                        </form>
                        <?php
                        //Consulta dados na tabela conferencias e regioes
                        $consulta_conferencia = "SELECT * FROM Conferencias, Regioes WHERE Regioes_id_regiao = id_regiao AND id_regiao = '$id_regiao'";
                        $resultado_consulta_conferencia = mysql_query($consulta_conferencia);
                        //Armazena quantidade de registros encontrados na consulta
                        $qtde_resultado_consulta_conferencia = mysql_num_rows($resultado_consulta_conferencia);

                        //Verifica se possui mais de 0 registros
                        if($qtde_resultado_consulta_conferencia > 0){
                        ?>
                        <h3></h3>
                        <h3>Selecione a Conferência</h3>
                        <form method="get">
                            <table>
                                <tr>
                                    <td>ID</td>
                                    <td>Estado</td>
                                    <td>Conferência</td>
                                    <td>Selecionar</td>
                                </tr>
                                <?php 
                                //Enquanto houver registros, mostrar os dados da consulta_conferencia
                                while ($registros_resultado_consulta_conferencia = mysql_fetch_array($resultado_consulta_conferencia)){ 
                                ?>
                                <tr>
                                    <!--Campo oculto, somente para passagem de parâmetro-->
                                    <input type="hidden" name="id_regiao" value="<?php echo $registros_resultado_consulta_conferencia['id_regiao']?>" size="2" readonly>
                                    <td><input type="text" name="id_conferencia" value="<?php echo $registros_resultado_consulta_conferencia['id_conferencia']?>" size="2" readonly></td>
                                    <td><input type="text" name="nome_regiao" value="<?php echo $registros_resultado_consulta_conferencia['nome_regiao']?>" size="2" readonly></td>
                                    <td><input type="text" name="nome_conferencia" value="<?php echo $registros_resultado_consulta_conferencia['nome_conferencia'] ?>" size="40" readonly></td>
                                    <td><a href="cadastros_igrejas.php?id_conferencia=<?php echo $registros_resultado_consulta_conferencia['id_conferencia'] ?>">Selecionar</a></td>
                                </tr>
                                <?php            
                                }
                                ?>
                            </table>
                        </form>
                        <?php
                        //Caso a tabela não tenha nenhum registro
                        }else{
                            echo '<h3></h3><h4>Este Estado não possui nenhuma conferência cadastrada.</h4>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>