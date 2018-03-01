<?php
// inicia sessão
session_start();
// conecta com banco de dados
require("../connect.php");
// ================ Começa recepção dos dados do formulário ===================
// seta caracteres para utf8
header('Content-Type: text/html; charset=utf8');
// dados OBS: variáveis com utf8_decode precisam dessa função para se adaptarem ao banco de dados e ao html
$cod = $_REQUEST['cod'];
$classe = $_REQUEST['classe'];
$classe = utf8_decode($classe);
$desc = $_REQUEST['desc'];
$desc = utf8_decode($desc);
$und = $_REQUEST['und'];
$embalagem = $_REQUEST['embalagem'];
$embalagem = utf8_decode($embalagem);
$valor = $_REQUEST['valor'];

$temp = str_replace(',', '.', $valor);

$cda = $_REQUEST['cda'];
$adv = $_REQUEST['adv'];
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
$query = "SELECT COUNT(*) FROM c_itens WHERE id = '$cod'";
$query = mysqli_query($connection, $query) or die($connection);
$query = mysqli_fetch_assoc($query);
// se não houver nada...
if ($query['COUNT(*)'] == 0) {
	$cadastrar = "INSERT INTO c_itens (id, classe, descricao, und, embalagem, valor, cda, adv) VALUES ('$cod', '$classe', '$desc', '$und', '$embalagem', '$temp', '$cda', '$adv')";
    $cadastrar = mysqli_query($connection, $cadastrar) or die($connection);

	$atividade = "Relizado cadastro de item " . $desc . " de cod " . $cod;
    
    $rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
    $rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);
}
// se já houver dados
else {
	$query = "SELECT * FROM c_itens WHERE descricao = '$desc'";
	$query = mysqli_query($connection, $query) or die($connection);
	$query = mysqli_fetch_assoc($query);

	$atividade = "Relizado atualiza&ccedil;&atilde;o cadastral do item " . $query['conta'] . ".";
    
    $rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
    $rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);

    $atualizar_item = "UPDATE c_itens SET id = '$cod', classe = '$classe', descricao = '$desc', und = '$und', embalagem = '$embalagem', valor = '$temp', cda = '$cda', adv = '$adv' WHERE id = '$cod'";
	$atualizar_item = mysqli_query($connection, $atualizar_item) or die($connection);
}
?>