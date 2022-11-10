<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Manejo de Habitaciones</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Administrar habitaciones
                    <button class="btn btn-secondary pull-right" style="border-radius:0%" data-toggle="modal" data-target="#addRoom">Agregar habitaciones</button>
                </div>
                <div class="panel-body">
                    <?php
                    if (isset($_GET['error'])) {
                        echo "<div class='alert alert-danger'>
                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Error on Delete !
                            </div>";
                    }
                    if (isset($_GET['success'])) {
                        echo "<div class='alert alert-success'>
                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Successfully Delete !
                            </div>";
                    }
                    ?>
                    <table class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%"
                           id="rooms">
                        <thead>
                        <tr>
                            <th>N° Habitación</th>
                            <th>Tipo de habitación</th>
                            <th>Estado de reservación</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Accion</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $habitacion_query = "SELECT * FROM habitacion NATURAL JOIN tipohabitacion WHERE EliminarEstado = 0";
                        $habitaciones_result = mysqli_query($connection, $habitacion_query);
                        if (mysqli_num_rows($habitaciones_result) > 0) {
                            while ($habitaciones = mysqli_fetch_assoc($habitaciones_result)) { ?>
                                <tr>
                                    <td><?php echo $habitaciones['numeroHabitacion'] ?></td>
                                    <td><?php echo $habitaciones['tipohabitacion'] ?></td>
                                    <td>
                                        <?php
                                        if ($habitaciones['estado'] == 0) {
                                            echo '<a href="index.php?reservation&room_id=' . $habitaciones['idHabitacion'] . '&id_tipohabitacion=' . $habitaciones['id_tipohabitacion'] . '" class="btn btn-success" style="border-radius:0%">Book Room</a>';
                                        } else {
                                            echo '<a href="#" class="btn btn-danger" style="border-radius:0%">Reservados</a>';
                                        }
                                        ?>


                                    <td>
                                        <?php
                                        if ($habitaciones['estado'] == 1 && $habitaciones['check_in_Estado'] == 0) {
                                            echo '<button class="btn btn-warning" id="checkInRoom"  data-id="' . $habitaciones['idHabitacion'] . '" data-toggle="modal" style="border-radius:0%" data-target="#checkIn">Check In</button>';
                                        } elseif ($habitaciones['estado'] == 0) {
                                            echo '-';
                                        } else {

                                            echo '<a href="#" class="btn btn-danger" style="border-radius:0%">Checked In</a>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($habitaciones['estado'] == 1 && $habitaciones['check_in_Estado'] == 1) {
                                            echo '<button class="btn btn-primary" style="border-radius:0%" id="checkOutRoom" data-id="' . $habitaciones['idHabitacion'] . '">Check Out</button>';
                                        } elseif ($habitaciones['estado'] == 0) {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                    <td>

                                        <button title="Edit Room Information" style="border-radius:60px;" data-toggle="modal"
                                                data-target="#editRoom" data-id="<?php echo $habitaciones['idHabitacion']; ?>"
                                                id="roomEdit" class="btn btn-info"><i class="fa fa-pencil"></i></button>
                                        <?php
                                        if ($habitaciones['estado'] == 1) {
                                            echo '<button title="Customer Information" data-toggle="modal" data-target="#cutomerDetailsModal" data-id="' . $habitaciones['idHabitacion'] . '" id="cutomerDetails" class="btn btn-warning" style="border-radius:60px;"><i class="fa fa-eye"></i></button>';
                                        }
                                        ?>

                                        <a href="ajax.php?delete_room=<?php echo $habitaciones['idHabitaciones']; ?>"
                                           class="btn btn-danger" style="border-radius:60px;" onclick="return confirm('¿Estás seguro?')"><i
                                                    class="fa fa-trash" alt="delete"></i></a>
                                    </td>
                                </tr>
                            <?php }
                        } else {
                            echo "No hay habitaciones";
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Agregar habitación Modal -->
    <div id="addRoom" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Agregar nueva habitación</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="addRoom" data-toggle="validator" role="form">
                                <div class="response"></div>
                                <div class="form-group">
                                    <label>Tipo habitación</label>
                                    <select class="form-control" id="id_tipohabitacion" required
                                            data-error="Seleccione un tipo de habitación">
                                        <option selected disabled>Seleccionar tipo de habitación</option>
                                        <?php
                                        $query = "SELECT * FROM tipohabitacion";
                                        $result = mysqli_query($connection, $query);
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($tipohabitacion = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $tipohabitacion['id_tipohabitacion'] . '">' . $tipohabitacion['tipohabitacion'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group">
                                    <label>N° Habitacion</label>
                                    <input class="form-control" placeholder="Room No" id="numeroHabitacion"
                                           data-error="Ingrese el N° de Habitación" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <button class="btn btn-success pull-right">Agregar habitación</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!--Edit Room Modal -->
    <div id="editRoom" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar habitación</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="roomEditFrom" data-toggle="validator" role="form">
                                <div class="edit_response"></div>
                                <div class="form-group">
                                    <label>tipo de habitacion</label>
                                    <select class="form-control" id="edit_room_type" required
                                            data-error="Seleccione un tipo de habitación">
                                        <option selected disabled>Seleccionar tipo de habitación</option>
                                        <?php
                                        $query = "SELECT * FROM tipohabitacion";
                                        $result = mysqli_query($connection, $query);
                                        if (mysqli_num_rows($result) > 0) {
                                            while ($tipohabitacion = mysqli_fetch_assoc($result)) {
                                                echo '<option value="' . $tipohabitacion['id_tipohabitacion'] . '">' . $tipohabitacion['tipohabitacion'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group">
                                    <label>N° habitación</label>
                                    <input class="form-control" placeholder="Habitación N°" id="edit_room_no" required
                                           data-error="Ingrese el número de habitación">
                                    <div class="help-block with-errors"></div>
                                </div>
                                <input type="hidden" id="edit_room_id">
                                <button class="btn btn-success pull-right">Editar habitacion</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!---customer details-->
    <div id="cutomerDetailsModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center"><b>Detalles del cliente</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-responsive table-bordered">
                                <!-- <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Detail</th>
                                </tr>
                                </thead> -->
                                <tbody>
                                <tr>
                                    <td><b>Nombre del cliente</b></td>
                                    <td id="customer_name"></td>
                                </tr>
                                <tr>
                                    <td><b>Contacto del cliente</b></td>
                                    <td id="customer_contact_no"></td>
                                </tr>
                                <tr>
                                    <td><b>Correo</b></td>
                                    <td id="customer_email"></td>
                                </tr>
                                <tr>
                                    <td><b>tipo de tarjeta de identificacion</b></td>
                                    <td id="customer_id_card_type"></td>
                                </tr>
                                <tr>
                                    <td><b>numero de tarjeta de identificacion</b></td>
                                    <td id="customer_id_card_number"></td>
                                </tr>
                                <tr>
                                    <td><b>Direccion</b></td>
                                    <td id="customer_address"></td>
                                </tr>
                                <tr>
                                    <td><b>Cantidad restante</b></td>
                                    <td id="remaining_price"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!---customer details ends here-->

    <!-- Check In Modal -->
    <div id="checkIn" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center"><b>Habitacion - Check In</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-responsive table-bordered">
                                
                                <tbody>
                                <tr>
                                    <td><b>Nombre del cliente</b></td>
                                    <td id="getCustomerName"></td>
                                </tr>
                                <tr>
                                    <td><b>tipo de habitacion</b></td>
                                    <td id="getRoomType"></td>
                                </tr>
                                <tr>
                                    <td><b>Numero de habitacion</b></td>
                                    <td id="getRoomNo"></td>
                                </tr>
                                <tr>
                                    <td><b>Check In</b></td>
                                    <td id="getCheckIn"></td>
                                </tr>
                                <tr>
                                    <td><b>Check Out</b></td>
                                    <td id="getCheckOut"></td>
                                </tr>
                                <tr>
                                    <td><b>precio total</b></td>
                                    <td id="getTotalPrice"></td>
                                </tr>
                                </tbody>
                            </table>
                            <form role="form" id="advancePayment">
                                <div class="payment-response"></div>
                                <div class="form-group col-lg-12">
                                    <label>Pago por adelantado</label>
                                    <input type="number" class="form-control" id="advance_payment"
                                           placeholder="Please Enter Amounts Here..">
                                </div>
                                <input type="hidden" id="getBookingID" value="">
                                <button type="submit" class="btn btn-primary pull-right">Pago & Check In</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Check Out Modal-->
    <div id="checkOut" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center"><b>Habitacion - Check Out</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-responsive table-bordered">
                                
                                <tbody>
                                <tr>
                                    <td><b>Nombre del cliente</b></td>
                                    <td id="getCustomerName_n"></td>
                                </tr>
                                <tr>
                                    <td><b>tipo de habitacion</b></td>
                                    <td id="getRoomType_n"></td>
                                </tr>
                                <tr>
                                    <td><b>numero de habitacion</b></td>
                                    <td id="getRoomNo_n"></td>
                                </tr>
                                <tr>
                                    <td><b>Check In</b></td>
                                    <td id="getCheckIn_n"></td>
                                </tr>
                                <tr>
                                    <td><b>Check Out</b></td>
                                    <td id="getCheckOut_n"></td>
                                </tr>
                                <tr>
                                    <td><b>Monto total</b></td>
                                    <td id="getTotalPrice_n"></td>
                                </tr>
                                <tr>
                                    <td><b>Cantidad restante</b></td>
                                    <td id="getRemainingPrice_n"></td>
                                </tr>
                                </tbody>
                            </table>
                            <form role="form" id="checkOutRoom_n" data-toggle="validator">
                                <div class="checkout-response"></div>
                                <div class="form-group col-lg-12">
                                    <label><b>Pago restante</b></label>
                                    <input type="text" class="form-control" id="remaining_amount"
                                           placeholder="Remaining Payment" required
                                           data-error="Please Enter Remaining Amount">
                                    <div class="help-block with-errors"></div>
                                </div>
                                <input type="hidden" id="getBookingId_n" value="">
                                <button type="submit" class="btn btn-primary pull-right">Procesar pago</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="row"><br>
     
        <div class="col-sm-12">
       
        </div>
    </div>

</div>    <!--/.main-->
