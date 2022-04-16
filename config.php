<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "";

$connection = mysqli_connect($server, $username, $password, $database);

if(!$connection) {
    die("<script>Connection Failed</script>");
}