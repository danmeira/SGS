<?php
session_start();
// conecta com banco de dados
require("../connect.php");
// ================ Começa recepção dos dados do formulário ===================
// seta caracteres para utf8
header('Content-Type: text/html; charset=utf8');
// dados OBS: variáveis com utf8_decode precisam dessa função para se adaptarem ao banco de dados e ao html
$conveniado = $_REQUEST['conveniado'];
$conveniado = utf8_decode($conveniado);
// =================== Configura informações do relatório =====================
// seta fuso horário para São Paulo
date_default_timezone_set("America/Sao_Paulo");
// recebe nome do usuário
$usuario = $_SESSION['nome'];
// seta data e hora
$hoje = date("y.m.d");
$hora = date("H:i:s");

$query = "SELECT * FROM c_conveniados WHERE conveniado = '$conveniado'";
$query = mysqli_query($connection, $query) or die($connection);
$query = mysqli_fetch_row($query);

$arr = array('convenio' => $query[2], 'cnpj' => $query[3], 'ie' => $query[4], 'contato' => $query[5], 'email' => $query[6], 'telefone' => $query[7], 'endereco' => $query[8], 'complemento' => $query[9], 'cep' => $query[10], 'cidade' => $query[11], 'uf' => $query[12]);

echo $arr['convenio'] . ";" . $arr['cnpj'] . ";" . $arr['ie'] . ";" . $arr['contato'] . ";" . $arr['email'] . ";" . $arr['telefone'] . ";" . utf8_encode($arr['endereco']) . ";" . utf8_encode($arr['complemento']) . ";" . $arr['cep'] . ";" . utf8_encode($arr['cidade']) . ";" . $arr['uf'];
?>