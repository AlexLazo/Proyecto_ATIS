<?php 
    include 'db.php';
    $sql = "SELECT * FROM habitacion WHERE estado IS NULL AND EliminarEstado = '0'";
    $query = $connection->query($sql);

    echo "$query->num_rows";

?>