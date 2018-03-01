<?php
session_start();
// conecta com banco de dados
require("../connect.php");
// ================ Começa recepção dos dados do formulário ===================
// seta caracteres para utf8
header('Content-Type: text/html; charset=utf8');
// dados OBS: variáveis com utf8_decode precisam dessa função para se adaptarem ao banco de dados e ao html
$colaborador = $_REQUEST['colaborador'];
$colaborador = utf8_decode($colaborador);
// =================== Configura informações do relatório =====================
// seta fuso horário para São Paulo
date_default_timezone_set("America/Sao_Paulo");
// recebe nome do usuário
$usuario = $_SESSION['nome'];
// seta data e hora
$hoje = date("y.m.d");
$hora = date("H:i:s");

$query = "SELECT * FROM c_colaboradores WHERE nome = '$colaborador'";
$query = mysqli_query($connection, $query) or die($connection);
$query = mysqli_fetch_row($query);

$arr = array('cpf' => $query[0], 'sexo' => $query[2], 'endereco' => $query[3], 'complemento' => $query[4], 'cep' => $query[5], 'cidade' => $query[6], 'uf' => $query[7], 'telefone' => $query[8], 'celular' => $query[9], 'email' => $query[10], 'cargo' => $query[11], 'regime' => $query[12], 'admissao' => $query[13], 'demissao' => $query[14], 'cc' => $query[15], 'cfp' => $query[16]);

echo $arr['cpf'] . ";" . $arr['sexo'] . ";" . utf8_encode($arr['endereco']) . ";" . utf8_encode($arr['complemento']) . ";" . $arr['cep'] . ";" . utf8_encode($arr['cidade']) . ";" . $arr['uf'] . ";" . $arr['telefone'] . ";" . $arr['celular'] . ";" . $arr['email'] . ";" . $arr['cargo'] . ";" . utf8_encode($arr['regime']) . ";" . $arr['admissao'] . ";" . $arr['demissao'] . ";" . $arr['cc'] . ";" . $arr['cfp'];
?>