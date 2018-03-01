<?php
// inicia sessão
session_start();
// conecta com banco de dados
require("../connect.php");
// ================ Começa recepção dos dados do formulário ===================
// seta caracteres para utf8
header('Content-Type: text/html; charset=utf8');
// dados OBS: variáveis com utf8_decode precisam dessa função para se adaptarem ao banco de dados e ao html
$cargo = $_REQUEST['cargo'];
$cargo = utf8_decode($cargo);
$cbo = $_REQUEST['cbo'];
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
$query = "SELECT COUNT(*) FROM c_cargo WHERE cbo = '$cbo'";
$query = mysqli_query($connection, $query) or die($connection);
$query = mysqli_fetch_assoc($query);
// se não houver nada...
if ($query['COUNT(*)'] == 0) {
	$cadastrar = "INSERT INTO c_cargo (cbo, cargo) VALUES ('$cbo', '$cargo')";
    $cadastrar = mysqli_query($connection, $cadastrar) or die($connection);

	$atividade = "Relizado cadastro do cargo " . $cargo . " de cbo " . $cbo . ".";
    
    $rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
    $rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);
}
// se já houver dados
else {
	$query = "SELECT * FROM c_cargo WHERE cbo = '$cbo'";
	$query = mysqli_query($connection, $query) or die($connection);
	$query = mysqli_fetch_assoc($query);

	$atividade = "Relizado atualiza&ccedil;&atilde;o cadastral do cargo " . $query['cargo'] . ": " . $query['cargo'] . " -> " . $cargo . "; " . $query['cbo'] . " -> " . $cbo . ".";
    
    $rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
    $rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);

    $atualizar_cargo = "UPDATE c_cargo SET cargo = '$cargo', cbo = '$cbo' WHERE cbo = '$cbo' OR cargo = '$cargo'";
	$atualizar_cargo = mysqli_query($connection, $atualizar_cargo) or die($connection);
}
?>