<?php
session_start();
//defini fuso horario
date_default_timezone_set("America/Sao_Paulo");
//conecta com banco de dados
require("../connect.php");
//recupera nome de usuario logado
$usuario = $_SESSION['nome'];

$id = $_REQUEST['id'];

$hoje = date("Y.m.d");
$hora = date("H:i:s");

$ver = "SELECT * FROM s_usuarios WHERE id = '$id'";
$ver_send = mysqli_query($connection, $ver) or die($connection);
$view = mysqli_fetch_row($ver_send);

$atividade = "Usuário " . utf8_encode($view[1]) . " de ID " . $id ." removido.";
$atividade = utf8_decode(urldecode($atividade));

$rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
$rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);

$query = "DELETE FROM s_usuarios WHERE id = '$id'";
$query = mysqli_query($connection, $query) or die($query);
?>