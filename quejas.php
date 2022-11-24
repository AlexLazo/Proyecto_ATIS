<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Quejas</li>
        </ol>
    </div><!--/.row-->

    

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Hacer una queja</div>
                <div class="panel-body">
                    <?php
                    if (isset($_GET['error'])) {
                        echo "<div class='alert alert-danger'>
                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Error al realizar la queja
                            </div>";
                    }
                    if (isset($_GET['success'])) {
                        echo "<div class='alert alert-success'>
                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Queja correctamente agregada
                            </div>";
                    }
                    ?>
                    <form role="form"  data-toggle="validator" method="post" action="ajax.php">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label>Nombre de la queja</label>
                                <input type="text" class="form-control" placeholder="Nombre de la Queja" name="complaint_name" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-6">
                                <label>Tipo de queja</label>
                                <input type="text" class="form-control" placeholder="Tipo de queja" name="complaint_type" required>
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group col-lg-12">
                                <label>Describe tu queja</label>
                                <textarea class="form-control" name="complaint" placeholder="Describe tu queja" required></textarea>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-lg btn-success" name="createComplaint" style="border-radius:0%">Agregar</button>
                        <button type="reset" class="btn btn-lg btn-danger" style="border-radius:0%">Reiniciar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Administración de quejas</div>
                <div class="panel-body">
                    <?php
                    if (isset($_GET['resolveError'])) {
                        echo "<div class='alert alert-danger'>
                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Error al resolver
                            </div>";
                    }
                    if (isset($_GET['resolveSuccess'])) {
                        echo "<div class='alert alert-success'>
                                <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Queja resuelta correctamente
                            </div>";
                    }
                    ?>
                    <table class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%" id="rooms">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre de la queja</th>
                            <th>Tipo de queja</th>
                            <th>Queja</th>
                            <th>Creada</th>
                            <th>Resuelto</th>
                            <th>Presupuesto</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $complaint_query = "SELECT * FROM quejas";
                        $complaint_result = mysqli_query($connection, $complaint_query);
                        if (mysqli_num_rows($complaint_result) > 0) {
                            $num = 0;
                            while ($complaint = mysqli_fetch_assoc($complaint_result)) {
                                $num++
                                ?>
                                <tr>
                                    <td><?php echo $num ?></td>
                                    <td><?php echo $complaint['nombreQueja'] ?></td>
                                    <td><?php echo $complaint['tipoQueja'] ?></td>
                                    <td><?php echo $complaint['Queja'] ?></td>
                                    <td><?php echo date('M j, Y',strtotime($complaint['fechaQueja'])) ?></td>
                                    <td>
                                        <?php if(!$complaint['EstadoResolucion']){
                                            echo '<button class="btn btn-info" data-toggle="modal" style="border-radius:0%" data-target="#complaintModal" data-id="' . $complaint['id'] . '" id="complaint">Resolver</a>';
                                        } else{
                                            echo date('M j, Y',strtotime($complaint['FechaResolucion']));
                                        }
                                        ?>
                                    </td>
                                    <th>$ <?php echo $complaint['presupuesto'] ?></th>


                                </tr>
                            <?php }
                        } else {
                            echo "No Rooms";
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Agregar habitación -->
    <div id="complaintModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Quejas resuelta</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form data-toggle="validator" role="form" method="post" action="ajax.php">
                                <div class="form-group">
                                    <label>Presupuesto</label>
                                    <input class="form-control" placeholder="Presupuesto" name="budget" data-error="Ingresa el presupuesto" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <input type="hidden" id="complaint_id" name="complaint_id" value="">
                                <button class="btn btn-success pull-right" name="resolve_complaint">Queja resuelta</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div> 