<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Reportes de Habitaciones</li>
        </ol>
    </div>

    <br>

    <div class="row">
        <div class="col-lg-12">
            <div id="success"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
</br>
            <form action="pdf2.php" method="post" accept-charset="utf-8">
                    <button type="submit" class="btn btn-secondary pull-right" style="border-radius:0%"  formtarget="_blank">Descargar Reporte</button>
                </form>
                <div class="panel-heading">Reportes de Habitaciones</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-responsive" cellspacing="0" width="100%"
                           id="rooms">
                        <thead>
                        <tr>
                            <th>N° de Habitación</th>
                            <th>Tipo de Habitación</th>
                            <th>Precio</th>
                            <th>Máximo de personas</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $room_query = "SELECT * FROM habitacion NATURAL JOIN tipohabitacion";
                        $rooms_result = mysqli_query($connection, $room_query);
                        if (mysqli_num_rows($rooms_result) > 0) {
                            while ($rooms = mysqli_fetch_assoc($rooms_result)) { ?>
                                <tr>
                                    <td><?php echo $rooms['numeroHabitacion'] ?></td>
                                    <td><?php echo $rooms['tipohabitacion'] ?></td>
                                    <td>$<?php echo $rooms['precio'] ?></td>
                                    <td><?php echo $rooms['maximopersona'] ?></td>
                                    <?php }
                        } else {
                            echo "No hay reportes";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>