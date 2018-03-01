<?php
session_start();

require('connect.php');

date_default_timezone_set("America/Sao_Paulo");
header('Content-Type: text/html; charset=utf8');
$hoje = date("y.m.d");
$hora = date("H:i:s");

$usuario = $_SESSION['nome'];

$atividade = "Usu&aacute;rio " . $_SESSION['nome'] . " de ID " . $_SESSION['id'] . " efetuou logoff.";
    
$rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
$rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);

session_destroy();
header('Location: ../../index.php');
?>