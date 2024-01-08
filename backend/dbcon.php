<?php

$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'restaurantsystems';
$port = 3311;

$con = mysqli_connect($hostname, $username, $password, $dbname, $port);

if (!$con) {
    echo "Connection Fail";
    die();
}