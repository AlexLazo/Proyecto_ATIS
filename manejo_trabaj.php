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
                    <a href="index.php?agregar_emp" class="btn btn-secondary pull-right" style="border-radius:0%">Agregar empleado</a>
                </div>
                <div class="panel-body">
                    <?php
                    if (isset($_GET['error'])) {
                        echo "<div class='alert alert-danger'>
                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Error al hacer el cambio de turno
                            </div>";
                    }
                    if (isset($_GET['success'])) {
                        echo "<div class='alert alert-success'>
                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp;Cambio correctamente agregado
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
                            <th>Cambio de turno</th>
                            <th>Accion</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $staff_query = "SELECT * FROM personal  NATURAL JOIN tipopersonal NATURAL JOIN cambio";
                        $staff_result = mysqli_query($connection, $staff_query);

                        if (mysqli_num_rows($staff_result) > 0) {
                            while ($staff = mysqli_fetch_assoc($staff_result)) { ?>
                                <tr>
                                    <td><?php echo $staff['id_empleado']; ?></td>
                                    <td><?php echo $staff['nombre']; ?></td>
                                    <td><?php echo $staff['id_tipopersonal']; ?></td>
                                    <td><?php echo $staff['cambio'] . ' - ' . $staff['tiempoCambio']; ?></td>
                                    <td><?php echo date('M j, Y', strtotime($staff['diaIngreso'])); ?></td>
                                    <td><?php echo $staff['salario']; ?></td>
                                    <td>
                                        <button class="btn btn-warning" style="border-radius:0%" data-toggle="modal" data-target="#changeShift"
                                                data-id="<?php echo $staff['id_empleado']; ?>" id="change_shift">Cargar cambio</button>
                                    </td>
                                    <td>

                                        <button data-toggle="modal"
                                                data-target="#empDetail<?php echo $staff['id_empleado']; ?>"
                                                data-id="<?php echo $staff['id_empleado']; ?>" id="editEmp"
                                                class="btn btn-info" style="border-radius:60px;"><i class="fa fa-pencil"></i></button>

                                                
                                        <a href='functionmis.php?empid=<?php echo $staff['id_empleado']; ?>'
                                           class="btn btn-danger" onclick="return confirm('¿Estás seguro?')" style="border-radius:60px;"><i
                                                    class="fa fa-trash"></i></a>
                                        <a href='index.php?emp_historial&empid=<?php echo $staff['id_empleado']; ?>'
                                           class="btn btn-success" title="Historial de Empleados" style="border-radius:60px;"><i class="fa fa-eye"></i></a>
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

</div>

<?php
$staff_query = "SELECT * FROM personal  NATURAL JOIN tipopersonal NATURAL JOIN cambio";
$staff_result = mysqli_query($connection, $staff_query);

if (mysqli_num_rows($staff_result) > 0) {
    while ($staffGlobal = mysqli_fetch_assoc($staff_result)) {
        $fullname = explode(" ", $staffGlobal['nombre']);
        ?>


        <!-- Employee Detail-->
        <div id="empDetail<?php echo $staffGlobal['id_empleado']; ?>" class="modal fade" role="dialog">
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
                                                    <label>Trabajadores</label>
                                                    <select class="form-control" id="staff_type" name="staff_type_id"
                                                            required>
                                                        <option selected disabled>Seleccione el tipo de puesto</option>
                                                        <?php
                                                        $query = "SELECT * FROM tipopersonal";
                                                        $result = mysqli_query($connection, $query);
                                                        if (mysqli_num_rows($result) > 0) {
                                                            while ($staff = mysqli_fetch_assoc($result)) {
                                                                echo '<option value="' . $staff['id_tipopersonal'] . '" ' . (($staff['id_tipopersonal'] == $staffGlobal['id_tipopersonal']) ? 'selected="selected"' : "") . '>' . $staff['tipopersonal'] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <select style="visibility: hidden;" class="form-control" id="shift" name="shift_id" required>
                                                        <option selected disabled>Seleccione Horario de Cambio</option>
                                                        <?php
                                                        $query = "SELECT * FROM cambio";
                                                        $result = mysqli_query($connection, $query);
                                                        if (mysqli_num_rows($result) > 0) {
                                                            while ($shift = mysqli_fetch_assoc($result)) {
                                                                echo '<option value="' . $shift['id_cambio'] . '" ' . (($shift['id_cambio'] == $staffGlobal['id_cambio']) ? 'selected="selected"' : "") . '>' . $shift['tiempoCambio'] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <input type="hidden" value="<?php echo $staffGlobal['id_empleado']; ?>"
                                                       id="emp_id" name="emp_id">

                                                <div class="form-group col-lg-6">
                                                    <label>Nombre</label>
                                                    <input type="text" value="<?php echo $fullname[0]; ?>"
                                                           class="form-control" placeholder="Nombre" id="first_name"
                                                           name="first_name" required>
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label>Apellido</label>
                                                    <input type="text" value="<?php echo $fullname[1]; ?>"
                                                           class="form-control" placeholder="Apellido" id="last_name"
                                                           name="last_name" required>
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label>Tipo de Identificación</label>
                                                    <select class="form-control" id="id_card_id" name="id_card_type"
                                                            required>
                                                        <option selected disabled>Seleccione el tipo de ID</option>
                                                        <?php
                                                        $query = "SELECT * FROM tipo_documento";
                                                        $result = mysqli_query($connection, $query);

                                                        if (mysqli_num_rows($result) > 0) {
                                                            while ($id_card_type = mysqli_fetch_assoc($result)) {
                                                                echo '<option  value="' . $id_card_type['id_tipodocumento'] . '" ' . (($id_card_type['id_tipodocumento'] == $staffGlobal['tipotarjeta']) ? 'selected="selected"' : "") . '>' . $id_card_type['tipotarjeta'] . '</option>';
                                                            }
                                                        }

                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label>N° de ID</label>
                                                    <input type="text" class="form-control" placeholder="ID Card No"
                                                           id="id_card_no"
                                                           value="<?php echo $staffGlobal['numeroTarjeta']; ?>"
                                                           name="id_card_no" required>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label>Número de contacto</label>
                                                    <input type="number" class="form-control"
                                                           placeholder="Contact Number" id="contact_no"
                                                           value="<?php echo $staffGlobal['telefono']; ?>"
                                                           name="contact_no" required>
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label>Dirección</label>
                                                    <input type="text" class="form-control" placeholder="Dirección"
                                                           id="address" value="<?php echo $staffGlobal['direccion']; ?>"
                                                           name="address">
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label>Salario</label>
                                                    <input type="number" class="form-control" placeholder="Salario"
                                                           id="salary" value="<?php echo $staffGlobal['salario']; ?>"
                                                           name="salary" required>
                                                </div>

                                            </div>

                                            <button type="submit" class="btn btn-lg btn-primary" name="submit">Guardar
                                            </button>
                                            <button type="reset" class="btn btn-lg btn-danger">Reiniciar</button>
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
                        <h4 class="modal-title">Cambio de Turno</h4>
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
                                                    <option selected disabled>Seleccione el horario</option>
                                                    <?php
                                                    $query = "SELECT * FROM cambio";
                                                    $result = mysqli_query($connection, $query);
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($shift = mysqli_fetch_assoc($result)) {
                                                            echo '<option value="' . $shift['id_cambio'] . '" ' . (($shift['id_cambio'] == $staffGlobal['id_cambio']) ? 'selected="selected"' : "") . '>' . $shift['tiempoCambio'] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            </div>
                                            <input type="hidden" name="emp_id" value="" id="getEmpId">
                                            <button type="submit" class="btn btn-lg btn-primary" name="change_shift">Guardar</button>
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