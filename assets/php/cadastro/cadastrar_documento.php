<?php
// inicia sessão
session_start();
// conecta com banco de dados
require("../connect.php");
// ================ Começa recepção dos dados do formulário ===================
// seta caracteres para utf8
header('Content-Type: text/html; charset=utf8');
// dados OBS: variáveis com utf8_decode precisam dessa função para se adaptarem ao banco de dados e ao html
$id = $_REQUEST['id'];
$doc = $_REQUEST['doc'];
$doc = utf8_decode($doc);
$num = $_REQUEST['num'];
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
$query = "SELECT COUNT(*) FROM c_documentos WHERE id = '$id'";
$query = mysqli_query($connection, $query) or die($connection);
$query = mysqli_fetch_assoc($query);
// se não houver nada...
if ($query['COUNT(*)'] == 0) {
	$cadastrar = "INSERT INTO c_documentos (tipo, numero) VALUES ('$doc', '$num')";
    $cadastrar = mysqli_query($connection, $cadastrar) or die($connection);

	$atividade = "Relizado cadastro do documento " . $doc . ".";
    
    $rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
    $rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);
}
// se já houver dados
else {
	$atividade = "Relizado atualiza&ccedil;&atilde;o cadastral do documento " . $doc . ".";
    
    $rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
    $rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);

    $atualizar_fonte = "UPDATE c_documentos SET tipo = '$doc', numero = '$num' WHERE id = '$id'";
	$atualizar_fonte = mysqli_query($connection, $atualizar_fonte) or die($connection);
}
?>