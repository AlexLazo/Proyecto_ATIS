<?php
if (isset($_GET['idHabitacion'])){
    $get_habitacion_id = $_GET['idHabitacion'];
    $get_habitacion_sql = "SELECT * FROM habitacion NATURAL JOIN tipohabitacion WHERE idHabitacion = '$get_habitacion_id'";
    $get_habitacion_result = mysqli_query($connection,$get_habitacion_sql);
    $get_habitacion = mysqli_fetch_assoc($get_room_result);

    $get_tipo_habitacion_id = $get_habitacion['id_tipohabitacion'];
    $get_tipo_habitacion = $get_habitacion['tipohabitacion'];
    $get_habitacion_no = $get_habitacion['numeroHabitacion'];
    $get_precio_habitacion = $get_habitacion['precio'];
}
?>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Reservaciones </li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <form role="form" id="booking" data-toggle="validator">
                <div class="response"></div>
                <div class="col-lg-12">
                    <?php
                    if (isset($_GET['idHabitacion'])){?>

                        <div class="panel panel-default">
                            <div class="panel-heading">Informacion de la habitacion:
                                <a class="btn btn-secondary pull-right" href="index.php?room_mang">Replanificar la reservacion</a>
                            </div>
                            <div class="panel-body">
                                <div class="form-group col-lg-6">
                                    <label>Tipo de habitacion</label>
                                    <select class="form-control" id="room_type" data-error="Select Room Type" required>
                                        <option selected disabled>Seleccionar tipo de habitacion</option>
                                        <option selected value="<?php echo $get_tipo_habitacion_id; ?>"><?php echo $get_tipo_habitacion; ?></option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>N° Habitacion</label>
                                    <select class="form-control" id="room_no" onchange="fetch_price(this.value)" required data-error="Select Room No">
                                        <option selected disabled>Seleccionar numero de habitacion</option>
                                        <option selected value="<?php echo $get_habitacion_id; ?>"><?php echo $get_habitacion_no; ?></option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Check In</label>
                                    <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="check_in_date" data-error="Select Check In Date" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Check Out</label>
                                    <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="check_out_date" data-error="Select Check Out Date" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="col-lg-12">
                                    <h4 style="font-weight: bold">Total de Dias : <span id="staying_day">0</span> Days</h4>
                                    <h4 style="font-weight: bold">Precio: <span id="price"><?php echo $get_precio_habitacion; ?></span> /-</h4>
                                    <h4 style="font-weight: bold">Monto total : <span id="total_price">0</span> /-</h4>
                                </div>
                            </div>
                        </div>
                    <?php } else{?>
                        <div class="panel panel-default">
                            <div class="panel-heading">Informacion de la habitacion:
                                <a class="btn btn-secondary pull-right" style="border-radius:0%" href="index.php?reservation">Replanificar la reservacion</a>
                            </div>
                            <div class="panel-body">
                                <div class="form-group col-lg-6">
                                    <label>Tipo de habitacion</label>
                                    <select class="form-control" id="tipohabitacion" onchange="fetch_room(this.value);" required data-error="Select Room Type">
                                        <option selected disabled>Seleccionar tipo de habitacion</option>
                                        <?php
                                        $query  = "SELECT * FROM tipohabitacion";
                                        $result = mysqli_query($connection,$query);
                                        if (mysqli_num_rows($result) > 0){
                                            while ($tipo_habitacion = mysqli_fetch_assoc($result)){
                                                echo '<option value="'.$tipo_habitacion['id_tipohabitacion'].'">'.$tipo_habitacion['tipohabitacion'].'</option>';
                                            }}
                                        ?>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>N° habitación</label>
                                    <select class="form-control" id="numeroHabitacion" onchange="fetch_price(this.value)" required data-error="Seleccione el número de habitación">

                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Check In</label>
                                    <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="check_in_date" data-error="Select una Fecha de Entrada" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Check Out</label>
                                    <input type="text" class="form-control" placeholder="mm/dd/yyyy" id="check_out_date" data-error="Select una Fecha de Salida" required>
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="col-lg-12">
                                    <h4 style="font-weight: bold">Total de Dias : <span id="staying_day">0</span> Días</h4>
                                    <h4 style="font-weight: bold">Precio: <span id="price">0</span> /-</h4>
                                    <h4 style="font-weight: bold">Monto total : <span id="total_price">0</span> /-</h4>
                                </div>
                            </div>
                        </div>
                    <?php }
                    ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">Detalles del cliente:</div>
                        <div class="panel-body">
                            <div class="form-group col-lg-6">
                                <label>Nombre</label>
                                <input class="form-control" placeholder="Nombre" id="first_name" data-error="Ingrese el nombre" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Apellido</label>
                                <input class="form-control" placeholder="Apellido" id="last_name">
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Numero de contacto</label>
                                <input type="number" class="form-control" data-error="Ingrese al menos 8 dígitos" data-minlength="8" placeholder="Contact No" id="contact_no" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Direccion de correo electronico</label>
                                <input type="email" class="form-control" placeholder="Dirección de E-Mail" id="email" data-error="Enter Valid Email Address" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Tipo de tarjeta de identificacion</label>
                                <select class="form-control" id="id_card_id" data-error="Seleccione el Tipo de ID" required onchange="validId(this.value);">
                                    <option selected disabled>Seleccionar el tipo de tarjeta de identificacion</option>
                                    <?php
                                    $query  = "SELECT * FROM tipo_documento";
                                    $result = mysqli_query($connection,$query);
                                    if (mysqli_num_rows($result) > 0){
                                        while ($tipodocumento = mysqli_fetch_assoc($result)){
                                            echo '<option value="'.$tipodocumento['id_tipodocumento'].'">'.$tipodocumento['tipotarjeta'].'</option>';
                                        }}
                                    ?>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Numero de tarjeta de identificacion seleccionada</label>
                                <input type="text" class="form-control" placeholder="ID Card Number" id="id_card_no" data-error="Enter Valid ID Card No" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-12">
                                <label>Direccion de residencia</label>
                                <input type="text" class="form-control" placeholder="Full Address" id="address" required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-lg btn-success pull-right" style="border-radius:0%">Enviar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row"><br>
        <div class="col-sm-12">
        </div>
    </div>

</div>    <!--/.main-->


<!-- Booking Confirmation-->
<div id="bookingConfirm" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><b>Reserva de habitacion</b></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert bg-success alert-dismissable" role="alert"><em class="fa fa-lg fa-check-circle">&nbsp;</em>Habitacion reservada con exito</div>
                        <table class="table table-striped table-bordered table-responsive">
                            <tbody>
                            <tr>
                                <td><b>Nombre del cliente</b></td>
                                <td id="getCustomerName"></td>
                            </tr>
                            <tr>
                                <td><b>Tipo de habitación</b></td>
                                <td id="getRoomType"></td>
                            </tr>
                            <tr>
                                <td><b>N° Habitación</b></td>
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
                                <td><b>Monto total</b></td>
                                <td id="getTotalPrice"></td>
                            </tr>
                            <tr>
                                <td><b>Estado de pago</b></td>
                                <td id="getPaymentStaus"></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary" style="border-radius:60px;" href="index.php?reservation"><i class="fa fa-check-circle"></i></a>
            </div>
        </div>

    </div>
</div>