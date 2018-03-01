<?php
// inicia sessão
session_start();
// conecta com banco de dados
require("../connect.php");
// ================ Começa recepção dos dados do formulário ===================
// seta caracteres para utf8
header('Content-Type: text/html; charset=utf8');
// dados OBS: variáveis com utf8_decode precisam dessa função para se adaptarem ao banco de dados e ao html
$conveniado = $_REQUEST['conveniado'];
$conveniado = utf8_decode($conveniado);
$convenio = $_REQUEST['convenio'];
$cnpj = $_REQUEST['cnpj'];
$ie = $_REQUEST['ie'];
$telefone = $_REQUEST['telefone'];
$contato = $_REQUEST['contato'];
$contato = utf8_decode($contato);
$email = $_REQUEST['email'];
$endereco = $_REQUEST['endereco'];
$endereco = utf8_decode($endereco);
$complemento = $_REQUEST['complemento'];
$complemento = utf8_decode($complemento);
$cep = $_REQUEST['cep'];
$cidade = $_REQUEST['cidade'];
$cidade = utf8_decode($cidade);
$uf = $_REQUEST['uf'];
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
$query = "SELECT COUNT(*) FROM c_conveniados WHERE cnpj = '$cnpj'";
$query = mysqli_query($connection, $query) or die($connection);
$query = mysqli_fetch_assoc($query);
// se não houver nada...
if ($query['COUNT(*)'] == 0) {
	// se não foi inserido inscrição estadual
	if ($ie == "") {
	$cadastrar_conveniado = "INSERT INTO c_conveniados (conveniado, convenio, cnpj, telefone, contato, email, endereco, complemento, cep, cidade, uf) VALUES ('$conveniado', '$convenio', '$cnpj', '$telefone', '$contato', '$email', '$endereco', '$complemento', '$cep', '$cidade', '$uf')";
	$cadastrar_conveniado = mysqli_query($connection, $cadastrar_conveniado) or die($connection);
	}
	// se foi inserido inscrição estadual
	else {
	$cadastrar_conveniado = "INSERT INTO c_conveniados (conveniado, convenio, cnpj, ie, telefone, contato, email, endereco, complemento, cep, cidade, uf) VALUES ('$conveniado', '$convenio', '$cnpj', '$ie', '$telefone', '$contato', '$email', '$endereco', '$complemento', '$cep', '$cidade', '$uf')";
	$cadastrar_conveniado = mysqli_query($connection, $cadastrar_conveniado) or die($connection);
	}
	// envio dos dados da atividade
	$atividade = "Relizado cadastro do conveniado " . $conveniado . ".";
    
    $rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
    $rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);
}
// se já houver dados
else {
	// se não foi inserido inscrição estadual
	if ($ie == "") {
		$atualizar_conveniado = "UPDATE c_conveniados SET conveniado = '$conveniado', convenio = '$convenio', cnpj = '$cnpj', telefone = '$telefone', contato = '$contato', email = '$email', endereco = '$endereco', complemento = '$complemento', cep = '$cep', cidade = '$cidade', uf = '$uf' WHERE cnpj = '$cnpj'";
		$atualizar_conveniado = mysqli_query($connection, $atualizar_conveniado) or die($connection);
	}
	// se foi inserido inscrição estadual
	else {
		$atualizar_conveniado = "UPDATE c_conveniados SET conveniado = '$conveniado', convenio = '$convenio', cnpj = '$cnpj', ie = '$ie', telefone = '$telefone', contato = '$contato', email = '$email', endereco = '$endereco', complemento = '$complemento', cep = '$cep', cidade = '$cidade', uf = '$uf' WHERE cnpj = '$cnpj'";
		$atualizar_conveniado = mysqli_query($connection, $atualizar_conveniado) or die($connection);
	}
	// envio dos dados da atividade
	$atividade = "Relizado atualiza&ccedil;&atilde;o cadastral do conveniado " . $conveniado . ".";
    
    $rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
    $rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);
}
?>