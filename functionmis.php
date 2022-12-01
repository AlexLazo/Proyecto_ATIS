<?php
include_once 'db.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    echo $username;
    echo $password;
    $query = "SELECT * FROM login WHERE username = '$username' and password='$password'";
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
if (isset($_POST['submit'])) {

    $emp_id = $_POST['emp_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $staff_type_id = $_POST['staff_type_id'];
    $shift_id= $_POST['shift_id'];
    $id_card_type = $_POST['id_card_type'];
    $id_card_no = $_POST['id_card_no'];
    $address = $_POST['address'];
    $contact_no = $_POST['contact_no'];
    $joining_date = strtotime($_POST['joining_date']);
    $salary = $_POST['salary'];

    $query="UPDATE personal
SET nombre='$first_name $last_name', id_tipopersonal='$staff_type_id', id_cambio='$shift_id', id_tipodocumento=$id_card_type,
numeroTarjeta='$id_card_no',direccion='$address',telefono='$contact_no',diaIngreso='$joining_date',salario='$salary'
WHERE id_empleado=$emp_id ";
//echo $query;
    if (mysqli_query($connection, $query)) {
        header('Location: index.php?manejo_trabaj&success');
    } else {
        echo "Error actualizando el registro: " . mysqli_error($connection);
    }

}

if (isset($_GET['empid'])!="")
{
   $emp_id=$_GET['empid'];
    $deleteQuery = "DELETE FROM personal WHERE id_empleado = $emp_id";
    if (mysqli_query($connection, $deleteQuery)) {
        header('Location: index.php?manejo_trabaj');
    } else {
        echo "Error actualizando el registro: " . mysqli_error($connection);
    }
}

?>