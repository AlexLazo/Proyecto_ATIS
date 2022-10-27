<?php
include_once "db.php";
session_start();

if (isset($_SESSION['id_Usuario'])){
    $id_Usuario = $_SESSION['id_Usuario'];
    $userQuery = "SELECT * FROM user WHERE id_Usuario = '$id_Usuario'";
    $result = mysqli_query($connection, $userQuery);
    $user = mysqli_fetch_assoc($result);
}else{
    header('Location:login.php');
}

include_once "header.php";
include_once "barra.php";

if (isset($_GET['manejo_cuart'])){
    include_once "manejo_cuart.php";
}
elseif (isset($_GET['dashboard'])){
    include_once "dashboard.php";
}
elseif (isset($_GET['reservation'])){
    include_once "reservation.php";
}
elseif (isset($_GET['manejo_trabaj'])){
    include_once "manejo_trabaj.php";
}
elseif (isset($_GET['quejas'])){
    include_once "quejas.php";
}
elseif (isset($_GET['estadist'])){
    include_once "estadist.php";
}
elseif (isset($_GET['emp_history'])){
    include_once "emp_history.php";
}
else{
    include_once "manejo_cuart.php";
}

include_once "footer.php";