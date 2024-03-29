<body>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="dashboard.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Dashboard</li>
			</ol>
		</div>
		
		<div class="panel panel-container">
			<div class="row">
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-teal panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-bed color-blue"></em>
						<div class="large"><?php include 'contador/cont-habit.php'?></div>
							<div class="text-muted">Habitaciones totales</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-blue panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-bookmark color-orange"></em>
						<div class="large"><?php include 'contador/cont-reserv.php'?></div>
							<div class="text-muted">Reservaciones</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-orange panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-users color-teal"></em>
						<div class="large"><?php include 'contador/cont-trabaj.php'?></div>
							<div class="text-muted">Trabajadores</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-red panel-widget ">
						<div class="row no-padding"><em class="fa fa-xl fa-comments color-red"></em>
						<div class="large"><?php include 'contador/cont-quejas.php'?></div>
							<div class="text-muted">Quejas</div>
						</div>
					</div>
				</div>
			</div>

			<hr>

			<div class="row">
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-teal panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-reorder color-red"></em>
						<div class="large"><?php include 'contador/cont-habreservadas.php'?></div>
							<div class="text-muted">Habitaciones reservadas</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-blue panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-check-circle color-green"></em>
						<div class="large"><?php include 'contador/cont-habdisponibles.php'?></div>
							<div class="text-muted">Habitaciones disponibles</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-orange panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-check-square-o color-magg"></em>
						<div class="large"><?php include 'contador/cont-checkin.php'?></div>
							<div class="text-muted">Checked-In</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-red panel-widget ">
						<div class="row no-padding"><em class="fa fa-xl fa-spinner color-blue"></em>
						<div class="large"><?php include 'contador/cont-pagopend.php'?></div>
							<div class="text-muted">Total de pagos pendientes</div>
						</div>
					</div>
				</div>
			</div>

			<hr>

			<div class="row">
				<div class="col-xs-6 col-md-2 col-lg-2 no-padding">
					
				</div>

				<div class="col-xs-6 col-md-4 col-lg-4 no-padding">
					<div class="panel panel-red panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-money color-red"></em>
                        <div class="large">$<?php include 'contador/cont-ingresos.php'?></div>
							<div class="text-muted">Total de Ganancias</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-4 col-lg-4 no-padding">
					<div class="panel panel-orange panel-widget ">
						<div class="row no-padding"><em class="fa fa-xl fa-credit-card color-purp"></em>
							<div class="large">$<?php include 'contador/pagopendiente.php'?></div>
							<div class="text-muted">Pago pendiente</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-2 col-lg-2 no-padding">
					
				</div>
			</div>
		</div>

		<div class="row">
		<?php
  			$data1 = '';
  			$data2 = '';
    		$sql = "SELECT check_in, SUM(precioTotal) AS total FROM reservacion GROUP BY check_in  ";
    		$result = mysqli_query($connection, $sql);

    		while ($row = mysqli_fetch_array($result)) {
        		$data1 = $data1 . '"'. $row['check_in'].'",';
        		$data2 = $data2 . '"'. $row['total'] .'",';
    		}

    		$data1 = trim($data1,",");
    		$data2 = trim($data2,",");
		?>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="js/Chart.bundle.min.js"></script>
        <div class="container"> 
            <canvas id="chart" style="width: 100%; height: 30vh; background: #222; border: 1px solid #555652; margin-top: 10px;"></canvas>

            <script>
                var ctx = document.getElementById("chart").getContext('2d');
                var myChart = new Chart(ctx, {
                type: 'line',
                data: {
					
                    labels: [<?php echo $data1; ?> ],
                    datasets: 
                    [
                    {
                        label: 'Total de ganancias por día',
                        data: [<?php echo $data2; ?>, ],
                        backgroundColor: 'transparent',
                        borderColor:'rgba(0,255,255)',
                        borderWidth: 3  
                    }]
                },

                options: {
                    scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
                    tooltips:{mode: 'index'},
                    legend:{display: true, position: 'top', labels: {fontColor: 'rgb(255,255,255)', fontSize: 16}}
                }
            });
            </script>
        </div>
		</div>
		
	</div>
	
</body>
</html>