<?php
// Inclui o arquivo com o sistema de segurança
require_once("seguranca.php");
// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Salva duas variáveis com o que foi digitado no formulário
  // Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido
  $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
  $senha = isset($_POST['senha']) ? MD5($_POST['senha']) : '';
  // Utiliza uma função criada no seguranca.php pra validar os dados digitados
  if (validaUsuario($usuario, $senha) == true) {
    // O usuário e a senha digitados foram validados, manda pra página interna
    //verifica se o perfil eh admin ou não para enviar a pg correta
    if($_SESSION['usuarioAdministrador'] == '1'){
        header("Location: painel_admin.php");
    }else{
        header("Location: painel.php");
    }
  } else {
    // O usuário e/ou a senha são inválidos, manda de volta pro form de login
    // Para alterar o endereço da página de login, verifique o arquivo seguranca.php
    expulsaVisitante();
  }
}