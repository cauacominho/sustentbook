<?php

$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "";

$connect = new mysqli($host, $usuario, $senha, $banco);

if (!isset($connect)) {
    echo die("Database connection failed");
}
