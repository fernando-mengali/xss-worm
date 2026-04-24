<?php
error_reporting(0);
include("includes/db.php");

if (isset($_POST['check_path'])) {
    $path = $_POST['check_path'];

    $username=mysql_real_escape_string($username);
    $query=mysql_query("SELECT * FROM verifica WHERE user='$path'");

    if(mysql_num_rows($query)==0)
        {
            mysql_query("INSERT INTO verifica(user)VALUES('$path')");
            echo "0";
            exit;
        }
    else {
            echo "1";
            exit;
        }
}