<?php
session_start();
require('connect.php');

date_default_timezone_set("America/Sao_Paulo");
header('Content-Type: text/html; charset=utf8');
$hoje = date("y.m.d");
$hora = date("H:i:s");

//manda dados postados para variáveis.
$password = hash("sha1", $_POST['password']);

if (isset($_POST['password'])){
    //Checa se os dados exisem ou não no banco de dados.
    $query = "SELECT * FROM `s_usuarios` WHERE senha='$password'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $show = mysqli_fetch_assoc($result);
}
//verifica se os dados das variáveis são iguais aos do banco de dados.
if ($show['senha'] == $password){
    $_SESSION['id'] = $show['id'];
    $_SESSION['nome'] = $show['nome'];
    $_SESSION['nivel'] = $show['nivel'];
    $_SESSION['senha'] = $show['senha'];
    $_SESSION['resetado'] = $show['resetado'];
    
    header("Location: ../../dashboard.php");

    $usuario = $_SESSION['nome'];

    $atividade = "Usu&aacute;rio " . $_SESSION['nome'] . " de ID " . $_SESSION['id'] . " efetuou login.";
        
    $rel_ativ = "INSERT INTO s_atividade (data, hora, atividade, usuario) VALUES ('$hoje', '$hora', '$atividade', '$usuario')";
    $rel_ativ = mysqli_query($connection, $rel_ativ) or die($connection);
}
//se os dados não baterem com o banco de dados.
else{
    $fmsg = "Credenciais inválidas.";
    echo $fmsg;
    header('Location: ../../index.php');
}

?>