
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="img/user.png" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name"><?php echo $user['nombre'];?></div>
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>Manager</div>
        </div>
        <div class="profile-options">
            <button id="addUserButton" class="btn btn-sm btn-primary">
                Add user
            </button>
    </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>
    <style>
        /* Style for the "Add User" button */
        .profile-options {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }

        #addUserButton {
            margin-left: 10px;
        }

        /* Style for the floating window */
        .floating-window {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border: 1px solid #ccc;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        z-index: 1000;
        display: none;
        width: 400px; /* Set the width to your desired value */
    }
        
    </style>

<div class="floating-window">
    <button id="closeButton" class="btn btn-sm btn-danger">Cerrar</button>
    <h2>Agregar nuevo usuario</h2>
    <form method="post" action="">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="form-group">
            <label for="username">Usuario:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>


        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="button" class="btn btn-primary" id="registerButton" name="register">Registrar</button>
    </form>
</div>

    <ul class="nav menu">
    <?php 
        if (isset($_GET['dashboard'])){ ?>
            <li class="active">
                <a href="index.php?dashboard"><em class="fa fa-dashboard">&nbsp;</em>
                    Dashboard
                </a>
            </li>
        <?php } else{?>
            <li>
                <a href="index.php?dashboard"><em class="fa fa-dashboard">&nbsp;</em>
                    Dashboard
                </a>
            </li>
        <?php }
        if (isset($_GET['reservation'])){ ?>
            <li class="active">
            <a href="index.php?reservation"><em class="fa fa-calendar">&nbsp;</em>
                    Reservaciones
                </a>
            </li>
        <?php } else{?>
            <li>
            <a href="index.php?reservation"><em class="fa fa-calendar">&nbsp;</em>
                    Reservaciones
                </a>
            </li>
        <?php }
        if (isset($_GET['manejo_cuart'])){ ?>
            <li class="active">
                <a href="index.php?manejo_cuart"><em class="fa fa-bed">&nbsp;</em>
                    Administrar Cuartos
                </a>
            </li>
        <?php } else{?>
            <li>
            <a href="index.php?manejo_cuart"><em class="fa fa-bed">&nbsp;</em>
                    Administrar Cuartos
                </a>
            </li>
        <?php }
        if (isset($_GET['manejo_trabaj'])){ ?>
            <li class="active">
                <a href="index.php?manejo_trabaj"><em class="fa fa-users">&nbsp;</em>
                    Trabajadores
                </a>
            </li>
        <?php } else{?>
            <li>
                <a href="index.php?manejo_trabaj"><em class="fa fa-users">&nbsp;</em>
                    Trabajadores
                </a>
            </li>
        <?php }
        if (isset($_GET['quejas'])){ ?>
            <li class="active">
                <a href="index.php?quejas"><em class="fa fa-comments">&nbsp;</em>
                    Administrar quejas
                </a>
            </li>
        <?php } else{?>
            <li>
                <a href="index.php?quejas"><em class="fa fa-comments">&nbsp;</em>
                    Administrar quejas
                </a>
            </li>
        <?php }
        ?>

        <?php
        if (isset($_GET['estadist'])){ ?>
            <li class="active">
                <a href="index.php?estadist"><em class="fa fa-pie-chart">&nbsp;</em>
                    Reporte de Reservaciones
                </a>
            </li>
        <?php } else{?>
        <li>
            <a href="index.php?estadist"><em class="fa fa-pie-chart">&nbsp;</em>
                    Reportes de Reservaciones
            </a>
        </li>
<?php }?>
<?php
        if (isset($_GET['reportesHab'])){ ?>
            <li class="active">
                <a href="index.php?reportesHab"><em class="fa fa-pie-chart">&nbsp;</em>
                    Reportes de Habitaciones
                </a>
            </li>
        <?php } else{?>
        <li>
            <a href="index.php?reportesHab"><em class="fa fa-pie-chart">&nbsp;</em>
                    Reportes de Habitaciones
            </a>
        </li>
<?php }?>


        
    </ul>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var floatingWindow = $('.floating-window');

        $('#addUserButton').click(function() {
            floatingWindow.fadeIn();
        });

        $('#closeButton').click(function() {
            floatingWindow.fadeOut();
        });

        // Use event delegation to handle the click event for dynamically added #registerButton
        $(document).on('click', '#registerButton', function(event) {
            event.preventDefault();

            var nombre = $('#nombre').val();
            var username = $('#username').val();
            var password = $('#password').val();

            var formData = {
                nombre: nombre,
                username: username,
                password: password
            }

            $.ajax({
                type: 'POST',
                url: 'register.php', // Specify the correct URL for your registration script
                data: formData,
                success: function(response) {
                    if (response === 'success') {
                        alert('Registro completado');
                        floatingWindow.fadeOut();
                    } else if (response === 'error') {
                        alert('Registro fallido.');
                    }
                }
            });
        });
    });
</script>

