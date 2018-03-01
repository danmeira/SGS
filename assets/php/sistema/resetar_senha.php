<?php
session_start();
//defini fuso horario
date_default_timezone_set("America/Sao_Paulo");
//conecta com banco de dados
require("../connect.php");
//recupera nome de usuario logado
$usuario = $_SESSION['nome'];

$id = $_REQUEST['id'];
$nome = $_REQUEST['nome'];
$nome = hash("sha1", $nome);

$hoje = date("y.m.d");
$hora = date("H:i:s");

$ver = "SELECT * FROM s_usuarios WHERE id = '$id'";
$ver_send = mysqli_query($connection, $ver) or die($connection);
$view = mysqli_fetch_row($ver_send);

$reset = "UPDATE `s_usuarios` SET `id`='$view[0]',`nome`='$view[1]',`nivel`='$view[2]',`senha`='$nome',`resetado`=1 WHERE id = '$id'";
$reset = mysqli_query($connection, $reset) or die($connection);

$atividade = "Usu&aacute;rio " . $view[1] . " de ID " . $id ." teve sua senha resetada.";

$rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
$rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);

if($view[1] == $usuario){
	$_SESSION['resetado'] = 1;
}
?>