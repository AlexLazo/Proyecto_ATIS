<?php 
    include './db.php';
    $sql = "SELECT SUM(precioTotal) FROM reservacion WHERE EstadoPago = '0'";
    // $query = $connection->query($sql);
    $amountsum = mysqli_query($connection, $sql) or die(mysqli_error($sql));
        $row_amountsum = mysqli_fetch_assoc($amountsum);
        $totalRows_amountsum = mysqli_num_rows($amountsum);
    echo $row_amountsum['SUM(precioTotal)'];


?>