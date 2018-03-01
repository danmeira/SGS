<?php
// inicia sessão
session_start();
// conecta com banco de dados
require("../connect.php");
// ================ Começa recepção dos dados do formulário ===================
// seta caracteres para utf8
header('Content-Type: text/html; charset=utf8');
// dados OBS: variáveis com utf8_decode precisam dessa função para se adaptarem ao banco de dados e ao html
$colaborador = $_REQUEST['colaborador'];
$colaborador = utf8_decode($colaborador);
$cpf = $_REQUEST['cpf'];
$sexo = $_REQUEST['sexo'];
$cep = $_REQUEST['cep'];
$endereco = $_REQUEST['endereco'];
$endereco = utf8_decode($endereco);
$complemento = $_REQUEST['complemento'];
$complemento = utf8_decode($complemento);
$cidade = $_REQUEST['cidade'];
$cidade = utf8_decode($cidade);
$uf = $_REQUEST['uf'];
$telefone = $_REQUEST['telefone'];
$celular = $_REQUEST['celular'];
$email = $_REQUEST['email'];
$cargo = $_REQUEST['cargo'];
$regime = $_REQUEST['regime'];
$admissao = $_REQUEST['admissao'];
$admissao = explode("/", $admissao);
$admissao_perm = $admissao[2] . "-" . $admissao[1] . "-" . $admissao[0];
$demissao = $_REQUEST['demissao'];
$demissao = explode("/", $demissao);
$demissao_perm = $demissao[2] . "-" . $demissao[1] . "-" . $demissao[0];
$custo = $_REQUEST['custo'];
$fonte = $_REQUEST['fonte'];

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
$query = "SELECT COUNT(*) FROM c_colaboradores WHERE cpf = '$cpf'";
$query = mysqli_query($connection, $query) or die($connection);
$query = mysqli_fetch_assoc($query);
// se não houver nada...
if ($query['COUNT(*)'] == 0) {
	// se não foi inserido inscrição estadual
	$cadastrar_colaborador = "INSERT INTO c_colaboradores (`cpf`, `nome`, `sexo`, `endereco`, `complemento`, `cep`, `cidade`, `uf`, `telefone`, `celular`, `email`, `cargo`, `regime`, `admissao`, `demissao`, `cc`, `cfp`) VALUES ('$cpf', '$colaborador', '$sexo', '$endereco', '$complemento', '$cep', '$cidade', '$uf', '$telefone', '$celular', '$email', '$cargo', '$regime', '$admissao_perm', '$demissao_perm', '$custo', '$fonte')";
	$cadastrar_colaborador = mysqli_query($connection, $cadastrar_colaborador) or die($connection);
	// envio dos dados da atividade
	$atividade = "Relizado cadastro do colaborador " . $colaborador . ".";
    
    $rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
    $rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);
}
// se já houver dados
else {
	// se não foi inserido inscrição estadual
	$atualizar_colaborador = "UPDATE `c_colaboradores` SET `cpf`='$cpf',`nome`='$colaborador',`sexo`='$sexo',`endereco`='$endereco',`complemento`='$complemento',`cep`='$cep',`cidade`='$cidade',`uf`='$uf',`telefone`='$telefone',`celular`='$celular',`email`='$email',`cargo`='$cargo',`regime`='$regime',`admissao`='$admissao_perm',`demissao`='$demissao_perm',`cc`='$custo',`cfp`='$fonte' WHERE `cpf` = '$cpf'";
	$atualizar_colaborador = mysqli_query($connection, $atualizar_colaborador) or die($connection);
	// envio dos dados da atividade
	$atividade = "Relizado atualiza&ccedil;&atilde;o cadastral do colaborador " . $colaborador . ".";
    
    $rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
    $rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);
}
?>