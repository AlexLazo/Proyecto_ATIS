<?php 
    include './db.php';
    $sql = "SELECT * FROM reservacion";
    $query = $connection->query($sql);

    echo "$query->num_rows";

?>