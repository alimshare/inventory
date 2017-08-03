<?php 

	$pdf->AliasNbPages();
	$pdf->AddPage('P');

    // Content PDF          
	$pdf->Ln(15);	
    $pdf->setFont('Arial','B',14);
    $pdf->cell(0,10,"MINI PROPOSAL",0,0,'C',0); 
	$pdf->Ln(20);	

    $text = $data->background;

    $pdf->setFont('Arial','',10);
    $pdf->MultiCell(0,5,$text,0,'J',0);
    
    $pdf->Ln();
	$text = @$data->what .' '. @$data->why .' '. @$data->who .' '. @$data->where_location;
    $pdf->MultiCell(0,5,$text,0,'J',0);
	
	$pdf->Ln(15);

    $pdf->cell(30,5,"Requested by ",0,0,'L',0); 
    $pdf->cell(5,5,":",0,0,'C',0);
    $pdf->cell(30,5,$data->create_by,0,0,'L',0); 
    $pdf->Ln();
    $pdf->cell(30,5,"Date ",0,0,'L',0); 
    $pdf->cell(5,5,":",0,0,'C',0);
    $pdf->cell(30,5,$data->dateCreate,0,0,'L',0); 

	$pdf->Ln(20);	
	
    $pdf->cell(30,5,"Approved by ",0,0,'L',0); 
    $pdf->cell(5,5,":",0,0,'C',0);
    $pdf->cell(30,5,$data->submittoUsername,0,0,'L',0); 
    $pdf->Ln();
    $pdf->cell(30,5,"Date ",0,0,'L',0); 
    $pdf->cell(5,5,":",0,0,'C',0);
    $pdf->cell(30,5,date('Y-m-d'),0,0,'L',0); 


	// $pdf->Output();

?>