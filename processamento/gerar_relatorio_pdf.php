<?php
include("../seguranca.php"); // Inclui o arquivo com o sistema de segurança
protegePagina(); // Chama a função que protege a página

//obtém o nome da página que gerará o relatório
$relatorio = $_GET['relatorio'];

$html = "<html>";
$html .=   "<head>";
$html .=   "<title></title>";
$html .=   "<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>";
$html .=   "<link rel='stylesheet' href='../css/style.css'>";
$html .=   "</head>";
$html .=   "<body>";
$html .=   "<div id='quadro_cabecalho_pdf'>";
$html .=   "<div id='logo_pdf'>";
$html .=   "<img src='../images/logo.png' />";
$html .=   "</div>";
$html .=   "<div id='quadro_titulo_pdf'>";
$html .=   "<p>";

//condição para exibir o título do relatório
if($relatorio == "templos"){
$html .=   "<strong>Relatório de Arrecadação por Templo</strong>";
}else if($relatorio == "regioes"){
$html .=   "<strong>Relatório de Arrecadações por Estado</strong>";    
}else if($relatorio == "fundos"){
$html .=   "<strong>Relatório de Arrecadações por Fundo</strong>";    
}else if($relatorio == "doadores"){
$html .=   "<strong>Relatório de arrecadações por Doador</strong>";    
}else if($relatorio == "conferencias"){
$html .=   "<strong>Relatório de Arrecadações por Conferência</strong>";    
}else if($relatorio == "bancos"){
$html .=   "<strong>Relatório de Arrecadações por Banco</strong>";    
}

//exibe o nome do usuário que está acessando 
$html .=   "</p>";
$html .=   "Solicitante: ".$_SESSION['usuarioNome']."<br />";
$html .=   "</div>";
$html .=   "</div>";
$html .=   "<div id='conteudo_pdf'>";

//condição para exibir o conteúdo
if($relatorio == "templos"){
$html .=   "<table>";
$html .=   "<tr>";
$html .=   "<td>Nome do Templo</td><td>Total arrecadado</td>";
$html .=   "</tr>";
$html .=   "<tr>";
$html .=   "<td><hr /></td><td><hr /></td>";
$html .=   "</tr>";

//consulta as tabelas igrejas, fundos, doacoes_para_fundos
$consulta_templos = "SELECT *, SUM(valor_recebido) AS total FROM Conferencias, Igrejas, Fundos WHERE id_conferencia = Conferencias_id_conferencia AND id_igreja = Igrejas_id_igreja AND valor_recebido > '0' GROUP BY id_igreja ORDER BY total DESC";
$resultado_consulta_templos = mysql_query($consulta_templos);

//Enquanto houver registros mostrar dados abaixo
while ($registros_resultado_consulta_templos = mysql_fetch_array($resultado_consulta_templos)){
    $html .=   "<tr>";
    $html .=   "<td>";
    $html .=   $registros_resultado_consulta_templos['nome_igreja'];
    $html .=   "</td>";
    $html .=   "<td>";
    $html .=   "R$ " . number_format($registros_resultado_consulta_templos['total'], 2, ',', '.');
    $html .=   "</td>";
    $html .=   "</tr>";
    }
    
$html .=   "</table>";
}else if($relatorio == "regioes"){
$html .=   "<table>";
$html .=   "<tr>";
$html .=   "<td>Estado</td><td>Total arrecadado</td>";
$html .=   "</tr>";
$html .=   "<tr>";
$html .=   "<td><hr /></td><td><hr /></td>";
$html .=   "</tr>";    
    
//consulta as tabelas conferencias, regioes, igrejas, fundos, doacoes_para_fundos
$consulta_regioes = "SELECT *, SUM(valor_recebido) AS total FROM Conferencias, Regioes, Igrejas, Fundos WHERE id_conferencia = Conferencias_id_conferencia AND id_regiao = Regioes_id_regiao AND id_igreja = Igrejas_id_igreja AND valor_recebido > '0' GROUP BY id_regiao ORDER BY total DESC";
$resultado_consulta_regioes = mysql_query($consulta_regioes);

//Enquanto houver registros mostrar dados abaixo
while ($registros_resultado_consulta_regioes = mysql_fetch_array($resultado_consulta_regioes)){
    $html .=   "<tr>";
    $html .=   "<td>";
    $html .=   $registros_resultado_consulta_regioes['nome_regiao'];
    $html .=   "</td>";
    $html .=   "<td>";
    $html .=   "R$ " . number_format($registros_resultado_consulta_regioes['total'], 2, ',', '.');
    $html .=   "</td>";
    $html .=   "</tr>";
    }
}

//final do corpo do relatório
$html .=   "</div>";
$html .=   "</body>";
$html .=   "</html>";

//bibliotecas utilizadas para gerar o pdf
require_once '../dompdf/lib/html5lib/Parser.php';
require_once '../dompdf/lib/php-font-lib/src/FontLib/Autoloader.php';
//require_once '../dompdf/src/functions.inc.php';
require_once '../dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->set_option('isHtml5ParserEnabled', true);
$dompdf->render();
$pdf = $dompdf->output();
$dompdf->stream("gerar_relatorio_pdf");

//exibe o conteúdo acima no arquivo pdf
echo $html;

?>