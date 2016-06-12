<?php
include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//Consulta dados nas tabelas contas e bancos e ordene pela ID da conta
$consulta_contas = "SELECT * FROM Contas, Bancos WHERE '".$_SESSION['usuarioID']."' = Usuarios_id_usuario AND Bancos_id_banco = id_banco ORDER BY id_conta";
$resultado_consulta_contas = mysql_query($consulta_contas);
//Armazena quantidade de registros
$qtde_registros_resultado_consulta_contas = mysql_num_rows($resultado_consulta_contas);

//verifica se é usuário administrador
if($_SESSION['usuarioAdministrador'] == '1'){
    include './inc/cabecalho_sub_painel_admin.php';
    include './inc/cadastrar_conta.php';
}else{
    include './inc/cabecalho_painel.php';
    include './inc/cadastrar_conta.php';
}
?>

                        <h3>Minhas contas</h3>
                        <?php
                        //Verifica se possui menos que 1 registro
                        if($qtde_registros_resultado_consulta_contas <= 0){
                        echo '<h3></h3><h4>Você não possui conta bancária cadastrada!</h4>';
                        }else{
                        ?>
                        <form>
                            <table>
                                <tr>
                                    <td>ID</td>
                                    <td>Banco</td>
                                    <td>Agência</td>
                                    <td>Conta</td>
                                </tr>
                                <?php
                                //Enquanto houver registros mostrar dados abaixo
                                while ($registros_resultado_consulta_contas = mysql_fetch_array($resultado_consulta_contas)){
                                ?>
                                <tr>
                                    <td><input type="text" name="id_conta" value="<?php echo $registros_resultado_consulta_contas['id_conta'] ?>" size="2" readonly></td>
                                    <td><input type="text" name="banco" value="<?php echo $registros_resultado_consulta_contas['banco'] ?>" size="20" required></td>
                                    <td><input type="text" name="agencia" value="<?php echo $registros_resultado_consulta_contas['agencia'] ?>" size="20" maxlength="20" required></td>
                                    <td><input type="text" name="conta" value="<?php echo $registros_resultado_consulta_contas['conta'] ?>" size="20" maxlength="20" required></td>
                                </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </form>
                        <?php
                        }
                        ?>    
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
