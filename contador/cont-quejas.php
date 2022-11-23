<?php 
    include './db.php';
    $sql = "SELECT * FROM quejas";
    $query = $connection->query($sql);

    echo "$query->num_rows";

?>