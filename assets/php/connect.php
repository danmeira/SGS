<?php
$connection = mysqli_connect("127.0.0.1", "root", "", "sgs_db");
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'sgs_db');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}
?>

