
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="img/user.png" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name"><?php echo $user['name'];?></div>
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>Manager</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>
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
                    Estadísticas
                </a>
            </li>
        <?php } else{?>
        <li>
            <a href="index.php?estadist"><em class="fa fa-pie-chart">&nbsp;</em>
                    Estadísticas
            </a>
        </li>
<?php }?>

        
    </ul>
</div>