<?php
// inicia sessão
session_start();
// conecta com banco de dados
require("../connect.php");
// ================ Começa recepção dos dados do formulário ===================
// seta caracteres para utf8
header('Content-Type: text/html; charset=utf8');
// dados OBS: variáveis com utf8_decode precisam dessa função para se adaptarem ao banco de dados e ao html
$fonte = $_REQUEST['fonte'];
$fonte = utf8_decode($fonte);
$cfp = $_REQUEST['cfp'];
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
$query = "SELECT COUNT(*) FROM c_fontes WHERE cfp = '$cfp'";
$query = mysqli_query($connection, $query) or die($connection);
$query = mysqli_fetch_assoc($query);
// se não houver nada...
if ($query['COUNT(*)'] == 0) {
	$cadastrar = "INSERT INTO c_fontes (cfp, fonte_pagadora) VALUES ('$cfp', '$fonte')";
    $cadastrar = mysqli_query($connection, $cadastrar) or die($connection);

	$atividade = "Relizado cadastro da fonte " . $fonte . " de CFP " . $cfp . ".";
    
    $rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
    $rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);
}
// se já houver dados
else {
	$query = "SELECT * FROM c_fontes WHERE cfp = '$cfp'";
	$query = mysqli_query($connection, $query) or die($connection);
	$query = mysqli_fetch_assoc($query);

	$atividade = "Relizado atualiza&ccedil;&atilde;o cadastral da fonte pagadora " . $query['fonte_pagadora'] . ": " . $query['fonte_pagadora'] . " -> " . $fonte . "; " . $query['cfp'] . " -> " . $cfp . ".";
    
    $rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
    $rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);

    $atualizar_fonte = "UPDATE c_fontes SET fonte_pagadora = '$fonte', cfp = '$cfp' WHERE cfp = '$cfp' OR fonte_pagadora = '$fonte'";
	$atualizar_fonte = mysqli_query($connection, $atualizar_fonte) or die($connection);
}
?>