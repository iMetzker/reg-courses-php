<?php 

session_start();

$BASE_URL = "http://" . $_SERVER["SERVER_NAME"] . dirname($_SERVER["REQUEST_URI"]. "?") . "/";

$db_name = "cadcursos";
$db_host = "localhost";
$db_user = "root";
$db_pass = "";

$connect = new PDO("mysql:dbname=" . $db_name . ";host=" . $db_host, $db_user, $db_pass);