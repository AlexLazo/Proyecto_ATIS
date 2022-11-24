<?php 
    include './db.php';
    $sql = "SELECT * FROM reservacion WHERE EstadoPago = '0'";
    $query = $connection->query($sql);

    echo "$query->num_rows";

?>