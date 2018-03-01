<?php
session_start();
//defini fuso horario
date_default_timezone_set("America/Sao_Paulo");
header('Content-Type: text/html; charset=utf8');
//conecta com banco de dados
require("../connect.php");
//recupera nome de usuario logado
$usuario = $_SESSION['nome'];
// recupera iformações do formulário
$id = $_REQUEST['id'];
$nome = $_REQUEST['nome'];
$nome = utf8_decode($nome);
$nivel = $_REQUEST['nivel'];
$senha = $_REQUEST['senha'];
// seta dia e hora
$hoje = date("y.m.d");
$hora = date("H:i:s");
// se id não estiver vazio (caso o usuário existe)
if($id != ""){
    // busca as informações do usuário existente
    $ver = "SELECT * FROM s_usuarios WHERE id = '$id'";
    $ver = mysqli_query($connection, $ver) or die($connection);
    $view = mysqli_fetch_row($ver);

    //muda os três
    if($view[1] != $nome and $view[2] != $nivel and $view[3] != $senha){
        $atividade = "Alterou nome de " . $view[1] . " para " . $nome . ", n&iacute;vel de " .  utf8_decode($view[2]) . " para " . utf8_decode($nivel) . " e a senha foi alterada";
        $senha = hash("sha1", $senha);
        //envia novamente o nome para a sessão
        if($id == $_SESSION['id']){
            $_SESSION['nome'] = $nome;
        }
    }
    //muda só o nome
    else if($view[1] != $nome and $view[2] == $nivel and $view[3] == $senha){
        $atividade = "Alterou nome de " . $view[1] . " para " . $nome . ".";
        //envia novamente o nome para a sessão
        if($id == $_SESSION['id']){
            $_SESSION['nome'] = $nome;
        }
    }
    //muda só o nível
    else if($view[1] == $nome and $view[2] != $nivel and $view[3] == $senha){
        $atividade = "Alterou n&iacute;vel do usu&aacute;rio " . $view[1] . " de " . utf8_decode($view[2]) . " para " . utf8_decode($nivel) . ".";
    }
    //muda só a senha
    else if($view[1] == $nome and $view[2] == $nivel and $view[3] != $senha){
        $atividade = "Alterou senha do usu&aacute;rio " . $view[1] . ".";
        $senha = hash("sha1", $senha);
    }
    //muda nome e nível
    else if($view[1] != $nome and $view[2] != $nivel and $view[3] == $senha){
        $atividade = "Alterou nome de " . $view[1] . " para " . $nome . " e n&iacute;vel de " . utf8_decode($view[2]) . " para " . utf8_decode($nivel) . ".";
        //envia novamente o nome para a sessão
        if($id == $_SESSION['id']){
            $_SESSION['nome'] = $nome;
        }
    }
    //muda nome e senha
    else if($view[1] != $nome and $view[2] == $nivel and $view[3] != $senha){
        $atividade = "Alterou nome de " . $view[1] . " para " . $nome . " e alterou senha.";
        $senha = hash("sha1", $senha);
        //envia novamente o nome para a sessão
        if($id == $_SESSION['id']){
            $_SESSION['nome'] = $nome;
        }
    }
    //muda nivel e senha
    else if($view[1] == $nome and $view[2] != $nivel and $view[3] != $senha){
        $atividade = "Alterou n&iacute;vel de " . utf8_decode($view[2]) . " para " . utf8_decode($nivel) . " e alterou senha.";
        $senha = hash("sha1", $senha);
    }
    //não muda nada
    else{
        $atividade = "Sem altera&ccedil;&otilde;es.";
        utf8_decode(urldecode($atividade));
    }
    // realiza a atualização do cadastro
    $update = "UPDATE `s_usuarios` SET `nome`='$nome',`nivel`='$nivel',`senha`='$senha' WHERE id = '$id'";
    $update = mysqli_query($connection, $update) or die($connection);
    // manda relatório de atividade
    $rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
    $rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);
}
if($id == ""){
    // efetua o hashing da senha
    $senha = hash("sha1", $senha);
    // cria o usuário
    $cad_query = "INSERT INTO s_usuarios (nome, nivel, senha) VALUES('$nome', '$nivel', '$senha')";
    $send = mysqli_query($connection, $cad_query) or die($connection);
    // seta tipo de atividade
    $atividade = "Realizado cadastro do usu&aacute;rio " . $nome . ", cujo n&iacute;vel &eacute; " . utf8_decode($nivel) . ".";
    // envia relatório de atividade
    $rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
    $rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);
}
?>