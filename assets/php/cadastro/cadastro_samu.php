<?php
// inicia sessão
session_start();
// conecta com banco de dados
require("../connect.php");
// ================ Começa recepção dos dados do formulário ===================
// seta caracteres para utf8
header('Content-Type: text/html; charset=utf8');
// dados OBS: variáveis com utf8_decode precisam dessa função para se adaptarem ao banco de dados e ao html
$samu = $_REQUEST['samu'];
$samu = utf8_decode($samu);
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
$query = "SELECT COUNT(*) FROM c_samu";
$query = mysqli_query($connection, $query) or die($connection);
$query = mysqli_fetch_assoc($query);
// se não houver nada...
if ($query['COUNT(*)'] == 0) {
	// se não foi inserido inscrição estadual
	if ($ie == "") {
	$cadastrar_samu = "INSERT INTO c_samu (samu, convenio, cnpj, telefone, contato, email, endereco, complemento, cep, cidade, uf) VALUES ('$samu', '$convenio', '$cnpj', '$telefone', '$contato', '$email', '$endereco', '$complemento', '$cep', '$cidade', '$uf')";
	$cadastrar_samu = mysqli_query($connection, $cadastrar_samu) or die($connection);
	}
	// se foi inserido inscrição estadual
	else {
	$cadastrar_samu = "INSERT INTO c_samu (samu, convenio, cnpj, ie, telefone, contato, email, endereco, complemento, cep, cidade, uf) VALUES ('$samu', '$convenio', '$cnpj', '$ie', '$telefone', '$contato', '$email', '$endereco', '$complemento', '$cep', '$cidade', '$uf')";
	$cadastrar_samu = mysqli_query($connection, $cadastrar_samu) or die($connection);
	}
	// envio dos dados da atividade
	$atividade = "Relizado preenchimento do formu&aacute;rio Cadastro SAMU 192.";
    
    $rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
    $rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);
}
// se já houver dados
else {
	$buscar_info = "SELECT COUNT(*) FROM c_samu";
	$buscar_info = mysqli_query($connection, $buscar_info) or die($connection);
	$buscar_info = mysqli_fetch_row($buscar_info);
	// se não foi inserido inscrição estadual
	if ($ie == "") {
	$atualizar_samu = "UPDATE `c_samu` SET samu = '$samu', convenio = '$convenio', cnpj = '$cnpj', telefone = '$telefone', contato = '$contato', email = '$email', endereco = '$endereco', complemento = '$complemento', cep = '$cep', cidade = '$cidade', uf = '$uf' WHERE cnpj = '$cnpj'";
	$atualizar_samu = mysqli_query($connection, $atualizar_samu) or die($connection);
	}
	// se foi inserido inscrição estadual
	else {
	$atualizar_samu = "UPDATE c_samu SET samu = '$samu', convenio = '$convenio', cnpj = '$cnpj', ie = '$ie', telefone = '$telefone', contato = '$contato', email = '$email', endereco = '$endereco', complemento = '$complemento', cep = '$cep', cidade = '$cidade', uf = '$uf' WHERE cnpj = '$cnpj'";
	$atualizar_samu = mysqli_query($connection, $atualizar_samu) or die($connection);
	}
	// envio dos dados da atividade
	$atividade = "Relizado altera&ccedil;&atilde;o do formu&aacute;rio Cadastro SAMU 192.";
    
    $rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
    $rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);
}
?>