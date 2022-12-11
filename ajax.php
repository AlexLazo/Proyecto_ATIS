<?php
include_once 'db.php';
session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!$email && !$password) {
        header('Location:login.php?empty');
    } else {
        $password = md5($password);
        $query = "SELECT * FROM usuario WHERE username = '$email' OR email='$email' AND passw='$password'";
        $result = mysqli_query($connection, $query);
        if ($datos=$result->fetch_object()) {
            $_SESSION['username']=$datos->username;
            $_SESSION['user_id'] = $datos->id;
            header('Location:index.php?dashboard');
        } else {
            header('Location:login.php?loginE');
        }
    }
}


//Agregar habitacion
if (isset($_POST['add_room'])) {
    $room_type_id = $_POST['id_tipohabitacion'];
    $room_no = $_POST['numeroHabitacion'];

    if ($room_no != '') {
        $sql = "SELECT * FROM habitacion WHERE numeroHabitacion = '$room_no'";
        if (mysqli_num_rows(mysqli_query($connection, $sql)) >= 1) {
            $response['done'] = false;
            $response['data'] = "N° de Habitación ya existe";
        } else {
            $query = "INSERT INTO habitacion (id_tipohabitacion,numeroHabitacion) VALUES ('$room_type_id','$room_no')";
            $result = mysqli_query($connection, $query);

            if ($result) {
                $response['done'] = true;
                $response['data'] = 'Habitación agregada correctamente';
            } else {
                $response['done'] = false;
                $response['data'] = "Error de Base de Datos";
            }
        }
    } else {

        $response['done'] = false;
        $response['data'] = "Por favor ingresa el N° de Habitación";
    }

    echo json_encode($response);
}




if (isset($_POST['room'])) {
    $room_id = $_POST['id_habitacion'];

    $sql = "SELECT * FROM habitacion WHERE id_habitacion = '$room_id'";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        $room = mysqli_fetch_assoc($result);
        $response['done'] = true;
        $response['room_no'] = $room['numeroHabitacion'];
        $response['room_type_id'] = $room['id_tipohabitacion'];
    } else {
        $response['done'] = false;
        $response['data'] = "Error de Base de Datos";
    }

    echo json_encode($response);
}

//Editar habitacion
if (isset($_POST['edit_room'])) {
    $room_type_id = $_POST['id_tipohabitacion'];
    $room_no = $_POST['numeroHabitacion'];
    $room_id = $_POST['id_habitacion'];

    if ($room_no != '') {
        $query = "UPDATE habitacion SET numeroHabitacion = '$room_no', id_tipohabitacion = '$room_type_id' where id_habitacion = '$room_id'";
        $result = mysqli_query($connection, $query);

        if ($result) {
            $response['done'] = true;
            $response['data'] = 'Habitación actualizada correctamente';
        } else {
            $response['done'] = false;
            $response['data'] = "Error de Base de Datos";
        }

    } else {

        $response['done'] = false;
        $response['data'] = "Por favor ingresa un N° de Habitación";
    }

    echo json_encode($response);
}

//Función para eliminar cuartos
if (isset($_GET['delete_room'])) {
    $room_id = $_GET['delete_room'];
    $sql = "UPDATE habitacion SET EliminarEstado = '1' WHERE id_Habitacion = '$room_id' AND estado IS NULL";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        header("Location:index.php?manejo_cuart&success");
    } else {
        header("Location:index.php?manejo_cuart&error");
    }
}


///Función para seleccionar el tipo de habitación
if (isset($_POST['room_type'])) {
    $room_type_id = $_POST['id_tipohabitacion'];

    $sql = "SELECT * FROM habitacion WHERE id_tipohabitacion = '$room_type_id' AND estado IS NULL AND EliminarEstado = '0'";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        echo "<option selected disabled>Seleccione el Tipo de Habitación</option>";
        while ($room = mysqli_fetch_assoc($result)) {
            echo "<option value='" . $room['id_habitacion'] . "'>" . $room['numeroHabitacion'] . "</option>";
        }
    } else {
        echo "<option>No Available</option>";
    }
}

//Precio habitación
if (isset($_POST['room_price'])) {
    $room_id = $_POST['id_habitacion'];

    $sql = "SELECT * FROM habitacion NATURAL JOIN tipohabitacion WHERE id_habitacion = '$room_id'";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        $room = mysqli_fetch_assoc($result);
        echo $room['precio'];
    } else {
        echo "0";
    }
}


