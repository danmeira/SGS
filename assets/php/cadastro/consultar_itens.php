<?php
session_start();
// conecta com banco de dados
require("../connect.php");
// ================ Começa recepção dos dados do formulário ===================
// seta caracteres para utf8
header('Content-Type: text/html; charset=utf8');
// dados OBS: variáveis com utf8_decode precisam dessa função para se adaptarem ao banco de dados e ao html
$fornecedor = $_REQUEST['fornecedor'];
$fornecedor = utf8_decode($fornecedor);
// =================== Configura informações do relatório =====================
// seta fuso horário para São Paulo

$query = "SELECT * FROM c_fornecedores WHERE razao_social = '$fornecedor'";
$query = mysqli_query($connection, $query) or die($connection);
$query = mysqli_fetch_row($query);

$arr = array('cnpj' => $query[2], 'ie' => $query[3], 'contato' => $query[4], 'email' => $query[5], 'telefone' => $query[6], 'endereco' => $query[7], 'complemento' => $query[8], 'cep' => $query[9], 'cidade' => $query[10], 'uf' => $query[11], 'classe' => $query[12], 'conta' => $query[13]);

echo $arr['cnpj'] . ";" . $arr['ie'] . ";" . $arr['contato'] . ";" . $arr['email'] . ";" . $arr['telefone'] . ";" . utf8_encode($arr['endereco']) . ";" . utf8_encode($arr['complemento']) . ";" . $arr['cep'] . ";" . utf8_encode($arr['cidade']) . ";" . $arr['uf'] . ";" . utf8_encode($arr['classe']) . ";" . utf8_encode($arr['conta']);
?>