<?php
session_start();
// conecta com banco de dados
require("../connect.php");
// ================ Começa recepção dos dados do formulário ===================
// seta caracteres para utf8
header('Content-Type: text/html; charset=utf8');
// =================== Configura informações do relatório =====================
// seta fuso horário para São Paulo
date_default_timezone_set("America/Sao_Paulo");
// recebe nome do usuário
$usuario = $_SESSION['nome'];
// seta data e hora
$hoje = date("y.m.d");
$hora = date("H:i:s");

$query = "SELECT * FROM c_custo";
$query = mysqli_query($connection, $query) or die($connection);

while($table = mysqli_fetch_row($query)){
    $array[] = $table[0];
}

$string = "";

for ($i = 0; $i < count($array); $i++) {
	if ($i == 0) {
		$string = $array[$i];
	}
	else {
		$string = $string . ";" . $array[$i];
	}
}

echo $string;
?>