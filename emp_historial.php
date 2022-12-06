<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Historial de Empleados</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Historial de Empleados</h1>
        </div>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Historial</div>
                <div class="panel-body">
                    <?php
                    if(isset($_GET['empid'])){
                        $emp_id = $_GET['empid'];
                    }else{
                        header('Location:404.php');
                    }
                    $emp = "SELECT * FROM personal WHERE id_empleado='$emp_id'";
                    $emp_result = mysqli_query($connection,$emp);
                    $employee = mysqli_fetch_assoc($emp_result);
                    ?>
                    <p><b>Nombre del Empleado: </b> <?php echo $employee['nombre']; ?></p>
                    <p><b>Salario del Empleado: </b> <?php echo $employee['salario'].'$'; ?></p>
                    <table class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%"
                           id="rooms">
                        <thead>
                        <tr>
                            <th>Sr. No</th>
                            <th>Cambio</th>
                            <th>Desde</th>
                            <th>Hasta</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        $staff_query = "SELECT * FROM historiaempleado NATURAL JOIN cambio WHERE id_empleado = '$emp_id' ORDER BY creado DESC";
                        $staff_result = mysqli_query($connection, $staff_query);

                        if (mysqli_num_rows($staff_result) > 0) {
                            $num = 0;
                            while ($staff = mysqli_fetch_assoc($staff_result)) {
                                $num++;
                                ?>
                                <tr>
                                    <td><?php echo $num; ?></td>
                                    <td><?php echo $staff['cambio'].' - '.$staff['tiempoCambio']; ?></td>
                                    <td><?php echo date('M j, Y', strtotime($staff['from_date'])); ?></td>
                                    <td>
                                        <?php
                                        if ($staff['to_date'] == NULL){
                                            echo "<div class='color-blue'>Actualmente trabajando</div>";
                                        }else{
                                            echo date('M j, Y', strtotime($staff['to_date']));


                                        }?>
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
</div> 

<?php
$staff_query = "SELECT * FROM personal NATURAL JOIN tipopersonal NATURAL JOIN cambio";
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
                        <h4 class="modal-title">Detalles del empleado</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Detalles:</div>
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
                                                            while ($staff = mysqli_fetch_assoc($result)) {
                                                                echo '<option value="' . $staff['id_tipopersonal'] . '" ' . (($staff['id_tipopersonal'] == $staffGlobal['id_tipopersonal']) ? 'selected="selected"' : "") . '>' . $staff['tipopersonal'] . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <select style="visibility: hidden;" class="form-control" id="shift" name="shift_id" required>
                                                        <option selected disabled>Seleccione el tipo de personal</option>
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
                                                           class="form-control" placeholder="nombre" id="first_name"
                                                           name="first_name" required>
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label>Apellido</label>
                                                    <input type="text" value="<?php echo $fullname[1]; ?>"
                                                           class="form-control" placeholder="Apellido" id="last_name"
                                                           name="last_name" required>
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label>Tipo de ID</label>
                                                    <select class="form-control" id="id_card_id" name="id_card_type"
                                                            required>
                                                        <option selected disabled>Seleccione el tipo de ID</option>
                                                        <?php
                                                        $query = "SELECT * FROM tipo_documento";
                                                        $result = mysqli_query($connection, $query);

                                                        if (mysqli_num_rows($result) > 0) {
                                                            while ($id_card_type = mysqli_fetch_assoc($result)) {
                                                                echo '<option  value="' . $id_card_type['id_tipodocumento'] . '" ' . (($id_card_type['id_tipodocumento'] == $staffGlobal['id_tipodocumento']) ? 'selected="selected"' : "") . '>' . $id_card_type['tipotarjeta'] . '</option>';
                                                            }
                                                        }

                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label>N° de ID</label>
                                                    <input type="text" class="form-control" placeholder="Número de ID"
                                                           id="id_card_no"
                                                           value="<?php echo $staffGlobal['numeroTarjeta']; ?>"
                                                           name="id_card_no" required>
                                                </div>
                                                <div class="form-group col-lg-6">
                                                    <label>Número de contacto</label>
                                                    <input type="number" class="form-control"
                                                           placeholder="Número de contacto" id="contact_no"
                                                           value="<?php echo $staffGlobal['telefono']; ?>"
                                                           name="contact_no" required>
                                                </div>

                                                <div class="form-group col-lg-6">
                                                    <label>Dirección</label>
                                                    <input type="text" class="form-control" placeholder="address"
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

                                            <button type="submit" class="btn btn-lg btn-primary" name="submit">Agregar
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
                        <h4 class="modal-title">Cambiar Turno</h4>
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
                                                        <option selected disabled>Seleccione el turno</option>
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
                                            <button type="submit" class="btn btn-lg btn-primary" name="change_shift">Enivar</button>
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