///Funcion para reservas
if (isset($_POST['booking'])) {
    $room_id = $_POST['room_id'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $total_price = $_POST['total_price'];
    $name = $_POST['name'];
    $contact_no = $_POST['contact_no'];
    $email = $_POST['email'];
    $id_card_id = $_POST['id_card_id'];
    $id_card_no = $_POST['id_card_no'];
    $address = $_POST['address'];
    
    $customer_sql = "INSERT INTO cliente (nombre,contacto,email,id_tipodocumento,n_tarjeta,direccion) VALUES ('$name','$contact_no','$email','$id_card_id','$id_card_no','$address')";
    $customer_result = mysqli_query($connection, $customer_sql);

    if ($customer_result) {
        $customer_id = mysqli_insert_id($connection);
        $booking_sql = "INSERT INTO reservacion (id_cliente,id_habitacion,check_in,check_out,precioTotal,precioRestante) VALUES ('$customer_id','$room_id','$check_in','$check_out','$total_price','$total_price')";
        $booking_result = mysqli_query($connection, $booking_sql);
        if ($booking_result) {
            $room_stats_sql = "UPDATE habitacion SET estado = '1' WHERE id_habitacion = '$room_id'";
            if (mysqli_query($connection, $room_stats_sql)) {
                $response['done'] = true;
                $response['data'] = 'Correctamente agregado';
            } else {
                $response['done'] = false;
                $response['data'] = "Error en la base de Datos en el Cambio de Estado";
            }
        } else {
            $response['done'] = false;
            $response['data'] = "Error en la Base de Datos al hacer el cambio";
        }
    } else {
        $response['done'] = false;
        $response['data'] = "Error en la Base de Datos al agregar el Cliente";
    }

    echo json_encode($response);
}


////Funcionalidad del Modal para detalles del Cliente
if (isset($_POST['customerDetails'])) {
    $room_id = $_POST['room_id'];

    if ($room_id != '') {
        $sql = "SELECT * FROM habitacion NATURAL JOIN tipohabitacion NATURAL JOIN reservacion NATURAL JOIN cliente WHERE id_habitacion = '$room_id' AND EstadoPago = '0'";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            $customer_details = mysqli_fetch_assoc($result);
            $id_type = $customer_details['id_tipodocumento'];
            $query = "SELECT tipotarjeta FROM tipo_documento WHERE id_tipodocumento = '$id_type'";
            $result = mysqli_query($connection, $query);
            $id_type_name = mysqli_fetch_assoc($result);
            $response['done'] = true;
            $response['customer_id'] = $customer_details['id_cliente'];
            $response['customer_name'] = $customer_details['nombre'];
            $response['contact_no'] = $customer_details['contacto'];
            $response['email'] = $customer_details['email'];
            $response['id_card_no'] = $customer_details['n_tarjeta'];
            $response['id_card_type_id'] = $id_type_name['tipotarjeta'];
            $response['address'] = $customer_details['direccion'];
            $response['remaining_price'] = $customer_details['precioRestante'];
        } else {
            $response['done'] = false;
            $response['data'] = "DataBase Error";
        }

        echo json_encode($response);
    }
}


//Funcionalidad para las habitaciones reservadas
if (isset($_POST['booked_room'])) {
    $room_id = $_POST['room_id'];

    $sql = "SELECT * FROM habitacion NATURAL JOIN tipohabitacion NATURAL JOIN reservacion NATURAL JOIN cliente WHERE id_habitacion = '$room_id' AND EstadoPago = '0'";
    $result = mysqli_query($connection, $sql);
    if ($result) {
        $room = mysqli_fetch_assoc($result);
        $response['done'] = true;
        $response['booking_id'] = $room['id_reservacion'];
        $response['name'] = $room['nombre'];
        $response['room_no'] = $room['numeroHabitacion'];
        $response['room_type'] = $room['tipohabitacion'];
        $response['check_in'] = date('M j, Y', strtotime($room['check_in']));
        $response['check_out'] = date('M j, Y', strtotime($room['check_out']));
        $response['total_price'] = $room['precioTotal'];
        $response['remaining_price'] = $room['precioRestante'];
    } else {
        $response['done'] = false;
        $response['data'] = "Error";
    }

    echo json_encode($response);
}



////Funcionalidad del Modal de Check-In
if (isset($_POST['check_in_room'])) {
    $booking_id = $_POST['booking_id'];
    $advance_payment = $_POST['advance_payment'];

    if ($booking_id != '') {
        $sql = "SELECT * FROM reservacion WHERE id_reservacion = '$booking_id'";
        $result = mysqli_query($connection, $sql);
        $booking_details = mysqli_fetch_assoc($result);
        $room_id = $booking_details['id_habitacion'];
        $remaining_price = $booking_details['precioTotal'] - $advance_payment;

        $updateBooking = "UPDATE reservacion SET precioRestante = '$remaining_price' where id_reservacion = '$booking_id'";
        $result = mysqli_query($connection, $updateBooking);
        if ($result) {
            $updateRoom = "UPDATE habitacion SET check_in_Estado = '1' WHERE id_habitacion = '$room_id'";
            $updateResult = mysqli_query($connection, $updateRoom);
            if ($updateResult) {
                $response['done'] = true;
            } else {
                $response['done'] = false;
                $response['data'] = "Problema en actualizar el estado de la habitación";
            }
        } else {
            $response['done'] = false;
            $response['data'] = "Problema en el Pago";
        }
    } else {
        $response['done'] = false;
        $response['data'] = "Error con el Registro";
    }
    echo json_encode($response);
}


