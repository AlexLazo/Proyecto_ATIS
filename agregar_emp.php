<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Agregar empleado</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Detalles del empleado:</div>
                <div class="panel-body">
                    <div class="emp-response"></div>
                    <form role="form" id="addEmployee" data-toggle="validator">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>Personal</label>
                                <select class="form-control" id="staff_type" required data-error="Seleccione el tipo de Personal">
                                    <option selected disabled>Seleccione el Tipo de Empleado</option>
                                    <?php
                                    $query = "SELECT * FROM tipopersonal";
                                    $result = mysqli_query($connection, $query);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($staff = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $staff['id_tipopersonal'] . '">' . $staff['tipopersonal'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Turno</label>
                                <select class="form-control" id="shift" required data-error="Seleccion el tipo de Turno">
                                    <option selected disabled>Seleccione el tipo de personal</option>
                                    <?php
                                    $query = "SELECT * FROM cambio";
                                    $result = mysqli_query($connection, $query);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($shift = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $shift['id_cambio'] . '">' . $shift['cambio'] . ' - ' . $shift['tiempoCambio'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Nombre</label>
                                <input type="text" class="form-control" placeholder="Nombre" id="first_name" required data-error="Ingrese su nombre">
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Apellido</label>
                                <input type="text" class="form-control" placeholder="Apellido" id="last_name" required data-error="Ingrese su apellido">
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Tipo de Tarjeta de ID</label>
                                <select class="form-control" id="id_card_id" required onchange="validId(this.value);">
                                    <option selected disabled>Seleccione el tipo de tarjeta de ID</option>
                                    <?php
                                    $query = "SELECT * FROM tipo_documento";
                                    $result = mysqli_query($connection, $query);
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($id_card_type = mysqli_fetch_assoc($result)) {
                                            echo '<option value="' . $id_card_type['id_tipodocumento'] . '">' . $id_card_type['tipotarjeta'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>N° de ID</label>
                                <input type="text" class="form-control" placeholder="N° de ID" id="id_card_no" required>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Número de contacto</label>
                                <input type="number" class="form-control" placeholder="Número de contacto" id="contact_no" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Dirección de residencia</label>
                                <input type="text" class="form-control" placeholder="Dirección de residencia" id="address" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Salario</label>
                                <input type="number" class="form-control" placeholder="Salario" id="salary" data-error="Ingresar salario" required>
                                <div class="help-block with-errors"></div>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-lg btn-success" style="border-radius:0%">Agregar</button>
                        <button type="reset" class="btn btn-lg btn-danger" style="border-radius:0%">Reiniciar</button>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>




