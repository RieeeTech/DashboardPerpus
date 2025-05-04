<?php

$host = "localhost";
$username = "root";
$password = "";
$database_name = "db_perpus1";

$db = mysqli_connect($host, $username, $password, $database_name); 

if ($db->connect_error){
  die("erorr!");
}

?>