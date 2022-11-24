<?php 
    include './db.php';
    $sql = "SELECT * FROM habitacion WHERE estado = '1'";
    $query = $connection->query($sql);

    echo "$query->num_rows";

?>