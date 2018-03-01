<?php
// inicia sessão
session_start();
// conecta com banco de dados
require("../connect.php");
// ================ Começa recepção dos dados do formulário ===================
// seta caracteres para utf8
header('Content-Type: text/html; charset=utf8');
// dados OBS: variáveis com utf8_decode precisam dessa função para se adaptarem ao banco de dados e ao html
$fornecedor = $_REQUEST['fornecedor'];
$fornecedor = utf8_decode($fornecedor);
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
$classe = $_REQUEST['classe'];
$classe = utf8_decode($classe);
$conta = $_REQUEST['conta'];
$conta = utf8_decode($conta);
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
$query = "SELECT COUNT(*) FROM c_fornecedores WHERE cnpj = '$cnpj'";
$query = mysqli_query($connection, $query) or die($connection);
$query = mysqli_fetch_assoc($query);
// se não houver nada...
if ($query['COUNT(*)'] == 0) {
	// se não foi inserido inscrição estadual
	if ($ie == "") {
	$cadastrar_fornecedor = "INSERT INTO c_fornecedores (razao_social, cnpj, telefone, contato, email, endereco, complemento, cep, cidade, uf, classe, conta) VALUES ('$fornecedor', '$cnpj', '$telefone', '$contato', '$email', '$endereco', '$complemento', '$cep', '$cidade', '$uf', '$classe', '$conta')";
	$cadastrar_fornecedor = mysqli_query($connection, $cadastrar_fornecedor) or die($connection);
	}
	// se foi inserido inscrição estadual
	else {
	$cadastrar_fornecedor = "INSERT INTO c_fornecedores (razao_social, cnpj, ie, telefone, contato, email, endereco, complemento, cep, cidade, uf, classe, conta) VALUES ('$fornecedor', '$cnpj', '$ie', '$telefone', '$contato', '$email', '$endereco', '$complemento', '$cep', '$cidade', '$uf', '$classe', '$conta')";
	$cadastrar_fornecedor = mysqli_query($connection, $cadastrar_fornecedor) or die($connection);
	}
	// envio dos dados da atividade
	$atividade = "Relizado cadastro do fornecedor " . $fornecedor . " de CNPJ " . $cnpj . ".";
    
    $rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
    $rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);
}
// se já houver dados
else {
	// se não foi inserido inscrição estadual
	if ($ie == "") {
		$atualizar_fornecedor = "UPDATE c_fornecedores SET razao_social = '$fornecedor', cnpj = '$cnpj', telefone = '$telefone', contato = '$contato', email = '$email', endereco = '$endereco', complemento = '$complemento', cep = '$cep', cidade = '$cidade', uf = '$uf', classe = '$classe', conta = '$conta' WHERE cnpj = '$cnpj'";
		$atualizar_fornecedor = mysqli_query($connection, $atualizar_fornecedor) or die($connection);
	}
	// se foi inserido inscrição estadual
	else {
		$atualizar_fornecedor = "UPDATE c_fornecedores SET razao_social = '$fornecedor', cnpj = '$cnpj', ie = '$ie', telefone = '$telefone', contato = '$contato', email = '$email', endereco = '$endereco', complemento = '$complemento', cep = '$cep', cidade = '$cidade', uf = '$uf', classe = '$classe', conta = '$conta' WHERE cnpj = '$cnpj'";
		$atualizar_fornecedor = mysqli_query($connection, $atualizar_fornecedor) or die($connection);
	}
	// envio dos dados da atividade
	$atividade = "Relizado atualiza&ccedil;&atilde;o cadastral do fornecedor " . $fornecedor . ".";
    
    $rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
    $rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);
}
?>