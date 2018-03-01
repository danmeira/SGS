<?php
// inicia sessão
session_start();
// conecta com banco de dados
require("../connect.php");
// ================ Começa recepção dos dados do formulário ===================
// seta caracteres para utf8
header('Content-Type: text/html; charset=utf8');
// dados OBS: variáveis com utf8_decode precisam dessa função para se adaptarem ao banco de dados e ao html
$cnpj = $_REQUEST['cnpj'];
// =================== Configura informações do relatório =====================
// seta fuso horário para São Paulo
date_default_timezone_set("America/Sao_Paulo");
// recebe nome do usuário
$usuario = $_SESSION['nome'];
// seta data e hora
$hoje = date("y.m.d");
$hora = date("H:i:s");
// ============= Começo do processo de cadastro ou atualização ================
// verifica se existe algum dado na tabela
$query = "SELECT * FROM c_conveniados WHERE cnpj = '$cnpj'";
$query = mysqli_query($connection, $query) or die($connection);
$query = mysqli_fetch_row($query);

$delete = "DELETE FROM c_conveniados WHERE id = '$query[0]'";
$delete = mysqli_query($connection, $delete) or die($connection);

$atividade = "O conveniado " . $query[1] . " de ID " . $query[0] . "foi removido.";
$rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
$rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);

?>