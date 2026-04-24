<?php
// Adicione a porta 3306 ao final do IP fixo
$servername = "172.18.0.10:3306"; 
$username = "root";
$password = "rootpassword";
$database = "wall";

// O @ esconde warnings irrelevantes, focando no erro real se falhar
$connection = mysql_connect($servername, $username, $password);

if (!$connection) {
    die("Erro real: " . mysql_error());
}

mysql_select_db($database, $connection);
?>