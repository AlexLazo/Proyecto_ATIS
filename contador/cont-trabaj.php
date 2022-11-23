<?php 
    include './db.php';
    $sql = "SELECT * FROM personal";
    $query = $connection->query($sql);

    echo "$query->num_rows";
?>