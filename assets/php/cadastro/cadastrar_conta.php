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
$query = "SELECT COUNT(*) FROM c_contas WHERE conta = '$conta'";
$query = mysqli_query($connection, $query) or die($connection);
$query = mysqli_fetch_assoc($query);
// se não houver nada...
if ($query['COUNT(*)'] == 0) {
	$cadastrar = "INSERT INTO c_contas (conta, cfp) VALUES ('$conta', '$cfp')";
    $cadastrar = mysqli_query($connection, $cadastrar) or die($connection);

    $qtd = "SELECT COUNT(*) FROM c_custo";
    $qtd = mysqli_query($connection, $qtd) or die($connection);
    $qtd = mysqli_fetch_assoc($qtd);

    for ($i = 0; $i < $qtd['COUNT(*)']; $i++) {
    	if ($i == 0) {
    		$op = array(0);
    	}
    	else {
    		array_push($op, 0);
    	}
    }

    $str_op = implode(';', $op);

    $insert_rat = "INSERT INTO c_rateio (contas, rateio) VALUES ('$conta', '$str_op')";
    $insert_rat = mysqli_query($connection, $insert_rat) or die($connection);

	$atividade = "Relizado cadastro da conta " . $conta . ".";
    
    $rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
    $rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);
}
// se já houver dados
else {
	$query = "SELECT * FROM c_contas WHERE conta = '$conta'";
	$query = mysqli_query($connection, $query) or die($connection);
	$query = mysqli_fetch_assoc($query);

	$atividade = "Relizado atualiza&ccedil;&atilde;o cadastral da conta " . $query['conta'] . ": " . $query['conta'] . " -> " . $conta . "; " . $query['cfp'] . " -> " . $cfp . ".";
    
    $rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
    $rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);

    $atualizar_cargo = "UPDATE c_contas SET conta = '$cconta', cfp = '$cfp' WHERE cfp = '$cfp'";
	$atualizar_cargo = mysqli_query($connection, $atualizar_cargo) or die($connection);
}
?>