////Funcionalidad del Modal de Check-Out
if (isset($_POST['check_out_room'])) {
    $booking_id = $_POST['booking_id'];
    $remaining_amount = $_POST['remaining_amount'];

    if ($booking_id != '') {
        $query = "SELECT * FROM reservacion where id_reservacion = '$booking_id'";
        $result = mysqli_query($connection, $query);
        $booking_details = mysqli_fetch_assoc($result);
        $room_id = $booking_details['id_habitacion'];
        $remaining_price = $booking_details['precioRestante'];

        if ($remaining_price == $remaining_amount) {
            $updateBooking = "UPDATE reservacion SET precioRestante = '0', EstadoPago = '1' where id_reservacion= '$booking_id'";
            $result = mysqli_query($connection, $updateBooking);
            if ($result) {
                $updateRoom = "UPDATE habitacion SET estado = NULL,check_in_Estado = '0',check_out_Estado = '1' WHERE id_habitacion = '$room_id'";
                $updateResult = mysqli_query($connection, $updateRoom);
                if ($updateResult) {
                    $response['done'] = true;
                } else {
                    $response['done'] = false;
                    $response['data'] = "Problem in Update Room Check in status";
                }
            } else {
                $response['done'] = false;
                $response['data'] = "Problem en el pago";
            }

        } else {
            $response['done'] = false;
            $response['data'] = "Por favor ingresa el pago completo";
        }
    } else {
        $response['done'] = false;
        $response['data'] = "Error en la reservacion";
    }
    echo json_encode($response);
}


//Agregar empledo
if (isset($_POST['add_employee'])) {

    $staff_type = $_POST['staff_type'];
    $shift = $_POST['shift'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $name = $first_name . ' ' . $last_name;
    $contact_no = $_POST['contact_no'];
    $id_card_id = $_POST['id_card_id'];
    $id_card_no = $_POST['id_card_no'];
    $address = $_POST['address'];
    $salary = $_POST['salary'];

    if ($staff_type == '' && $shift == '' && $salary == ''){
        $response['done'] = false;
        $response['data'] = "Please Enter Carednalities";
    }else{
        $customer_sql = "INSERT INTO personal (nombre,id_tipopersonal,id_cambio,id_tipodocumento,numeroTarjeta,direccion,telefono,salario) VALUES ('$name','$staff_type','$shift','$id_card_id','$id_card_no','$address','$contact_no','$salary')";
        $customer_result = mysqli_query($connection, $customer_sql);
        $emp_id = mysqli_insert_id($connection);
        $insert = "INSERT INTO historiaempleado (id_empleado,id_cambio) VALUES ('$emp_id','$shift')";
        $insert_result = mysqli_query($connection,$insert);
        if ($customer_result && $insert_result) {
            $response['done'] = true;
            $response['data'] = 'Agregado correctamente';
        } else {
            $response['done'] = false;
            $response['data'] = "Error de la Base de Datos en el cambio de Estado";
        }
    }
    echo json_encode($response);
}


//Crear queja
if (isset($_POST['createComplaint'])) {
    $complaint_name = $_POST['complaint_name'];
    $complaint_type = $_POST['complaint_type'];
    $complaint = $_POST['complaint'];

    $query = "INSERT INTO quejas(nombreQueja,tipoQueja,Queja) VALUES ('$complaint_name','$complaint_type','$complaint')";
    $result = mysqli_query($connection, $query);
    if ($result) {
        header("Location:index.php?quejas&success");
    } else {
        header("Location:index.php?quejas&error");
    }

}

//Resolver queja
if (isset($_POST['resolve_complaint'])) {
    $budget = $_POST['budget'];
    $complaint_id = $_POST['complaint_id'];
    $query = "UPDATE quejas set presupuesto = '$budget',EstadoResolucion = '1' WHERE id='$complaint_id'";
    $result = mysqli_query($connection, $query);
    if ($result) {
        header("Location:index.php?quejas&resolveSuccess");
    } else {
        header("Location:index.php?quejas&resolveError");
    }
}

//Cambio de turno
if (isset($_POST['change_shift'])) {
    $emp_id = $_POST['emp_id'];
    $shift_id = $_POST['shift_id'];
    $query = "UPDATE personal SET id_cambio = '$shift_id' WHERE id_empleado='$emp_id'";
    $result = mysqli_query($connection, $query);
    $to_date = date("Y-m-d H:i:s");
    $update = "UPDATE historiaempleado SET to_date = '$to_date' WHERE id_empleado = '$emp_id' AND to_date IS NULL";
    $update_result = mysqli_query($connection,$update);
    $insert = "INSERT INTO historiaempleado(id_empleado,id_cambio) VALUES ('$emp_id','$shift_id')";
    $insert_result = mysqli_query($connection,$insert);

    if ($result && $insert_result && $update_result) {
        header("Location:index.php?manejo_trabaj&success");
    } else {
        header("Location:index.php?manejo_trabaj&error");
    }
}
