<?php
// inicia sessão
session_start();
// conecta com banco de dados
require("../connect.php");
// ================ Começa recepção dos dados do formulário ===================
// seta caracteres para utf8
header('Content-Type: text/html; charset=utf8');
// dados OBS: variáveis com utf8_decode precisam dessa função para se adaptarem ao banco de dados e ao html
$conta = $_REQUEST['conta'];
$conta = utf8_decode($conta);
$rateio = $_REQUEST['rateio'];
// =================== Configura informações do relatório =====================
// seta fuso horário para São Paulo
date_default_timezone_set("America/Sao_Paulo");
// recebe nome do usuário
$usuario = $_SESSION['nome'];
// seta data e hora
$hoje = date("y.m.d");
$hora = date("H:i:s");
// ============= Começo do processo de cadastro ou atualização ================
$atualizar = "UPDATE c_rateio SET rateio = '$rateio' WHERE contas = '$conta'";
$atualizar = mysqli_query($connection, $atualizar) or die($connection);
?>