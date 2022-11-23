<?php 
    include './db.php';
    $sql = "SELECT * FROM habitacion WHERE status = '1'";
    $query = $connection->query($sql);

    echo "$query->num_rows";

?>