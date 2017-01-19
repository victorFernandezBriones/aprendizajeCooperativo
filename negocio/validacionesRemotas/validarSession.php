<?php

require_once '../data/Usuario.php';

$sessionUsuario = new Usuario();
session_start();
$sessionUsuario = $_SESSION['usuario'];

if ($sessionUsuario == "") {
    header("location:../index.php");
}
