<?php
include_once 'db.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    echo $username;
    echo $password;
    $query = "select * from login where username = '$username' and password='$password'";
    $result = mysqli_query($connection, $query);

    $userdetails = mysqli_fetch_assoc($result);

    if($userdetails['username']=='manager')
    {
        header('Location: index.php?manejo_cuart');
    }
    else{

        header('Location: login.php');
    }


}