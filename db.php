<?php
$servidor = "localhost";
$bd = "hotelsystem";
$usuario = "root";
$password = "";
// Create connection
$connection = new mysqli($servidor, $usuario, $password, $bd);
// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
// echo "Connected successfully";
// mysqli_close($conexion);
?>