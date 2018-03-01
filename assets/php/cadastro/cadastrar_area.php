<?php
// inicia sessão
session_start();
// conecta com banco de dados
require("../connect.php");
// ================ Começa recepção dos dados do formulário ===================
// seta caracteres para utf8
header('Content-Type: text/html; charset=utf8');
// dados OBS: variáveis com utf8_decode precisam dessa função para se adaptarem ao banco de dados e ao html
$area = $_REQUEST['area'];
$area = utf8_decode($area);
$cc = $_REQUEST['cc'];
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
$query = "SELECT COUNT(*) FROM c_area WHERE area = '$area'";
$query = mysqli_query($connection, $query) or die($connection);
$query = mysqli_fetch_assoc($query);
// se não houver nada...
if ($query['COUNT(*)'] == 0) {
	$cadastrar = "INSERT INTO c_area (area, centro_custo) VALUES ('$area', '$cc')";
    $cadastrar = mysqli_query($connection, $cadastrar) or die($connection);

	$atividade = "Relizado cadastro da area " . $area . ".";
    
    $rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
    $rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);
}
// se já houver dados
else {
	$query = "SELECT * FROM c_area WHERE area = '$area'";
	$query = mysqli_query($connection, $query) or die($connection);
	$query = mysqli_fetch_assoc($query);

	$atividade = "Relizado atualiza&ccedil;&atilde;o cadastral da area " . $query['area'] . ".";
    
    $rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
    $rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);

    $atualizar = "UPDATE c_area SET area = '$area', centro_custo = '$cc' WHERE area = '$area'";
	$atualizar = mysqli_query($connection, $atualizar) or die($connection);
}
?>