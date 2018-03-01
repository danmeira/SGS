<?php
// inicia sessão
session_start();
// conecta com banco de dados
require("../connect.php");
// ================ Começa recepção dos dados do formulário ===================
// seta caracteres para utf8
header('Content-Type: text/javascript');
// dados OBS: variáveis com utf8_decode precisam dessa função para se adaptarem ao banco de dados e ao html
$centro = $_REQUEST['centro'];
$centro = utf8_decode($centro);
$cc = $_REQUEST['cc'];
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
$query = "SELECT COUNT(*) FROM c_custo WHERE cc = '$cc'";
$query = mysqli_query($connection, $query) or die($connection);
$query = mysqli_fetch_assoc($query);

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
// cria um novo array com um campo a mais
// grava as primeiras linhas
for ($i = 0; $i < $linha_null; $i++){
	if ($i == 0) {
		$new_file = array($jsfile[$i]);
	}
	else{
		array_push($new_file, $jsfile[$i]);
	}
}
// adiciona um campo null
array_push($new_file, "					null,
	");
// grava mais algumas linhas
for ($i = $linha_null; $i < $linha_vir - 1; $i++){
	if ($i == $linha_null) {
		$jsfile[$i] = "				" . trim($jsfile[$i]) . "
		";
	}
	elseif ($i == $linha_null + 1) {
		$jsfile[$i] = "		" . ltrim($jsfile[$i]);
	}
	array_push($new_file, $jsfile[$i]); 
}
// adiciona um campo vazio
array_push($new_file, "			data = this.datatable.row.add([" . ($dq . "'', ") . "actions ]);
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

// se não houver nada...
if ($query['COUNT(*)'] == 0) {
	$cadastrar = "INSERT INTO c_custo (cc, centro_custo) VALUES ('$cc', '$centro')";
    $cadastrar = mysqli_query($connection, $cadastrar) or die($connection);

	$atividade = "Relizado cadastro do centro de custo " . $centro . " de cc " . $cc . ".";
    
    $rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
    $rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);

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
    	if ($arr_c[$i] == $cc) {
    		$posicao = $i;
    	}
    }

    while ($rat = mysqli_fetch_row($rateio)) {
        $arr_rat = explode(";", $rat[1]);
        $n_str = "";
        $meio = false;
        // achar um jeito de juntar os dois arrays
        for ($i = 0; $i < count($arr_c); $i++) {
            // se for o primeiro espaço e posição nao for zero
        	if ($i == 0 && $i != $posicao && $posicao != (count($arr_c) - 1)) {
                // atribui o primeiro bool existente no novo array
        		$n_str = array($arr_rat[$i]);
                array_shift($arr_rat);
        	}
            // se posicao for zero
        	elseif ($i == 0 && $i == $posicao) {
                // inicia o array com zero
        		$n_str = array(0);
                // preenche com o restante de bool
                for ($x = 0; $x < (count($arr_c) - $i); $x++) {
                    if ($arr_rat[$i + $x] != '') {
                        array_push($n_str, $arr_rat[$i + $x]);   
                    }
                }
        	}
            // se posição for o último
            elseif ($i == 0 && $posicao == (count($arr_c) - 1)) {
                $n_str = array($arr_rat[$i]);
                // preenche com os bools existentes
                for ($x = 1; $x < count($arr_c) - 1; $x++) {
                    array_push($n_str, $arr_rat[$x]);   
                }
                // termina o novo array com zero
                array_push($n_str, 0);
            }
            // se estiver em qualquer lugar no meio
            elseif ($i != 0 && $posicao != (count($arr_c) - 1) && $meio == false && $posicao != 0) {
                if ($posicao != $i) {
                    if ($arr_rat[0] != '') {
                        array_push($n_str, $arr_rat[0]);
                        array_shift($arr_rat);
                    }
                }
                else {
                    array_push($n_str, 0);
                    for ($x = $posicao; $x < count($arr_c); $x++) {
                        if ($arr_rat[0] != '') {
                            array_push($n_str, $arr_rat[0]);
                            array_shift($arr_rat);
                        }
                    }
                    $meio = true;
                }
            }
        }

        $insert_str = implode(";", $n_str);

        $insert_rat = "UPDATE c_rateio SET `rateio` = '$insert_str' WHERE `contas` = '$rat[0]'";
        $insert_rat = mysqli_query($connection, $insert_rat) or die($connection);
    }
}
// se já houver dados
else {
	$query = "SELECT * FROM c_custo WHERE cc = '$cc'";
	$query = mysqli_query($connection, $query) or die($connection);
	$query = mysqli_fetch_assoc($query);

	$atividade = "Relizado atualiza&ccedil;&atilde;o cadastral do centro de custo " . $query['centro_custo'] . ": " . $query['centro_custo'] . " -> " . $centro . "; " . $query['cc'] . " -> " . $cc . ".";
    
    $rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
    $rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);

    $atualizar_cargo = "UPDATE c_custo SET centro_custo = '$centro', cc = '$cc' WHERE cc = '$cc' OR centro_custo = '$centro'";
	$atualizar_cargo = mysqli_query($connection, $atualizar_cargo) or die($connection);
}
?>