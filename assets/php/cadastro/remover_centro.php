<?php
session_start();
//defini fuso horario
date_default_timezone_set("America/Sao_Paulo");
//conecta com banco de dados
require("../connect.php");
//recupera nome de usuario logado
$usuario = $_SESSION['nome'];

$cc = $_REQUEST['cc'];

$hoje = date("Y.m.d");
$hora = date("H:i:s");

$get_cc = "SELECT COUNT(*) FROM c_custo";
$get_cc = mysqli_query($connection, $get_cc) or die($connection);
$get_cc = mysqli_fetch_row($get_cc);

// pega o arquivo js
$jsfile = file('../../pages/datatables.editable_rateio.init.js');
// gera uma linha de interesse
for ($i = 0; $i < $get_cc[0] + 1; $i++) {
	if ($i == 0) {
		$dq = "'', ";
	}
	else {
		$dq .= "'', ";
	}
}
// procura as partes de interesse dentro do arquivo
for ($i = 0; $i < count($jsfile); $i++){
	if(trim($jsfile[$i]) == "null,"){
		$linha_null = $i + 1;
	}
	elseif (trim($jsfile[$i]) == "data = this.datatable.row.add([" . $dq . "actions ]);"){
		$linha_vir = $i + 1;
	}
}
// cria um novo array com um campo a menos
// grava as primeiras linhas
for ($i = 0; $i < $linha_null - 1; $i++){
	if ($i == 0) {
		$new_file = array($jsfile[$i]);
	}
	else{
		array_push($new_file, $jsfile[$i]);
	}
}
// grava mais algumas linhas
for ($i = $linha_null; $i < $linha_vir - 1; $i++){
	if ($i == $linha_null) {
		$jsfile[$i] = "					" . trim($jsfile[$i]) . "
		";
	}
	elseif ($i == $linha_null + 1) {
		$jsfile[$i] = "		" . ltrim($jsfile[$i]);
	}
	array_push($new_file, $jsfile[$i]); 
}
// retira um campo vazio
$n_dq = explode(",", $dq);
array_shift($n_dq);
$dq = implode(',', $n_dq);

$dq = ltrim($dq);

array_push($new_file, "			data = this.datatable.row.add([" . $dq . "actions ]);
	");
// grava o resto das linhas
for ($i = $linha_vir; $i < count($jsfile); $i++){
	if ($i == $linha_vir) {
		$jsfile[$i] = "		" . trim($jsfile[$i]) . "
";
	}
	array_push($new_file, $jsfile[$i]); 
}

file_put_contents('../../pages/datatables.editable_rateio.init.js', $new_file);

$rateio = "SELECT * FROM c_rateio";
$rateio = mysqli_query($connection, $rateio) or die($connection);

$custo = "SELECT cc FROM c_custo ORDER BY cc ASC";
$custo = mysqli_query($connection, $custo) or die($connection);

$ife = false;

while ($custo_a = mysqli_fetch_row($custo)) {
    if ($ife == false) {
    	$arr_c = array($custo_a[0]);
    	$ife = true;
    }
    else {
    	array_push($arr_c, $custo_a[0]);
    }
}

for ($i = 0; $i < count($arr_c); $i++) {
	// DEPOIS TROCAR POR VARIÁVEL
	if ($arr_c[$i] == $cc) {
		$posicao = $i;
	}
}
while ($rat = mysqli_fetch_row($rateio)) {
    $arr_rat = explode(";", $rat[1]);
    $n_str = "";
    $acabou = false;
    for ($i = 0; $i < count($arr_rat); $i++) {
    	// se for o primeiro espaço
        if ($posicao == 0 && $i == 0) {
        	array_shift($arr_rat);
        	$n_str = $arr_rat;
        	$acabou = true;
        }
        // se for o ultimo espaço
        elseif ($posicao == count($arr_rat) - 1 && $i == 0) {
        	array_pop($arr_rat);
        	$n_str = $arr_rat;
        	$acabou = true;
        }
        elseif ($acabou == false) {
        	$n_str = $arr_rat;
        	unset($n_str[$posicao]);
        	$acabou = true;
        }
    }

    $insert_str = implode(";", $n_str);

    echo $insert_str . " | ";

    $insert_rat = "UPDATE c_rateio SET `rateio` = '$insert_str' WHERE `contas` = '$rat[0]'";
    $insert_rat = mysqli_query($connection, $insert_rat) or die($connection);
}

$ver = "SELECT * FROM c_custo WHERE cc = '$cc'";
$ver_send = mysqli_query($connection, $ver) or die($connection);
$view = mysqli_fetch_row($ver_send);

$atividade = "Centro de custo " . utf8_encode($view[1]) . " de CC " . $cc ." removido.";
$atividade = utf8_decode(urldecode($atividade));

$rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
$rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);

$query = "DELETE FROM c_custo WHERE cc = '$cc'";
$query = mysqli_query($connection, $query) or die($query);
?>