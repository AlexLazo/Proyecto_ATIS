<?php 
    include './db.php';
    $sql = "SELECT * FROM habitacion WHERE EliminarEstado = '0'";
    $query = $connection->query($sql);

    echo "$query->num_rows";

?>