<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Trabajadores</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Detalles sobre empleados
                    <a href="index.php?manejo_trabaj" class="btn btn-secondary pull-right" style="border-radius:0%">Agregar empleado</a>
                </div>
                <div class="panel-body">
                    <?php
                    if (isset($_GET['error'])) {
                        echo "<div class='alert alert-danger'>
                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Error on Shift Change !
                            </div>";
                    }
                    if (isset($_GET['success'])) {
                        echo "<div class='alert alert-success'>
                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Shift Successfully Changed!
                            </div>";
                    }
                    ?>
                    <table class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%"
                           id="rooms">
                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nombre de empleado</th>
                            <th>Personal</th>
                            <th>Cambio</th>
                            <th>Dia de ingreso</th>
                            <th>Salario</th>
                            <th>Cambiar turno</th>
                            <th>Accion</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        //$staff_query = "SELECT * FROM staff  JOIN staff_type JOIN shift ON staff.staff_type_id =staff_type.staff_type_id ON shift.";
                        $personal_query = "SELECT * FROM personal  NATURAL JOIN tipopersonal NATURAL JOIN cambio";
                        $personal_result = mysqli_query($connection, $personal_query);

                        if (mysqli_num_rows($personal_result) > 0) {
                            while ($staff = mysqli_fetch_assoc($personal_result)) { ?>
                                <tr>

                                    <td><?php echo $personal['id_empleado']; ?></td>
                                    <td><?php echo $personal['nombre']; ?></td>
                                    <td><?php echo $personal['id_tipopersonal']; ?></td>
                                    <td><?php echo $personal['cambio'] . ' - ' . $staff['tiempoCambio']; ?></td>
                                    <td><?php echo date('M j, Y', strtotime($personal['diaIngreso'])); ?></td>
                                    <td><?php echo $personal['salario']; ?></td>
                                    <td>
                                        <button class="btn btn-warning" style="border-radius:0%" data-toggle="modal" data-target="#changeShift"
                                                data-id="<?php echo $personal['id_empleado']; ?>" id="change_shift">Cargar cambio</button>
                                    </td>
                                    <td>

                                        <button data-toggle="modal"
                                                data-target="#empDetail<?php echo $personal['id_empleado']; ?>"
                                                data-id="<?php echo $personal['id_empleado']; ?>" id="editEmp"
                                                class="btn btn-info" style="border-radius:60px;"><i class="fa fa-pencil"></i></button>
                                        <a href='functionmis.php?empid=<?php echo $personal['id_empleado']; ?>'
                                           class="btn btn-danger" onclick="return confirm('Estas seguro?')" style="border-radius:60px;"><i
                                                    class="fa fa-trash"></i></a>
                                        <a href='index.php?emp_history&empid=<?php echo $personal['id_empleado']; ?>'
                                           class="btn btn-success" title="Employee Histery" style="border-radius:60px;"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>


                                <?php
                            }
                        }
                        ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row"><br>
        <div class="col-sm-12">
        </div>
    </div>

</div>    <!--/.main-->

<?php
//$staff_query = "SELECT * FROM staff  JOIN staff_type JOIN shift ON staff.staff_type_id =staff_type.staff_type_id ON shift.";
$personal_query = "SELECT * FROM personal  NATURAL JOIN tipopersonal NATURAL JOIN cambio";
$personal_result = mysqli_query($connection, $personal_query);

