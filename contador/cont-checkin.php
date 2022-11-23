<?php 
    include './db.php';
    $sql = "SELECT * FROM habitacion WHERE check_in_estado = '1'";
    $query = $connection->query($sql);

    echo "$query->num_rows";

?>