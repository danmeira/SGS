<?php
session_start();
//defini fuso horario
date_default_timezone_set("America/Sao_Paulo");
header('Content-Type: text/html; charset=utf8');
//conecta com banco de dados
require("connect.php");
//recupera nome de usuario logado
$usuario = $_SESSION['nome'];
$id = $_SESSION['id'];

$senha = $_REQUEST['senha'];
$senha = hash("sha1", $senha);

$hoje = date("y.m.d");
$hora = date("H:i:s");

$update = "UPDATE `s_usuarios` SET `senha`='$senha', `resetado` = 0 WHERE id = '$id'";
$update = mysqli_query($connection, $update) or die($connection);

$atividade = "Usu&aacute;rio " . $usuario . " de ID " . $id . " realizou o cadastro de uma nova senha.";
    
$rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
$rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);

//$_SESSION['id'] = 0;
?>