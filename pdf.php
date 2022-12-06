<?php
require_once('fpdf.php');
include('db.php');
date_default_timezone_set('America/El_Salvador');


ob_end_clean(); 

class PDF extends FPDF{
      
    	public function Header() {
            $this->Image('img/kingplace.png', 72, 10, 80, 40, '', '', '', false, 30, '', false, false, 0);
            $this->SetFont('Helvetica','B',13);
            $this->Cell(80);
            $this->Cell(30,10,'Reporte de Ventas',0,0,'C');
            $this->Ln(5);
            $this->Cell(80);
            $this->Ln(27);
	    }
}

$pdf = new PDF('p', 'mm','A4');
$pdf->SetMargins(20, 35, 25);
$pdf->SetFillColor(232,232,232);
$pdf->SetCreator('Hotel King Place');
$pdf->SetAuthor('Hotel King Place');
$pdf->SetTitle('Informe de Ventas');
$pdf->AddPage();
$pdf->SetFont('helvetica','B',10);
$pdf->SetXY(150, 20);
$pdf->SetXY(150, 25);
$pdf->Write(0, 'Fecha: '. date('d-m-Y'));
$pdf->SetXY(150, 30);
$pdf->Write(0, 'Hora: '. date('h:i A'));
$univ ='San Miguel';
$people ='Admin';
$pdf->SetFont('helvetica','B',10);
$pdf->SetTextColor(204,0,0);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetXY(15, 20);
$pdf->SetXY(15, 25);
$pdf->Write(0, 'Departamento: '. $univ);
$pdf->SetXY(15, 30);
$pdf->Write(0, 'Usuario: '. $people);
$pdf->Ln(35);
$pdf->Cell(40,26,'',0,0,'C');
$pdf->SetTextColor(34,68,136);
$pdf->Write(0,iconv('UTF-8','windows-1252',''));

$pdf->SetFont('helvetica','B', 15); 
$pdf->Cell(100,6,'Ventas',0,0,'C');
$pdf->Ln(10);
$pdf->SetTextColor(0, 0, 0); 

$pdf->SetFillColor(232,232,232);
$pdf->SetFont('helvetica','B',12); 
$pdf->Cell(25,5,'Habitacion',1,0,'C',1); 
$pdf->Cell(40,5,'Nombre',1,0,'C',1);
$pdf->Cell(37,5,'Fecha reserva',1,0,'C',1);
$pdf->Cell(25,5,'Check-In',1,0,'C',1);
$pdf->Cell(25,5,'Check-Out',1,0,'C',1);
$pdf->Cell(25,5,'Total (USD)',1,1,'C',1);
$pdf->SetFont('helvetica','',10);

$sqlFecha= ("SELECT * FROM reservacion NATURAL JOIN cliente NATURAL JOIN habitacion ORDER BY fecha_reserva ASC");

$query = mysqli_query($connection, $sqlFecha);

while ($dataRow = mysqli_fetch_array($query)) {
        $pdf->Cell(25,6,($dataRow['numeroHabitacion']),1,0,'C');
        $pdf->Cell(40,6,($dataRow['nombre']),1,0,'C');
        $pdf->Cell(37,6,($dataRow['fecha_reserva']),1,0,'C');
        $pdf->Cell(25,6,($dataRow['check_in']),1,0,'C');
        $pdf->Cell(25,6,($dataRow['check_out']),1,0,'C');
        $pdf->Cell(25,6,($dataRow['precioTotal']),1,1,'C');
    }

$pdf->Output('Resumen_Pedido_'.date('d_m_y').'.pdf', 'I'); 