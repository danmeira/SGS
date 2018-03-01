<?php
session_start();
// conecta com banco de dados
require("../connect.php");
// ================ Começa recepção dos dados do formulário ===================
// seta caracteres para utf8
header('Content-Type: text/html; charset=utf8');

$query = "SELECT * FROM c_conveniados";
$query = mysqli_query($connection, $query) or die($connection);

while($table = mysqli_fetch_row($query)){
    $array[] = utf8_encode($table[1]);
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