if (mysqli_num_rows($personal_result) > 0) {
    while ($personalGlobal = mysqli_fetch_assoc($personal_result)) {
        $fullname = explode(" ", $personalGlobal['nombre']);
        ?>

        <!-- Employee Detail-->
        <div id="empDetail<?php echo $personalGlobal['id_empleado']; ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Detalles de empleado</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Detalles de empleado:</div>
                                    <div class="panel-body">
                                        <form data-toggle="validator" role="form" action="functionmis.php"
                                              method="post">
                                            <div class="row">
                                                <div class="form-group col-lg-6">
                                                    <label>Personal</label>
                                                    <select class="form-control" id="staff_type" name="staff_type_id"
                                                            required>
                                                        <option selected disabled>Seleccionar tipo de personal</option>
                                                        <?php
                                                        $query = "SELECT * FROM tipopersonal";
                                                        $result = mysqli_query($connection, $query);
                                                        if (mysqli_num_rows($result) > 0) {
                                                            while ($personal = mysqli_fetch_assoc($result)) {
                                                                echo '<option value="' . $personal['id_tipopersonal'] . '" ' . (($personal['id_tipopersonal'] == $personalGlobal['id_tipopersonal']) ? 'selected="selected"' : "") . '>' . $personal['tipoPersonal'] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <select style="visibility: hidden;" class="form-control" id="shift" name="shift_id" required>
                                                        <option selected disabled>Seleccionar tipo de personal</option>
                                                        <?php
                                                        $query = "SELECT * FROM cambio";
                                                        $result = mysqli_query($connection, $query);
                                                        if (mysqli_num_rows($result) > 0) {
                                                            while ($cambio = mysqli_fetch_assoc($result)) {
                                                                echo '<option value="' . $cambio['id_cambbio'] . '" ' . (($cambio['id_cambio'] == $personalGlobal['id_cambio']) ? 'selected="selected"' : "") . '>' . $cambio['tiempoCambio'] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <input type="hidden" value="<?php echo $personalGlobal['id_empleado']; ?>"
                                                       id="emp_id" name="emp_id">

                                                <div class="form-group col-lg-6">
                                                    <label>Nombre</label>
                                                    <input type="text" value="<?php echo $fullname[0]; ?>"
                                                           class="form-control" placeholder="First Name" id="first_name"
                                                           name="first_name" required>
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label>Apellido</label>
                                                    <input type="text" value="<?php echo $fullname[1]; ?>"
                                                           class="form-control" placeholder="Last Name" id="last_name"
                                                           name="last_name" required>
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label>Tipo de tarjeta de identificacion</label>
                                                    <select class="form-control" id="id_card_id" name="id_card_type"
                                                            required>
                                                        <option selected disabled>Seleccionar tipo de tarjeta de identificacion</option>
                                                        <?php
                                                        $query = "SELECT * FROM tipo_documento";
                                                        $result = mysqli_query($connection, $query);

                                                        if (mysqli_num_rows($result) > 0) {
                                                            while ($tipodocumento = mysqli_fetch_assoc($result)) {
                                                                //  echo '<option value="' . $id_card_type['id_card_type_id'] . '">' . $id_card_type['id_card_type'] . '</option>';
                                                                echo '<option  value="' . $tipodocumento['id_tipodocumento'] . '" ' . (($tipodocumento['id_tipodocumento'] == $personalGlobal['tipotarjeta']) ? 'selected="selected"' : "") . '>' . $tipodocumento['tipotarjeta'] . '</option>';
                                                            }
                                                        }

                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label>N° tarjeta de identificacion</label>
                                                    <input type="text" class="form-control" placeholder="ID Card No"
                                                           id="id_card_no"
                                                           value="<?php echo $personalGlobal['numeroTarjeta']; ?>"
                                                           name="id_card_no" required>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label>Numero de contacto</label>
                                                    <input type="number" class="form-control"
                                                           placeholder="Contact Number" id="contact_no"
                                                           value="<?php echo $personalGlobal['telefono']; ?>"
                                                           name="contact_no" required>
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label>Direccion</label>
                                                    <input type="text" class="form-control" placeholder="address"
                                                           id="address" value="<?php echo $personalGlobal['direccion']; ?>"
                                                           name="address">
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label>Salario</label>
                                                    <input type="number" class="form-control" placeholder="Salary"
                                                           id="salary" value="<?php echo $personalGlobal['salario']; ?>"
                                                           name="salary" required>
                                                </div>

                                            </div>

                                            <button type="submit" class="btn btn-lg btn-primary" name="submit">Enviar
                                            </button>
                                            <button type="reset" class="btn btn-lg btn-danger">Reset</button>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!-- Employee Detail-->
        <div id="changeShift" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Cargar cambio</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <form data-toggle="validator" role="form" action="ajax.php" method="post">
                                            <div class="row">
                                            <div class="form-group col-lg-12">
                                                <label>Cambio</label>
                                                <select class="form-control" id="shift" name="shift_id" required>
                                                    <option selected disabled>Seleccionar tipo de personal</option>
                                                    <?php
                                                    $query = "SELECT * FROM cambio";
                                                    $result = mysqli_query($connection, $query);
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($cambio = mysqli_fetch_assoc($result)) {
                                                            // echo '<option value="' . $shift['shift_id'] . '">' . $shift['shift'] . ' - ' . $shift['shift_timing'] . '</option>';
                                                            echo '<option value="' . $cambio['id_cambio'] . '" ' . (($cambio['id_cambio'] == $personalGlobal['id_cambio']) ? 'selected="selected"' : "") . '>' . $cambio['tiempoCambio'] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            </div>
                                            <input type="hidden" name="emp_id" value="" id="getEmpId">
                                            <button type="submit" class="btn btn-lg btn-primary" name="change_shift">Enviar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>

            </div>
        </div>
        <?php
    }
}