<?php
require('fpdf.php');

class PDF extends FPDF
{
	// Page header
	function Header()
	{
	    // Logo
	    $this->Image('../images/assets/header.png',10,6,180);
	    // Arial bold 15
	    $this->SetFont('Arial','B',15);
	    // Colors of frame, background and text
	    $this->SetDrawColor(0,80,180);
	    $this->SetFillColor(230,230,0);
	    $this->SetTextColor(220,50,50);
	    // Thickness of frame (1 mm)
	    $this->SetLineWidth(1);
	    $this->Cell(80);
	    // Title
	    $this->Cell(180,10,'Title',1,0,'C',true);
	    // Line break
	    $this->Ln(20);
	}

	// Page footer
	function Footer()
	{
	    // Position at 1.5 cm from bottom
	    $this->SetY(-15);
	    // Arial italic 8
	    $this->SetFont('Arial','I',8);
	    // Page number
	    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
for($i=1;$i<=40;$i++)
    $pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->Output();
?>