<?php
session_start();
//defini fuso horario
date_default_timezone_set("America/Sao_Paulo");
//conecta com banco de dados
require("../connect.php");
//recupera nome de usuario logado
$usuario = $_SESSION['nome'];

$cod = $_REQUEST['cod'];

$hoje = date("Y.m.d");
$hora = date("H:i:s");

$ver = "SELECT * FROM c_itens WHERE id = '$cod'";
$ver_send = mysqli_query($connection, $ver) or die($connection);
$view = mysqli_fetch_row($ver_send);

$atividade = "Item " . utf8_encode($view[2]) . " removido.";
$atividade = utf8_decode(urldecode($atividade));

$rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
$rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);

$query = "DELETE FROM c_itens WHERE id = '$cod'";
$query = mysqli_query($connection, $query) or die($query);
?>